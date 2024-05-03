<x-app-layout>
    <x-slot name="header">
        <title>Clases</title>
        <h2 class="font-semibold dark:bg-gray-800 text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clases') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <br>
                <div class="flex ml-7 pb-2 justify-left">
                    @role('Docente|Admin')
                        <button data-modal-target="agregar-modal" data-modal-toggle="agregar-modal" type="button"
                            onclick="cargarMaterias({{ $materias }})"
                            class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-3 h-3 text-white me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 16">
                                <path
                                    d="M3.414 1A2 2 0 0 0 0 2.414v11.172A2 2 0 0 0 3.414 15L9 9.414a2 2 0 0 0 0-2.828L3.414 1Z" />
                            </svg>
                            {{ __('Agregar') }}
                        </button>
                    @endrole
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-[95%] mx-auto">
                    @if (session('status'))
                        <div id="session-status"
                            class="bg-green-800 text-gray-800 dark:text-gray-200 text-center text-lg font-bold p-2">
                            {{ session('status') }}</div>
                    @endif
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-white">ID</th>
                                <th scope="col" class="px-6 py-3 text-white">Materia</th>
                                <th scope="col" class="px-6 py-3 text-white">Fecha</th>
                                <th scope="col" class="px-6 py-3 text-white">Tema</th>
                                <th scope="col" class="px-6 py-3 text-white">Actividad</th>
                                <th scope="col" class="px-6 py-3 text-white">Asistencia</th>
                                <th scope="col" class="px-6 py-3 text-white">Recursos</th>
                                <th scope="col" class="px-6 py-3 text-white">Observaciones</th>
                                <th scope="col" class="px-6 py-3 text-white">Estrategia</th>
                                @role('Docente|Admin')
                                    <th scope="col" class="px-6 py-3 text-white">Acciones</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clases as $clase)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td scope="row"
                                        class="px-6 py- font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $clase->id }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $clase->materia->nombre }}
                                    </td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $clase->fecha }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $clase->tema }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $clase->actividad }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="flex justify-center">
                                            <button type="button" data-modal-target="asistencia-modal"
                                                data-modal-toggle="asistencia-modal"
                                                onclick="claseAsistencia({{ $clase }}, {{ $asistencias }}, {{ $estudiantes }})"
                                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-800 bg-gray-200 dark:bg-gray-800 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-300 dark:focus:bg-gray-700">
                                                <svg class="w-6 h-6" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 21 21">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m6.072 10.072 2 2 6-4m3.586 4.314.9-.9a2 2 0 0 0 0-2.828l-.9-.9a2 2 0 0 1-.586-1.414V5.072a2 2 0 0 0-2-2H13.8a2 2 0 0 1-1.414-.586l-.9-.9a2 2 0 0 0-2.828 0l-.9.9a2 2 0 0 1-1.414.586H5.072a2 2 0 0 0-2 2v1.272a2 2 0 0 1-.586 1.414l-.9.9a2 2 0 0 0 0 2.828l.9.9a2 2 0 0 1 .586 1.414v1.272a2 2 0 0 0 2 2h1.272a2 2 0 0 1 1.414.586l.9.9a2 2 0 0 0 2.828 0l.9-.9a2 2 0 0 1 1.414-.586h1.272a2 2 0 0 0 2-2V13.8a2 2 0 0 1 .586-1.414Z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{-- {{ pathinfo($clase->recursos, PATHINFO_BASENAME) }} |  --}}
                                        <a class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200"
                                            target="_blank" href="{{ asset($clase->recursos) }}">
                                            {{ __('Ver') }}
                                        </a> | <a href="{{ asset($clase->recursos) }}"
                                            download="{{ pathinfo($clase->recursos, PATHINFO_BASENAME) }}"
                                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200">
                                            {{ __('Descargar') }}
                                        </a></td>
                                    <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $clase->observaciones }}</td>
                                    <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $clase->estrategia }}</td>
                                    @role('Docente|Admin')
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <x-button data-modal-target="editar-modal" data-modal-toggle="editar-modal"
                                                type="button"
                                                onclick="editarClase({{ json_encode($clase) }}, {{ $materias }})">
                                                {{ __('Modificar') }}
                                            </x-button>
                                            <x-button data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                                                class="dark:bg-red-500 bg-red-500 hover:bg-blue-400 dark:hover:bg-blue-400"
                                                type="button" onclick="eliminar({{ $clase->id }})">
                                                {{ __('Eliminar') }}
                                            </x-button>
                                            </form>
                                        </td>
                                    @endrole
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        </div>
    </div>

    <!-- Agregar modal -->
    <div id="agregar-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ __('Agregar Clase') }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="agregar-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('clases.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-4 md:p-5">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="idMateria"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Selecciona la Materia') }}</label>
                            <select id="idMateria" name="idMateria"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>{{ __('Ninguno') }}</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="fecha"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Fecha') }}</label>
                            <div class="relative ">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input type="date" id="fecha" name="fecha"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="fecha" required="">
                            </div>
                        </div>
                        <div class="col-span-2">
                            <label for="tema"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tema') }}</label>
                            <input type="text" name="tema" id="tema"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Tematica' required="">
                        </div>
                        <div class="col-span-2">
                            <label for="actividad"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Actividad') }}</label>
                            <input type="text" name="actividad" id="actividad"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Actividades' required="">
                        </div>
                        <div class="col-span-2">
                            <label for="recursos"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Recursos') }}</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" name="recursos" id="recursos" type="file" required="">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" name="recursos" id="recursos">
                                SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
                        </div>
                        <div class="col-span-2">
                            <label for="observaciones"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Observaciones') }}</label>
                            <input type="text" name="observaciones" id="observaciones"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Comentarios' required="">
                        </div>
                        <div class="col-span-2">
                            <label for="estrategia"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Estrategia') }}</label>
                            <input type="text" name="estrategia" id="estrategia"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Metodo' required="">
                        </div>
                    </div>
                    @foreach (['idMateria', 'fecha', 'tema', 'actividad', 'recursos', 'observaciones', 'estrategia'] as $campo)
                        @error($campo)
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    @endforeach

                    <button type="submit"
                        class="mt-2 text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ __('Agreagar Clase') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar-->
    <div id="delete-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="delete-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                        {{ __('Seguro de eliminar esta Clase!?') }}</h3>

                    <form id="delete-form" action="#" method="POST">
                        @csrf
                        @method('DELETE')
                        <button data-modal-hide="delete-modal" type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            {{ __('Si, Eliminar') }}
                        </button>
                        <button data-modal-hide="delete-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">{{ __('Cancelar') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Editar modal -->
    <div id="editar-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ __('Editar Clase') }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="editar-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form id="editar-form" method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="idMateria"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Selecciona la Materia') }}</label>
                            <select id="edit-idMateria" name="idMateria"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>{{ __('Ninguno') }}</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="fecha"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Fecha') }}</label>
                            <div class="relative ">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input type="date" id="edit-fecha" name="fecha"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="fecha">
                            </div>
                        </div>
                        <div class="col-span-2">
                            <label for="tema"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tema') }}</label>
                            <input type="text" name="tema" id="edit-tema"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Tematica' required="">
                        </div>
                        <div class="col-span-2">
                            <label for="actividad"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Actividad') }}</label>
                            <input type="text" name="actividad" id="edit-actividad"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Actividades' required="">
                        </div>
                        <div class="col-span-2">
                            <label for="recursos" id="label-recursos"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Recursos') }}</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" name="recursos" id="recursos" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" name="recursos"
                                id="edit-recursos">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
                        </div>
                        <div class="col-span-2">
                            <label for="observaciones"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Observaciones') }}</label>
                            <input type="text" name="observaciones" id="edit-observaciones"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Comentarios' required="">
                        </div>
                        <div class="col-span-2">
                            <label for="estrategia"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Estrategia') }}</label>
                            <input type="text" name="estrategia" id="edit-estrategia"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Metodo' required="">
                        </div>
                    </div>
                    @foreach (['materia', 'fecha', 'tema', 'actividad', 'recursos', 'observaciones', 'estrategia'] as $campo)
                        @error($campo)
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    @endforeach

                    <button type="submit"
                        class="mt-2 text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ __('Guardar') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Asistencia modal -->
    <div id="asistencia-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-3xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        @if (auth()->user()->hasRole('Docente'))
                            {{ __('Registrar Asistencia') }}
                        @else
                            {{ __('Ver Asistencia') }}
                        @endif
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="asistencia-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="{{ route('asistencias.store') }}" method="POST" class="p-4 md:p-5">
                    @csrf
                    <div class="pt-6 pb-6 relative overflow-x-auto shadow-md sm:rounded-lg w-[95%] mx-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-white">ID</th>
                                    <th scope="col" class="px-6 py-3 text-white">Estudiante</th>
                                    <th scope="col" class="px-6 py-3 text-white">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <input type="hidden" name="idMateria" id="claseidMateria">
                                <input type="hidden" name="idClase" id="idClase">
                                @foreach ($estudiantes as $estudiante)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td scope="row"
                                            class="px-6 py- font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <input type="hidden" name="idEstudiante[]"
                                                value="{{ $estudiante->id }}">
                                            {{ $estudiante->id }}
                                        </td>
                                        <td scope="row"
                                            class="px-6 py- font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $estudiante->name }}
                                        </td>
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <input type="hidden" name="idAsistencia[]" id="idAsistencia{{ $estudiante->id }}">
                                            <select name="estado[]" id="estado{{ $estudiante->id }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="Faltante">Faltante</option>
                                                <option value="Presente">Presente</option>
                                                <option value="Tarde">Tarde</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @foreach (['idMateria', 'idClase', 'idAsistencia', 'idEstudiante', 'estado'] as $campo)
                            @error($campo)
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        @endforeach
                    </div>
                    @role('Docente|Admin')
                        <button type="submit"
                            class="mt-4 text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ __('Guardar') }}
                        </button>
                    @endrole
                </form>

            </div>
        </div>
    </div>

    <script>
        function eliminar(id) {
            document.getElementById('delete-form').action = '/clases/' + id;
        }

        function editarClase(clase, materias) {

            var selectEditMateria = document.getElementById('edit-idMateria');
            selectEditMateria.innerHTML = ''; // Limpiar el select antes de agregar nuevas opciones

            // Iterar sobre los roles y agregar cada uno como una opción en el select
            materias.forEach(function(materia) {
                var option = document.createElement('option');
                option.value = materia.id; // Asignar el valor del id del rol
                option.textContent = materia.nombre; // Asignar el nombre del rol como texto de la opción
                if (clase.idMateria === materia.id) {
                    option.selected = true; // Seleccionar la materia de la clase si coincide con la opción actual
                }
                selectEditMateria.appendChild(option); // Agregar la opción al select
            });

            document.getElementById('edit-fecha').value = clase.fecha;
            document.getElementById('edit-tema').value = clase.tema;
            document.getElementById('edit-actividad').value = clase.actividad;
            document.getElementById('edit-observaciones').value = clase.observaciones;
            document.getElementById('edit-estrategia').value = clase.estrategia;
            var labelRecursos = document.getElementById('label-recursos');

            if (clase.recursos === '') {
                labelRecursos.innerText = "{{ __('Cargar Recursos') }}";
            } else {
                labelRecursos.innerText = "{{ __('Reemplazar Recursos: ') }}";
            }

            document.getElementById('editar-form').action = '/clases/' + clase.id;
        }

        setTimeout(function() {
            var sessionStatus = document.getElementById('session-status');
            if (sessionStatus) {
                sessionStatus.style.display = 'none';
            }
        }, 2000);

        function cargarMaterias(materias) {
            var selectRol = document.getElementById('idMateria');
            selectRol.innerHTML = ''; // Limpiar el select antes de agregar nuevas opciones

            // Iterar sobre los roles y agregar cada uno como una opción en el select
            materias.forEach(function(materia) {
                var option = document.createElement('option');
                option.value = materia.id; // Asignar el valor del id del rol
                option.textContent = materia.nombre; // Asignar el nombre del rol como texto de la opción
                selectRol.appendChild(option); // Agregar la opción al select
            });
        }

        function claseAsistencia(clase, asistencias, estudiantes) {
            document.getElementById('claseidMateria').value = clase.idMateria;
            document.getElementById('idClase').value = clase.id;

            // Iterar sobre cada estudiante
            estudiantes.forEach(function(estudiante) {
                var selectEstado = document.getElementById('estado' + estudiante.id);
                var estadoSeleccionado = false; // Bandera para verificar si se seleccionó algún estado

                // Iterar sobre las asistencias para encontrar la del estudiante y clase específicos
                asistencias.forEach(function(asistencia) {
                    if (asistencia.idEstudiante === estudiante.id && asistencia.idClase === clase.id) {
                        // Seleccionar el valor de estado correspondiente
                        selectEstado.value = asistencia.estado;
                        estadoSeleccionado = true; // Se encontró un estado para este estudiante

                        // Establecer el valor del idAsistencia
                        document.getElementById('idAsistencia' + estudiante.id).value = asistencia.id;
                    }
                });

                // Si no se seleccionó ningún estado, restablecer el selector
                if (!estadoSeleccionado) {
                    selectEstado.selectedIndex = 0; // Seleccione la primera opción (Faltante)
                }
            });

        }
    </script>

</x-app-layout>
