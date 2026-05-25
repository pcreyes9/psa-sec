<div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-gray-200">

    <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 p-4 bg-white">

        <!-- Dropdown -->
        <div>
            <button id="dropdownActionButton"
                    data-dropdown-toggle="dropdownAction"
                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5"
                    type="button">

                <span class="sr-only">Action button</span>

                Action

                <svg class="w-3 h-3 ms-2"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 10 6">

                    <path stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m1 1 4 4 4-4"/>
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdownAction"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">

                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownActionButton">

                    <li>
                        <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Reward
                        </a>
                    </li>

                    <li>
                        <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Promote
                        </a>
                    </li>

                    <li>
                        <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Archive
                        </a>
                    </li>
                </ul>

                <div class="py-1">
                    <a href="#"
                    class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        Delete
                    </a>
                </div>
            </div>
        </div>

        <!-- Search -->
        <label for="table-search" class="sr-only">Search</label>

        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">

                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 20 20">

                    <path stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>

            <input type="text"
                id="table-search"
                class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Search users">
        </div>
    </div>

    <!-- Table -->
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

        <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-200 dark:text-gray-900">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search"
                            type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">

                        <label for="checkbox-all-search" class="sr-only">
                            checkbox
                        </label>
                    </div>
                </th>

                <th scope="col" class="px-6 py-3">
                    Name
                </th>

                <th scope="col" class="px-6 py-3">
                    Position
                </th>

                 <th scope="col" class="px-6 py-3">
                    Salary
                </th>

                <th scope="col" class="px-6 py-3">
                    Status
                </th>

                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($employees as $employee)
                <tr class="bg-white border-b hover:bg-gray-50">

                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                        </div>
                    </td>

                    <th scope="row"
                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">

                        <img class="w-10 h-10 rounded-full"
                            src="https://flowbite.com/docs/images/people/profile-picture-1.jpg"
                            alt="Neil Sims">

                        <div class="ps-3">
                            <div class="text-base font-semibold">
                                {{ $employee->name }}
                            </div>

                            <div class="font-normal text-gray-500">
                                {{-- {{ $employee->email }} --}}
                                Email Address
                            </div>
                        </div>
                    </th>

                    <td class="px-6 py-4">
                        {{ $employee->position }}
                    </td>

                    <td class="px-6 py-4">
                        ₱{{ number_format($employee->salary, 2) }}
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-green-400 me-2"></div>
                            Online
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <a href="#"
                        class="font-medium text-blue-600 hover:underline"
                        data-modal-target="crud-modal" 
                        data-modal-toggle="crud-modal"
                        wire:click="modalShow('{{ $employee->id }}')"
                        >
                            View User
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <!-- Modal toggle -->
    {{-- <button 
        data-modal-target="crud-modal" 
        data-modal-toggle="crud-modal"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none"
        type="button">

        Toggle modal
    </button> --}}

    <!-- Main modal -->
    <div id="crud-modal"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
                justify-center items-center w-full md:inset-0 h-full 
                backdrop-blur-sm bg-black/20">

        <div class="relative p-4 w-full max-w-4xl max-h-full">

            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-600">

                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{-- {{ $employee_modal->name ?? 'Employee Details' }} --}}
                    </h3>

                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="crud-modal">

                        <svg class="w-3 h-3"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 14 14">

                            <path stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m1 1 6 6 6-6M1 13l6-6 6 6"/>
                        </svg>

                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <form class="p-4 md:p-5">

                    <div class="grid gap-4 mb-4 grid-cols-2">

                        <div class="col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">

                                Name
                            </label>

                            <input type="text"
                                name="name"
                                id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Type product name"
                                disabled>
                        </div>

                        <div class="col-span-2 sm:col-span-1">

                            <label for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">

                                Price
                            </label>

                            <input type="number"
                                name="price"
                                id="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="$2999"
                                disabled>
                        </div>

                        <div class="col-span-2 sm:col-span-1">

                            <label for="category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">

                                Category
                            </label>

                            <select id="category"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    disabled>

                                <option selected>Select category</option>
                                <option value="TV">TV/Monitors</option>
                                <option value="PC">PC</option>
                                <option value="GA">Gaming/Console</option>
                                <option value="PH">Phones</option>
                            </select>
                        </div>

                        <div class="col-span-2">

                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">

                                Product Description
                            </label>

                            <textarea id="description"
                                    rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Write product description here"
                                    disabled></textarea>
                        </div>
                    </div>

                    <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">

                        <svg class="me-1 -ms-1 w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">

                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>

                        Add new product
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>