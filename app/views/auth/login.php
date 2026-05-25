<div class="auth-page">
    <div class="blob blob-one"></div>
    <div class="blob blob-two"></div>

    <div class="auth-header">
        <h2 class="title">Welcome back</h2>
        <p class="subtitle">
            Or <a href="<?= BASE_URL ?>/register" class="link">create a new account</a>
        </p>
    </div>

    <div class="auth-card">
        <?php if (isset($error)): ?>
            <div class="alert"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form class="form-stack" action="<?= BASE_URL ?>/login" method="POST">
            <div class="field">
                <label for="email">Email address</label>
                <input id="email" name="email" type="email" autocomplete="email" required>
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required>
            </div>

            <label class="checkbox-row" for="remember-me">
                <input id="remember-me" name="remember-me" type="checkbox">
                <span>Remember me</span>
            </label>

            <button type="submit" class="btn">Sign in</button>
        </form>
    </div>
</div>
