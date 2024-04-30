@include('admin.newsidebar')

<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white p-8 rounded-md shadow-md">
        <h1 class="text-xl font-semibold mb-6">Karakter Szerkesztése</h1>
        <form method="POST" action="{{ url('characters/edit/', $character->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="charactername" class="block text-gray-700 text-sm font-bold mb-2">Karakter Neve:</label>
                <input type="text" id="charactername" name="charactername" value="{{ $character->charactername }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label for="health" class="block text-gray-700 text-sm font-bold mb-2">Életerő:</label>
                    <input type="number" id="health" name="health" value="{{ $character->health }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div>
                    <label for="armor" class="block text-gray-700 text-sm font-bold mb-2">Páncél:</label>
                    <input type="number" id="armor" name="armor" value="{{ $character->armor }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label for="hunger" class="block text-gray-700 text-sm font-bold mb-2">Éhség:</label>
                    <input type="number" id="hunger" name="hunger" value="{{ $character->hunger }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div>
                    <label for="thirst" class="block text-gray-700 text-sm font-bold mb-2">Szomjúság:</label>
                    <input type="number" id="thirst" name="thirst" value="{{ $character->thirst }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>

            <div class="mb-4">
                <label for="money" class="block text-gray-700 text-sm font-bold mb-2">Pénz:</label>
                <input type="number" id="money" name="money" value="{{ $character->money }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="pp" class="block text-gray-700 text-sm font-bold mb-2">Prémium Pontok (PP):</label>
                <input type="number" id="pp" name="pp" value="{{ $character->pp }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="skin_id" class="block text-gray-700 text-sm font-bold mb-2">Ruházat azonosító:</label>
                <input type="number" id="skin_id" name="skin_id" value="{{ $character->skin_id }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="maxvehs" class="block text-gray-700 text-sm font-bold mb-2">Maximum Járművek:</label>
                <input type="number" id="maxvehs" name="maxvehs" value="{{ $character->maxvehs }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="maxinteriors" class="block text-gray-700 text-sm font-bold mb-2">Maximum Házak:</label>
                <input type="number" id="maxinteriors" name="maxinteriors" value="{{ $character->maxinteriors }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="faction_id" class="block text-gray-700 text-sm font-bold mb-2">Frakció Azonosító:</label>
                <input type="number" id="faction_id" name="faction_id" value="{{ $character->faction_id  ?? 'Nincs frakcióban' }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Karakter Frissítése</button>
        </form>
    </div>
</div>
