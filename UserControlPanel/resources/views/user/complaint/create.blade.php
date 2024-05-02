@include('admin.newsidebar') <!-- Az oldalsáv beillesztése -->

<div class="container mx-auto px-4 mt-10">
    <div class="flex justify-center">
        <div class="w-full max-w-2xl">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h1 class="block text-gray-700 text-xl font-bold mb-2">Panasz Beküldése</h1>
                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @include('errorhandling')

                <form action="{{ url('complaint/store') }}" method="POST">
                    @csrf
                    <!-- A panaszt benyújtó és az ellenfél adatokat a háttérben kell kezelni a felhasználói azonosítók lekérdezéséhez -->

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
                            Tárgy
                        </label>
                        <input type="text" id="title" name="title"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               required>
                    </div>
                    <div class="mb-4">
                        <label for="complained_against" class="block text-gray-700 text-sm font-bold mb-2">
                            Panaszolt Játékos (Karakterazonosító)
                        </label>
                        <input type="text" id="complained_against" name="complained_against"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                            Leírás
                        </label>
                        <textarea id="description" name="description"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                  rows="4" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="prooflink" class="block text-gray-700 text-sm font-bold mb-2">
                            Bizonyíték Linkje (Képernyőkép, videó, stb. Imgur.com vagy hasonló oldal.)
                        </label>
                        <input type="url" id="prooflink" name="prooflink"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label for="messages" class="block text-gray-700 text-sm font-bold mb-2">
                            További Üzenetek
                        </label>
                        <textarea id="messages" name="messages"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                  rows="2"></textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Panasz Beküldése
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
