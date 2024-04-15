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
                        <th>Név</th>
                        <th>E-mail cím</th>
                        <th>Neptun kód</th>
                        <th>Módosítás</th>
                        <th>Jogosultság adás</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->nk }}</td>
                            <td><a href="{{ url('user/edit', $user->id) }}" class="btn btn-primary">Módosítás</a></td>
                            <td>
                                @if($user->usertype == '0')
                                    <a href="{{ url('user/giveadmin', $user->id) }}" class="btn btn-success">Kinevezés Adminná</a>
                                @else
                                    <a href="{{ url('user/removeAdmin', $user->id) }}" class="btn btn-danger">Admin elvétele</a>
                                @endif
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
<script>
    function searchUsers() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("users");
        tr = table.getElementsByTagName("tr");

        for (i = 1; i < tr.length; i++) {
            tr[i].style.display = "none";
            td = tr[i].getElementsByTagName("td");
            for (var j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    }
                }
            }
        }
    }
</script>
</body>
</html>
