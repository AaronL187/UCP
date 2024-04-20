@include('admin.newsidebar')
<div class="bg-orange-100 min-h-screen p-6">
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
    <div class="container mx-auto max-w-4xl mt-6 p-6 bg-white rounded shadow-md">

        <h2 class="text-lg font-bold mb-4 text-orange-600">Új Serialváltási kérelem</h2>
        <form action="{{ url('serial/store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="old_serial" class="block text-sm font-semibold text-gray-700 mb-2">Jelenlegi serialod</label>
                <input type="text" id="old_serial" name="old_serial" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-orange-300" placeholder="{{ strtoupper($currentSerial) ?? 'Nem található Serial ehhez a felhasználóhoz' }}" required>
            </div>

            <div class="mb-4">
                <label for="new_serial" class="block text-sm font-semibold text-gray-700 mb-2">Új serialod</label>
                <input type="text" id="new_serial" name="new_serial" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-orange-300" placeholder="Írd be az új serialod" required>
            </div>

            <div class="mb-4">
                <label for="reason" class="block text-sm font-semibold text-gray-700 mb-2">Indok</label>
                <input type="text" id="reason" name="reason" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-orange-300" placeholder="Indokold meg a serial váltásod" required>
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

    <div class="container mx-auto max-w-6xl mt-6 p-6 bg-white rounded shadow-md">
        <h2 class="text-lg font-bold mb-4 text-orange-600">Serialváltási kérelmek</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                        Régi serial
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                        Új serial
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                        Állapot
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                        Indok
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($serialChanges as $change)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ strtoupper($change->old_serial) }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ strtoupper($change->new_serial) }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                            @if ($change->status === 1)
                                Elfogadva
                            @elseif ($change->status === 0)
                                Elutasítva
                            @else
                                Kérelem elküldve
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
