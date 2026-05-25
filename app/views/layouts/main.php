<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) : 'SkillSwap' ?></title>
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
        }
    </script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/style.css?v=<?= filemtime(BASE_PATH . '/public/assets/css/style.css') ?>">
</head>
<body>

    <nav class="site-header">
        <div class="nav-container">
            <a href="<?= BASE_URL ?>/" class="brand">SkillSwap</a>
            <div class="nav-actions">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="<?= BASE_URL ?>/dashboard" class="nav-link">Dashboard</a>
                    <a href="<?= BASE_URL ?>/skills" class="nav-link">Browse Skills</a>
                    <?php if (($_SESSION['role'] ?? 'student') === 'admin'): ?>
                        <a href="<?= BASE_URL ?>/admin" class="nav-link">Admin</a>
                    <?php endif; ?>
                    <div class="user-menu">
                        <span class="username"><?= htmlspecialchars($_SESSION['username']) ?></span>
                        <a href="<?= BASE_URL ?>/logout" class="logout-link">Logout</a>
                    </div>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>/login" class="nav-link">Log in</a>
                    <a href="<?= BASE_URL ?>/register" class="btn">Sign up</a>
                <?php endif; ?>

                <button id="theme-toggle" type="button" class="theme-toggle" aria-label="Toggle dark mode">
                    <svg id="theme-toggle-dark-icon" class="is-hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="is-hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        </div>
    </nav>

    <main class="site-main">
        <?= isset($content) ? $content : '' ?>
    </main>

    <footer class="site-footer">
        <p class="footer-text">&copy; <?= date('Y') ?> SkillSwap. All rights reserved.</p>
    </footer>

    <script src="<?= BASE_URL ?>/public/assets/js/main.js?v=<?= filemtime(BASE_PATH . '/public/assets/js/main.js') ?>"></script>
</body>
</html>
