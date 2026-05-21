<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Profile;

class ProfileController extends Controller {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        $profileModel = new Profile();
        $profile = $profileModel->getByUserId($_SESSION['user_id']);

        $this->view('profile/index', [
            'title' => 'My Profile - SkillSwap',
            'profile' => $profile
        ]);
    }

    public function edit() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        $profileModel = new Profile();
        $userModel = new \App\Models\User();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentUser = $userModel->findById($_SESSION['user_id']);
            
            if (isset($_POST['change_password'])) {
                $currentPassword = $_POST['current_password'] ?? '';
                $newPassword = $_POST['new_password'] ?? '';
                $confirmPassword = $_POST['confirm_password'] ?? '';
                
                if (empty($currentPassword) || !password_verify($currentPassword, $currentUser['password'])) {
                    $error = 'Current password is incorrect.';
                    $profile = $profileModel->getByUserId($_SESSION['user_id']);
                    $this->view('profile/edit', [
                        'title' => 'Edit Profile - SkillSwap',
                        'profile' => $profile,
                        'user' => $currentUser,
                        'password_error' => $error
                    ]);
                    return;
                }
                
                if ($newPassword !== $confirmPassword) {
                    $error = 'New password and confirmation do not match.';
                    $profile = $profileModel->getByUserId($_SESSION['user_id']);
                    $this->view('profile/edit', [
                        'title' => 'Edit Profile - SkillSwap',
                        'profile' => $profile,
                        'user' => $currentUser,
                        'password_error' => $error
                    ]);
                    return;
                }
                
                $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                $userUpdated = $userModel->updateProfileData($_SESSION['user_id'], $currentUser['full_name'], $currentUser['username'], $passwordHash);
                
                if ($userUpdated) {
                    $this->redirect('/profile');
                } else {
                    $profile = $profileModel->getByUserId($_SESSION['user_id']);
                    $this->view('profile/edit', [
                        'title' => 'Edit Profile - SkillSwap',
                        'profile' => $profile,
                        'user' => $currentUser,
                        'password_error' => 'Failed to change password.'
                    ]);
                    return;
                }
            } else {
                $bio = filter_input(INPUT_POST, 'bio', FILTER_SANITIZE_STRING);
                $availability = filter_input(INPUT_POST, 'availability_status', FILTER_SANITIZE_STRING);
                
                $fullName = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
                $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

                // Validate username uniqueness if changed
                if ($username !== $currentUser['username']) {
                    $existingUser = $userModel->findByUsername($username);
                    if ($existingUser) {
                        $profile = $profileModel->getByUserId($_SESSION['user_id']);
                        $this->view('profile/edit', [
                            'title' => 'Edit Profile - SkillSwap',
                            'profile' => $profile,
                            'user' => $currentUser,
                            'profile_error' => 'Username is already taken.'
                        ]);
                        return;
                    }
                }

                $profileData = [
                    'bio' => $bio,
                    'availability_status' => $availability
                ];

                $profileUpdated = $profileModel->update($_SESSION['user_id'], $profileData);
                $userUpdated = $userModel->updateProfileData($_SESSION['user_id'], $fullName, $username, null);

                if ($profileUpdated && $userUpdated) {
                    // Update session vars
                    $_SESSION['full_name'] = $fullName;
                    $_SESSION['username'] = $username;
                    $this->redirect('/profile');
                } else {
                    $profile = $profileModel->getByUserId($_SESSION['user_id']);
                    $this->view('profile/edit', [
                        'title' => 'Edit Profile - SkillSwap',
                        'profile' => $profile,
                        'user' => $currentUser,
                        'profile_error' => 'Failed to update profile.'
                    ]);
                    return;
                }
            }
        }

        $profile = $profileModel->getByUserId($_SESSION['user_id']);
        $currentUser = $userModel->findById($_SESSION['user_id']);
        $this->view('profile/edit', [
            'title' => 'Edit Profile - SkillSwap',
            'profile' => $profile,
            'user' => $currentUser
        ]);
    }
}
