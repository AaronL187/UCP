@include('admin.newsidebar')
@include('admin.link')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<div class="container-fluid page-body-wrapper">
    <div class="container" align="center" style="padding-top: 100px; margin-left: 250px">
        @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    X
                </button>
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-12">
                <input type="text" id="searchInput" placeholder="Keresés Név, Neptun Kód vagy E-mail alapján" class="form-control">
                <button onclick="searchUsers()" class="btn btn-primary">Keresés</button>
                <table id="users" class="table table-bordered table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Cím</th>
                        <th>Tartalom</th>
                        <th>Kép</th>
                        <th>Módosítás</th>
                        <th>Törlés</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($news as $new)
                        <tr>
                            <td>{{ $new['id'] }}</td>
                            <td>{{ $new['title'] }}</td>
                            <td>{{ $new['content']}}</td>
                            <td>
                                <img src="{{ asset('storage/' . $new['image_path']) }}" alt="Hirdetmény képe" height="150px" width="300px" class="mdi-format-float-center">
                            </td>
                            <td><a href="{{ url('news/edit', $new['id']) }}" class="btn btn-primary">Módosítás</a></td>
                            <td><form method="POST" action="{{ url('news/destroy', $new['id']) }}" onsubmit="return confirm('Biztosan törlöd ezt az elemet?');">
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
