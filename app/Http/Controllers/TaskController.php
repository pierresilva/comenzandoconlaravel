<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }
    /**
     * Listado de tareas
     * @return [type]
     */
    public function index()
    {
    	$tasks = Task::orderBy('created_at', 'asc')->with('user')->get();        
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('tasks.form', []);
    }
    /**
     * Guarda una tarea
     * @param  Request $request
     * @return [type]
     */
    public function store(Request $request)
    {
    	// Creo un objeto de validacion
        $validator = Validator::make($request->all(), [
            'name'        => 'required|max:64|min:6',
            'description' => 'required|min:10',
        ]);
        // Comprubo que la validacion pase
        if ($validator->fails()) {
        	// si no pasa redirije al formulario
            return redirect('/task/create')
                //->wihtInput()
                ->withErrors($validator);
        }
        // Guarda la tarea
        $task              = new Task;
        $task->name        = $request->name;
        $task->description = $request->description;
        $task->user_id = \Auth::user()->id;
         $task->save();

        return redirect('/task');
    }
    

    public function destroy($id)
    {
        //dd($request->all());
        
        $task = new Task;

        $deleted = $task::destroy($id);

        if ($deleted) {
            return redirect('/task');
        }

        return "Ocurrio un error";

    }
}
