<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Skill {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllWithUsers() {
        $stmt = $this->db->query("
            SELECT s.*, u.full_name, u.username, c.name as category_name
            FROM skills s
            JOIN users u ON s.user_id = u.id
            JOIN categories c ON s.category_id = c.id
            ORDER BY s.created_at DESC
        ");
        return $stmt->fetchAll();
    }

    public function getByUserId($userId) {
        $stmt = $this->db->prepare("
            SELECT s.*, c.name as category_name
            FROM skills s
            JOIN categories c ON s.category_id = c.id
            WHERE s.user_id = :user_id
            ORDER BY s.created_at DESC
        ");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO skills (user_id, category_id, name, description, type) 
            VALUES (:user_id, :category_id, :name, :description, :type)
        ");
        
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':type', $data['type']);
        
        return $stmt->execute();
    }

    public function countByType($userId, $type) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM skills WHERE user_id = :user_id AND type = :type");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
