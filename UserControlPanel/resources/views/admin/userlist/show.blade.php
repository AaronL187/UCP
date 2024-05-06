@include('admin.newsidebar')

<div class=" min-h-screen p-6">

    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="flex flex-wrap my-2">
                <div class="w-full sm:w-1/4">
                    <input placeholder="Search by Username or ID..." type="text" id="searchInput"
                           class="appearance-none rounded border border-gray-400 py-2 px-4 w-full bg-white text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300"/>
                </div>
            </div>
            <div class="overflow-x-auto mt-6">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Azonosító
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Felhasználónév
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            E-mail
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Serial
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Műveletek
                        </th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">
                    @foreach ($users as $user)
                        <tr @if($loop->even) class="bg-gray-100" @endif>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                {{ $user->id }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                {{ $user->username }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                {{ $user->email }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                {{ strtoupper($user->serial) }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                <a href="{{ url('users/edit/' . $user->id) }}"
                                   class="text-blue-600 hover:text-blue-800">
                                    Módosítás
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="flex flex-wrap justify-center min-w-full ml-auto bg-gray-50">
                {{ $users->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('keyup', debounce(function () {
            window.location.href = `?search=${searchInput.value}`;
        }, 500));
    });

    function debounce(func, timeout = 300) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => {
                func.apply(this, args);
            }, timeout);
        };
    };
</script>
