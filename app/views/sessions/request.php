<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white shadow sm:rounded-lg border border-gray-100 overflow-hidden relative">
        <div class="absolute top-0 right-0 -mt-16 -mr-16 text-secondary/10">
            <svg class="h-64 w-64" fill="currentColor" viewBox="0 0 100 100"><polygon points="50,0 100,25 100,75 50,100 0,75 0,25"></polygon></svg>
        </div>
        
        <div class="px-4 py-5 sm:p-6 relative z-10">
            <h3 class="text-2xl leading-6 font-bold text-gray-900 mb-1">Request a Session</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500 mb-6">Send a request to <span class="font-bold text-gray-800"><?= htmlspecialchars($skill['full_name']) ?></span> to <?= $skill['type'] == 'teach' ? 'learn' : 'teach them' ?> <span class="font-bold text-primary"><?= htmlspecialchars($skill['name']) ?></span>.</p>

            <?php if (isset($error)): ?>
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-md">
                    <p class="text-sm text-red-700"><?= htmlspecialchars($error) ?></p>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/sessions/request?skill_id=<?= $skill['id'] ?>" method="POST" class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Session Title / Topic</label>
                    <div class="mt-1">
                        <input type="text" name="title" id="title" required class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 bg-gray-50 transition" placeholder="e.g. Help me understand React Hooks">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <div>
                        <label for="session_date" class="block text-sm font-medium text-gray-700">Preferred Date</label>
                        <div class="mt-1">
                            <input type="date" name="session_date" id="session_date" min="<?= date('Y-m-d') ?>" required class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 bg-gray-50 transition">
                        </div>
                    </div>

                    <div>
                        <label for="session_time" class="block text-sm font-medium text-gray-700">Preferred Time</label>
                        <div class="mt-1">
                            <input type="time" name="session_time" id="session_time" required class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 bg-gray-50 transition">
                        </div>
                    </div>
                </div>

                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                    <div class="mt-1">
                        <select id="duration" name="duration" required class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 bg-gray-50 transition">
                            <option value="30">30 minutes</option>
                            <option value="45">45 minutes</option>
                            <option value="60" selected>1 hour</option>
                            <option value="90">1.5 hours</option>
                            <option value="120">2 hours</option>
                        </select>
                    </div>
                </div>

                <div class="pt-5 border-t border-gray-100 flex justify-end">
                    <a href="<?= BASE_URL ?>/skills" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                        Cancel
                    </a>
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition transform hover:-translate-y-0.5">
                        Send Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
