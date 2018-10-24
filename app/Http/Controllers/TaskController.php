<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Priority;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return [
            'tasks' => Task::where('user_id', auth()->id())
                            ->where('state', '<>', 'done')
                            ->where('category', $request->category)
                            ->orderBy('created_at', 'DESC')
                            ->get(),
            'priorities' => Priority::getPriorities()
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);

        $task = new Task();

        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->category = $request->category; 
        $task->state = "pending";
        $task->user_id = auth()->id();
        
        $task->save();

        return $task;

    }

    /**
     * Complete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complete(Task $task)
    {
        //$task = Task::find($id);
        $task->state = "done";
        $task->save();

        return response()->json(['result' => 'ok']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::find($id)->destroy();
    }
}
