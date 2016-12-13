<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Validator;

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
        $task->user_id     = \Auth::user()->id;
        $task->save();

        return redirect('/task');
    }
    /**
     * Mostrar el formulario de edicion
     * @param  int $id Id de la tarea
     * @return View
     */
    public function edit($id)
    {
        $task = Task::find($id);
        //dd($task->toArray());
        return view('tasks.edit', ['task' => $task]);
    }
    /**
     * Actualiza una tarea
     * @param  int  $id      Id de la tarea
     * @param  Request $request
     * @return Redirect
     */
    public function update($id, Request $request)
    {
        $task = Task::find($id);

        $task->name        = $request->name;
        $task->description = $request->description;
        $updated           = $task->save();

        if ($updated) {
            return redirect('/task');
        }

        throw new Exception("Ocurrio un error actualizando la tarea:", 1);

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
