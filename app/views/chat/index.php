<div class="chat-page">
    <div class="chat-shell card">
        <aside class="chat-sidebar">
            <div class="chat-sidebar-head">
                <h2 class="section-title">Session Chats</h2>
                <div class="search-field">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="chat-search" class="input" placeholder="Search sessions...">
                </div>
            </div>

            <div class="chat-list">
                <?php if (!empty($conversations)): ?>
                    <?php foreach ($conversations as $conv): ?>
                        <a href="?session=<?= $conv['session_id'] ?>" class="chat-item <?= $sessionId == $conv['session_id'] ? 'active' : '' ?>" data-title="<?= strtolower(htmlspecialchars($conv['title'])) ?>" data-name="<?= strtolower(htmlspecialchars($conv['other_name'])) ?>">
                            <div class="avatar"><?= strtoupper(substr($conv['skill_name'], 0, 1)) ?></div>
                            <div class="chat-item-body">
                                <div class="chat-item-title-row">
                                    <p class="chat-item-title"><?= htmlspecialchars($conv['title']) ?></p>
                                    <?php if ($conv['unread_count'] > 0): ?>
                                        <span class="chat-unread"><?= $conv['unread_count'] ?></span>
                                    <?php endif; ?>
                                </div>
                                <p class="chat-item-meta">with <?= htmlspecialchars($conv['other_name']) ?></p>
                                <p class="chat-item-skill"><?= htmlspecialchars($conv['skill_name']) ?></p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <p>No active session chats. Request a session first!</p>
                    </div>
                <?php endif; ?>
            </div>
        </aside>

        <section class="chat-main">
            <?php if ($sessionDetails):
                $otherUserName = ($sessionDetails['requester_id'] == $_SESSION['user_id']) ? $sessionDetails['provider_name'] : $sessionDetails['requester_name'];
            ?>
                <div class="chat-header">
                    <div class="owner-row">
                        <div class="avatar"><?= strtoupper(substr($otherUserName, 0, 1)) ?></div>
                        <div>
                            <h3 class="section-title"><?= htmlspecialchars($sessionDetails['title']) ?></h3>
                            <p class="table-secondary">with <?= htmlspecialchars($otherUserName) ?> / <?= htmlspecialchars($sessionDetails['skill_name']) ?></p>
                        </div>
                    </div>
                    <div class="inline-actions">
                        <?php if (!empty($sessionDetails['meeting_link'])): ?>
                            <a href="<?= htmlspecialchars($sessionDetails['meeting_link']) ?>" target="_blank" class="btn-success btn-sm">
                                Join <?= htmlspecialchars($sessionDetails['meeting_type']) ?> Session
                            </a>
                            <?php if ($sessionDetails['provider_id'] == $_SESSION['user_id']): ?>
                                <button onclick="document.getElementById('meeting-modal').classList.remove('is-hidden')" class="btn-outline btn-sm" title="Edit Meeting Link">Edit Link</button>
                            <?php endif; ?>
                        <?php elseif ($sessionDetails['provider_id'] == $_SESSION['user_id']): ?>
                            <button onclick="document.getElementById('meeting-modal').classList.remove('is-hidden')" class="btn-outline btn-sm">Set Meeting Link</button>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="chat-messages" id="chat-messages" <?= $chatEnabled ? 'data-session-id="' . $sessionDetails['id'] . '"' : '' ?> data-session-datetime="<?php echo $sessionIso; ?>"></div>

                <div class="chat-input">
                    <form id="chat-form" action="<?= BASE_URL ?>/chat/send" method="POST" class="chat-form <?= $chatEnabled ? '' : 'is-hidden' ?>">
                        <input type="hidden" name="session_id" value="<?= $sessionDetails['id'] ?>">
                        <div class="field chat-message-field">
                            <textarea id="message-input" name="message" rows="1" class="message-input" placeholder="Type a message..."></textarea>
                        </div>
                        <button type="submit" class="btn-icon" aria-label="Send message">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                            </svg>
                        </button>
                    </form>

                    <div id="lock-screen" class="<?= $chatEnabled ? 'is-hidden' : '' ?> chat-lock">
                        <p class="section-title">Chat will unlock soon</p>
                        <p id="countdown" class="subtitle"></p>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const sessionDtStr = "<?= $sessionIso ?>";
                        if (!sessionDtStr) return;
                        const sessionDt = new Date(sessionDtStr.replace(' ', 'T'));
                        const sessionId = "<?= $sessionDetails['id'] ?>";
                        const lockScreen = document.getElementById('lock-screen');
                        const chatForm = document.getElementById('chat-form');
                        const chatMessages = document.getElementById('chat-messages');
                        let pollInterval = null;

                        function unlockChat() {
                            if (lockScreen) lockScreen.classList.add('is-hidden');
                            if (chatForm) chatForm.classList.remove('is-hidden');
                            if (chatMessages && !chatMessages.dataset.sessionId) {
                                chatMessages.dataset.sessionId = sessionId;
                                if (typeof fetchMessages === 'function') {
                                    fetchMessages(sessionId);
                                    if (!pollInterval) pollInterval = setInterval(() => { fetchMessages(sessionId); }, 3000);
                                }
                                if (chatForm && typeof sendMessage === 'function') {
                                    chatForm.addEventListener('submit', (e) => {
                                        e.preventDefault();
                                        sendMessage();
                                    });
                                }
                            }
                        }

                        function updateCountdown() {
                            const diff = sessionDt - new Date();
                            if (diff <= 0) {
                                unlockChat();
                                return;
                            }
                            const hrs = Math.floor(diff / 3600000);
                            const mins = Math.floor((diff % 3600000) / 60000);
                            const secs = Math.floor((diff % 60000) / 1000);
                            const countdownEl = document.getElementById('countdown');
                            if (countdownEl) countdownEl.textContent = `${hrs}h ${mins}m ${secs}s`;
                        }

                        if (!<?= $chatEnabled ? 'true' : 'false' ?>) {
                            setInterval(updateCountdown, 1000);
                            updateCountdown();
                        }
                    });
                </script>
            <?php else: ?>
                <div class="chat-empty">
                    <div>
                        <div class="chat-empty-icon">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                            </svg>
                        </div>
                        <p class="section-title">Session Chat</p>
                        <p class="subtitle">Select an accepted session from the sidebar to start discussing the details and sharing meeting links.</p>
                    </div>
                </div>
            <?php endif; ?>
        </section>
    </div>
</div>

<?php if ($sessionDetails): ?>
<div id="meeting-modal" class="modal is-hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="modal-backdrop" onclick="document.getElementById('meeting-modal').classList.add('is-hidden')"></div>
    <div class="modal-shell">
        <div class="modal-card">
            <div class="sr-only-text">
                <h3 class="section-title" id="modal-title">Set Meeting Details</h3>
                <p class="subtitle">Provide a link for your learning session.</p>
            </div>
            <form action="<?= BASE_URL ?>/sessions/meeting" method="POST" class="form-stack">
                <input type="hidden" name="session_id" value="<?= $sessionDetails['id'] ?>">
                <div class="field">
                    <label>Meeting Type</label>
                    <select name="meeting_type" required>
                        <option value="Google Meet" <?= ($sessionDetails['meeting_type'] ?? '') == 'Google Meet' ? 'selected' : '' ?>>Google Meet</option>
                        <option value="Zoom" <?= ($sessionDetails['meeting_type'] ?? '') == 'Zoom' ? 'selected' : '' ?>>Zoom</option>
                        <option value="Discord" <?= ($sessionDetails['meeting_type'] ?? '') == 'Discord' ? 'selected' : '' ?>>Discord</option>
                        <option value="Telegram" <?= ($sessionDetails['meeting_type'] ?? '') == 'Telegram' ? 'selected' : '' ?>>Telegram</option>
                        <option value="Other" <?= ($sessionDetails['meeting_type'] ?? '') == 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
                <div class="field">
                    <label>Meeting Link / Username</label>
                    <input type="text" name="meeting_link" value="<?= htmlspecialchars($sessionDetails['meeting_link'] ?? '') ?>" required>
                </div>
                <div class="modal-actions">
                    <button type="submit" class="btn">Save</button>
                    <button type="button" class="btn-outline" onclick="document.getElementById('meeting-modal').classList.add('is-hidden')">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatSearch = document.getElementById('chat-search');
    const chatItems = document.querySelectorAll('.chat-item');

    if (chatSearch) {
        chatSearch.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            chatItems.forEach(item => {
                const title = item.getAttribute('data-title') || '';
                const name = item.getAttribute('data-name') || '';
                item.style.display = title.includes(query) || name.includes(query) ? '' : 'none';
            });
        });
    }
});
</script>
