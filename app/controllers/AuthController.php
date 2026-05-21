<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller {
    public function loginForm() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/dashboard');
        }
        $this->view('auth/login', [
            'title' => 'Login - SkillSwap'
        ]);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['role'] = $user['role'];
                
                $this->redirect('/dashboard');
            } else {
                $this->view('auth/login', [
                    'title' => 'Login - SkillSwap',
                    'error' => 'Invalid email or password.'
                ]);
            }
        }
    }

    public function registerForm() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/dashboard');
        }
        $this->view('auth/register', [
            'title' => 'Register - SkillSwap'
        ]);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullName = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $passwordConfirm = $_POST['password_confirm'];

            $errors = [];

            if ($password !== $passwordConfirm) {
                $errors[] = 'Passwords do not match.';
            }

            $userModel = new User();
            
            if ($userModel->findByEmail($email)) {
                $errors[] = 'Email is already registered.';
            }

            if ($userModel->findByUsername($username)) {
                $errors[] = 'Username is already taken.';
            }

            if (empty($errors)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $userId = $userModel->create([
                    'full_name' => $fullName,
                    'username' => $username,
                    'email' => $email,
                    'password' => $hashedPassword
                ]);

                if ($userId) {
                    $_SESSION['user_id'] = $userId;
                    $_SESSION['username'] = $username;
                    $_SESSION['full_name'] = $fullName;
                    $_SESSION['role'] = 'student';
                    
                    $this->redirect('/dashboard');
                } else {
                    $errors[] = 'Something went wrong. Please try again.';
                }
            }

            $this->view('auth/register', [
                'title' => 'Register - SkillSwap',
                'errors' => $errors,
                'input' => [
                    'full_name' => $fullName,
                    'username' => $username,
                    'email' => $email
                ]
            ]);
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect('/');
    }
}
