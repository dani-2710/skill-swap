<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Message {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getConversation($sessionId) {
        $stmt = $this->db->prepare("
            SELECT m.*, u.full_name as sender_name 
            FROM messages m
            JOIN users u ON m.sender_id = u.id
            WHERE m.session_id = :session_id
            ORDER BY m.created_at ASC
        ");
        $stmt->bindParam(':session_id', $sessionId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function send($sessionId, $senderId, $receiverId, $message) {
        $stmt = $this->db->prepare("
            INSERT INTO messages (session_id, sender_id, receiver_id, message) 
            VALUES (:session_id, :sender_id, :receiver_id, :message)
        ");
        $stmt->bindParam(':session_id', $sessionId);
        $stmt->bindParam(':sender_id', $senderId);
        $stmt->bindParam(':receiver_id', $receiverId);
        $stmt->bindParam(':message', $message);
        return $stmt->execute();
    }

    public function getUnreadCount($userId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM messages WHERE receiver_id = :user_id AND is_read = FALSE");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getChatSessions($userId) {
        $stmt = $this->db->prepare("
            SELECT s.id as session_id, s.title, s.meeting_link, s.meeting_type, 
                   sk.name as skill_name, 
                   u.full_name as other_name, u.username as other_username, u.id as other_user_id,
                   (SELECT COUNT(*) FROM messages WHERE session_id = s.id AND receiver_id = :userId_sum AND is_read = FALSE) as unread_count
            FROM sessions s
            JOIN skills sk ON s.skill_id = sk.id
            JOIN users u ON (s.requester_id = u.id AND s.provider_id = :userId1) OR (s.provider_id = u.id AND s.requester_id = :userId2)
            WHERE (s.requester_id = :userId3 OR s.provider_id = :userId4) 
              AND s.status = 'accepted'
        ");
        $stmt->bindParam(':userId_sum', $userId);
        $stmt->bindParam(':userId1', $userId);
        $stmt->bindParam(':userId2', $userId);
        $stmt->bindParam(':userId3', $userId);
        $stmt->bindParam(':userId4', $userId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function markAsRead($sessionId, $receiverId) {
        $stmt = $this->db->prepare("
            UPDATE messages 
            SET is_read = TRUE 
            WHERE session_id = :session_id AND receiver_id = :receiver_id AND is_read = FALSE
        ");
        $stmt->bindParam(':session_id', $sessionId);
        $stmt->bindParam(':receiver_id', $receiverId);
        return $stmt->execute();
    }
}
