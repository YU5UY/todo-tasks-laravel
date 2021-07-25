@extends('layouts.app')

@section("title")
    {{__("messages.list_tasks")}}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="message-danger d-none">
            <div class="border-{{$direction}} p-3 my-2 border-danger all-taks">
                {{__("messages.no_tasks_completed")}}
            </div>
            <div class="border-{{$direction}} p-3 border-danger">
                {{__("messages.no_waste_time")}}
            </div>
        </div>
        <div class="message-warning d-none">
            <div class="border-{{$direction}} p-3 my-2 border-warning">
                {{__("messages.complete")}} <span class="counter-done-tasks"></span> {{__("messages.tasks")}} !
            </div>
            <div class="border-{{$direction}} p-3 border-warning">
                {{__("messages.good_job")}}
            </div>
        </div>
        <div class="message-success d-none">
            <div class="border-{{$direction}} p-3 my-2 border-success">
                {{__("messages.more_than_4")}}
            </div>
            <div class="border-{{$direction}} p-3 border-success">
               {{__("messages.great_job")}}
            </div>
            <div class="border-{{$direction}} p-3 my-2 border-success">
                {{__("count_done_tasks")}} - <span class="counter-done-tasks"></span> -
            </div>
        </div>
    </div>
    <div class="container py-3 my-3 border-top border-bottom border-info">
        <div class="text-center">
            <img src="{{ asset('img/list_tasks.svg') }}" class="list-tasks-img" alt="List of Tasks"
                class="my-2 border-bottom border-info py-2" width="300">
        </div>
        <div class="row justify-content-center align-items-center pt-3 text-center">
            <div class="col-9 col-md-7 col-lg-6">
                <input type="text" class="form-control" id="text-task" placeholder="{{__("messages.enter_task")}}">
            </div>

            <div class="col-3 col-lg-2">
                <div class="add-task btn-info py-1 rounded d-flex align-items-center justify-content-center disabled">
                    <span class="spinner-grow spinner-grow d-none" role="status" aria-hidden="true"></span>
                    <div class="d-none active-loading">+</div>
                </div>
            </div>
            <div class="col-9 col-md-7 col-lg-6 font-weight-light small task-note text-{{$direction}}">
                {{__("messages.task_note")}} 
            </div>

            <div class="col-3 col-lg-2"></div>
        </div>

    </div>
    <div class="border-{{$direction}} p-3 m-3 shadow border-primary">
        {{__("messages.list_tasks")}} - <span class="counter-all-tasks"></span> -
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center justify-content-md-around text-center my-row border-bottom border-info my-2">
            {{-- here will be all the tasks of the user after auth and fetch it using javaScript [ jquery(Ajax) ]--}}
        </div>

        @if(Auth::user()-> private != 1)
        <div class="row justify-content-center align-items-center">
            <div class="card bg-secondary text-black col-11 col-lg-8 p-0">
                <div class="card-header">{{__("messages.share_link")}}</div>
                <div class="card-body p-1">
                    <div class="share-link row justify-content-around align-items-center m-2">
                        <div class="col-12 col-sm-7 col-md-8">
                            <div class="row justify-content-around align-items-center">
                                <button class="btn btn-info col-3 col-md-4 col-lg-3" id="btn-copy">{{__("messages.copy")}}</button>
                                <input type="text" readonly="readonly" class="bg-dark text-white border border-info p-2 rounded col-8 col-md-6 col-lg-8 url-id" style="outline:none;direction:ltr !important;" value="{{route("single",Auth::user()->username)}}">
                            </div>
                        </div>
                        <div class="col-10 col-sm-5 col-md-3 my-3">
                            <img src="{{asset("img/share_link.svg")}}" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="confirm-delete text-center p-2 rounded border border-info">
        <div class="head-confirm-delete border-bottom border-info p-2">
            <div class="title">
                {{__("messages.confirm_delete")}}
            </div>
        </div>
        <div class="body-confirm-delete">
            <div class="container-fulid">
                <div class="row justify-content-around">
                    <div class="yes-delete btn btn-outline-info px-2 py-1 mt-2 rounded">
                        {{__("messages.yes")}}
                    </div>
                    <div class="no-delete btn btn-info px-2 py-1 mt-2 rounded">
                        {{__("messages.no")}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="confirm-finish text-center 300 p-2 rounded border border-info">
        <div class="head-confirm-finish border-bottom border-info p-2">
            <div class="title">
                {{__("messages.confirm_finish")}}
            </div>
        </div>
        <div class="body-confirm-finish">
            <div class="container-fulid">
                <div class="row justify-content-around">
                    <div class="yes-finish btn btn-outline-info px-2 py-1 mt-2 rounded">
                        {{__("messages.yes")}}
                    </div>
                    <div class="no-finish btn btn-info px-2 py-1 mt-2 rounded">
                        {{__("messages.no")}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="full-screen-shadow"></div>
    <div class="spinner-loading d-none">
        <div class="spinner-grow text-info" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
@endsection

@section('hidden-inputs')
    @include('layouts.hidden')
@endsection