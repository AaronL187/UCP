@include('admin.newsidebar')
<div class="container mx-auto px-4 mt-10">
    <div class="flex justify-center">
        <div class="w-full max-w-2xl">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <h1 class="block text-gray-700 text-xl font-bold mb-2">Probléma Beküldése</h1>
                    <!-- Problem Submission -->
                </div>

                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                         role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @include('errorhandling')
                <form action="{{ url('ticket/store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="problem" class="block text-gray-700 text-sm font-bold mb-2">
                            Írd le a problémád <!-- Describe your problem -->
                        </label>

                        <textarea
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('problem') border-red-500 @enderror"
                            id="proofurl" name="problem" rows="4" required></textarea>
                        <label for="proofurl" class="block text-gray-700 text-sm font-bold mt-2">
                            Példa: https://www.example.com/ <!-- Example: https://www.example.com/ -->
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('problem') border-red-500 @enderror"
                            id="proofurl" name="proofurl" type="text" placeholder="Bizonyíték URL" required>
                        @error('problem')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Beküldés <!-- Submit -->
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
