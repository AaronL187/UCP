@include('admin.newsidebar')

    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="character-name">
                    Character Name
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="character-name" type="text" value="{{ $character->charactername }}" readonly>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="health">
                    Health
                </label>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $character->health }}%"></div>
                </div>
            </div>
            <!-- Debugging output -->
            <p>Active Character ID: {{ auth()->user()->activecharacter }}</p>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="armor">
                    Armor
                </label>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $character->armor }}%"></div>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="hunger">
                    Hunger
                </label>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-yellow-600 h-2.5 rounded-full" style="width: {{ $character->hunger }}%"></div>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="thirst">
                    Thirst
                </label>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-blue-400 h-2.5 rounded-full" style="width: {{ $character->thirst }}%"></div>
                </div>
            </div>

            <!-- Additional fields -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="admin-nick">
                    Admin Nick
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="admin-nick" type="text" value="{{ $character->adminnick }}" readonly>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="money">
                    Money
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="money" type="text" value="${{ number_format($character->money, 2) }}" readonly>
            </div>

           {{-- <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="faction">
                    Faction
                </label>
                <select class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="faction" disabled>
                    @foreach($factions as $faction)
                        <option value="{{ $faction->id }}" {{ $character->faction_id == $faction->id ? 'selected' : '' }}>
                            {{ $faction->name }}
                        </option>
                    @endforeach
                </select>
            </div> --}}
        </div>
    </div>

