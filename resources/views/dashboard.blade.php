<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <div
                    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    
                    <div class="grid grid-cols-1 divide-y divide-gray-900 dark:divide-gray-200">
                        <div>
                            <div class="flex justify-between ml-2 mb-2 pb-2">
                                <!-- Título "Materia" -->
                                <div class="flex items-center">
                                    <svg class="w-7 h-7 text-gray-900 dark:text-gray-200 mb-3 mr-3" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M16 14V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 0 0 0-2h-1v-2a2 2 0 0 0 2-2ZM4 2h2v12H4V2Zm8 16H3a1 1 0 0 1 0-2h9v2Z" />
                                    </svg>
                                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                        {{ __('Materias') }}</h5>
                                </div>
        
                                <!-- Buscador de materias -->
                                <div class="relative">
                                    <label for="search" class="sr-only">{{ __('Buscar Materia') }}</label>
                                    <div
                                        class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="search"
                                        class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder={{ __('Buscar materia') }}>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4" id="materias">
                                @foreach ($materias as $materia)
                                    <div
                                        class="mt-2 max-w-md bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <a href="#">
                                            <img class="rounded-t-lg" src="{{ asset('storage/images-materias/image.jpeg') }}"
                                                alt="Nombre de la imagen" />
                                        </a>
                                        <div class="p-5">
                                            <a href="#">
                                                <h5
                                                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                    {{ $materia->nombre }}</h5>
                                            </a>
                                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                                {{ __('Semestre: ') }}{{ $materia->semestre }}{{ __(' - Creditos: ') }}
                                                {{ $materia->creditos }}</p>
                                            <a href="{{ route('materias.show', $materia->id) }}"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                {{ __('Ver Materia') }}
                                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Obtener el campo de entrada de búsqueda
        const searchInput = document.getElementById('search');

        // Obtener todas las tarjetas de materia
        const materias = document.querySelectorAll('#materias .max-w-md');

        // Agregar evento de escucha al campo de entrada de búsqueda
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            // Iterar sobre todas las tarjetas de materia
            materias.forEach(function(materia) {
                const nombre = materia.querySelector('.text-gray-900').textContent.toLowerCase();

                // Mostrar o ocultar la tarjeta de materia según si el término de búsqueda coincide con el nombre de la materia
                if (nombre.includes(searchTerm)) {
                    materia.style.display = 'block';
                } else {
                    materia.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>
