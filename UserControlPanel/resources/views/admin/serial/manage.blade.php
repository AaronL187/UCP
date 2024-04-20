@include('admin.newsidebar');
<div class="bg-orange-100 min-h-screen p-6">
<body class="bg-gray-100 p-6">
<button id="toggleButton" class="px-4 py-2 mb-4 text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-300 active:bg-blue-800 transition duration-150 ease-in-out">
    Függőben lévők mutatása
</button>
<!-- Serial Change Requests Table -->
<div class="mb-6 bg-white shadow-md rounded px-8 pt-6 pb-8">
    <h2 class="text-lg font-bold mb-4 text-gray-700">Serial Váltási kérelmek kezelése</h2>

    <!-- Search Bar -->
    <div class="mb-4">
        <input id="searchInput" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Keresés ID/Serial/Felhasználó név...">
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Azonosító</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Dátum</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Felhasználó</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Régi Serial</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Új Serial</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Státusz</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Indoklás</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kezelés</th>
            </tr>
            </thead>
            <tbody id="tableBody">
            @foreach ($serialChanges as $change)
                <tr data-status="{{ is_null($change->status) ? 'null' : $change->status }}"
                    class="{{ $change->status === 1 ? 'bg-green-100' : ($change->status === 0 ? 'bg-red-100' : (is_null($change->status) ? 'bg-yellow-100' : '')) }}">
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ $change->id }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ $change->date }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ $change->username }} ({{ $change->userId }})</td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ strtoupper($change->old_serial) }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ strtoupper($change->new_serial) }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        @if ($change->status === 1)
                            Elfogadva
                        @elseif ($change->status === 0)
                            Elutasítva
                        @else
                            Függőben
                        @endif
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ $change->reason }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm flex justify-start">
                        @if ($change->status === 0 || $change->status === 1)
                            Kezelte: {{ $change->handled_by }}
                        @else
                            <!-- Accept button -->
                            <form action="{{ url('serial/accept', $change->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-900 mx-2">
                                    Elfogadás
                                </button>
                            </form>

                            <!-- Decline button -->
                            <form action="{{ url('serial/decline', $change->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-900 mx-2">
                                    Elutasítás
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach



            </tbody>
        </table>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('keyup', function () {
            const searchTerm = searchInput.value.toLowerCase();
            const tableRows = document.querySelectorAll('#tableBody tr');

            tableRows.forEach(row => {
                // Get specific columns from the row
                const usernameCell = row.querySelector('td:nth-child(2)'); // Assuming username is in the second column
                const characterIdCell = row.querySelector('td:nth-child(3)'); // Assuming character_id is in the third column

                // Check if the cells exist and get their text content
                const username = usernameCell ? usernameCell.textContent.toLowerCase() : '';
                const characterId = characterIdCell ? characterIdCell.textContent.toLowerCase() : '';

                // Determine if the row should be visible
                const isVisible = username.includes(searchTerm) || characterId.includes(searchTerm);
                row.style.display = isVisible ? '' : 'none';
            });
        });
    });

        document.addEventListener('DOMContentLoaded', function () {
            const toggleButton = document.getElementById('toggleButton');
            let showAll = false; // Start by showing only null statuses

            // Function to update the visibility of rows based on the current toggle state
            const updateRowsVisibility = () => {
                const rows = document.querySelectorAll('#tableBody tr');
                rows.forEach(row => {
                    const status = row.getAttribute('data-status');
                    if (showAll) {
                        row.style.display = ''; // Show all rows
                    } else {
                        row.style.display = status === 'null' ? '' : 'none'; // Show only rows with 'null' status
                    }
                });
            };

            // Initial setup to show only 'null' status rows
            updateRowsVisibility();

            // Event listener for the toggle button
            toggleButton.addEventListener('click', function () {
                showAll = !showAll; // Toggle the state between showing all and showing only 'null' status
                updateRowsVisibility();
                toggleButton.textContent = showAll ? 'Csak a folyamatban lévők mutatása' : 'Összes Mutatása';
            });
        });

</script>

