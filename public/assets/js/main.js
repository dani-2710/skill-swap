// Main JavaScript for SkillSwap

document.addEventListener('DOMContentLoaded', () => {
    // Add fade-in animation to main content
    const mainContent = document.querySelector('main');
    if (mainContent) {
        mainContent.classList.add('fade-in');
    }

    // Theme toggle logic
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    const themeToggleBtn = document.getElementById('theme-toggle');

    if (themeToggleDarkIcon && themeToggleLightIcon && themeToggleBtn) {
        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('is-hidden');
        } else {
            themeToggleDarkIcon.classList.remove('is-hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('is-hidden');
            themeToggleLightIcon.classList.toggle('is-hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.setAttribute('data-theme', 'light');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.getAttribute('data-theme') === 'dark') {
                    document.documentElement.setAttribute('data-theme', 'light');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    }

    // Handle AJAX Chat Polling if on chat page
    const chatContainer = document.getElementById('chat-messages');
    if (chatContainer) {
        const sessionId = chatContainer.dataset.sessionId;

        if (sessionId) {
            // Initial load
            fetchMessages(sessionId);

            // Poll for new messages every 3 seconds
            setInterval(() => {
                fetchMessages(sessionId);
            }, 3000);

            // Handle form submission via AJAX
            const chatForm = document.getElementById('chat-form');
            if (chatForm) {
                chatForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    sendMessage();
                });
            }
        }
    }
});

function scrollToBottom() {
    const chatContainer = document.getElementById('chat-messages');
    if (chatContainer) {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }
}

async function fetchMessages(sessionId) {
    const chatContainer = document.getElementById('chat-messages');
    if (!chatContainer) return;

    try {
        const response = await fetch(`${window.location.origin}/skill-swap/chat/getMessages?session_id=${sessionId}`);
        if (response.ok) {
            const html = await response.text();

            // Only update if there's new content to prevent flickering
            if (chatContainer.innerHTML.trim() !== html.trim()) {
                chatContainer.innerHTML = html;
                scrollToBottom();
            }
        }
    } catch (error) {
        console.error('Error fetching messages:', error);
    }
}

async function sendMessage() {
    const form = document.getElementById('chat-form');
    if (!form) return;

    const formData = new FormData(form);
    const input = document.getElementById('message-input');

    if (!input || !input.value.trim()) return;

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if (response.ok) {
            input.value = ''; // Clear input
            const sessionId = form.querySelector('input[name="session_id"]').value;
            fetchMessages(sessionId); // Refresh immediately
        }
    } catch (error) {
        console.error('Error sending message:', error);
    }
}
