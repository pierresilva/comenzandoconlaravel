@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-md-12">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">
						Tareas Actuales
					</div>
					<div class="panel-body">
					@if (count($tasks) > 0)
						<table class="table table-striped task-table">
							<thead>
								<th>Tarea</th>
								<th>Descripcion</th>
								<th>&nbsp;</th>
							</thead>
							<tbody>
								@foreach ($tasks as $task)
								<tr>
									<td>{{ $task->name }}</td>
									<td>{{ $task->description }}</td>
									<td> <!-- botones --></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<b>No hay tareas</b>
					@endif
					<a href="{{url('/task/create')}}" class="btn btn-success btn-sm">Crear una tarea</a>					
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection