<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Skill {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllWithUsers($status = 'active') {
        $where = '';
        if ($status !== 'all') {
            $where = "WHERE s.status = :status";
        }

        $stmt = $this->db->prepare("
            SELECT s.*, u.full_name, u.username, c.name as category_name
            FROM skills s
            JOIN users u ON s.user_id = u.id
            JOIN categories c ON s.category_id = c.id
            $where
            ORDER BY s.created_at DESC
        ");
        if ($status !== 'all') {
            $stmt->bindParam(':status', $status);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByUserId($userId) {
        $stmt = $this->db->prepare("
            SELECT s.*, c.name as category_name
            FROM skills s
            JOIN categories c ON s.category_id = c.id
            WHERE s.user_id = :user_id
              AND s.status = 'active'
            ORDER BY s.created_at DESC
        ");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $stmt = $this->db->prepare("
            SELECT s.*, c.name as category_name, u.full_name, u.username
            FROM skills s
            JOIN categories c ON s.category_id = c.id
            JOIN users u ON s.user_id = u.id
            WHERE s.id = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
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

    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE skills
            SET category_id = :category_id,
                name = :name,
                description = :description,
                type = :type,
                status = :status
            WHERE id = :id
        ");

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':type', $data['type']);
        $stmt->bindParam(':status', $data['status']);

        return $stmt->execute();
    }

    public function softDelete($id) {
        $stmt = $this->db->prepare("
            UPDATE skills
            SET status = 'deleted', deleted_at = CURRENT_TIMESTAMP
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function restore($id) {
        $stmt = $this->db->prepare("
            UPDATE skills
            SET status = 'active', deleted_at = NULL
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function countByType($userId, $type) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM skills WHERE user_id = :user_id AND type = :type AND status = 'active'");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function countByStatus($status = null) {
        if ($status) {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM skills WHERE status = :status");
            $stmt->bindParam(':status', $status);
        } else {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM skills");
        }
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
