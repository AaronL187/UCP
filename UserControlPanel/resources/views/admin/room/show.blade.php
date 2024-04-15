@include('admin.newsidebar')
@include('admin.link')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<div class="container-fluid page-body-wrapper">
    <div class="container" align="center" style="padding-top: 100px; margin-left: 250px">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Check for a custom error message flashed to the session -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Check for a custom success message flashed to the session -->
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="row justify-content-center">
                <table id="users" class="table table-bordered table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Szoba Neve</th>
                        <th>Nyitás</th>
                        <th>Zárás</th>
                        <th>Módosítás</th>
                        <th>Törlés</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rooms as $room)
                        <tr>
                            <td>{{ $room['id'] }}</td>
                            <td>{{ $room['name'] }}</td>
                            <td>{{ $room['opening']}}</td>
                            <td>{{ $room['closing']}}</td>
                            <td><a href="{{ url('room/edit', $room['id']) }}" class="btn btn-primary">Módosítás</a></td>
                            <td><form method="POST" action="{{ url('room/destroy', $room['id']) }}" onsubmit="return confirm('Biztosan törlöd ezt az elemet?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Törlés</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('admin.script')
    </div>
</div>
