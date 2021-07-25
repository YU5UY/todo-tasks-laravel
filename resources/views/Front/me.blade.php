@extends("layouts.app")

@section('title')
    {{ __('messages.profile_title') }}
@endsection

@section('content')
    <div class="container" style="max-width: 700px">
        <div class="result alert"></div>
        <div class="no-update alert alert-warning d-none">{{__("messages.no_update")}}</div>
            <div class="form-group">
                <label for="name">{{__("messages.name")}}</label>
                <input type="text" class="form-control" name="name" value="{{$information["name"]}}">
                <small class="form-text text-info text-name">{{__("messages.name.note")}}</small>
            </div>
            <div class="form-group">
                <label>{{__("messages.username")}}</label>
                <input type="text" class="form-control" name="username" value="{{$information["username"]}}">
                <small class="form-text text-info text-username">{{__("messages.username.note")}}</small>
            </div>
            <div class="form-group">
                <label>{{__("messages.password")}}</label>
                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                <small class="form-text text-info text-password">{{__("messages.password_new.note")}}</small>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input pt-2" name="private" @if ($information["private"] == 1) checked @endif>
                <label class="form-check-label 
                @if(LaravelLocalization::getCurrentLocale() == "ar")
                    px-3
                @endif
                ">{{__("messages.private_or_public")}}</label>
                
            </div>
            <button type="submit" class="btn btn-info">{{__("messages.update")}}</button>
    </div>
@endsection

@section('hidden-inputs')
    @include("layouts.hidden")
@endsection
