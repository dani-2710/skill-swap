<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Session;
use App\Models\Skill;

class SessionController extends Controller {
    
    public function request() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        $skillId = isset($_GET['skill_id']) ? (int)$_GET['skill_id'] : 0;
        
        // Find skill
        $skillModel = new \App\Models\Skill();
        $db = \App\Core\Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT s.*, u.full_name, u.id as provider_id FROM skills s JOIN users u ON s.user_id = u.id WHERE s.id = :id");
        $stmt->bindParam(':id', $skillId);
        $stmt->execute();
        $skill = $stmt->fetch();

        if (!$skill || $skill['provider_id'] == $_SESSION['user_id']) {
            $this->redirect('/skills');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'requester_id' => $_SESSION['user_id'],
                'provider_id' => $skill['provider_id'],
                'skill_id' => $skillId,
                'title' => filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING),
                'session_date' => $_POST['session_date'],
                'session_time' => $_POST['session_time'],
                'duration' => (int)$_POST['duration']
            ];

            $sessionModel = new Session();
            if ($sessionModel->create($data)) {
                $this->redirect('/dashboard');
            } else {
                $this->view('sessions/request', [
                    'title' => 'Request Session - SkillSwap',
                    'skill' => $skill,
                    'error' => 'Failed to send session request.'
                ]);
                return;
            }
        }

        $this->view('sessions/request', [
            'title' => 'Request Session - SkillSwap',
            'skill' => $skill
        ]);
    }

    public function accept() {
        if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
        }

        $sessionId = isset($_POST['session_id']) ? (int)$_POST['session_id'] : 0;
        $sessionModel = new Session();
        $sessionModel->updateStatus($sessionId, $_SESSION['user_id'], 'accepted');
        
        $this->redirect('/dashboard');
    }

    public function reject() {
        if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
        }

        $sessionId = isset($_POST['session_id']) ? (int)$_POST['session_id'] : 0;
        $sessionModel = new Session();
        $sessionModel->updateStatus($sessionId, $_SESSION['user_id'], 'rejected');
        
        $this->redirect('/dashboard');
    }

    public function meeting() {
        if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
        }

        $sessionId = isset($_POST['session_id']) ? (int)$_POST['session_id'] : 0;
        $type = filter_input(INPUT_POST, 'meeting_type', FILTER_SANITIZE_STRING);
        $link = filter_input(INPUT_POST, 'meeting_link', FILTER_SANITIZE_STRING); // Can be URL or username

        $sessionModel = new Session();
        $sessionModel->updateMeeting($sessionId, $_SESSION['user_id'], $type, $link);
        
        $this->redirect('/chat?session=' . $sessionId);
    }
}
