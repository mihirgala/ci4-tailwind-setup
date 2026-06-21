<nav class="bg-gray-950 border-b border-gray-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14">
            <a href="/" class="flex items-center gap-2 font-mono font-bold text-sm text-emerald-400">
                <span class="text-gray-500">~/$</span>
                <span>ci4-tailwind-setup</span>
                <span class="animate-pulse text-gray-500">▌</span>
            </a>
            <div class="hidden md:flex items-center gap-1 font-mono text-xs">
                <a href="/" class="px-3 py-1.5 text-gray-400 hover:text-emerald-400 hover:bg-gray-900 rounded transition-all">home/</a>

                <a href="https://github.com/mihirgala/ci4-tailwind-setup" target="_blank" class="px-3 py-1.5 text-gray-400 hover:text-emerald-400 hover:bg-gray-900 rounded transition-all">github/</a>
            </div>
            <button id="menu-toggle" class="md:hidden p-2 text-gray-400 hover:text-emerald-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-800 bg-gray-950 font-mono text-sm">
        <div class="px-4 py-3 space-y-1">
            <a href="/" class="block px-3 py-2 text-gray-400 hover:text-emerald-400 hover:bg-gray-900 rounded">home/</a>

            <a href="https://github.com/mihirgala/ci4-tailwind-setup" target="_blank" class="block px-3 py-2 text-gray-400 hover:text-emerald-400 hover:bg-gray-900 rounded">github/</a>
        </div>
    </div>
</nav>
<script>
document.getElementById('menu-toggle')?.addEventListener('click', function() {
    document.getElementById('mobile-menu')?.classList.toggle('hidden');
});
</script>
