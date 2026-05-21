<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Profile {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getByUserId($userId) {
        $stmt = $this->db->prepare("
            SELECT p.*, u.full_name, u.username, u.email 
            FROM profiles p
            JOIN users u ON p.user_id = u.id
            WHERE p.user_id = :user_id
        ");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $profile = $stmt->fetch();
        
        // If profile doesn't exist, return basic user info
        if (!$profile) {
            $stmt = $this->db->prepare("SELECT id as user_id, full_name, username, email FROM users WHERE id = :user_id");
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            $profile = $stmt->fetch();
            $profile['bio'] = '';
            $profile['profile_picture'] = 'default.png';
            $profile['availability_status'] = 'available';
        }
        
        return $profile;
    }

    public function update($userId, $data) {
        // Check if profile exists
        $stmt = $this->db->prepare("SELECT id FROM profiles WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        
        if ($stmt->fetch()) {
            // Update existing
            $stmt = $this->db->prepare("
                UPDATE profiles 
                SET bio = :bio, availability_status = :availability_status 
                WHERE user_id = :user_id
            ");
        } else {
            // Insert new
            $stmt = $this->db->prepare("
                INSERT INTO profiles (user_id, bio, availability_status) 
                VALUES (:user_id, :bio, :availability_status)
            ");
        }
        
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':bio', $data['bio']);
        $stmt->bindParam(':availability_status', $data['availability_status']);
        
        return $stmt->execute();
    }
}
