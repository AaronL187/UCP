@include('admin.newsidebar')

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6"> {{ $character->charactername }} ({{$character->id}})  háziállatai</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($pets as $pet)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-700">{{ $pet->name }}</h3>
                    <p class="text-gray-600">Típus:
                        @if($pet->pettype === 'cat')
                            Macska
                        @elseif($pet->pettype === 'lizard')
                            Gyík
                        @elseif($pet->pettype === 'dog')
                            Kutya
                        @elseif($pet->pettype === 'bird')
                            Papagáj
                        @elseif($pet->pettype === 'fish')
                            Hal
                        @else
                            Ismeretlen
                        @endif
                    </p>

                    <p class="text-gray-600">Éhség: {{ $pet->hunger }}%</p>
                    <p class="text-gray-600">Szomjúság: {{ $pet->thirst }}%</p>
                </div>
                <div class="bg-gray-100 p-4">
                    <span class="text-sm font-medium text-gray-600">Tulajdonos: {{ $character->charactername }}</span>
                </div>
            </div>
        @empty
            <p class="text-gray-700">Nincs háziállat ezen tulajdonoshoz.</p>
        @endforelse
    </div>
</div>
