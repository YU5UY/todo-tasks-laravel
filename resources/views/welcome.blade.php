@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="card bg-dark">
            <div class="header-card p-3 border-bottom border-info">
                @guest
                    {{__("messages.welcome_guest")}}
                @else
                    {{__("messages.welcome")}} {{Auth::user() -> name}} !
                @endguest
            </div>
            <div class="body-card p-3">
                <div class="row justify-content-around align-items-center">
                    <div class="col-12 col-md-6 my-2">
                        <img src="{{asset("img/to_do_list.svg")}}" alt="To do list Guest" width="90%" class="img-to-do-list">
                        
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="title-guest border-{{$direction}} border-info p-2">
                            <div class="p">{{__("messages.why_tasks")}}</div>
                            <hr>
                            <div class="p">{{__("messages.why_ex_tasks")}}</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card bg-dark my-1">
            <div class="header-card p-3 border-bottom border-info">
                {{__("messages.why_this_site")}}
            </div>
            <div class="body-card p-3">
                <div class="row justify-content-around align-items-center">
                    <div class="col-12 col-md-6 my-2">
                        <img src="{{asset("img/share_tasks.svg")}}" alt="To do list Guest" width="90%" class="img-to-do-list">
                        
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="title-guest border-{{$direction}} border-info p-2">
                            <div class="p">{{__("messages.why_this_site_ex_1")}}</div>
                            <div class="p">{{__("messages.why_this_site_ex_2")}}</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row justify-content-center justify-content-lg-around align-items-center border-top border-info p-3">
            <div class="col-12 col-md-8 text-center">
                <img src="{{asset("img/online_orginizer.svg")}}" alt="Organize your work" class="img-online-orgainize">
            </div>
            <div class="text-center col-12 col-md-4">
                <div class="border-bottom border-info py-3 my-3">{{__("messages.organize_tasks")}}</div>
                <a class="btn btn-info my-3" href="{{route("register")}}">{{__("messages.get_starting")}}</a>
            </div>

        </div>
    </div>
@endsection