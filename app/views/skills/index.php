<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Explore Skills
            </h2>
            <p class="mt-1 text-sm text-gray-500">Find what you want to learn or see what others are teaching.</p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="<?= BASE_URL ?>/skills/add" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                Share a Skill
            </a>
        </div>
    </div>

    <!-- Filters/Search (UI only for now) -->
    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6 mb-8 border border-gray-100">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
            <div class="col-span-1 sm:col-span-2">
                <input type="text" id="search-skills" placeholder="Search skills..." class="focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 shadow-sm bg-gray-50">
            </div>
            <div>
                <select id="filter-category" class="focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 shadow-sm bg-gray-50">
                    <option value="">All Categories</option>
                    <option value="Programming">Programming</option>
                    <option value="Design">Design</option>
                    <option value="Language">Language</option>
                </select>
            </div>
            <div>
                <select id="filter-type" class="focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 shadow-sm bg-gray-50">
                    <option value="">All Types</option>
                    <option value="teach">Teaching</option>
                    <option value="learn">Learning</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Skills Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <?php if (!empty($skills)): ?>
            <?php foreach ($skills as $skill): ?>
                <div class="skill-card bg-white overflow-hidden shadow rounded-xl border border-gray-100 hover:shadow-lg transition transform hover:-translate-y-1 flex flex-col h-full" 
                     data-name="<?= strtolower(htmlspecialchars($skill['name'])) ?>" 
                     data-category="<?= strtolower(htmlspecialchars($skill['category_name'])) ?>" 
                     data-type="<?= htmlspecialchars($skill['type']) ?>">
                    <div class="px-4 py-5 sm:p-6 flex-grow">
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $skill['type'] == 'teach' ? 'bg-indigo-100 text-indigo-800' : 'bg-emerald-100 text-emerald-800' ?>">
                                <?= ucfirst($skill['type']) ?>s this
                            </span>
                            <span class="text-xs text-gray-500 font-medium bg-gray-100 px-2 py-1 rounded-md"><?= htmlspecialchars($skill['category_name']) ?></span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($skill['name']) ?></h3>
                        <p class="text-sm text-gray-600 line-clamp-3 mb-4"><?= htmlspecialchars($skill['description']) ?></p>
                        
                        <div class="mt-auto flex items-center pt-4 border-t border-gray-100">
                            <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gradient-to-tr from-primary to-secondary flex items-center justify-center text-white text-xs font-bold">
                                <?= strtoupper(substr($skill['full_name'], 0, 1)) ?>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($skill['full_name']) ?></p>
                                <p class="text-xs text-gray-500">@<?= htmlspecialchars($skill['username']) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php if ($skill['user_id'] != $_SESSION['user_id']): ?>
                        <div class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-between border-t border-gray-100">
                            <a href="<?= BASE_URL ?>/chat?user=<?= $skill['user_id'] ?>" class="text-sm font-medium text-primary hover:text-indigo-900 transition flex items-center">
                                <svg class="mr-1.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                Message
                            </a>
                            <a href="<?= BASE_URL ?>/sessions/request?skill_id=<?= $skill['id'] ?>" class="text-sm font-medium text-secondary hover:text-emerald-900 transition flex items-center">
                                <svg class="mr-1.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Request Session
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center py-12 bg-white rounded-xl shadow border border-gray-100">
                <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No skills found</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by sharing a new skill.</p>
                <div class="mt-6">
                    <a href="<?= BASE_URL ?>/skills/add" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-indigo-700 transition">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Share Skill
                    </a>
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
    const cards = document.querySelectorAll('.skill-card');

    function filterSkills() {
        const query = searchInput.value.toLowerCase();
        const cat = categoryFilter.value.toLowerCase();
        const type = typeFilter.value.toLowerCase();

        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            const cardCat = card.getAttribute('data-category');
            const cardType = card.getAttribute('data-type');

            let matchesQuery = name.includes(query);
            let matchesCat = cat === '' || cardCat.includes(cat);
            let matchesType = type === '' || cardType === type;

            if (matchesQuery && matchesCat && matchesType) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }

    if(searchInput) searchInput.addEventListener('input', filterSkills);
    if(categoryFilter) categoryFilter.addEventListener('change', filterSkills);
    if(typeFilter) typeFilter.addEventListener('change', filterSkills);
});
</script>
