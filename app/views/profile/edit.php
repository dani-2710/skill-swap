<div class="narrow-page stack">
    <div class="card">
        <div class="card-body">
            <h3 class="form-title">Edit Profile</h3>
            <p class="subtitle">Update your personal information and availability.</p>

            <?php if (isset($profile_error)): ?>
                <div class="alert"><?= htmlspecialchars($profile_error) ?></div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/profile/edit" method="POST" class="form-stack">
                <div class="form-grid">
                    <div class="field">
                        <label for="full_name">Full Name</label>
                        <input type="text" name="full_name" id="full_name" value="<?= htmlspecialchars($user['full_name'] ?? $profile['full_name']) ?>" required>
                    </div>

                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required>
                    </div>
                </div>

                <div class="field">
                    <label for="availability_status">Availability Status</label>
                    <select id="availability_status" name="availability_status">
                        <option value="available" <?= $profile['availability_status'] == 'available' ? 'selected' : '' ?>>Available to teach/learn</option>
                        <option value="busy" <?= $profile['availability_status'] == 'busy' ? 'selected' : '' ?>>Busy</option>
                        <option value="offline" <?= $profile['availability_status'] == 'offline' ? 'selected' : '' ?>>Offline / Do not disturb</option>
                    </select>
                </div>

                <div class="field">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" rows="5" placeholder="Tell the community a little bit about yourself..."><?= htmlspecialchars($profile['bio']) ?></textarea>
                    <p class="help-text">Brief description for your profile.</p>
                </div>

                <div class="button-row">
                    <a href="<?= BASE_URL ?>/profile" class="btn-outline">Cancel</a>
                    <button type="submit" class="btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h3 class="form-title">Change Password</h3>
            <p class="subtitle">Update your account password.</p>

            <?php if (isset($password_error)): ?>
                <div class="alert"><?= htmlspecialchars($password_error) ?></div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/profile/edit" method="POST" class="form-stack">
                <input type="hidden" name="change_password" value="1">
                <div class="field">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password" placeholder="Enter current password" required>
                </div>
                <div class="field">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" placeholder="Enter new password" required>
                </div>
                <div class="field">
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm new password" required>
                </div>
                <div class="button-row">
                    <button type="submit" class="btn">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
