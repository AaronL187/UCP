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
