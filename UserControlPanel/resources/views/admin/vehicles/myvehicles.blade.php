@include('admin.newsidebar')

<div class="b min-h-screen p-6">
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="flex flex-wrap my-2">
               <h2 class="text-2xl font-semibold text-gray-700">Járműveim</h2>

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
                            Tuning
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Módosítás
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
                                @if(is_array( $vehicle->tuning))
                                    <ul>
                                        @foreach ($vehicle->tuning as $key => $value)
                                            <li>
                                                @switch($key)
                                                    @case('wheels')
                                                        Kerék Tuning: Stage {{ $value }}
                                                        @break
                                                    @case('engine')
                                                        Motor Tuning: Stage {{ $value }}
                                                        @break
                                                    @case('ecu')
                                                        ECU Tuning: Stage {{ $value }}
                                                        @break
                                                    @case('transmission')
                                                        Váltó Tuning: Stage {{ $value }}
                                                        @break
                                                    @case('nitro')
                                                        Nitro Tuning: Stage {{ $value }}
                                                        @break
                                                    @default
                                                        {{ ucfirst($key) }}: Stage {{ $value }}
                                                @endswitch
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    Gyári kiadás
                                @endif
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
            </div>
        </div>
    </div>
</div>

<script>
    // Simple debounce function to limit the rate of function execution
    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    document.addEventListener('DOMContentLoaded', function () {
        const searchInputs = document.querySelectorAll('#searchId, #searchOwner, #searchModelId');

        searchInputs.forEach(input => {
            input.addEventListener('keyup', debounce(function () {
                let searchParams = new URLSearchParams(window.location.search);

                // Update the URL search parameters for each field
                searchInputs.forEach(input => {
                    if (input.value) { // Only add parameter if input is not empty
                        searchParams.set(input.name, input.value);
                    } else {
                        searchParams.delete(input.name); // Remove parameter if input is empty
                    }
                });

                window.location.search = searchParams.toString();
            }, 500));
        });
    });
</script>
