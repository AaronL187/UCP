@include('admin.newsidebar')
@include('admin.link')



<div class="container">
    <h1 class="text-center" style="font-weight: bolder;padding-top: 60px">Időpont letiltása</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="main-form" action="{{url('appointment/ban')}}" method="post">
        @csrf
        <div class="row mt-5">

            <div class="col-sm-6">
                <label for="starttime" class="form-label">Foglalási időpont kezdete:</label>
                <input type="datetime-local" id="starttime" name="starttime" class="form-control" value="2023-12-15T10:00">
            </div>
            <div class="col-sm-6">
                <label for="endtime" class="form-label">Foglalás vége:</label>
                <input type="datetime-local" id="endtime" name="endtime" class="form-control" value="2023-12-15T18:00">
            </div>

            <div class="col-sm-12">
                <label for="departement" class="form-label">Szoba:</label>
                <select name="room" id="departement" class="custom-select" style="text-align: center">
                    @foreach($room as $rooms)
                        <option value="{{$rooms->name}}">{{$rooms->name}} - {{$rooms->floor}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label for="message" class="form-label">Megjegyzés:</label>
                <textarea name="message" id="message" class="form-control" rows="6" placeholder="Megjegyzés"></textarea>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Küldés</button>
            </div>
            @include('user.schedule')
        </div>
    </form>
</div>


