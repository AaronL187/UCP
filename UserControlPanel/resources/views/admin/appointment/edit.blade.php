@include('admin.newsidebar')
@include('admin.link')

<div class="container-fluid page-body-wrapper">

    <div class="container" align="center" style="padding-top: 100px">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
            <form action="{{ url('appointment/update', $data->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Név:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
                </div>

                <div class="form-group">
                    <label for="nk">Neptun kód:</label>
                    <input type="text" class="form-control" id="nk" name="nk" value="{{ $data->nk }}"
                           placeholder="Add meg az új Neptun kódot">
                </div>

                <div class="form-group">
                    <label for="room">Szoba:</label>
                    <select class="form-control" id="room" name="room">
                        <option value="">Válassz szobát</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->name }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="starttime">Ettől:</label>
                    <input type="datetime-local" class="form-control" id="starttime" name="starttime"
                           value="{{ \Carbon\Carbon::parse($data->starttime)->format('Y-m-d\TH:i') }}">
                </div>

                <div class="form-group">
                    <label for="endtime">Eddig:</label>
                    <input type="datetime-local" class="form-control" id="endtime" name="endtime"
                           value="{{ \Carbon\Carbon::parse($data->endtime)->format('Y-m-d\TH:i') }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Mentés</button>
                </div>
            </form>
    </div>
</div>


@include('admin.script')
@include('admin.link')
</body>
</html>



<!-- Add the Bootstrap CSS and JS links here -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
