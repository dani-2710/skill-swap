<div class="relative bg-white overflow-hidden">
    <!-- Background decorations -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-primary/10 blur-3xl mix-blend-multiply"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-secondary/10 blur-3xl mix-blend-multiply"></div>
    </div>

    <div class="max-w-7xl mx-auto relative z-10">
        <div class="relative z-10 pb-8 bg-transparent sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 pt-20">
            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                <div class="sm:text-center lg:text-left">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block xl:inline">Learn together,</span>
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">grow together.</span>
                    </h1>
                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        SkillSwap is the premier platform for students and learners to exchange knowledge. Teach what you know, learn what you don't. Connect with passionate individuals today.
                    </p>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        <div class="rounded-md shadow">
                            <a href="<?= BASE_URL ?>/register" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-indigo-700 md:py-4 md:text-lg md:px-10 transition transform hover:-translate-y-1 hover:shadow-lg">
                                Get started
                            </a>
                        </div>
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <a href="<?= BASE_URL ?>/skills" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-indigo-50 hover:bg-indigo-100 md:py-4 md:text-lg md:px-10 transition transform hover:-translate-y-1 hover:shadow-lg">
                                Browse Skills
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 mt-10 lg:mt-0 hidden lg:block">
        <!-- Abstract shape instead of image to ensure it loads perfectly without assets -->
        <div class="h-full w-full bg-gradient-to-br from-indigo-50 to-emerald-50 flex items-center justify-center overflow-hidden">
            <div class="relative w-full h-full">
                <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-primary/20 rounded-full mix-blend-multiply filter blur-2xl animate-blob"></div>
                <div class="absolute top-1/3 right-1/4 w-64 h-64 bg-secondary/20 rounded-full mix-blend-multiply filter blur-2xl animate-blob animation-delay-2000"></div>
                <div class="absolute bottom-1/4 left-1/3 w-64 h-64 bg-pink-300/20 rounded-full mix-blend-multiply filter blur-2xl animate-blob animation-delay-4000"></div>
                
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="glass p-8 rounded-2xl shadow-2xl bg-white/40 backdrop-blur-md border border-white/50 max-w-sm w-full transform rotate-3 hover:rotate-0 transition duration-500">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-primary to-secondary flex items-center justify-center text-white font-bold text-xl">S</div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Learn React.js</h3>
                                <p class="text-sm text-gray-500">with John Doe</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-600 border-t border-white/50 pt-4 mt-4">
                            <span>Tomorrow, 10:00 AM</span>
                            <span class="bg-secondary/20 text-secondary px-2 py-1 rounded-full text-xs font-semibold">Confirmed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
