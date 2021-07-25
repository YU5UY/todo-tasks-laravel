<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\UserTasks;
use Illuminate\Http\Request;
use App\Http\Requests\AddTaskRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\DirectionSiteTrait;
use Illuminate\Support\Facades\Hash;

class UserTasksController extends Controller
{
    //
    use DirectionSiteTrait;

    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $data = $this->getTasksUser();
        $side = $this->getdirection();
        return view('Front.Tasks')->with(["dataTasks" => $data, "direction" => $side]);
    }
    public function getTasksUser()
    {
        $data = UserTasks::where("username", Auth::user()->username)->get();
        if (count($data)) return $data;
        else return ["msg" => "there is no tasks"];
    }
    public function insertTask(AddTaskRequest $reqeust)
    {
        $task = new UserTasks();
        $task->username = Auth::user()->username;
        $task->task_description = $reqeust->description;
        $task->save();
        $all_tasks = $this->updateAllTasks();
        return ["msg" => "Task saved", "description" => $task->task_description, "id_task" => $task->id, "all_tasks" => $all_tasks];
    }
    function updateAllTasks()
    {
        $all_tasks_increase = User::find(Auth::user()->id);
        $all_tasks_increase->all_tasks = $all_tasks_increase->all_tasks + 1;
        $all_tasks_increase->save();
        return $all_tasks_increase->all_tasks;
    }
    public function doneTask(Request $reqeust)
    {
        $this->deleteTask($reqeust);
        $doneTasks = User::find(Auth::user()->id);
        $doneTasks->done_tasks = $doneTasks->done_tasks + 1;
        $doneTasks->save();
        return $doneTasks->done_tasks;
    }
    public function deleteTask(Request $reqeust)
    {
        $task = UserTasks::find($reqeust->id);
        $task->delete();
        $all_tasks_deacrease = User::find(Auth::user()->id);
        $all_tasks_deacrease->all_tasks = $all_tasks_deacrease->all_tasks - 1;
        $all_tasks_deacrease->save();
        return ["msg" => "Done delete"];
    }
    public function getSingleTasks($username)
    {
        $side = $this->getDirection();
        $name = User::select("*")->where(["username" => $username])->get()->first();
        if (empty($name)) {
            return redirect()->route("tasks");
        }
        $tasks = UserTasks::select("*")->where(["username" => $username])->get();
        return view("Front.single_tasks")->with(["direction" => $side, "name_user" => $name, "tasks" => $tasks]);
    }
    public function profile()
    {
        $side = $this->getDirection();
        $userinfo = Auth::user();
        return view("Front.me")->with(["direction" => $side, "information" => $userinfo]);
    }
    public function updateProfile(Request $request)
    {
        //return $request;
        $user = User::find(Auth::id());
        if ($request -> name != Auth::user() -> name){
            $user->name = $request->name;
        }
        if ($request -> private != Auth::user() -> private){
            $user -> private = $request -> private;
        }
        if ($request->password != "") {
            if (strlen($request -> password) < 5 ){
                return ["error" => 2,"msg" => __("messages.passlength")];
            }
            $user->password = Hash::make($request->password);
        }
        if ($request->username != Auth::user()->username) {
            $search = User::select("username")->where(["username" => $request->username])->first();
            if (empty($search)) {
                $user->username = $request->username;
            } else return ["error" => 1, "msg" => __("messages.username_req")];
        }

        $user->save();
        return ["error" => 0, "msg" => __("messages.updated")];
    }
    function resetAllTasks(){
        UserTasks::truncate();
        User::select("*")->update(["all_tasks" => 0 , "done_tasks" => 0]);
    }
}
