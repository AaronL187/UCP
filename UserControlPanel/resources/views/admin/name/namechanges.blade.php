@include('admin.newsidebar')
<div class=" min-h-screen p-6">
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Hoppá, valami hiba történt!</strong>
            <span class="block sm:inline">Kérjük, ellenőrizze az alábbi hibákat.</span>
            <ul class="mt-3 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- New Name Change Request Form -->
    <div class="container mx-auto max-w-4xl mt-6 p-6 bg-white rounded shadow-md">
        <h2 class="text-lg font-bold mb-4 text-orange-600">Új Névváltási kérelem</h2>
        <form action="{{ url('name/store') }}" method="POST">
            @csrf
            <!-- Old Name Input -->
            <div class="mb-4">
                <label for="old_name" class="block text-sm font-semibold text-gray-700 mb-2">Régi név</label>
                <input type="text" disabled id="old_name" name="old_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline disabled:opacity-25" value="{{$currentName}}" placeholder="{{ $currentName }}">
            </div>

            <!-- New Name Input -->
            <div class="mb-4">
                <label for="new_name" class="block text-sm font-semibold text-gray-700 mb-2">Új név</label>
                <input type="text" id="new_name" name="new_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Írd be az új nevet" required>
            </div>

            <!-- Reason Input -->
            <div class="mb-4">
                <label for="reason" class="block text-sm font-semibold text-gray-700 mb-2">Indok</label>
                <textarea id="reason" name="reason" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Indokold meg a névváltásod" required></textarea>
            </div>
            <div class="flex flex-col items-end space-y-2">
                @if ($checkIfRequestExists)
                    <div class="text-red-500 bg-red-100 border border-red-400 p-2 rounded">
                        Neked már van folyamatban egy kérelmed.
                    </div>
                    <button type="submit" disabled class="px-6 py-2 border border-transparent text-sm font-medium rounded-md text-gray-800 bg-gray-300 opacity-75 cursor-not-allowed">
                        Kérelem Benyújtása
                    </button>
                @else
                    <button type="submit" class="px-6 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-300 active:bg-blue-800 transition duration-150 ease-in-out">
                        Kérelem Benyújtása
                    </button>
                @endif
            </div>
        </form>
    </div>

    <!-- Name Change Requests Table -->
    <div class="container mx-auto max-w-6xl mt-6 p-6 bg-white rounded shadow-md">
        <h2 class="text-lg font-bold mb-4 text-orange-600">Névváltási kérelmek</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <!-- Table Headers -->
                <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Régi név
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Új név
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Állapot
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Indok
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($nameChanges as $change)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ $change->old_name }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ $change->new_name }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                            @if ($change->status === 1)
                                Elfogadva
                            @elseif ($change->status === 0)
                                Elutasítva
                            @else
                                Függőben
                            @endif
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ $change->reason }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
