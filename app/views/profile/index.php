<div class="profile-page">
    <div class="profile-card card">
        <div class="profile-cover"></div>

        <div class="profile-head">
            <div class="profile-identity">
                <div class="profile-avatar">
                    <?= strtoupper(substr($profile['full_name'], 0, 1)) ?>
                </div>
                <div>
                    <h3 class="form-title"><?= htmlspecialchars($profile['full_name']) ?></h3>
                    <p class="subtitle">@<?= htmlspecialchars($profile['username']) ?></p>
                </div>
            </div>
            <a href="<?= BASE_URL ?>/profile/edit" class="btn-outline">Edit Profile</a>
        </div>

        <dl class="profile-details">
            <div class="detail-row">
                <dt class="muted strong">Email address</dt>
                <dd><?= htmlspecialchars($profile['email']) ?></dd>
            </div>

            <div class="detail-row">
                <dt class="muted strong">Availability</dt>
                <dd>
                    <?php
                        $status = $profile['availability_status'];
                        $statusClass = $status == 'available' ? 'status-available' : ($status == 'busy' ? 'status-busy' : 'status-offline');
                    ?>
                    <span class="status-dot <?= $statusClass ?>"></span>
                    <span class="capitalize strong"><?= $status ?></span>
                </dd>
            </div>

            <div class="detail-row">
                <dt class="muted strong">About</dt>
                <dd>
                    <?= !empty($profile['bio']) ? nl2br(htmlspecialchars($profile['bio'])) : '<span class="muted italic">No bio provided yet.</span>' ?>
                </dd>
            </div>
        </dl>
    </div>
</div>
