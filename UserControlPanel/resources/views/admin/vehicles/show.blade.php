@include('admin.newsidebar')

<div class="bg-orange-100 min-h-screen p-6">
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="flex flex-wrap my-2">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <input type="text" class="form-control" placeholder="Search by ID" id="searchId" name="searchId">
                    </div>
                    <div class="w-full md:w-1/3 px-3">
                        <input type="text" class="form-control" placeholder="Search by Owner Name" id="searchOwner" name="searchOwner">
                    </div>
                    <div class="w-full md:w-1/3 px-3">
                        <input type="text" class="form-control" placeholder="Search by Model ID" id="searchModelId" name="searchModelId">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mt-4">
                        <button type="submit" class="btn btn-primary">Keresés</button>
                    </div>
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
                            Modell
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Tulajdonos
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Szín
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Pozíció (X, Y, Z)
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">
                    @foreach ($vehicles as $vehicle)
                        <tr @if($loop->even) class="bg-gray-100" @endif>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                {{ $vehicle->id }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                {{ $vehicleModels[$vehicle->model] ?? 'Unknown Model' }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                            {{ $vehicle->character ? $vehicle->character->charactername : 'No Owner' }} ({{ $vehicle->character ? $vehicle->character->id : 'N/A' }})

                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <div style="width: 20px; height: 20px; background-color: rgb({{ $vehicle->r }}, {{ $vehicle->g }}, {{ $vehicle->b }}); border: 1px solid #ddd;"></div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                ({{ $vehicle->x }}, {{ $vehicle->y }}, {{ $vehicle->z }})
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm text-gray-700">
                                <a href="{{ url('vehicles/edit/' . $vehicle->id) }}" class="text-blue-600 hover:text-blue-800">Modify</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="flex flex-wrap justify-center min-w-full bg-gray-50">
                {{ $vehicles->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInputs = document.querySelectorAll('#searchId, #searchOwner, #searchModelId');

        searchInputs.forEach(input => {
            input.addEventListener('keyup', debounce(function () {
                // Trigger the search on all fields
                let searchParams = new URLSearchParams(window.location.search);
                searchParams.set(input.name, input.value);
                window.location.search = searchParams.toString();
            }, 500));
        });
    });

</script>
