<div class="auth-page">
    <div class="blob blob-one"></div>
    <div class="blob blob-two"></div>

    <div class="auth-header">
        <h2 class="title">Create your account</h2>
        <p class="subtitle">
            Already have an account? <a href="<?= BASE_URL ?>/login" class="link">Sign in</a>
        </p>
    </div>

    <div class="auth-card">
        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="alert">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form class="form-stack" action="<?= BASE_URL ?>/register" method="POST">
            <div class="form-grid">
                <div class="field span-2">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" id="full_name" required value="<?= isset($input['full_name']) ? htmlspecialchars($input['full_name']) : '' ?>">
                </div>

                <div class="field">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required value="<?= isset($input['username']) ? htmlspecialchars($input['username']) : '' ?>">
                </div>

                <div class="field">
                    <label for="email">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required value="<?= isset($input['email']) ? htmlspecialchars($input['email']) : '' ?>">
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" required>
                </div>

                <div class="field">
                    <label for="password_confirm">Confirm Password</label>
                    <input id="password_confirm" name="password_confirm" type="password" required>
                </div>
            </div>

            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</div>
