@extends('layouts.app')

@section('title')
    {{ __('messages.list_tasks_user') }}
    {{ $name_user['name'] }}
@endsection

@section('content')
    <div class="container">
        <div class="card bg-dark">
            <div class="card-header">
                {{ __('messages.list_tasks_user') }} {{ $name_user['name'] }}
                <a href="{{ route('single', $name_user['username']) }}"
                    class="badge badge-info">{{ $name_user['username'] }}</a>
            </div>
            <div class="card-body">
                <div class="row justify-content-center justify-content-md-around text-center my-row">
                    {{-- {{print_r($name_user)}} --}}
                    @if($name_user["private"] != 1)
                        @forelse ($tasks as $item)
                            <div class="col-10 col-md-5 col-lg-3 mb-2 bg-info rounded task" style="background-image:url({{asset("img/list-task.svg")}});background-position:{{$direction}};">
                                <div class="row justify-content-center align-items-center p-2">
                                    <div class="col-11">
                                        {{$item["task_description"]}}
                                    </div>
                                </div>
                            </div>
                        @empty
                            {{__("messages.no_tasks")}}  
                        @endforelse
                    @else 
                        {{__("messages.private_tasks")}}
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
