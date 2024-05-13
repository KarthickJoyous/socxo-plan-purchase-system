<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
    <title>@setting('app_name') | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }

        .content {
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        @include('layouts.users.header')
        <div class="content container mt-5">
            @include('layouts.users.notification')
            @yield('content')
        </div>
        @include('layouts.users.footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script>
        function handleBaseFormSubmit(formId, loadingText) {
            $(`#${formId}Btn`).attr('disabled', true);
            $(`#${formId}Btn`).text(loadingText);
            $(`#${formId}Btn`).append(`<span class="spinner-border spinner-border-sm mx-1" role="status" aria-hidden="true"></span>`);
	    }
    </script>
    @yield('script')
</body>

</html>