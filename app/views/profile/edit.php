<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg border border-gray-100 dark:border-gray-700 transition-colors duration-300">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-2xl leading-6 font-bold text-gray-900 dark:text-white transition-colors duration-300">Edit Profile</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400 transition-colors duration-300">Update your personal information and availability.</p>

            <?php if (isset($profile_error)): ?>
                <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-400 p-4 mb-6 rounded-md">
                    <p class="text-sm text-red-700 dark:text-red-400"><?= htmlspecialchars($profile_error) ?></p>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/profile/edit" method="POST" class="space-y-6">
                
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors duration-300">Full Name</label>
                        <div class="mt-1">
                            <input type="text" name="full_name" id="full_name" value="<?= htmlspecialchars($user['full_name'] ?? $profile['full_name']) ?>" required class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md py-2 px-3 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300">
                        </div>
                    </div>

                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors duration-300">Username</label>
                        <div class="mt-1">
                            <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md py-2 px-3 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300">
                        </div>
                    </div>
                </div>
                <div>

                </div>

                <div>
                    <label for="availability_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors duration-300">Availability Status</label>
                    <div class="mt-1">
                        <select id="availability_status" name="availability_status" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md py-2 px-3 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300">
                            <option value="available" <?= $profile['availability_status'] == 'available' ? 'selected' : '' ?>>Available to teach/learn</option>
                            <option value="busy" <?= $profile['availability_status'] == 'busy' ? 'selected' : '' ?>>Busy</option>
                            <option value="offline" <?= $profile['availability_status'] == 'offline' ? 'selected' : '' ?>>Offline / Do not disturb</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors duration-300">Bio</label>
                    <div class="mt-1">
                        <textarea id="bio" name="bio" rows="5" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md py-2 px-3 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300" placeholder="Tell the community a little bit about yourself..."><?= htmlspecialchars($profile['bio']) ?></textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 transition-colors duration-300">Brief description for your profile.</p>
                </div>

                <div class="pt-5 border-t border-gray-100 dark:border-gray-700 flex justify-end transition-colors duration-300">
                    <a href="<?= BASE_URL ?>/profile" class="bg-white dark:bg-gray-700 py-2 px-4 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-300">
                        Cancel
                    </a>
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition transform hover:-translate-y-0.5">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg border border-gray-100 dark:border-gray-700 transition-colors duration-300 mt-8">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-2xl leading-6 font-bold text-gray-900 dark:text-white transition-colors duration-300">Change Password</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400 transition-colors duration-300">Update your account password.</p>
            
            <?php if (isset($password_error)): ?>
                <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-400 p-4 mt-4 mb-6 rounded-md">
                    <p class="text-sm text-red-700 dark:text-red-400"><?= htmlspecialchars($password_error) ?></p>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/profile/edit" method="POST" class="space-y-6 mt-6">
                <input type="hidden" name="change_password" value="1">
                <div class="space-y-6">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors duration-300">Current Password</label>
                        <div class="mt-1">
                            <input type="password" name="current_password" id="current_password" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md py-2 px-3 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300" placeholder="Enter current password" required>
                        </div>
                    </div>
                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors duration-300">New Password</label>
                        <div class="mt-1">
                            <input type="password" name="new_password" id="new_password" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md py-2 px-3 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300" placeholder="Enter new password" required>
                        </div>
                    </div>
                    <div>
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors duration-300">Confirm New Password</label>
                        <div class="mt-1">
                            <input type="password" name="confirm_password" id="confirm_password" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md py-2 px-3 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-300" placeholder="Confirm new password" required>
                        </div>
                    </div>
                </div>
                <div class="pt-5 border-t border-gray-100 dark:border-gray-700 flex justify-end">
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition transform hover:-translate-y-0.5">
                        Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
