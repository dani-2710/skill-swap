<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white shadow overflow-hidden sm:rounded-xl border border-gray-100 relative">
        
        <!-- Header Background -->
        <div class="h-32 bg-gradient-to-r from-primary to-secondary relative">
            <!-- Overlay blobs -->
            <div class="absolute inset-0 bg-white/20 mix-blend-overlay"></div>
        </div>
        
        <div class="px-4 py-5 sm:px-6 relative -mt-16 flex justify-between items-end">
            <div class="flex items-end">
                <div class="h-32 w-32 rounded-full border-4 border-white bg-white shadow-md overflow-hidden flex items-center justify-center relative bg-gradient-to-tr from-gray-100 to-gray-200">
                    <span class="text-4xl font-bold text-gray-400">
                        <?= strtoupper(substr($profile['full_name'], 0, 1)) ?>
                    </span>
                </div>
                <div class="ml-5 pb-2">
                    <h3 class="text-2xl leading-6 font-bold text-gray-900"><?= htmlspecialchars($profile['full_name']) ?></h3>
                    <p class="text-sm text-gray-500 font-medium">@<?= htmlspecialchars($profile['username']) ?></p>
                </div>
            </div>
            <div class="pb-2">
                <a href="<?= BASE_URL ?>/profile/edit" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                    Edit Profile
                </a>
            </div>
        </div>

        <div class="border-t border-gray-100 px-4 py-5 sm:p-0">
            <dl class="sm:divide-y sm:divide-gray-100">
                
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 hover:bg-gray-50 transition">
                    <dt class="text-sm font-medium text-gray-500">Email address</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"><?= htmlspecialchars($profile['email']) ?></dd>
                </div>
                
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 hover:bg-gray-50 transition">
                    <dt class="text-sm font-medium text-gray-500">Availability</dt>
                    <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2 flex items-center">
                        <?php 
                            $status = $profile['availability_status'];
                            $color = $status == 'available' ? 'emerald' : ($status == 'busy' ? 'yellow' : 'gray');
                        ?>
                        <span class="h-2.5 w-2.5 rounded-full bg-<?= $color ?>-400 mr-2"></span>
                        <span class="capitalize text-gray-900 font-medium"><?= $status ?></span>
                    </dd>
                </div>
                
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 hover:bg-gray-50 transition">
                    <dt class="text-sm font-medium text-gray-500">About</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <?= !empty($profile['bio']) ? nl2br(htmlspecialchars($profile['bio'])) : '<span class="text-gray-400 italic">No bio provided yet.</span>' ?>
                    </dd>
                </div>

            </dl>
        </div>
    </div>
</div>
