<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Skill;
use App\Models\User;

class AdminController extends Controller {
    private function requireAdmin() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        if (($_SESSION['role'] ?? 'student') !== 'admin') {
            http_response_code(403);
            die('403 Forbidden');
        }
    }

    public function index() {
        $this->requireAdmin();

        $userModel = new User();
        $skillModel = new Skill();

        $users = $userModel->getAll();
        $skills = $skillModel->getAllWithUsers('all');

        $this->view('admin/index', [
            'title' => 'Admin - SkillSwap',
            'users' => $users,
            'skills' => $skills,
            'userCount' => count($users),
            'activeSkillsCount' => $skillModel->countByStatus('active'),
            'deletedSkillsCount' => $skillModel->countByStatus('deleted')
        ]);
    }

    public function updateUserRole() {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin');
        }

        $userId = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
        $role = $_POST['role'] ?? 'student';

        if ($userId !== (int)$_SESSION['user_id'] && in_array($role, ['student', 'admin'], true)) {
            $userModel = new User();
            $userModel->updateRole($userId, $role);
        }

        $this->redirect('/admin');
    }

    public function restoreSkill() {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $skillId = isset($_POST['skill_id']) ? (int)$_POST['skill_id'] : 0;
            $skillModel = new Skill();
            $skillModel->restore($skillId);
        }

        $this->redirect('/admin');
    }
}
