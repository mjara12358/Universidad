<x-app-layout>
    <x-slot name="header">
        <title>Clases</title>
        <h2 class="font-semibold dark:bg-gray-800 text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Usuarios') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <br>
                <div class="flex ml-7 pb-2 justify-left">

                    <button data-modal-target="agregar-modal" data-modal-toggle="agregar-modal" type="button"
                        onclick="cargarRoles({{ $roles }})"
                        class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-6">
                            <path
                                d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                        </svg>
                        {{ __('Agregar') }}
                    </button>
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
                    <table id="tabla-users" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-900 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Nombre</th>
                                <th scope="col" class="px-6 py-3">Correo</th>
                                <th scope="col" class="px-6 py-3">Rol</th>
                                <th scope="col" class="px-6 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="filas-users">
                            @foreach ($users as $user)
                                <tr id="fila-{{ $user->id }}"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td scope="row"
                                        class="px-6 py- font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $user->id }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $user->name }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $user->email }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        @foreach ($user->roles as $role)
                                            {{ $role->name }}
                                        @endforeach
                                    </td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <x-button-edit data-modal-target="editar-modal" data-modal-toggle="editar-modal"
                                            type="button" class="mr-1"
                                            onclick="editarClase({{ json_encode($user) }}, {{ $roles }})">
                                        </x-button-edit>
                                        @if ($user->id !== 1)
                                            <x-button-delete data-modal-target="delete-modal"
                                                data-modal-toggle="delete-modal" type="button"
                                                onclick="eliminar({{ $user->id }})">
                                            </x-button-delete>
                                        @endif
                                        </form>
                                    </td>
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
                        {{ __('Agregar Usuario') }}
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
                <form action="{{ route('users.store') }}" method="POST" class="p-4 md:p-5">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nombre') }}</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Nombre del Usuario' required="">
                        </div>
                        <div class="col-span-2">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Correo') }}</label>
                            <input type="text" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Correo Electronico' required="">
                        </div>
                        <div class="col-span-2">
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Contraseña') }}</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="•••••••••" required />
                        </div>
                        <div class="col-span-2">
                            <label for="password_confirmation"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Confirmar Contraseña') }}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="•••••••••" required />
                        </div>
                        <div class="col-span-2">
                            <label for="role"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Selecciona el Rol') }}</label>
                            <select id="role" name="role"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>{{ __('Ninguno') }}</option>
                            </select>
                        </div>

                    </div>
                    @foreach (['name', 'email', 'password', 'password_confirmation', 'role'] as $campo)
                        @error($campo)
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    @endforeach

                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ __('Agreagar') }}
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
                        {{ __('Seguro de eliminar este Usuario!?') }}</h3>

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
                        {{ __('Editar Usuario') }}
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
                <form id='editar-form' method="POST" class="p-4 md:p-5">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="edit-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nombre') }}</label>
                            <input type="text" name="name" id="edit-name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Nombre del usuario' required="">
                        </div>
                        <div class="col-span-2">
                            <label for="edit-email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Correo') }}</label>
                            <input type="text" name="email" id="edit-email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Correo Electronico' required="">
                        </div>
                        <div class="col-span-2">
                            <label for="edit_password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Contraseña') }}</label>
                            <input type="text" name="password" id="edit-password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Password Temporal' required="">
                        </div>
                        {{-- <div class="col-span-2">
                            <label for="edit_password_confirmation"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Confirmar Contraseña') }}</label>
                            <input type="text" name="password_confirmation" id="password_confirmation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Confirm Password Temporal' required="">
                        </div> --}}
                        <div class="col-span-2">
                            <label for="edit_role"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Selecciona el Rol') }}</label>
                            <select id="edit_role" name="role"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>{{ __('Ninguno') }}</option>
                            </select>
                        </div>

                    </div>
                    @foreach (['name', 'email', 'password', 'role'] as $campo)
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
            var filas = document.getElementById('filas-users').getElementsByTagName('tr');

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
            document.getElementById('delete-form').action = '/users/' + id;
        }

        function editarClase(user, roles) {
            document.getElementById('edit-name').value = user.name;
            document.getElementById('edit-email').value = user.email;
            //document.getElementById('edit-password').value = user.password;

            var selectEditRol = document.getElementById('edit_role');
            selectEditRol.innerHTML = ''; // Limpiar el select antes de agregar nuevas opciones

            // Iterar sobre los roles y agregar cada uno como una opción en el select
            roles.forEach(function(role) {
                var option = document.createElement('option');
                option.value = role.id; // Asignar el valor del id del rol
                option.textContent = role.name; // Asignar el nombre del rol como texto de la opción
                if (user.roles.length > 0 && user.roles[0].id === role.id) {
                    option.selected = true; // Seleccionar el rol del usuario si coincide con la opción actual
                }
                selectEditRol.appendChild(option); // Agregar la opción al select
            });

            document.getElementById('editar-form').action = '/users/' + user.id;
        }

        setTimeout(function() {
            var sessionStatus = document.getElementById('session-status');
            if (sessionStatus) {
                sessionStatus.style.display = 'none';
            }
        }, 2000);

        function cargarRoles(roles) {
            var selectRol = document.getElementById('role');
            selectRol.innerHTML = ''; // Limpiar el select antes de agregar nuevas opciones

            // Iterar sobre los roles y agregar cada uno como una opción en el select
            roles.forEach(function(role) {
                var option = document.createElement('option');
                option.value = role.id; // Asignar el valor del id del rol
                option.textContent = role.name; // Asignar el nombre del rol como texto de la opción
                selectRol.appendChild(option); // Agregar la opción al select
            });
        }
    </script>

</x-app-layout>
