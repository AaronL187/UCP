<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GameLife - AdminPanel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Ensure you include FontAwesome for icons if you're using them -->
</head>
<body class="bg-white font-sans">

<div class="flex w-full h-16 bg-blue-800 z-30">
    <a class="text-white text-xl font-bold p-4" href="#"></a>
    <button onclick="toggleSidebar()" class="text-white ml-auto p-4 focus:outline-none">
        <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24"> <!-- Hamburger Icon -->
            <path d="M3,18H21V16H3V18Z M3,13H21V11H3V13Z M3,6V8H21V6H3Z" />
        </svg>
    </button>
</div>

<div x-data="{ open: true }" class="sidebar fixed top-0 left-0 h-full bg-gray-800 text-white transform -translate-x-full transition duration-300 ease-in-out z-20 w-64 overflow-y-auto">
    <div class="sidebar-header p-5 text-center border-b border-gray-700">
        <img src="{{ asset('/admin/assets/images/logo.png') }}" alt="Logo" class="w-40 h-24 mx-auto">
        <h2 class="text-white">Adminisztrációs felület</h2>
    </div>
    <ul class="sidebar-menu mt-4 space-y-2">
        <!-- Menu Item with Submenu -->
        <div x-data="{ serialOpen: false, nameChangeOpen: false }">
            <ul class="sidebar-menu mt-4">
                <!-- Serialváltási kérelmek menu item with toggle for submenu -->
                <li class="menu-item p-3 hover:bg-gray-700">
                    <a @click="serialOpen = !serialOpen" class="flex items-center justify-between cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                        </svg>

                        <span class="flex items-center">
                    <span class="icon mr-4">
                        <!-- Main Item Icon (e.g., dashboard) -->
                    </span>
                    <span class="title" >Serialváltási kérelmek</span>
                </span>
                        <!-- Toggle Icon -->
                        <svg :class="{'rotate-45': open}" class="transition-transform h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </a>
                    <!-- Submenu -->
                    <ul x-show="serialOpen" x-collapse class="mt-2 space-y-2">
                        <li class="pl-8 pr-3 py-1 hover:bg-gray-700">
                            <a href={{url('serial/show')}} class="flex items-center">
                                <span class="title">Serialváltási kérelem beküldése</span>
                            </a>
                        </li>
                        <li class="pl-8 pr-3 py-1 hover:bg-gray-700">
                            <a href={{url('serial/manage')}} class="flex items-center">
                                <span class="title">Serialváltások kezelése</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Névváltási kérelmek menu item with toggle for submenu -->
                <li class="menu-item p-3 hover:bg-gray-700">
                    <a @click="nameChangeOpen = !nameChangeOpen" class="flex items-center justify-between cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                        </svg>

                        <span class="flex items-center">
                    <span class="icon mr-4">
                        <!-- Main Item Icon (e.g., settings) -->
                    </span>
                    <span class="title">Névváltási kérelmek</span>
                </span>
                        <svg :class="{'rotate-180': nameChangeOpen}" class="transition-transform h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </a>
                    <!-- Submenu -->
                    <ul x-show="nameChangeOpen" x-collapse class="mt-2 space-y-2">
                        <li class="pl-8 pr-3 py-1 hover:bg-gray-700">
                            <a href="#" class="flex items-center">
                                <span class="title">Névváltási kérelem beküldése</span>
                            </a>
                        </li>
                        <li class="pl-8 pr-3 py-1 hover:bg-gray-700">
                            <a href="#" class="flex items-center">
                                <span class="title">Névváltások kezelése</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        </li>
        <!-- Existing Serialváltási kérelmek and Névváltási kérelmek menu items... -->

        <!-- Profil menu item -->
        <li class="menu-item p-3 hover:bg-gray-700 flex items-center">
            <a href="#" class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>

                <!-- Replace # with the actual link to the Profil page -->
                <span class="title cursor-pointer">Profil</span>
            </a>
        </li>


        <!-- Tiltólista menu item -->
        <li class="menu-item p-3 hover:bg-gray-700">
            <a href="#" class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
                </svg>

                <!-- Replace # with the actual link to the Tiltólista page -->
                <span class="title">Tiltólista</span>
            </a>
        </li>
        <!-- Karakterek menu item -->
        <li class="menu-item p-3 hover:bg-gray-700">
            <a href="#" class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>

                <!-- Replace # with the actual link to the Karakterek page -->
                <span class="title">Karakterek</span>
            </a>
        </li>
        <!-- Felhasználók menu item -->
        <li class="menu-item p-3 hover:bg-gray-700">
            <a href="#" class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                </svg>

                <!-- Replace # with the actual link to the Felhasználók page -->
                <span class="title">Felhasználók</span>
            </a>
        </li>
        <!-- Járművek menu item -->
        <li class="menu-item p-3 hover:bg-gray-700">
            <a href="#" class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>

                <!-- Replace # with the actual link to the Járművek page -->
                <span class="title">Járművek</span>
            </a>
        </li>
        <!-- Frakciók menu item -->
        <li class="menu-item p-3 hover:bg-gray-700">
            <a href="#" class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                </svg>

                <!-- Replace # with the actual link to the Frakciók page -->
                <span class="title">Frakciók</span>
            </a>
        </li>
        <!-- Háziállatok menu item -->
        <li class="menu-item p-3 hover:bg-gray-700">
            <a href="#" class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>

                <!-- Replace # with the actual link to the Háziállatok page -->
                <span class="title">Háziállatok</span>
            </a>
        </li>
        <!-- Felhasználói Csoportok menu item -->
        <li class="menu-item p-3 hover:bg-gray-700">
            <a href="#" class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                </svg>

                <!-- Replace # with the actual link to the Felhasználói Csoportok page -->
                <span class="title">Felhasználói Csoportok</span>
            </a>
        </li>
        <!-- Csapat menu item -->
        <li class="menu-item p-3 hover:bg-gray-700">
            <a href="#" class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <!-- Replace # with the actual link to the Csapat page -->
                <span class="title">Admin Csapat</span>


            </a>
        </li>
        <!-- Logok menu item -->
        <li class="menu-item p-3 hover:bg-gray-700">
            <a href="#" class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                </svg>

                <!-- Replace # with the actual link to the Logok page -->
                <span class="title">Logok</span>
            </a>
        </li>
        <!-- Serialváltási kérelmek menu item with toggle for submenu -->
        <li class="menu-item p-3 hover:bg-gray-700">
            <a @click="ticketOpen = !ticketOpen" class="flex items-center justify-between cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                </svg>

                <span class="flex items-center">
                    <span class="icon mr-4">
                        <!-- Main Item Icon (e.g., dashboard) -->
                    </span>
                    <span class="title" >Hiba jelentések</span>
                </span>
                <!-- Toggle Icon -->
                <svg :class="{'rotate-45': ticketOpen}" class="transition-transform h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </a>
            <!-- Submenu -->
            <ul x-show="ticketOpen" x-collapse class="mt-2 space-y-2">
                <li class="pl-8 pr-3 py-1 hover:bg-gray-700">
                    <a href="#" class="flex items-center">
                        <span class="title">Serialváltási kérelem beküldése</span>
                    </a>
                </li>
                <li class="pl-8 pr-3 py-1 hover:bg-gray-700">
                    <a href="#" class="flex items-center">
                        <span class="title">Serialváltások kezelése</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>

<div x-data="{ isOpen: true }">
    <button x-on:click="isOpen = !isOpen"></button>
    <div id="sidebar" :class="{'-translate-x-full': !isOpen, 'translate-x-0': isOpen}" class="transition-transform">
        <!-- Sidebar content goes here -->
    </div>
</div>
<script src="//unpkg.com/alpinejs" defer></script>
<script src="//unpkg.com/@alpinejs/collapse" defer></script>



<div class="pl-0 md:pl-64 pt-16">
    <!-- Main content here -->
</div>

<script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('-translate-x-full');
    }

</script>

</body>
</html>
