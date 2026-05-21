<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 h-[calc(100vh-140px)] flex flex-col">
    <div class="flex-grow flex overflow-hidden bg-white shadow-xl rounded-2xl border border-gray-100">
        
        <!-- Sidebar: Chat List -->
        <div class="w-1/3 border-r border-gray-100 flex flex-col bg-gray-50/50">
            <div class="p-4 border-b border-gray-100 bg-white">
                <h2 class="text-lg font-semibold text-gray-800">Session Chats</h2>
                <div class="mt-2 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" id="chat-search" class="focus:ring-primary focus:border-primary block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-2 bg-gray-50" placeholder="Search sessions...">
                </div>
            </div>
            
            <div class="flex-grow overflow-y-auto">
                <?php if (!empty($conversations)): ?>
                    <?php foreach ($conversations as $conv): ?>
                        <a href="?session=<?= $conv['session_id'] ?>" class="chat-item flex items-center px-4 py-3 transition <?= $sessionId == $conv['session_id'] ? 'border-l-4 border-primary bg-indigo-50 shadow-sm' : 'border-l-4 border-transparent hover:bg-gray-100' ?>" data-title="<?= strtolower(htmlspecialchars($conv['title'])) ?>" data-name="<?= strtolower(htmlspecialchars($conv['other_name'])) ?>">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-lg bg-gradient-to-tr from-primary to-secondary flex items-center justify-center text-white font-bold shadow">
                                    <?= strtoupper(substr($conv['skill_name'], 0, 1)) ?>
                                </div>
                            </div>
                            <div class="ml-3 flex-1 overflow-hidden">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-bold truncate <?= $sessionId == $conv['session_id'] ? 'text-primary' : 'text-gray-900' ?>"><?= htmlspecialchars($conv['title']) ?></p>
                                    <?php if ($conv['unread_count'] > 0): ?>
                                        <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-primary text-white text-[10px] font-bold">
                                            <?= $conv['unread_count'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <p class="text-sm text-gray-500 truncate">with <?= htmlspecialchars($conv['other_name']) ?></p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="p-8 text-center text-gray-500">
                        <p class="text-sm">No active session chats. Request a session first!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="flex-1 flex flex-col bg-white/50 backdrop-blur-sm relative">
            <?php if ($sessionDetails):
                $otherUserName = ($sessionDetails['requester_id'] == $_SESSION['user_id']) ? $sessionDetails['provider_name'] : $sessionDetails['requester_name'];
            ?>
                <!-- Chat Header -->
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-white/80 backdrop-blur-md z-10 shadow-sm">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-gradient-to-tr from-primary to-secondary flex items-center justify-center text-white font-bold">
                            <?= strtoupper(substr($otherUserName, 0, 1)) ?>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-bold text-gray-900"><?= htmlspecialchars($sessionDetails['title']) ?></h3>
                            <div class="flex items-center">
                                <span class="text-xs text-gray-500">with <?= htmlspecialchars($otherUserName) ?> • <?= htmlspecialchars($sessionDetails['skill_name']) ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <?php if (!empty($sessionDetails['meeting_link'])): ?>
                            <a href="<?= htmlspecialchars($sessionDetails['meeting_link']) ?>" target="_blank" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-emerald-500 hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition">
                                <svg class="mr-1.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                Join <?= htmlspecialchars($sessionDetails['meeting_type']) ?> Session
                            </a>
                            <?php if ($sessionDetails['provider_id'] == $_SESSION['user_id']): ?>
                                <button onclick="document.getElementById('meeting-modal').classList.remove('hidden')" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition" title="Edit Meeting Link">
                                    <svg class="h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if ($sessionDetails['provider_id'] == $_SESSION['user_id']): ?>
                                <button onclick="document.getElementById('meeting-modal').classList.remove('hidden')" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition">
                                    Set Meeting Link
                                </button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Chat Messages -->
                <div class="flex-1 p-6 overflow-y-auto flex flex-col" id="chat-messages" <?= $chatEnabled ? 'data-session-id="' . $sessionDetails['id'] . '"' : '' ?> data-session-datetime="<?php echo $sessionIso; ?>">
                    <!-- Messages loaded via AJAX polling -->
                </div>

                <!-- Chat Input Area -->
                <div class="p-4 bg-white border-t border-gray-100">
                    <!-- The Chat Form -->
                    <form id="chat-form" action="<?= BASE_URL ?>/chat/send" method="POST" class="flex items-end space-x-3 <?= $chatEnabled ? '' : 'hidden' ?>">
                        <input type="hidden" name="session_id" value="<?= $sessionDetails['id'] ?>">
                        <div class="flex-1">
                            <textarea id="message-input" name="message" rows="1"
                                class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-full py-3 px-4 resize-none bg-gray-50 transition"
                                placeholder="Type a message..."></textarea>
                        </div>
                        <button type="submit" class="inline-flex items-center justify-center h-11 w-11 rounded-full border border-transparent shadow-sm text-white bg-primary hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition transform hover:-translate-y-0.5">
                            <svg class="h-5 w-5 ml-1 transform rotate-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                            </svg>
                        </button>
                    </form>

                    <!-- The Lock Screen -->
                    <div id="lock-screen" class="<?= $chatEnabled ? 'hidden' : '' ?> p-8 text-center bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-xl shadow-lg text-white animate-pulse">
                        <svg class="mx-auto w-12 h-12 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.343 3-3V7a3 3 0 10-6 0v1c0 1.657 1.343 3 3 3z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11h14v10H5V11z"/>
                        </svg>
                        <p class="text-lg font-semibold">Chat will unlock soon</p>
                        <p id="countdown" class="mt-2 text-sm"></p>
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
                            if (lockScreen) lockScreen.classList.add('hidden');
                            if (chatForm) chatForm.classList.remove('hidden');
                            
                            // Initialize JS features if they weren't started by main.js
                            if (chatMessages && !chatMessages.dataset.sessionId) {
                                chatMessages.dataset.sessionId = sessionId;
                                
                                // Start fetching
                                if (typeof fetchMessages === 'function') {
                                    fetchMessages(sessionId);
                                    if (!pollInterval) {
                                        pollInterval = setInterval(() => { fetchMessages(sessionId); }, 3000);
                                    }
                                }
                                
                                // Bind form
                                if (chatForm && typeof sendMessage === 'function') {
                                    chatForm.addEventListener('submit', (e) => {
                                        e.preventDefault();
                                        sendMessage();
                                    });
                                }
                            }
                        }

                        function updateCountdown() {
                            const now = new Date();
                            const diff = sessionDt - now;
                            if (diff <= 0) {
                                unlockChat();
                                return;
                            }
                            const hrs = Math.floor(diff/3600000);
                            const mins = Math.floor((diff%3600000)/60000);
                            const secs = Math.floor((diff%60000)/1000);
                            const countdownEl = document.getElementById('countdown');
                            if (countdownEl) {
                                countdownEl.textContent = `${hrs}h ${mins}m ${secs}s`;
                            }
                        }

                        if (!<?= $chatEnabled ? 'true' : 'false' ?>) {
                            setInterval(updateCountdown, 1000);
                            updateCountdown();
                        }
                    });
                </script>
                </div>
            <?php else: ?>
                <div class="flex-1 flex flex-col items-center justify-center text-gray-400 p-8">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="h-12 w-12 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                    </div>
                    <p class="text-lg font-medium text-gray-600 mb-2">Session Chat</p>
                    <p class="text-sm text-center max-w-sm">Select an accepted session from the sidebar to start discussing the details and sharing meeting links.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if ($sessionDetails): ?>
<!-- Meeting Modal -->
<div id="meeting-modal" class="hidden fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="document.getElementById('meeting-modal').classList.add('hidden')"></div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
      <div class="mt-3 text-center sm:mt-5">
        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Set Meeting Details</h3>
        <div class="mt-2">
          <p class="text-sm text-gray-500">Provide a link for your learning session (e.g., Zoom, Google Meet, Discord).</p>
        </div>
      </div>
      <form action="<?= BASE_URL ?>/sessions/meeting" method="POST" class="mt-5 space-y-4">
        <input type="hidden" name="session_id" value="<?= $sessionDetails['id'] ?>">
        <div>
            <label class="block text-sm font-medium text-gray-700 text-left">Meeting Type</label>
            <select name="meeting_type" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                <option value="Google Meet" <?= ($sessionDetails['meeting_type'] ?? '') == 'Google Meet' ? 'selected' : '' ?>>Google Meet</option>
                <option value="Zoom" <?= ($sessionDetails['meeting_type'] ?? '') == 'Zoom' ? 'selected' : '' ?>>Zoom</option>
                <option value="Discord" <?= ($sessionDetails['meeting_type'] ?? '') == 'Discord' ? 'selected' : '' ?>>Discord</option>
                <option value="Telegram" <?= ($sessionDetails['meeting_type'] ?? '') == 'Telegram' ? 'selected' : '' ?>>Telegram</option>
                <option value="Other" <?= ($sessionDetails['meeting_type'] ?? '') == 'Other' ? 'selected' : '' ?>>Other</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 text-left">Meeting Link / Username</label>
            <input type="text" name="meeting_link" value="<?= htmlspecialchars($sessionDetails['meeting_link'] ?? '') ?>" required class="mt-1 shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3">
        </div>
        <div class="mt-5 sm:mt-6 sm:flex sm:flex-row-reverse">
          <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-indigo-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
            Save
          </button>
          <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm" onclick="document.getElementById('meeting-modal').classList.add('hidden')">
            Cancel
          </button>
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
                
                if (title.includes(query) || name.includes(query)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
});
</script>
