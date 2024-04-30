@include('admin.newsidebar')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-md shadow-md">
            <h1 class="text-xl font-semibold mb-6">Felhasználó Szerkesztése</h1>
            <form method="POST" action="{{ url('users/update', $user->id) }}">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-4 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @elseif(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Felhasználónév:</label>
                    <input type="text" id="username" name="username" value="{{ $user->username }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">

                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Cím:</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="serial" class="block text-gray-700 text-sm font-bold mb-2">Serial:</label>
                    <input type="text" id="serial" name="serial" value="{{ strtoupper($user->serial) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Új jelszó megadása:</label>
                    <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="adminlevel" class="block text-gray-700 text-sm font-bold mb-2">Adminisztrációs Szint:</label>
                    <select id="adminlevel" name="adminlevel" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach($adminrankname as $rank => $name)
                            <option value="{{ $rank }}" {{ old('adminlevel', $user->adminlevel) == $rank ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>




                <div class="mb-4">
                    <label for="adminnickname" class="block text-gray-700 text-sm font-bold mb-2">Adminnév:</label>
                    <input type="text" id="adminnickname" name="adminnickname" value="{{ $user->adminnickname ?? 'Ismeretlen' }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="activecharacter" class="block text-gray-700 text-sm font-bold mb-2">Aktív Karakter Azonosító:</label>
                    <input type="number" id="activecharacter" name="activecharacter" value="{{ $user->activecharacter ?? 'Ismeretlen' }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Felhasználó Frissítése</button>
            </form>
        </div>
    </div>

