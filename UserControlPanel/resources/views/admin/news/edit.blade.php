@include('admin.newsidebar')
@include('admin.link')
<style>
    html,body {
        background: #f5f5f5;
        height: 80%;
        margin: 0;
    }

    .containerv3 {
        padding: 30px;
        border-radius: 15px;
        min-height: 100%;
        height: 85vh;
        margin: 2% auto;
        flex-direction: column;
        width: auto;
    }

    h2 {
        color: #0056b3;
    }

    .btn-primary {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-primary:hover {
        background-color: #003d82;
        border-color: #003d82;
    }

    .form-control {
        border-radius: 4px;
    }

    .form-control:focus {
        border-color: #0056b3;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(0,86,179,.6);
    }

    .invalid-feedback {
        display: none;
    }

    .was-validated .form-control:invalid {
        border-color: #dc3545;
    }

    .was-validated .form-control:invalid:focus {
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(220,53,69,.6);
    }

    .was-validated .invalid-feedback:invalid {
        display: block;
    }
</style>

<div class="containerv3 mt-5" >
    <div class="row">
        <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">
            <h2 class="mb-4 text-center">{{ $news['title'] }}</h2>
            <!-- Error message output -->
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
            <form action="{{url('news/update', $news['id'])}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="form-group">
                    <label for="title">Hirdetmény címe:</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $news['title'] }}" required>
                    <div class="invalid-feedback">Hirdetmény címe</div>
                </div>
                <div class="form-group">
                    <label for="content">Tartalom:</label>
                    <textarea class="form-control" id="content" name="content" rows="15" required>{{ $news['content'] }}</textarea>
                    <div class="invalid-feedback">Tartalom:</div>
                </div>
                <div class="form-group">
                    <label for="image">Kép:</label>
                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Módosítás</button>
            </form>
        </div>
    </div>
</div>
