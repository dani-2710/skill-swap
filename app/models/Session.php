<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Session {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getUpcoming($userId) {
        $stmt = $this->db->prepare("
            SELECT s.*, sk.name as skill_name, u.full_name as other_user_name
            FROM sessions s
            JOIN skills sk ON s.skill_id = sk.id
            JOIN users u ON (s.requester_id = u.id AND s.provider_id = :user_id1) OR (s.provider_id = u.id AND s.requester_id = :user_id2)
            WHERE (s.requester_id = :user_id3 OR s.provider_id = :user_id4) 
              AND s.status = 'accepted'
              AND s.session_date >= CURDATE()
            ORDER BY s.session_date ASC, s.session_time ASC
            LIMIT 5
        ");
        $stmt->bindParam(':user_id1', $userId);
        $stmt->bindParam(':user_id2', $userId);
        $stmt->bindParam(':user_id3', $userId);
        $stmt->bindParam(':user_id4', $userId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPendingRequests($userId) {
        $stmt = $this->db->prepare("
            SELECT s.*, sk.name as skill_name, u.full_name as requester_name
            FROM sessions s
            JOIN skills sk ON s.skill_id = sk.id
            JOIN users u ON s.requester_id = u.id
            WHERE s.provider_id = :user_id
              AND s.status = 'pending'
            ORDER BY s.created_at DESC
        ");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO sessions (requester_id, provider_id, skill_id, title, session_date, session_time, duration) 
            VALUES (:requester_id, :provider_id, :skill_id, :title, :session_date, :session_time, :duration)
        ");
        
        $stmt->bindParam(':requester_id', $data['requester_id']);
        $stmt->bindParam(':provider_id', $data['provider_id']);
        $stmt->bindParam(':skill_id', $data['skill_id']);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':session_date', $data['session_date']);
        $stmt->bindParam(':session_time', $data['session_time']);
        $stmt->bindParam(':duration', $data['duration']);
        
        return $stmt->execute();
    }

    public function updateStatus($sessionId, $providerId, $status) {
        $stmt = $this->db->prepare("
            UPDATE sessions 
            SET status = :status 
            WHERE id = :id AND provider_id = :provider_id
        ");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $sessionId);
        $stmt->bindParam(':provider_id', $providerId);
        return $stmt->execute();
    }

    public function findById($sessionId) {
        $stmt = $this->db->prepare("
            SELECT s.*, sk.name as skill_name, u1.full_name as requester_name, u2.full_name as provider_name
            FROM sessions s
            JOIN skills sk ON s.skill_id = sk.id
            JOIN users u1 ON s.requester_id = u1.id
            JOIN users u2 ON s.provider_id = u2.id
            WHERE s.id = :id
        ");
        $stmt->bindParam(':id', $sessionId);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateMeeting($sessionId, $userId, $type, $link) {
        // Only the provider (teacher) can set the meeting link
        $stmt = $this->db->prepare("
            UPDATE sessions 
            SET meeting_type = :type, meeting_link = :link 
            WHERE id = :id AND provider_id = :user_id
        ");
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':id', $sessionId);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }

    public function countLearningSessions($userId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM sessions WHERE requester_id = :user_id AND status = 'accepted'");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
