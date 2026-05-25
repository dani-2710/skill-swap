<div class="wide-page">
    <div class="page-header">
        <div>
            <h2 class="title">Explore Skills</h2>
            <p class="subtitle">Find what you want to learn or see what others are teaching.</p>
        </div>
        <a href="<?= BASE_URL ?>/skills/add" class="btn">Share a Skill</a>
    </div>

    <div class="panel">
        <div class="panel-body">
            <div class="filter-grid <?= (($_SESSION['role'] ?? 'student') === 'admin') ? 'has-status' : '' ?>">
                <input type="text" id="search-skills" class="input" placeholder="Search skills...">
                <select id="filter-category" class="input">
                    <option value="">All Categories</option>
                    <option value="Programming">Programming</option>
                    <option value="Design">Design</option>
                    <option value="Language">Language</option>
                </select>
                <select id="filter-type" class="input">
                    <option value="">All Types</option>
                    <option value="teach">Teaching</option>
                    <option value="learn">Learning</option>
                </select>
                <?php if (($_SESSION['role'] ?? 'student') === 'admin'): ?>
                    <select id="filter-status" class="input">
                        <option value="<?= BASE_URL ?>/skills?status=active" <?= ($status ?? 'active') === 'active' ? 'selected' : '' ?>>Active Skills</option>
                        <option value="<?= BASE_URL ?>/skills?status=deleted" <?= ($status ?? 'active') === 'deleted' ? 'selected' : '' ?>>Deleted Skills</option>
                        <option value="<?= BASE_URL ?>/skills?status=all" <?= ($status ?? 'active') === 'all' ? 'selected' : '' ?>>All Skills</option>
                    </select>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="skills-grid spaced-top">
        <?php if (!empty($skills)): ?>
            <?php foreach ($skills as $skill): ?>
                <div class="skill-card card"
                     data-name="<?= strtolower(htmlspecialchars($skill['name'])) ?>"
                     data-category="<?= strtolower(htmlspecialchars($skill['category_name'])) ?>"
                     data-type="<?= htmlspecialchars($skill['type']) ?>">
                    <div class="card-body skill-content">
                        <div class="badge-row">
                            <span class="<?= $skill['type'] == 'teach' ? 'badge-teach' : 'badge-learn' ?>">
                                <?= ucfirst($skill['type']) ?>s this
                            </span>
                            <span>
                                <?php if (($skill['status'] ?? 'active') === 'deleted'): ?>
                                    <span class="badge-deleted">Deleted</span>
                                <?php endif; ?>
                                <span class="badge-muted"><?= htmlspecialchars($skill['category_name']) ?></span>
                            </span>
                        </div>
                        <h3 class="section-title card-title"><?= htmlspecialchars($skill['name']) ?></h3>
                        <p class="skill-description"><?= htmlspecialchars($skill['description']) ?></p>

                        <div class="owner-row skill-owner">
                            <div class="avatar-sm"><?= strtoupper(substr($skill['full_name'], 0, 1)) ?></div>
                            <div>
                                <p class="table-primary"><?= htmlspecialchars($skill['full_name']) ?></p>
                                <p class="table-secondary">@<?= htmlspecialchars($skill['username']) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php if ((int)$skill['user_id'] === (int)$_SESSION['user_id'] || (($_SESSION['role'] ?? 'student') === 'admin')): ?>
                        <div class="card-footer row-between">
                            <a href="<?= BASE_URL ?>/skills/<?= $skill['id'] ?>/edit" class="btn-link">Edit</a>
                            <?php if (($skill['status'] ?? 'active') !== 'deleted'): ?>
                                <form action="<?= BASE_URL ?>/skills/<?= $skill['id'] ?>/delete" method="POST" onsubmit="return confirm('Delete this skill? It will be hidden, not permanently removed.');">
                                    <button type="submit" class="btn-link-danger">Delete</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php elseif ($skill['user_id'] != $_SESSION['user_id']): ?>
                        <div class="card-footer row-between">
                            <a href="<?= BASE_URL ?>/chat?user=<?= $skill['user_id'] ?>" class="btn-link">Message</a>
                            <a href="<?= BASE_URL ?>/sessions/request?skill_id=<?= $skill['id'] ?>" class="btn-link-success">Request Session</a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state card">
                <h3 class="section-title">No skills found</h3>
                <p class="subtitle">Get started by sharing a new skill.</p>
                <div class="spaced-top">
                    <a href="<?= BASE_URL ?>/skills/add" class="btn">Share Skill</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-skills');
    const categoryFilter = document.getElementById('filter-category');
    const typeFilter = document.getElementById('filter-type');
    const statusFilter = document.getElementById('filter-status');
    const cards = document.querySelectorAll('.skill-card');

    function filterSkills() {
        const query = searchInput.value.toLowerCase();
        const cat = categoryFilter.value.toLowerCase();
        const type = typeFilter.value.toLowerCase();

        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            const cardCat = card.getAttribute('data-category');
            const cardType = card.getAttribute('data-type');

            card.style.display = name.includes(query) && (cat === '' || cardCat.includes(cat)) && (type === '' || cardType === type) ? '' : 'none';
        });
    }

    if (searchInput) searchInput.addEventListener('input', filterSkills);
    if (categoryFilter) categoryFilter.addEventListener('change', filterSkills);
    if (typeFilter) typeFilter.addEventListener('change', filterSkills);
    if (statusFilter) statusFilter.addEventListener('change', function() {
        window.location.href = statusFilter.value;
    });
});
</script>
