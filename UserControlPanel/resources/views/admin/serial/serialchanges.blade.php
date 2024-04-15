@include('admin.newsidebar')
<div class="bg-orange-100 min-h-screen p-6">
    <!-- Heading and form container -->
    <div class="container mx-auto max-w-2xl mt-6 p-6 bg-white rounded shadow-md">
        <!-- Section heading -->
        <h2 class="text-lg font-bold mb-4 text-orange-600">Új serialváltási kérelem</h2>
        <!-- Form -->
        <form action="{{ url('serial.store') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <!-- Characters ID -->
            <div class="mb-4">
                <label for="character_id" class="block text-sm font-semibold text-gray-700 mb-2">Jelenlegi serialod</label>
                <input type="number" id="character_id" name="character_id" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-orange-300" placeholder="53B1A7EC7A1F032232C0042EB20FFF4" required>
            </div>

            <!-- Old Serial -->
            <div class="mb-4">
                <label for="old_serial" class="block text-sm font-semibold text-gray-700 mb-2">Új serialod</label>
                <input type="text" id="old_serial" name="old_serial" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-orange-300" placeholder="írd be az új serialod" required>
            </div>

            <!-- New Serial -->
            <div class="mb-4">
                <label for="new_serial" class="block text-sm font-semibold text-gray-700 mb-2">Indok</label>
                <input type="text" id="new_serial" name="new_serial" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-orange-300" placeholder="Indokold meg a serial váltoáshoz" required>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:border-orange-700 focus:ring focus:ring-orange-200 active:bg-orange-700 transition duration-150 ease-in-out">
                    Kérelem benyújtása
                </button>
            </div>
        </form>
    </div>

    <!-- Requests Table -->
    <div class="container mx-auto max-w-2xl mt-6 p-6 bg-white rounded shadow-md">
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
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <!-- Data Here -->
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <!-- Data Here -->
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <!-- Data Here -->
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <!-- Data Here -->
                    </td>
                </tr>
                <!-- More rows here -->
                </tbody>
            </table>
        </div>
    </div>
</div>
