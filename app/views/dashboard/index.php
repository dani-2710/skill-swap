<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white transition-colors duration-300">Dashboard</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 transition-colors duration-300">Welcome back, <?= htmlspecialchars($_SESSION['full_name']) ?>!</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="<?= BASE_URL ?>/skills/add" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add Skill
            </a>
            <a href="<?= BASE_URL ?>/profile" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-300">
                Edit Profile
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
        <!-- Stat Card 1 -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all duration-300">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-100 rounded-md p-3">
                        <svg class="h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate transition-colors duration-300">Skills I Teach</dt>
                            <dd class="text-2xl font-semibold text-gray-900 dark:text-white transition-colors duration-300"><?= $skillsTeach ?? 0 ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all duration-300">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-emerald-100 rounded-md p-3">
                        <svg class="h-6 w-6 text-secondary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate transition-colors duration-300">Skills I Learn</dt>
                            <dd class="text-2xl font-semibold text-gray-900 dark:text-white transition-colors duration-300"><?= $skillsLearn ?? 0 ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all duration-300">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                        <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate transition-colors duration-300">Upcoming Sessions</dt>
                            <dd class="text-2xl font-semibold text-gray-900 dark:text-white transition-colors duration-300"><?= $upcomingSessionsCount ?? 0 ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all duration-300">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                        <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate transition-colors duration-300">Unread Messages</dt>
                            <dd class="text-2xl font-semibold text-gray-900 dark:text-white transition-colors duration-300"><?= $unreadMessages ?? 0 ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Upcoming Sessions & Requests -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Pending Requests -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg border border-gray-100 dark:border-gray-700 transition-colors duration-300">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center transition-colors duration-300">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white transition-colors duration-300">Pending Requests</h3>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <?= count($pendingRequests ?? []) ?> New
                    </span>
                </div>
                
                <?php if (!empty($pendingRequests)): ?>
                    <ul class="divide-y divide-gray-100 dark:divide-gray-700 transition-colors duration-300">
                        <?php foreach($pendingRequests as $req): ?>
                            <li class="p-4 hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-300">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-tr from-primary to-secondary flex items-center justify-center text-white text-sm font-bold">
                                            <?= strtoupper(substr($req['requester_name'], 0, 1)) ?>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 transition-colors duration-300"><?= htmlspecialchars($req['requester_name']) ?> wants to learn <span class="text-primary font-bold"><?= htmlspecialchars($req['skill_name']) ?></span></p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 transition-colors duration-300"><?= htmlspecialchars($req['title']) ?> - <?= date('M d, Y', strtotime($req['session_date'])) ?> at <?= date('h:i A', strtotime($req['session_time'])) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <form action="<?= BASE_URL ?>/sessions/accept" method="POST" class="inline">
                                            <input type="hidden" name="session_id" value="<?= $req['id'] ?>">
                                            <button type="submit" class="bg-secondary text-white px-3 py-1 rounded-md text-xs font-medium hover:bg-emerald-600 transition">Accept</button>
                                        </form>
                                        <form action="<?= BASE_URL ?>/sessions/reject" method="POST" class="inline">
                                            <input type="hidden" name="session_id" value="<?= $req['id'] ?>">
                                            <button type="submit" class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 px-3 py-1 rounded-md text-xs font-medium hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-300">Decline</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="p-6 text-center text-gray-500 py-10">
                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <p>No pending session requests.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Upcoming Sessions -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg border border-gray-100 dark:border-gray-700 transition-colors duration-300">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-100 dark:border-gray-700 transition-colors duration-300">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white transition-colors duration-300">Upcoming Sessions</h3>
                </div>
                
                <?php if (!empty($upcomingSessions)): ?>
                    <ul class="divide-y divide-gray-100 dark:divide-gray-700 transition-colors duration-300">
                        <?php foreach($upcomingSessions as $sess): ?>
                            <li class="p-4 hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-300">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-blue-50 dark:bg-blue-900/30 p-2 rounded-lg text-primary dark:text-blue-400 text-center w-14 transition-colors duration-300">
                                            <span class="block text-xs font-bold uppercase"><?= date('M', strtotime($sess['session_date'])) ?></span>
                                            <span class="block text-xl font-bold"><?= date('d', strtotime($sess['session_date'])) ?></span>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-bold text-gray-900 dark:text-gray-100 transition-colors duration-300"><?= htmlspecialchars($sess['title']) ?></p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 transition-colors duration-300">with <?= htmlspecialchars($sess['other_user_name']) ?> • <?= htmlspecialchars($sess['skill_name']) ?></p>
                                        </div>
                                    </div>
                                    <div class="text-right flex flex-col items-end">
                                        <div>
                                            <span class="text-sm text-gray-900 dark:text-gray-100 font-medium transition-colors duration-300"><?= date('h:i A', strtotime($sess['session_time'])) ?></span>
                                            <span class="block text-xs text-gray-500 dark:text-gray-400 transition-colors duration-300"><?= $sess['duration'] ?> mins</span>
                                        </div>
                                        <div class="flex space-x-2 mt-2">
                                            <?php if ($sess['meeting_link']): ?>
                                                <a href="<?= htmlspecialchars($sess['meeting_link']) ?>" target="_blank" class="bg-emerald-500 text-white px-3 py-1 rounded-md text-xs font-medium hover:bg-emerald-600 transition">Join</a>
                                            <?php endif; ?>
                                            <a href="<?= BASE_URL ?>/chat?session=<?= $sess['id'] ?>" class="bg-primary text-white px-3 py-1 rounded-md text-xs font-medium hover:bg-indigo-700 transition">Chat</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="p-6 text-center text-gray-500 py-10">
                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p>You have no upcoming sessions.</p>
                        <a href="<?= BASE_URL ?>/skills" class="mt-3 inline-block text-primary hover:text-indigo-700 font-medium text-sm">Find someone to learn from &rarr;</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right Column: Recent Activity & Quick Links -->
        <div class="space-y-8">
            
            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg border border-gray-100 dark:border-gray-700 transition-colors duration-300">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-100 dark:border-gray-700 transition-colors duration-300">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white transition-colors duration-300">Quick Links</h3>
                </div>
                <div class="p-4">
                    <ul class="space-y-3">
                        <li>
                            <a href="<?= BASE_URL ?>/profile" class="group flex items-center p-3 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-300">
                                <div class="bg-gray-100 dark:bg-gray-800 p-2 rounded-md group-hover:bg-primary/10 transition-colors duration-300">
                                    <svg class="h-5 w-5 text-gray-500 group-hover:text-primary transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white transition-colors duration-300">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/skills" class="group flex items-center p-3 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-300">
                                <div class="bg-gray-100 dark:bg-gray-800 p-2 rounded-md group-hover:bg-primary/10 transition-colors duration-300">
                                    <svg class="h-5 w-5 text-gray-500 group-hover:text-primary transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white transition-colors duration-300">Explore Skills</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/chat" class="group flex items-center p-3 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-300">
                                <div class="bg-gray-100 dark:bg-gray-800 p-2 rounded-md group-hover:bg-primary/10 transition-colors duration-300">
                                    <svg class="h-5 w-5 text-gray-500 group-hover:text-primary transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white transition-colors duration-300">Messages</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
