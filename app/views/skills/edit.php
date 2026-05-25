<div class="narrow-page">
    <div class="card">
        <div class="card-body">
            <h3 class="form-title">Edit Skill</h3>
            <p class="subtitle">Update the details people see when browsing skills.</p>

            <?php if (isset($error)): ?>
                <div class="alert"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/skills/<?= $skill['id'] ?>/edit" method="POST" class="form-stack">
                <div class="field">
                    <label for="name">Skill Name</label>
                    <input type="text" name="name" id="name" required value="<?= htmlspecialchars($skill['name']) ?>">
                </div>

                <div class="form-grid">
                    <div class="field">
                        <label for="category_id">Category</label>
                        <select id="category_id" name="category_id" required>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= (int)$skill['category_id'] === (int)$cat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="field">
                        <label for="type">Skill Type</label>
                        <select id="type" name="type" required>
                            <option value="teach" <?= $skill['type'] === 'teach' ? 'selected' : '' ?>>I can teach this</option>
                            <option value="learn" <?= $skill['type'] === 'learn' ? 'selected' : '' ?>>I want to learn this</option>
                        </select>
                    </div>
                </div>

                <?php if (($_SESSION['role'] ?? 'student') === 'admin'): ?>
                    <div class="field">
                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <option value="active" <?= ($skill['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="deleted" <?= ($skill['status'] ?? 'active') === 'deleted' ? 'selected' : '' ?>>Deleted</option>
                        </select>
                    </div>
                <?php endif; ?>

                <div class="field">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4" required><?= htmlspecialchars($skill['description']) ?></textarea>
                </div>

                <div class="button-row">
                    <a href="<?= BASE_URL ?>/skills" class="btn-outline">Cancel</a>
                    <button type="submit" class="btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
