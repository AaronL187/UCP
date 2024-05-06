@include('admin.newsidebar')

<div class="bg-gray-100 p-6 min-h-screen">
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Panaszaid</h1>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Siker!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Összes Panasz</h3>
            </div>
            <div class="flex flex-wrap my-2">
                <div class="w-full sm:w-1/4">
                    <input placeholder="Azonosító vagy beküldő alapján" type="text" id="searchInput"
                           class="appearance-none rounded border border-gray-400 py-2 px-4 w-full bg-white text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300"/>
                </div>
            </div>
            <button id="toggleButton" class="px-4 py-2 mb-4 text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-300 active:bg-blue-800 transition duration-150 ease-in-out">
                Függőben lévők mutatása
            </button>
            <div class="border-t border-gray-200">
                <dl>
                    @if($complaints->isEmpty())
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <h3 class="text-sm leading-5 font-medium text-gray-500">Még nem tettél panaszt.</h3>
                        </div>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Azonosító
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Beküldése Dátuma
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Panasz
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Panaszra tett játékos
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Állapot
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Kezelte
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    További részletek
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($complaints as $complaint)
                                <tr data-status="{{ is_null($complaint->status) ? 'null' : $complaint->status }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $complaint->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $complaint->created_at }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $complaint->title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <a href="{{ url('characters/edit', $complaint->complained_against) }}" class="text-indigo-600 hover:text-indigo-900">Felhasználó #{{ $complaint->complained_against }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                {{ $complaint->status === 1 ? 'bg-green-100 text-green-800' :
                   ($complaint->status === 0 ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                {{ $complaint->status === 1 ? 'Elfogadva' : ($complaint->status === 0 ? 'Elutasítva' : 'Folyamatban') }}
            </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if ($complaint->handled_by == null)
                                            Nincs
                                        @else
                                        <a href="{{ url('users/edit', $complaint->handled_by) }}" class="text-indigo-600 hover:text-indigo-900">Felhasználó #{{$complaint->handled_by}}</a>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ url('complaint', $complaint->id) }}" class="text-indigo-600 hover:text-indigo-900">További részletek</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </dl>
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

    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('toggleButton');
        let showAll = false; // Start by showing only pending items

        toggleButton.addEventListener('click', function () {
            showAll = !showAll; // Toggle the state between showing all and showing only pending
            const rows = document.querySelectorAll('tbody tr[data-status]');
            rows.forEach(row => {
                const status = row.getAttribute('data-status');
                if (showAll || status === 'null') {
                    row.style.display = ''; // Show row
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });
            toggleButton.textContent = showAll ? 'Csak a folyamatban lévők mutatása' : 'Összes mutatása';
        });
    });

</script>
