@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
    <h3>Editar Tarea :id {{$task->id}}</h3>
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Task Form -->
        <form action="{{ url('task/update/' . $task->id) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Task Name -->
            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label">Nombre:</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control" value="{{$task->name}}">
                </div>
            </div>
            <div class="form-group">
                <label for="task-description" class="col-sm-3 control-label">Descripción:</label>
                <div class="col-sm-6">
                    <textarea name="description" id="task-description" class="form-control">{{$task->description}}</textarea>
                </div>                
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Editar Tarea
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- TODO: Current Tasks -->
@endsection