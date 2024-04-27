@include('admin.newsidebar')

<div class="bg-orange-100 min-h-screen p-6">
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="flex flex-wrap my-2">

            </div>
            <div class="overflow-x-auto mt-6">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Azonosító
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Neve
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Hírnév
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Tagok száma
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Mottó
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Műveletek
                        </th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">
                    @foreach ($factions as $faction)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                {{ $faction->id }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                {{ $faction->name }}
                            </td>
                            @foreach ($faction->factiondata as $key => $value)
                                @switch($key)
                                    @case('size')
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                        {{ $value }}
                                    </td>
                                    @case('motto')
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                        {{ $value }}
                                    </td>
                                    @break
                                    @default
                                        {{ ucfirst($key) }}: {{ $value }}<br>
                                @endswitch
                            @endforeach
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                <a href="{{ url('factions/edit/' . $faction->id) }}"
                                   class="text-blue-600 hover:text-blue-800">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="flex flex-wrap justify-center min-w-full bg-gray-50">
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.querySelector('#searchFaction');

        searchInput.addEventListener('keyup', debounce(function () {
            let searchParams = new URLSearchParams(window.location.search);
            searchParams.set(searchInput.name, searchInput.value);
            window.location.search = searchParams.toString();
        }, 500));
    });
</script>
