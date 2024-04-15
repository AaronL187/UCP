
@include('admin.newsidebar')
@include('admin.link')

<div class="container-fluid page-body-wrapper">

    <div class="container" align="center" style="padding-top: 150px">
        @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    X
                </button>
                {{session()->get('message')}}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{url('user/update',$data->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="fillable">
                <div style="padding: 15px">
                    <label>Név</label>
                    <input type="text" style="color:black" name="name" value="{{$data->name}}"
                           placeholder="Add meg az új nevet">
                </div>

                <div style="padding: 15px;">
                    <label>Neptun kód</label>
                    <input type="text" style="color:black" name="nk" value="{{$data->nk}}"
                           placeholder="Add meg az új Neptun kódot">
                </div>

                <div style="padding: 15px;">
                    <label>E-mail</label>
                    <input type="text" style="color:black" name="email" value="{{$data->email}}"
                           placeholder="Add meg az új e-mailt">
                </div>


                <div style="padding: 15px;">
                    <input type="submit" class="btn btn-success" style="background: green">
                </div>
        </form>
    </div>
</div>
</div>
</div>

</body>
</html>
