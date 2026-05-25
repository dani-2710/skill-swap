<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Skill;
use App\Models\Category;

class SkillController extends Controller {
    private function canManageSkill($skill) {
        return $skill
            && ((int)$skill['user_id'] === (int)$_SESSION['user_id']
            || (($_SESSION['role'] ?? 'student') === 'admin'));
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        $skillModel = new Skill();
        $status = $_GET['status'] ?? 'active';
        if (($_SESSION['role'] ?? 'student') !== 'admin') {
            $status = 'active';
        }
        if (!in_array($status, ['active', 'deleted', 'all'], true)) {
            $status = 'active';
        }
        $skills = $skillModel->getAllWithUsers($status);

        $this->view('skills/index', [
            'title' => 'Browse Skills - SkillSwap',
            'skills' => $skills,
            'status' => $status
        ]);
    }

    public function add() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $_SESSION['user_id'],
                'category_id' => filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT),
                'name' => filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING),
                'description' => filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING),
                'type' => filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING)
            ];

            $skillModel = new Skill();
            if ($skillModel->create($data)) {
                $this->redirect('/dashboard');
            } else {
                $this->view('skills/add', [
                    'title' => 'Add Skill - SkillSwap',
                    'categories' => $categories,
                    'error' => 'Failed to add skill.'
                ]);
                return;
            }
        }

        $this->view('skills/add', [
            'title' => 'Add Skill - SkillSwap',
            'categories' => $categories
        ]);
    }

    public function edit($id) {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        $skillModel = new Skill();
        $skill = $skillModel->findById((int)$id);

        if (!$this->canManageSkill($skill)) {
            $this->redirect('/skills');
        }

        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? $skill['status'];
            if (($_SESSION['role'] ?? 'student') !== 'admin') {
                $status = $skill['status'] === 'deleted' ? 'deleted' : 'active';
            }

            $data = [
                'category_id' => filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT),
                'name' => filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING),
                'description' => filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING),
                'type' => filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING),
                'status' => in_array($status, ['active', 'deleted'], true) ? $status : 'active'
            ];

            if ($skillModel->update((int)$id, $data)) {
                $this->redirect('/skills');
            }

            $this->view('skills/edit', [
                'title' => 'Edit Skill - SkillSwap',
                'categories' => $categories,
                'skill' => array_merge($skill, $data),
                'error' => 'Failed to update skill.'
            ]);
            return;
        }

        $this->view('skills/edit', [
            'title' => 'Edit Skill - SkillSwap',
            'categories' => $categories,
            'skill' => $skill
        ]);
    }

    public function delete($id) {
        if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
        }

        $skillModel = new Skill();
        $skill = $skillModel->findById((int)$id);

        if ($this->canManageSkill($skill)) {
            $skillModel->softDelete((int)$id);
        }

        $this->redirect('/skills');
    }
}
