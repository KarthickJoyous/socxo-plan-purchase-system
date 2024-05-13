<header class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img style="margin: 10px;" height="30px" src="@setting('app_logo')"></a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth('web')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.home')}}">{{__('messages.user.home.title')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.profile')}}">{{__('messages.user.profile.title')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.transactions.index')}}">{{__('messages.user.transactions.title')}}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" class="btn btn-danger">
                            {{__('messages.user.logout.title')}}
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{route('user.auth')}}">{{__('messages.user.login.email')}}</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</header>

@auth('web')
<div class="modal fade" id="logoutModal" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('messages.user.logout.title')}} ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{__('messages.user.logout.logout_confirmation')}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          {{__('messages.user.logout.cancel')}}
        </button>
        <button 
          type="button" 
          class="btn btn-danger" 
          id="logoutFormBtn"
          onclick="
          handleBaseFormSubmit('logoutForm', '{{__("messages.user.logout.submit_btn_loading_text")}}');
          document.getElementById('logoutForm').submit();"
          >
          {{__('messages.user.logout.title')}}
        </button>
        <form class="d-none" method="GET" id="logoutForm" action="{{route('user.logout')}}">
          @csrf
        </form>
      </div>
    </div>
  </div>
</div>
@endauth