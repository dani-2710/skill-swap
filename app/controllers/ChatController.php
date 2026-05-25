<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Message;
use App\Models\Session;

class ChatController extends Controller {
    public function index() {
        // Ensure user is logged in
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        $sessionId = isset($_GET['session']) ? (int)$_GET['session'] : null;
        $sessionDetails = null;
                $chatEnabled = false;
        $sessionIso = null;

        // Ensure timestamps are interpreted in the application timezone (UTC+3) 
        date_default_timezone_set('Asia/Riyadh'); // Adjust as needed for your locale

            $sessionModel = new Session();
            $sessionDetails = $sessionModel->findById($sessionId);

            // Validate that the session exists, is accepted and the user belongs to it
            $userId = $_SESSION['user_id'];
            if ($sessionDetails && $sessionDetails['status'] === 'accepted' &&
                ($sessionDetails['requester_id'] == $userId || $sessionDetails['provider_id'] == $userId)) {

            // Combine date and time strings; fallback if time stored without seconds
            // Parse session datetime using server timezone
            $sessionTimestamp = strtotime($sessionDetails['session_date'] . ' ' . $sessionDetails['session_time']);
            if ($sessionTimestamp === false) {
                // Fallback if missing seconds
                $sessionTimestamp = strtotime($sessionDetails['session_date'] . ' ' . $sessionDetails['session_time'] . ':00');
            }
            // Generate ISO 8601 string for client-side
            $sessionIso = date('c', $sessionTimestamp);
            $now = time();
            $chatEnabled = $now >= $sessionTimestamp;
            // Debug timestamps
            $debugNow = date('Y-m-d H:i:s', $now);
            $debugSession = $sessionTimestamp ? date('Y-m-d H:i:s', $sessionTimestamp) : 'invalid';      
            } else {
                $chatEnabled = false;
                $debugNow = null;
                $debugSession = null;
            }

        // Load conversations for the sidebar
        $messageModel = new Message();
        $conversations = $messageModel->getChatSessions($_SESSION['user_id'] ?? 0);

        $this->view('chat/index', [
            'title' => 'Messages - SkillSwap',
            'sessionDetails' => $sessionDetails,
            'sessionId' => $sessionId,
            'conversations' => $conversations,
            'chatEnabled' => $chatEnabled,
            'sessionIso' => $sessionIso,
            'debugNow' => $debugNow,
            'debugSession' => $debugSession,
        ]);
    }

    public function getMessages() {
        date_default_timezone_set('Asia/Riyadh');
        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);
            return;
        }
        $userId = $_SESSION['user_id'];
        $sessionId = isset($_GET['session_id']) ? (int)$_GET['session_id'] : 0;

        $sessionModel = new Session();
        $sessionDetails = $sessionModel->findById($sessionId);

        // Authorization check
        if (!$sessionDetails || $sessionDetails['status'] !== 'accepted' ||
            ($sessionDetails['requester_id'] != $userId && $sessionDetails['provider_id'] != $userId)) {
            http_response_code(403);
            return;
        }

        // Time gating – block access before the scheduled time
        $sessionDateTime = \DateTime::createFromFormat('Y-m-d H:i', $sessionDetails['session_date'] . ' ' . $sessionDetails['session_time'], new \DateTimeZone('Asia/Riyadh'));


$sessionTimestamp = $sessionDateTime ? $sessionDateTime->getTimestamp() : false;
        if ($sessionTimestamp === false) {
            // Fallback: parse without seconds; assume stored format may already include seconds
            $sessionTimestamp = strtotime($sessionDetails['session_date'] . ' ' . $sessionDetails['session_time']);
        }
        $now = time();
        if (!$sessionTimestamp || $now < $sessionTimestamp) {
            http_response_code(403);
            echo 'Chat unavailable until scheduled time.';
            return;
        }

        $messageModel = new Message();
        $messageModel->markAsRead($sessionId, $userId);
        $messages = $messageModel->getConversation($sessionId);

        foreach ($messages as $msg) {
            $isMe = $msg['sender_id'] == $userId;
            $class = $isMe ? 'is-me' : 'is-other';
            $time = date('H:i', strtotime($msg['created_at']));
            echo '<div class="message-row ' . $class . ' fade-in">';
            echo '  <div class="message-bubble">';
            echo        htmlspecialchars($msg['message']);
            echo '  </div>';
            echo '  <span class="message-time">' . $time . '</span>';
            echo '</div>';
        }
    }

    public function send() {
        // Ensure timestamps are interpreted in the application timezone (UTC+3)
        date_default_timezone_set('Asia/Riyadh');
        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);
            return;
        }
        $userId = $_SESSION['user_id'];
        $sessionId = isset($_POST['session_id']) ? (int)$_POST['session_id'] : 0;
        $message = trim($_POST['message'] ?? '');

        if (empty($message) || $sessionId <= 0) {
            http_response_code(400);
            echo 'Invalid input';
            return;
        }

        $sessionModel = new Session();
        $sessionDetails = $sessionModel->findById($sessionId);

        // Authorization check
        if (!$sessionDetails || $sessionDetails['status'] !== 'accepted' ||
            ($sessionDetails['requester_id'] != $userId && $sessionDetails['provider_id'] != $userId)) {
            http_response_code(403);
            return;
        }

        // Time gate – block sending before scheduled time
        $sessionDateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $sessionDetails['session_date'] . ' ' . $sessionDetails['session_time'], new \DateTimeZone('Asia/Riyadh'));
        if (!$sessionDateTime) {
            $sessionDateTime = \DateTime::createFromFormat('Y-m-d H:i', $sessionDetails['session_date'] . ' ' . $sessionDetails['session_time'], new \DateTimeZone('Asia/Riyadh'));
        }
        $sessionTimestamp = $sessionDateTime ? $sessionDateTime->getTimestamp() : false;
        if ($sessionTimestamp === false) {
            $sessionTimestamp = strtotime($sessionDetails['session_date'] . ' ' . $sessionDetails['session_time']);
        }
        if ($sessionTimestamp === false) {
            $sessionTimestamp = strtotime($sessionDetails['session_date'] . ' ' . $sessionDetails['session_time'] . ':00');
        }
        $now = time();
        if (!$sessionTimestamp || $now < $sessionTimestamp) {
            http_response_code(403);
            echo 'Cannot send messages before scheduled time.';
            return;
        }

        $receiverId = ($sessionDetails['requester_id'] == $userId) ? $sessionDetails['provider_id'] : $sessionDetails['requester_id'];
        $messageModel = new Message();
        $messageModel->send($sessionId, $userId, $receiverId, $message);
        echo 'Sent';
    }
}
?>
