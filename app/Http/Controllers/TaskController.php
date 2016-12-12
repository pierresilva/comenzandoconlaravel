<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Listado de tareas
     * @return [type]
     */
    public function index()
    {
    	$tasks = Task::orderBy('created_at', 'asc')->get();

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
    /**
     * Elimina una tarea
     * @param  integer $id
     * @return [type]
     */
    public function destroy($id)
    {
        # code...
    }
}
