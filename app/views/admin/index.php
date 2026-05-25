<div class="wide-page">
    <div class="page-header">
        <div>
            <h1 class="title">Admin</h1>
            <p class="subtitle">Manage users and skill visibility across SkillSwap.</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card card">
            <dt>Users</dt>
            <dd><?= $userCount ?></dd>
        </div>
        <div class="stat-card card">
            <dt>Active Skills</dt>
            <dd><?= $activeSkillsCount ?></dd>
        </div>
        <div class="stat-card card">
            <dt>Deleted Skills</dt>
            <dd><?= $deletedSkillsCount ?></dd>
        </div>
    </div>

    <div class="admin-grid spaced-top-large">
        <section class="panel">
            <div class="section-header">
                <h2 class="section-title">Users</h2>
            </div>
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td>
                                    <div class="table-primary"><?= htmlspecialchars($user['full_name']) ?></div>
                                    <div class="table-secondary">@<?= htmlspecialchars($user['username']) ?></div>
                                </td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td>
                                    <form action="<?= BASE_URL ?>/admin/users/role" method="POST" class="inline-actions">
                                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                        <select name="role" class="input" <?= (int)$user['id'] === (int)$_SESSION['user_id'] ? 'disabled' : '' ?>>
                                            <option value="student" <?= $user['role'] === 'student' ? 'selected' : '' ?>>Student</option>
                                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                        </select>
                                        <?php if ((int)$user['id'] !== (int)$_SESSION['user_id']): ?>
                                            <button type="submit" class="btn-link">Save</button>
                                        <?php endif; ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="panel">
            <div class="section-header">
                <h2 class="section-title">Skills</h2>
                <a href="<?= BASE_URL ?>/skills?status=all" class="btn-link">Browse all</a>
            </div>
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Skill</th>
                            <th>Owner</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($skills as $skill): ?>
                            <tr>
                                <td>
                                    <div class="table-primary"><?= htmlspecialchars($skill['name']) ?></div>
                                    <div class="table-secondary"><?= htmlspecialchars($skill['category_name']) ?> / <?= htmlspecialchars($skill['type']) ?></div>
                                </td>
                                <td><?= htmlspecialchars($skill['full_name']) ?></td>
                                <td>
                                    <span class="<?= $skill['status'] === 'deleted' ? 'badge-deleted' : 'badge-active' ?>">
                                        <?= ucfirst($skill['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="inline-actions">
                                        <a href="<?= BASE_URL ?>/skills/<?= $skill['id'] ?>/edit" class="btn-link">Edit</a>
                                        <?php if ($skill['status'] === 'deleted'): ?>
                                            <form action="<?= BASE_URL ?>/admin/skills/restore" method="POST">
                                                <input type="hidden" name="skill_id" value="<?= $skill['id'] ?>">
                                                <button type="submit" class="btn-link-success">Restore</button>
                                            </form>
                                        <?php else: ?>
                                            <form action="<?= BASE_URL ?>/skills/<?= $skill['id'] ?>/delete" method="POST" onsubmit="return confirm('Soft delete this skill?');">
                                                <button type="submit" class="btn-link-danger">Delete</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
