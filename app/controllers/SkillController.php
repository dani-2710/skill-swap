<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Skill;
use App\Models\Category;

class SkillController extends Controller {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        $skillModel = new Skill();
        $skills = $skillModel->getAllWithUsers();

        $this->view('skills/index', [
            'title' => 'Browse Skills - SkillSwap',
            'skills' => $skills
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
}
