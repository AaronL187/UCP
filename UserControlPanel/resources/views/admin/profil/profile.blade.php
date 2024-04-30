@include('admin.newsidebar')

<div class="container mx-auto p-6">
    <!-- Karakter Adatai -->
    <div class="bg-white rounded-lg shadow-xl p-5 mb-6">
        <h2 class="text-xl font-semibold mb-4 text-blue-500">Karakter Adatai</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-b border-gray-300 pb-4 bg-gray-50">
            <div>
                <label class="text-gray-700" for="character-name">Karakter Neve</label>
                <input class="form-input mt-1 block w-full" type="text" id="character-name"
                       value="{{$character->charactername}}" readonly>
            </div>
            <div>
                <label class="text-gray-700" for="character-id">Karakter ID</label>
                <input class="form-input mt-1 block w-full" type="text" id="character-id" value="{{$character->id}}"
                       readonly>
            </div>
            <div class="col-span-2">
                <label class="text-gray-700" for="health">Élet</label>
                <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                    <div class="bg-red-500 h-4 rounded-full" style="width: {{$character->health}}%;"></div>
                </div>
            </div>
            <div class="col-span-2">
                <label class="text-gray-700" for="armor">Páncél</label>
                <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                    <div class="bg-blue-500 h-4 rounded-full" style="width: {{$character->armor}}%;"></div>
                </div>
            </div>
            <div class="col-span-2">
                <label class="text-gray-700" for="hunger">Éhség</label>
                <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                    <div class="bg-yellow-500 h-4 rounded-full" style="width: {{$character->hunger}}%;"></div>
                </div>
            </div>
            <div class="col-span-2">
                <label class="text-gray-700" for="thirst">Szomjúság</label>
                <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                    <div class="bg-blue-400 h-4 rounded-full" style="width: {{$character->thirst}}%;"></div>
                </div>
            </div>

            <!-- Admin Eszközök -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden p-5 mb-6 my-10">
                <h2 class="text-xl font-semibold mb-6 text-gray-800">Karakter Adatai</h2>
                <div class="grid gap-6 mb-6 lg:grid-cols-2">
                    <!-- Admin név -->
                    <div>
                        <label class="block text-gray-700" for="admin-nick">Admin név</label>
                        <input class="form-input mt-1 block w-full border-gray-300 shadow-sm" id="admin-nick" type="text" name="admin-nick" required autofocus autocomplete="admin-nick" readonly value="{{$user->adminnickname}}">
                    </div>

                    <!-- Adminisztrációs Szint -->
                    <div>
                        <label class="block text-gray-700" for="admin-level">Adminisztrációs Szint</label>
                        <div class="relative">
                            <select class="form-select block w-full mt-1 border-gray-300 shadow-sm" id="admin-level" name="adminlevel">
                                @php
                                    $adminnames = [
                                        0 => 'Játékos',
                                        1 => 'Segítő',
                                        2 => 'Adminisztrátor',
                                        3 => 'Szuper Adminisztrátor',
                                        4 => 'Tulajdonos',
                                    ];
                                    $currentRankName = $rankname; // Assume $rankname is provided by your model
                                @endphp
                                @foreach($adminnames as $rank => $name)
                                    <option value="{{ $rank }}" {{ $currentRankName == $name ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Pénz -->
                    <div>
                        <label class="block text-gray-700" for="money">Pénz</label>
                        <input class="form-input mt-1 block w-full border-gray-300 shadow-sm" id="money" type="text" name="money" required autofocus autocomplete="money" readonly value="${{number_format($character->money, 0)}}">
                    </div>

                    <!-- Prémium Pontok -->
                    <div>
                        <label class="block text-gray-700" for="premiumpoints">Prémium Pontok</label>
                        <input class="form-input mt-1 block w-full border-gray-300 shadow-sm" id="premiumpoints" type="text" name="premiumpoints" required autofocus autocomplete="premiumpoints" readonly value="{{$character->pp}} PP">
                    </div>
                </div>

                <!-- Mentés Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        Mentés
                    </button>
                </div>
            </div>

            <!-- E-mail Frissítése Form -->
            <form class="bg-white rounded-lg shadow p-5 mb-6 my-10" action="/update.email" method="POST">
                <h2 class="text-xl font-semibold mb-4">E-mail Frissítése</h2>
                <div>
                    <label class="text-gray-700" for="old_email">Régi E-mail Cím</label>
                    <input class="form-input mt-1 block w-full" id="old_email" type="email" name="old_email"
                           required
                           autofocus autocomplete="email" readonly value="valaki@example.com">
                </div>
                <div class="mt-4">
                    <label class="text-gray-700" for="new_email">Új E-mail Cím</label>
                    <input class="form-input mt-1 block w-full" id="new_email" type="email" name="new_email"
                           required
                           autocomplete="email">
                </div>
                <div class="mt-4">
                    <label class="text-gray-700" for="confirm_email">Új E-mail Cím Megerősítése</label>
                    <input class="form-input mt-1 block w-full" id="confirm_email" type="email" name="confirm_email"
                           required autocomplete="email">
                </div>
                <button type="submit"
                        class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    E-mail Frissítése
                </button>
            </form>

            <!-- Jelszó Frissítése Form -->
            <form class="bg-white rounded-lg shadow p-5 mb-6" action="/update.password" method="POST">
                <h2 class="text-xl font-semibold mb-4">Jelszó Frissítése</h2>
                <div class="mt-4">
                    <label class="text-gray-700" for="new_password">Új Jelszó</label>
                    <input class="form-input mt-1 block w-full" id="new_password" type="password"
                           name="new_password"
                           required autocomplete="new-password">
                </div>
                <div class="mt-4">
                    <label class="text-gray-700" for="confirm_password">Új Jelszó Megerősítése</label>
                    <input class="form-input mt-1 block w-full" id="confirm_password" type="password"
                           name="confirm_password" required autocomplete="new-password">
                </div>
                <button type="submit"
                        class="mt-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 focus:outline-none focus:shadow-outline">
                    Jelszó Frissítése
                </button>
            </form>

        </div>
    </div>
</div>

{{--<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="character-name">
                Character Name
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="character-name" type="text" value="{{ $character->charactername }}" readonly>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="character-name">
                Character ID
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="character-name" type="text" value="{{ auth()->user()->activecharacter }}" readonly>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="health">
                    Health
                </label>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $character->health }}%"></div>
                </div>
            </div>

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
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="admin-nick" type="text" value="{{ $user->adminnickname }}" readonly>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="money">
                    Money
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="money" type="text" value="${{ number_format($character->money, 2) }}" readonly>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="premiumpoints">
                    Prémium Pontok
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="faction" type="text" value="{{ $character->pp }} PP" readonly>
            </div>

            --}}{{-- <div class="mb-4">
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
             </div> --}}{{--
        </div>
    </div>


    <!-- Password update form -->
    <form method="POST" action="{{ url('update.email') }}" class="mb-4">
        @csrf

        <div>
            <label for="old_email"
                   class="block text-gray-700 text-sm font-bold mb-2">{{ __('Old Email Address') }}</label>
            <input id="old_email" type="email" name="old_email"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   required autofocus autocomplete="email" disabled value="{{$user->email}}">
        </div>

        <div class="mt-4">
            <label for="new_email"
                   class="block text-gray-700 text-sm font-bold mb-2">{{ __('New Email Address') }}</label>
            <input id="new_email" type="email" name="new_email"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   required autocomplete="email">
        </div>

        <div class="mt-4">
            <label for="confirm_email"
                   class="block text-gray-700 text-sm font-bold mb-2">{{ __('Confirm New Email Address') }}</label>
            <input id="confirm_email" type="email" name="confirm_email"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   required autocomplete="email">
        </div>

        <x-button>{{ __('Update Email') }}</x-button>
    </form>


    <form method="POST" action="{{ url('update.password') }}" class="mb-4">
        @csrf
        <div class="mt-4">
            <label for="new_password"
                   class="block text-gray-700 text-sm font-bold mb-2">{{ __('New Password') }}</label>
            <input id="new_password" type="password" name="new_password"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   required autocomplete="new-password">
        </div>

        <div class="mt-4">
            <label for="confirm_password"
                   class="block text-gray-700 text-sm font-bold mb-2">{{ __('Confirm New Password') }}</label>
            <input id="confirm_password" type="password" name="confirm_password"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   required autocomplete="new-password">
        </div>

        <x-button>{{ __('Update Password') }}</x-button>
    </form>
--}}

