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
									<td>{{ $task->name }} <br>
									<span class="small">
									Creada por: 
									{{$task->user->name}}
									</span></td>
									<td>{{ $task->description }}</td>
									<td>
										<form 
										action="{{url('/task/' . $task->id)}}"
										method="POST"
										>
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<button
											class="btn btn-danger btn-sm">
												<i class="fa fa-trash"></i>
											</button>
										</form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<b>No hay tareas</b>
					@endif
					@if (Auth::user())
					<br>
					
					<a href="{{url('/task/create')}}" class="btn btn-success btn-sm">Crear una tarea</a>	
					@endif			
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection