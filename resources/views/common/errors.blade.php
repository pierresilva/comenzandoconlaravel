<!-- errores de validación -->

@if (count($errors) > 0)

<div class="alert-danger">
	<b>Algo salio mal!</b>
	<br>
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif