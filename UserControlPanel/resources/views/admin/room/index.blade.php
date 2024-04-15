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
        <form action="{{url('room/store')}}" method="post">
            @csrf
            <div class="fillable">
            <div style="padding: 15px;">
                <label>Szoba neve:</label>
                <input type="text" style="color:black" name="name" placeholder="Add meg a szoba nevét">
            </div>
            <div style="padding: 15px;">
                <label for="opening-time">Nyitvás:</label>
                <input value="08:00" type="time" id="opening" name="opening" style="color: black">
            </div>

            <div style="padding: 15px;">
                <label for="opening-time">Zárás:</label>
                <input value="16:00" type="time" id="closing" name="closing" style="color: black">
            </div>


            <div style="padding: 15px;">
                <label>Emelet:</label>
                <select name="floor" style="color: black; text-weight: bold; text-align: center">
                    <option value="Földszint">Földszint</option>
                    <option value="Első emelet">Első emelet</option>
                    <option value="Második emelet">Második emelet</option>
                    <option value="Harmadik emelet">Harmadik emelet</option>
                    <option value="Negyedik emelet">Negyedik emelet</option>
                    <option value="Ötödik emelet">Ötödik emelet</option>
                    <option value="Hatodik emelet">Hatodik emelet</option>
                    <option value="Hetedik emelet">Hetedik emelet</option>
                    <option value="Nyolcadik emelet">Nyolcadik emelet</option>
                    <option value="Kilencedik emelet">Kilencedik emelet</option>


                </select>
            </div>
            <div style="padding: 15px;">
                <input type="submit" class="btn btn-success" style="background: green">
            </div>
        </form>
    </div>
</div>
</div>

@include('admin.script')
</body>
</html>
