<div class="wide-page">
    <div class="page-header">
        <div>
            <h1 class="title">Dashboard</h1>
            <p class="subtitle">Welcome back, <?= htmlspecialchars($_SESSION['full_name']) ?>!</p>
        </div>
        <div class="inline-actions">
            <a href="<?= BASE_URL ?>/skills/add" class="btn">Add Skill</a>
            <a href="<?= BASE_URL ?>/profile" class="btn-outline">Edit Profile</a>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card card">
            <div class="stat-row">
                <div class="stat-icon">T</div>
                <dl>
                    <dt>Skills I Teach</dt>
                    <dd><?= $skillsTeach ?? 0 ?></dd>
                </dl>
            </div>
        </div>
        <div class="stat-card card">
            <div class="stat-row">
                <div class="stat-icon">L</div>
                <dl>
                    <dt>Skills I Learn</dt>
                    <dd><?= $skillsLearn ?? 0 ?></dd>
                </dl>
            </div>
        </div>
        <div class="stat-card card">
            <div class="stat-row">
                <div class="stat-icon">S</div>
                <dl>
                    <dt>Upcoming Sessions</dt>
                    <dd><?= $upcomingSessionsCount ?? 0 ?></dd>
                </dl>
            </div>
        </div>
        <div class="stat-card card">
            <div class="stat-row">
                <div class="stat-icon">M</div>
                <dl>
                    <dt>Unread Messages</dt>
                    <dd><?= $unreadMessages ?? 0 ?></dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="content-grid spaced-top">
        <div class="stack">
            <section class="panel">
                <div class="section-header">
                    <h3 class="section-title">Pending Requests</h3>
                    <span class="badge-warning"><?= count($pendingRequests ?? []) ?> New</span>
                </div>

                <?php if (!empty($pendingRequests)): ?>
                    <ul class="list">
                        <?php foreach($pendingRequests as $req): ?>
                            <li>
                                <div class="request-row">
                                    <div class="owner-row">
                                        <div class="avatar"><?= strtoupper(substr($req['requester_name'], 0, 1)) ?></div>
                                        <div>
                                            <p class="table-primary"><?= htmlspecialchars($req['requester_name']) ?> wants to learn <span class="primary-text"><?= htmlspecialchars($req['skill_name']) ?></span></p>
                                            <p class="table-secondary"><?= htmlspecialchars($req['title']) ?> - <?= date('M d, Y', strtotime($req['session_date'])) ?> at <?= date('h:i A', strtotime($req['session_time'])) ?></p>
                                        </div>
                                    </div>
                                    <div class="inline-actions">
                                        <form action="<?= BASE_URL ?>/sessions/accept" method="POST">
                                            <input type="hidden" name="session_id" value="<?= $req['id'] ?>">
                                            <button type="submit" class="btn-success btn-sm">Accept</button>
                                        </form>
                                        <form action="<?= BASE_URL ?>/sessions/reject" method="POST">
                                            <input type="hidden" name="session_id" value="<?= $req['id'] ?>">
                                            <button type="submit" class="btn-outline btn-sm">Decline</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="empty-state">
                        <p>No pending session requests.</p>
                    </div>
                <?php endif; ?>
            </section>

            <section class="panel">
                <div class="section-header">
                    <h3 class="section-title">Upcoming Sessions</h3>
                </div>

                <?php if (!empty($upcomingSessions)): ?>
                    <ul class="list">
                        <?php foreach($upcomingSessions as $sess): ?>
                            <li>
                                <div class="session-row">
                                    <div class="owner-row">
                                        <div class="date-pill">
                                            <span class="date-month"><?= date('M', strtotime($sess['session_date'])) ?></span>
                                            <span class="date-day"><?= date('d', strtotime($sess['session_date'])) ?></span>
                                        </div>
                                        <div>
                                            <p class="table-primary"><?= htmlspecialchars($sess['title']) ?></p>
                                            <p class="table-secondary">with <?= htmlspecialchars($sess['other_user_name']) ?> / <?= htmlspecialchars($sess['skill_name']) ?></p>
                                        </div>
                                    </div>
                                    <div class="inline-actions">
                                        <div>
                                            <p class="table-primary"><?= date('h:i A', strtotime($sess['session_time'])) ?></p>
                                            <p class="table-secondary"><?= $sess['duration'] ?> mins</p>
                                        </div>
                                        <?php if ($sess['meeting_link']): ?>
                                            <a href="<?= htmlspecialchars($sess['meeting_link']) ?>" target="_blank" class="btn-success btn-sm">Join</a>
                                        <?php endif; ?>
                                        <a href="<?= BASE_URL ?>/chat?session=<?= $sess['id'] ?>" class="btn btn-sm">Chat</a>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="empty-state">
                        <p>You have no upcoming sessions.</p>
                        <a href="<?= BASE_URL ?>/skills" class="btn-link">Find someone to learn from</a>
                    </div>
                <?php endif; ?>
            </section>
        </div>

        <aside class="panel">
            <div class="section-header">
                <h3 class="section-title">Quick Links</h3>
            </div>
            <div class="panel-body">
                <ul class="list">
                    <li><a href="<?= BASE_URL ?>/profile" class="quick-link"><span class="quick-icon">P</span><span>My Profile</span></a></li>
                    <li><a href="<?= BASE_URL ?>/skills" class="quick-link"><span class="quick-icon">S</span><span>Explore Skills</span></a></li>
                    <li><a href="<?= BASE_URL ?>/chat" class="quick-link"><span class="quick-icon">M</span><span>Messages</span></a></li>
                </ul>
            </div>
        </aside>
    </div>
</div>
