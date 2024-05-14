<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center p-2 rounded-md text-gray-800 bg-gray-200 dark:bg-gray-800 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-300 dark:focus:bg-gray-700']) }}>
    <svg class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
    {{ $slot }}
</button>
