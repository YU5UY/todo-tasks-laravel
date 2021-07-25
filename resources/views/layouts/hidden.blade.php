    {{-- Hidden inputs --}}
    <input type="hidden" value="{{ csrf_token() }}" id="csrf_token">
    <input type="hidden" value="{{ route('addTask') }}" id="add-task-route">
    <input type="hidden" value="{{ asset('img/delete_task.svg') }}" id="delete-task-img">
    <input type="hidden" value="{{ asset('img/done_task.svg') }}" id="done-task-img">
    <input type="hidden" value="{{route("allTasks")}}" id="url-tasks-json">
    <input type="hidden" value="{{route("doneTask")}}" id="url-done-task">
    <input type="hidden" value="{{route("deleteTask")}}" id="url-delete-task">
    <input type="hidden" value="{{Auth::user() -> done_tasks}}" id="done-tasks">
    <input type="hidden" value="{{Auth::user() -> all_tasks}}" id="all-tasks">
    <input type="hidden" value="{{route("update.userinfo")}}" id="update-route">
    <input type="hidden" value="{{__("messages.done")}}" id="done">
    {{-- End hidden Inputs --}}