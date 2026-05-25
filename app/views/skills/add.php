<div class="narrow-page">
    <div class="card">
        <div class="card-body">
            <h3 class="form-title">Share a Skill</h3>
            <p class="subtitle">What do you want to teach or learn? Fill out the details below to add it to your profile.</p>

            <?php if (isset($error)): ?>
                <div class="alert"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/skills/add" method="POST" class="form-stack">
                <div class="field">
                    <label for="name">Skill Name</label>
                    <input type="text" name="name" id="name" required placeholder="e.g. Advanced JavaScript">
                </div>

                <div class="form-grid">
                    <div class="field">
                        <label for="category_id">Category</label>
                        <select id="category_id" name="category_id" required>
                            <option value="">Select a category</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="field">
                        <label for="type">Skill Type</label>
                        <select id="type" name="type" required>
                            <option value="teach">I can teach this</option>
                            <option value="learn">I want to learn this</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4" required placeholder="Provide details about your skill level or what exactly you want to learn."></textarea>
                    <p class="help-text">Brief description to help others understand your skill.</p>
                </div>

                <div class="button-row">
                    <a href="<?= BASE_URL ?>/skills" class="btn-outline">Cancel</a>
                    <button type="submit" class="btn">Save Skill</button>
                </div>
            </form>
        </div>
    </div>
</div>
