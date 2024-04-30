@include('admin.newsidebar')

<div class="bg-orange-100 min-h-screen p-6">
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="flex flex-wrap my-2">
                <div class="w-full sm:w-1/4">
                    <input placeholder="Keresés Karakternév vagy ID alapján..." type="text" id="searchInput"
                           class="appearance-none rounded border border-gray-400 py-2 px-4 w-full bg-white text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300"/>
                </div>
            </div>
            <div class="overflow-x-auto mt-6">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            #
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Karakternév
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Utolsó belépés
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Pénz
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Műveletek
                        </th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">
                    @foreach ($characters as $character)
                        <tr @if($loop->even) class="bg-gray-100" @endif>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                {{ $character->id }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                {{ $character->charactername }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                {{ $character->last_login_time->format('Y-m-d H:i:s') }} <!-- Assuming last_login_time is a date -->
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                Készpénz: {{ $character->money }} Ft
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                <a href="{{ url('characters/edit/' . $character->id) }}"
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
            <div class="flex flex-wrap justify-center min-w-full ml-auto -left-20 bg-gray-50">
                {{ $characters->links('vendor.pagination.tailwind') }}

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
    }
</script>
