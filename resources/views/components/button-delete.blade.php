<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center p-2 rounded-md text-gray-800 bg-gray-200 dark:bg-gray-800 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-300 dark:focus:bg-gray-700']) }}>
    <svg class="h-8 w-8 text-red-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
        fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" />
        <line x1="4" y1="7" x2="20" y2="7" />
        <line x1="10" y1="11" x2="10" y2="17" />
        <line x1="14" y1="11" x2="14" y2="17" />
        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
    </svg>
    {{ $slot }}
</button>
