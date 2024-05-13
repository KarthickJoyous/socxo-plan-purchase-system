@extends('layouts.users.app')

@section('content')
<div class="row">
    <div class="col-md-12 mx-auto">
        <ul class="nav nav-tabs" id="auth" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">{{__('messages.user.login.title')}}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">{{__('messages.user.register.title')}}</button>
            </li>
        </ul>
        <div class="tab-content mt-3" id="authContent">
            <div class="tab-pane fade show active border rounded p-5" id="login" role="tabpanel" aria-labelledby="login-tab">
                <form class="" id="loginForm" method="POST" action="{{route('user.login')}}">
                    @csrf
                    <h2>{{__('messages.user.login.title')}}</h2>
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">{{__('messages.user.login.email')}}:</label>
                        <input type="email" name="email" maxlength="50" class="form-control" id="loginEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">{{__('messages.user.login.password')}}:</label>
                        <input type="password" name="password" minlength="8" maxlength="25" class="form-control" id="loginPassword" required>
                    </div>
                    <button type="submit" id="loginFormBtn" class="btn btn-primary">{{__('messages.user.login.title')}}</button>
                </form>
            </div>
            <div class="tab-pane fade border rounded p-5" id="register" role="tabpanel" aria-labelledby="register-tab">
                <form class="" id="loginForm" method="POST" action="{{route('user.register')}}">
                    @csrf
                    <h2>{{__('messages.user.register.title')}}</h2>
                    <div class="mb-3">
                        <label for="registerName" class="form-label">{{__('messages.user.register.name')}}:</label>
                        <input type="text" name="name" minlength="3" maxlength="30" class="form-control" id="registerName" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">{{__('messages.user.register.email')}}:</label>
                        <input type="email" name="email" maxlength="50" class="form-control" id="registerEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">{{__('messages.user.register.password')}}</label>
                        <input type="password" name="password" minlength="8" maxlength="25" class="form-control" id="registerPassword" required>
                    </div>
                    <button type="submit" id="registerFormBtn" class="btn btn-primary">{{__('messages.user.register.title')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

    @section('script')
        <script type="text/javascript">
            $("#loginForm").on("submit", function() {
                var validated = $("#loginEmail").val() && $("#loginPassword").val().length >= 8;
                if (validated) {
                    handleBaseFormSubmit("loginForm", "{{__('messages.user.login.submit_btn_loading_text')}}");
                }
                return validated;
            });

            $("#registerForm").on("submit", function() {
                var validated = $("#registerName").val().length >= 3 && $("#registerEmail").val() && $("#registerPassword").val().length >= 8;
                if (validated) {
                    handleBaseFormSubmit("registerForm", "{{__('messages.user.register.submit_btn_loading_text')}}");
                }
                return validated;
            });
        </script>
    @endsection
@endsection