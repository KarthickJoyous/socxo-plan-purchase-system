@if($errors->any())
    @foreach($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{$error}}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endforeach
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{session('error')}}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{session('success')}}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif