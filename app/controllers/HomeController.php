<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Skill;
use App\Models\Message;
use App\Models\Session;

class HomeController extends Controller {
    public function index() {
        $this->view('home/index', [
            'title' => 'Welcome to SkillSwap'
        ]);
    }

    public function dashboard() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        $userId = $_SESSION['user_id'];
        
        $skillModel = new Skill();
        $skillsTeach = $skillModel->countByType($userId, 'teach');

        $sessionModel = new Session();
        $skillsLearn = $sessionModel->countLearningSessions($userId);

        $messageModel = new Message();
        $unreadMessages = $messageModel->getUnreadCount($userId);

        $sessionModel = new Session();
        $upcomingSessions = $sessionModel->getUpcoming($userId);
        $pendingRequests = $sessionModel->getPendingRequests($userId);

        $this->view('dashboard/index', [
            'title' => 'Dashboard',
            'skillsTeach' => $skillsTeach,
            'skillsLearn' => $skillsLearn,
            'unreadMessages' => $unreadMessages,
            'upcomingSessionsCount' => count($upcomingSessions),
            'upcomingSessions' => $upcomingSessions,
            'pendingRequests' => $pendingRequests
        ]);
    }
}
