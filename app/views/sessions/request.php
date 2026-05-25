<div class="narrow-page">
    <div class="card">
        <div class="card-body">
            <h3 class="form-title">Request a Session</h3>
            <p class="subtitle">
                Send a request to <span class="strong"><?= htmlspecialchars($skill['full_name']) ?></span>
                to <?= $skill['type'] == 'teach' ? 'learn' : 'teach them' ?>
                <span class="primary-text strong"><?= htmlspecialchars($skill['name']) ?></span>.
            </p>

            <?php if (isset($error)): ?>
                <div class="alert"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/sessions/request?skill_id=<?= $skill['id'] ?>" method="POST" class="form-stack">
                <div class="field">
                    <label for="title">Session Title / Topic</label>
                    <input type="text" name="title" id="title" required placeholder="e.g. Help me understand React Hooks">
                </div>

                <div class="form-grid">
                    <div class="field">
                        <label for="session_date">Preferred Date</label>
                        <input type="date" name="session_date" id="session_date" min="<?= date('Y-m-d') ?>" required>
                    </div>

                    <div class="field">
                        <label for="session_time">Preferred Time</label>
                        <input type="time" name="session_time" id="session_time" required>
                    </div>
                </div>

                <div class="field">
                    <label for="duration">Duration</label>
                    <select id="duration" name="duration" required>
                        <option value="30">30 minutes</option>
                        <option value="45">45 minutes</option>
                        <option value="60" selected>1 hour</option>
                        <option value="90">1.5 hours</option>
                        <option value="120">2 hours</option>
                    </select>
                </div>

                <div class="button-row">
                    <a href="<?= BASE_URL ?>/skills" class="btn-outline">Cancel</a>
                    <button type="submit" class="btn">Send Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
