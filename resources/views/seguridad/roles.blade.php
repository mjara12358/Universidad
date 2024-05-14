<x-app-layout>
    <x-slot name="header">
        <title>Roles</title>
        <h2 class="font-semibold dark:bg-gray-800 text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roles') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <br>
                <div class="flex ml-7 pb-2 justify-left">

                    <button data-modal-target="agregar-modal" data-modal-toggle="agregar-modal" type="button"
                        class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="mr-2 h-6 w-6 text-gray-200" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ __('Agregar') }}
                    </button>

                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-[95%] mx-auto">
                    @if (session('status'))
                        <div id="session-status"
                            class="bg-green-800 text-gray-800 dark:text-gray-200 text-center text-lg font-bold p-2">
                            {{ session('status') }}</div>
                    @endif
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-900 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-100">

                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Nombre</th>
                                <th scope="col" class="px-6 py-3">Permisos</th>
                                <th scope="col" class="px-6 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $role->id }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $role->name }}</td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        @foreach ($role->permissions as $permission)
                                            <span scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <x-button-edit data-modal-target="editar-modal" data-modal-toggle="editar-modal"
                                            class="mr-1" type="button"
                                            onclick="editarClase({{ json_encode($role) }})"
                                            data-permissions="{{ json_encode($role->permissions->pluck('id')) }}">
                                        </x-button-edit>
                                        @if ($role->id !== 1)
                                            <x-button-delete data-modal-target="delete-modal"
                                                data-modal-toggle="delete-modal" type="button"
                                                onclick="eliminar({{ $role->id }})">
                                            </x-button-delete>
                                        @endif
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
                <form action="{{ route('roles.store') }}" method="POST" class="p-4 md:p-5">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nombre') }}</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Nombre del Rol' required="">
                        </div>
                        <div class="col-span-2 ">
                            <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">{{ __('Permisos') }}</h3>
                            <ul
                                class="w-68 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach ($permisos as $permiso)
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center ps-3">
                                            <input id="{{ $permiso->name }}" name="permissions[]" type="checkbox"
                                                value="{{ $permiso->id }}"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="{{ $permiso->name }}"
                                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $permiso->name }}</label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                    @foreach (['name, permissions'] as $campo)
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
                        {{ __('Seguro de eliminar este Rol!?') }}</h3>

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
                        {{ __('Editar Rol') }}
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
                <form id="editar-form" method="POST" class="p-4 md:p-5">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nombre') }}</label>
                            <input type="text" name="name" id="edit-name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder='Nombre del Rol' required="">
                        </div>
                        <div class="col-span-2 ">
                            <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">{{ __('Permisos') }}</h3>
                            <ul
                                class="w-68 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach ($permisos as $permiso)
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center ps-3">
                                            <input id="{{ $permiso->id }}" name="permissions[]" type="checkbox"
                                                value="{{ $permiso->id }}"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="{{ $permiso->name }}"
                                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $permiso->name }}</label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                    @foreach (['name, permissions'] as $campo)
                        @error($campo)
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    @endforeach

                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="mr-2 h-5 w-5 text-gray-200" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
        function eliminar(id) {
            document.getElementById('delete-form').action = '/roles/' + id;
        }

        function editarClase(role) {
            document.getElementById('edit-name').value = role.name;

            // Desmarcar todos los checkboxes antes de marcar los correspondientes
            document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                checkbox.checked = false;
            });

            var permissions = JSON.parse(document.querySelector("[data-permissions='" + JSON.stringify(role.permissions.map(
                p => p.id)) + "']").getAttribute("data-permissions"));
            permissions.forEach(permissionId => {
                document.getElementById(permissionId).checked = true;
            });

            document.getElementById('editar-form').action = '/roles/' + role.id;
        }

        setTimeout(function() {
            var sessionStatus = document.getElementById('session-status');
            if (sessionStatus) {
                sessionStatus.style.display = 'none';
            }
        }, 2000);
    </script>

</x-app-layout>
