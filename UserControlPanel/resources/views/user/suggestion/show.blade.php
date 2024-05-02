@include('admin.newsidebar')

<div class="bg-gray-100 p-6 min-h-screen">

    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Javaslataid</h1>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Siker!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Javaslatok áttekintése</h3>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    @if($suggestions->isEmpty())
                        <div class="bg-white px-4 py-6 sm:p-6">
                            <h3 class="text-sm leading-5 font-medium text-gray-500">Még nem tettél javaslatot.</h3>
                        </div>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Azonosító
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Javaslat
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Állapot
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Kezelte
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    További részletek
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($suggestions as $suggestion)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $suggestion->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $suggestion->suggestion }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $suggestion->status === 1 ? 'bg-green-100 text-green-800' :
                                               ($suggestion->status === 0 ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ $suggestion->status === 1 ? 'Elfogadva' : ($suggestion->status === 0 ? 'Elutasítva' : 'Folyamatban') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $suggestion->handled_by ? 'Felhasználó #' . $suggestion->handled_by : 'Nincs' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ url('suggestion', $suggestion->id) }}" class="text-indigo-600 hover:text-indigo-900">További részletek</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </dl>
            </div>
        </div>
    </div>
</div>

