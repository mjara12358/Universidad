<x-app-layout>
    <x-slot name="header">
        <title>Materias</title>
        <h2 class="font-semibold dark:bg-gray-800 text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Materias') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <br>
                <div class="flex ml-7 pb-2 justify-left">
                    @role('Docente|Admin')
                        <button data-modal-target="agregar-modal" data-modal-toggle="agregar-modal" type="button"
                            onclick="cargarProfesores({{ $profesores }})"
                            class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="mr-2 h-6 w-6 text-gray-200" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ __('Agregar') }}
                        </button>
                    @endrole
                    <div
                        class="flex ml-2 items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-0">

                        <label for="buscar" class="sr-only">{{ __('Buscar') }}</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="buscar"
                                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder={{ __('Buscar') }}>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-[95%] mx-auto">
                    @if (session('status'))
                        <div id="session-status"
                            class="bg-green-800 text-gray-800 dark:text-gray-200 text-center text-lg font-bold p-2">
                            {{ session('status') }}</div>
                    @endif
        
                    <table id="tabla-materias"
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-900 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Nombre</th>
                                <th scope="col" class="px-6 py-3">Semestre</th>
                                <th scope="col" class="px-6 py-3">Créditos</th>
                                <th scope="col" class="px-6 py-3">Profesor</th>
                                @role('Docente|Admin')
                                    <th scope="col" class="px-6 py-3">Acciones</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody id="filas-materias">
                            @foreach ($materias as $materia)
                                <tr id="fila-{{ $materia->id }}"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td scope="row"
                                        class="px-6 py- font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $materia->id }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $materia->nombre }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $materia->semestre }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $materia->creditos }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $materia->user->name }}</td>
                                    @role('Docente|Admin')
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <x-button-edit data-modal-target="editar-modal" data-modal-toggle="editar-modal"
                                                class="mr-1" type="button"
                                                onclick="editarMateria({{ json_encode($materia) }}, {{ $profesores }})">
                                            </x-button-edit>
                                            <x-button-delete data-modal-target="delete-modal"
                                                data-modal-toggle="delete-modal" type="button"
                                                onclick="eliminar({{ $materia->id }})">
                                            </x-button-delete>
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
                        {{ __('Agregar Materia') }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="agregar-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('materias.store') }}" method="POST" class="p-4 md:p-5">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="nombre"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nombre') }}</label>
                            <input type="text" name="nombre" id="nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Titulo de la Materia' required="">
                        </div>
                        <div class="col-span-2">
                            <label for="semestre"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Semestre') }}</label>
                            <input type="text" name="semestre" id="semestre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Numero de semestre' required="">
                        </div>
                        <div class="col-span-2">
                            <label for="creditos"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Creditos') }}</label>
                            <input type="text" name="creditos" id="creditos"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Numero de creditos' required="">
                        </div>
                        <div class="col-span-2">
                            <label for="profesor"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Selecciona la Profesor') }}</label>
                            <select id="profesor" name="idProfesor"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>{{ __('Ninguno') }}</option>
                            </select>
                        </div>
                    </div>
                    @foreach (['nombre', 'semestre', 'creditos', 'idProfesor'] as $campo)
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
                        {{ __('Agreagar Materia') }}
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
                        {{ __('Seguro de eliminar esta Materia!?') }}</h3>

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
                            <label for="nombre"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nombre') }}</label>
                            <input type="text" name="nombre" id="edit-nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Titulo de la Materia' required="">
                        </div>
                        <div class="col-span-2">
                            <label for="semestre"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Semestre') }}</label>
                            <input type="text" name="semestre" id="edit-semestre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='' required="">
                        </div>
                        <div class="col-span-2">
                            <label for="creditos"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Creditos') }}</label>
                            <input type="text" name="creditos" id="edit-creditos"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Numero de creditos' required="">
                        </div>
                        <div class="col-span-2">
                            <label for="profesor"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Selecciona la Profesor') }}</label>
                            <select id="edit-profesor" name="idProfesor"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>{{ __('Ninguno') }}</option>
                            </select>
                        </div>
                    </div>
                    @foreach (['nombre', 'semestre', 'creditos', 'idProfesor'] as $campo)
                        @error($campo)
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    @endforeach

                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="mr-2 h-5 w-5 text-gray-200" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                            <polyline points="17 21 17 13 7 13 7 21" />
                            <polyline points="7 3 7 8 15 8" />
                        </svg>
                        {{ __('Guardar') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('buscar').addEventListener('input', function() {
            var buscar = this.value.toLowerCase();
            var filas = document.getElementById('filas-materias').getElementsByTagName('tr');

            for (var i = 0; i < filas.length; i++) {
                var textoFila = filas[i].innerText.toLowerCase();
                if (textoFila.includes(buscar)) {
                    filas[i].style.display = '';
                } else {
                    filas[i].style.display = 'none';
                }
            }
        });

        function eliminar(id) {
            document.getElementById('delete-form').action = '/materias/' + id;
        }

        function editarMateria(materia, profesores) {

            var selectEditProf = document.getElementById('edit-profesor');
            selectEditProf.innerHTML = ''; // Limpiar el select antes de agregar nuevas opciones

            // Iterar sobre los roles y agregar cada uno como una opción en el select
            profesores.forEach(function(profesor) {
                var option = document.createElement('option');
                option.value = profesor.id; // Asignar el valor del id del rol
                option.textContent = profesor.name; // Asignar el nombre del rol como texto de la opción
                if (materia.idProfesor === profesor.id) {
                    option.selected = true; // Seleccionar la materia de la materia si coincide con la opción actual
                }
                selectEditProf.appendChild(option); // Agregar la opción al select
            });

            document.getElementById('edit-nombre').value = materia.nombre;
            document.getElementById('edit-semestre').value = materia.semestre;
            document.getElementById('edit-creditos').value = materia.creditos;

            document.getElementById('editar-form').action = '/materias/' + materia.id;
        }

        setTimeout(function() {
            var sessionStatus = document.getElementById('session-status');
            if (sessionStatus) {
                sessionStatus.style.display = 'none';
            }
        }, 2000);

        function cargarProfesores(profesores) {
            var selectProf = document.getElementById('profesor');
            selectProf.innerHTML = ''; // Limpiar el select antes de agregar nuevas opciones

            // Iterar sobre los roles y agregar cada uno como una opción en el select
            profesores.forEach(function(profesor) {
                var option = document.createElement('option');
                option.value = profesor.id; // Asignar el valor del id del rol
                option.textContent = profesor.name; // Asignar el nombre del rol como texto de la opción
                selectProf.appendChild(option); // Agregar la opción al select
            });
        }
    </script>
</x-app-layout>
