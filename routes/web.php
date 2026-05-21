<?php

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\ChatController;
use App\Controllers\SkillController;
use App\Controllers\ProfileController;
use App\Controllers\SessionController;

/** @var \App\Core\Router $router */

$router->get('/', [HomeController::class, 'index']);

$router->get('/login', [AuthController::class, 'loginForm']);
$router->post('/login', [AuthController::class, 'login']);

$router->get('/register', [AuthController::class, 'registerForm']);
$router->post('/register', [AuthController::class, 'register']);

$router->get('/logout', [AuthController::class, 'logout']);

$router->get('/dashboard', [HomeController::class, 'dashboard']);

$router->get('/skills', [SkillController::class, 'index']);
$router->get('/skills/add', [SkillController::class, 'add']);
$router->post('/skills/add', [SkillController::class, 'add']);

$router->get('/profile', [ProfileController::class, 'index']);
$router->get('/profile/edit', [ProfileController::class, 'edit']);
$router->post('/profile/edit', [ProfileController::class, 'edit']);

$router->get('/sessions/request', [SessionController::class, 'request']);
$router->post('/sessions/request', [SessionController::class, 'request']);
$router->post('/sessions/accept', [SessionController::class, 'accept']);
$router->post('/sessions/reject', [SessionController::class, 'reject']);
$router->post('/sessions/meeting', [SessionController::class, 'meeting']);

$router->get('/chat', [ChatController::class, 'index']);
$router->get('/chat/getMessages', [ChatController::class, 'getMessages']);
$router->post('/chat/send', [ChatController::class, 'send']);
