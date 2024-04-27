@include('admin.newsidebar')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold text-gray-800 my-6">Válaszd ki melyik karaktered szeretnéd használni.</h1>
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Hoppá!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>

        </div>
        @elseif (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Siker!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if ($characters->isEmpty())
        <p class="text-gray-600">Nincs karaktered! Készíts egyet a szerveren!</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($characters as $character)
                <div class="p-4 max-w-sm mx-auto bg-white rounded-lg border border-gray-200 shadow-md">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">{{ $character->charactername }}</h5>
                    <p class="font-normal text-gray-700">Élet: {{ $character->health }}/100</p>
                    <p class="font-normal text-gray-700">Páncél: {{ $character->armor }}/100</p>
                    <p class="font-normal text-gray-700">Pénz: ${{ $character->money }}</p>
                    <p class="font-normal text-gray-700">Utolsó
                        Belépés: {{ $character->last_login_time->format('Y-m-d H:i') }}</p>
                    <form action="{{ url('profil/select') }}" method="POST"> {{-- Update action as needed --}}
                        @csrf
                        <input type="hidden" name="character_id" value="{{ $character->id }}">
                        <button type="submit"
                                class="mt-3 inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-lg">
                            Kiválasztás
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
