<div class="relative" x-data="{ languageOpen: false, activeLanguage: 'EN' }" @click.away="languageOpen = false">
    <button
        class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-theme-xs transition hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-gray-800"
        @click="languageOpen = !languageOpen" type="button" aria-label="Select language">
        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M12 3c2.76 0 5.1 1.12 6.84 2.93M12 3C9.24 3 6.9 4.12 5.16 5.93M12 3v18m0 0c-2.76 0-5.1-1.12-6.84-2.93M12 21c2.76 0 5.1-1.12 6.84-2.93M3 12h18" />
        </svg>
        <span x-text="activeLanguage"></span>
        <svg class="h-4 w-4 text-gray-500 transition-transform dark:text-gray-400"
            :class="languageOpen ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                clip-rule="evenodd" />
        </svg>
    </button>

    <div x-show="languageOpen" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 rtl:right-auto rtl:left-0 mt-2 w-28 rounded-xl border border-gray-200 bg-white p-2 text-sm shadow-theme-lg dark:border-gray-800 dark:bg-gray-dark"
        style="display: none;">
        <a href="{{ route('language.switch', 'en') }}"
            class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-300 dark:hover:bg-white/5"
            @click="activeLanguage = 'EN'; languageOpen = false">
            <span>English</span>
            <span class="text-xs text-gray-400">EN</span>
        </a>
        <a href="{{ route('language.switch', 'fr') }}"
            class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-300 dark:hover:bg-white/5"
            @click="activeLanguage = 'FR'; languageOpen = false">
            <span>Français</span>
            <span class="text-xs text-gray-400">FR</span>
        </a>
        <a href="{{ route('language.switch', 'ar') }}"
            class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-300 dark:hover:bg-white/5"
            @click="activeLanguage = 'AR'; languageOpen = false">
            <span>العربية</span>
            <span class="text-xs text-gray-400">AR</span>
        </a>
    </div>
</div>
