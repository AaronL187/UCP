@include('admin.newsidebar')
<div class="container mx-auto px-4 mt-10">
    <div class="flex justify-center">
        <div class="w-full max-w-2xl">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <h1 class="block text-gray-700 text-xl font-bold mb-2">Javaslat Beküldése</h1>
                </div>

                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ url('suggestion/store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="suggestion" class="block text-gray-700 text-sm font-bold mb-2">
                            Javaslatod
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('suggestion') border-red-500 @enderror"
                                  id="suggestion" name="suggestion" rows="4" required></textarea>
                        @error('suggestion')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Beküldés
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
