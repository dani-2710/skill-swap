<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white shadow sm:rounded-lg border border-gray-100 overflow-hidden relative">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 -mt-16 -mr-16 text-primary/10">
            <svg class="h-64 w-64" fill="currentColor" viewBox="0 0 100 100"><circle cx="50" cy="50" r="50"></circle></svg>
        </div>
        
        <div class="px-4 py-5 sm:p-6 relative z-10">
            <h3 class="text-2xl leading-6 font-bold text-gray-900 mb-1">Share a Skill</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500 mb-8">What do you want to teach or learn? Fill out the details below to add it to your profile.</p>

            <?php if (isset($error)): ?>
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-md">
                    <p class="text-sm text-red-700"><?= htmlspecialchars($error) ?></p>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/skills/add" method="POST" class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Skill Name</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name" required class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 bg-gray-50 transition" placeholder="e.g. Advanced JavaScript">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                        <div class="mt-1">
                            <select id="category_id" name="category_id" required class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 bg-gray-50 transition">
                                <option value="">Select a category</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Skill Type</label>
                        <div class="mt-1">
                            <select id="type" name="type" required class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 bg-gray-50 transition">
                                <option value="teach">I can teach this</option>
                                <option value="learn">I want to learn this</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <div class="mt-1">
                        <textarea id="description" name="description" rows="4" required class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 bg-gray-50 transition" placeholder="Provide details about your skill level or what exactly you want to learn."></textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Brief description to help others understand your skill.</p>
                </div>

                <div class="pt-5 border-t border-gray-100 flex justify-end">
                    <a href="<?= BASE_URL ?>/skills" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                        Cancel
                    </a>
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition transform hover:-translate-y-0.5">
                        Save Skill
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
