@extends('admin.layout')

@section('content')
<h1>Lista de Invitados</h1>
{{ Form::open(array('url' => 'invitados-admin/invitados')) }}
<table class="table table-hover">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Email</th>
			<th>Anfitrion</th>
			<th>Grupo</th>
			<th>Accion</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $invitations as $invite )
		<tr class="invitation empty-template">
			<td><input type="hidden" name="id" value="{{ $invite->id }}"><input type="hidden" name="remove" value="false"><input class="form-control" placeholder="Nombre" name="nombre" value="{{ $invite->first_name }}"></td>
			<td><input class="form-control" name="apellido" placeholder="Apellido" value="{{ $invite->last_name }}"></td>
			<td><input class="form-control" name="email" placeholder="Email" value="{{ $invite->email }}"></td>
			<td>
				{{ Form::select('host', $hosts, $invite->host->id, array('class' => 'form-control')) }}
			</td>
			<td>{{ Form::select('group', $groups, ($invite->group)?$invite->group->id:null, array('class' => 'form-control group-select')) }}</td>
			<td><button class="btn btn-danger remove-invite">Borrar</button></td>
		</tr>
		@endforeach
		<tr class="invitation empty-template">
			<td><input type="hidden" name="id" value=""><input type="hidden" name="remove" value="false"><input class="form-control" placeholder="Nombre" name="nombre"></td>
			<td><input class="form-control" name="apellido" placeholder="Apellido"></td>
			<td><input class="form-control" name="email" placeholder="Email"></td>
			<td>
				{{ Form::select('host', $hosts, null, array('class' => 'form-control')) }}
			</td>
			<td>{{ Form::select('group', $groups, null, array('class' => 'form-control group-select')) }}</td>
			<td><button class="btn btn-danger remove-invite">Borrar</button></td>
		</tr>
	</tbody>
</table>
<hr>
<div class="pull-right">
	<button class="btn btn-default add-invite">Agregar Invitado</button>
	<button class="btn btn-primary save-invites" type="submit">Guardar</button>
</div>
{{ Form::close() }}
@stop
