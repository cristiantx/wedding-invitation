@extends('admin.layout')

@section('content')
<h1>Enviar Invitaciones</h1>
{{ Form::open(array('url' => '/invitaciones/enviar', 'method' => 'post')) }}
<table class="table table-hover invitaciones-list">
	<thead>
		<tr>
			<th><input type="checkbox" class="select-all"></th>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Email</th>
			<th>Anfitrion</th>
			<th>Grupo</th>
			<th>Visto</th>
			<th>Enviado</th>
			<th>Estado</th>
			<th>Accion</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $invitations as $invite )
		<tr class="invitation">
			<td><input type="checkbox" name="selected[]" value="{{ $invite->id }}"></td>
			<td>{{ $invite->first_name }}</td>
			<td>{{ $invite->last_name }}</td>
			<td>{{ $invite->email }}</td>
			<td>
				{{ $invite->host->first_name }}
			</td>
			<td>{{ ($invite->group)?$invite->group->id:'-' }}</td>
			<td>{{ $invite->seen_at }}</td>
			<td>{{ $invite->invited_on }}</td>
			@if( $invite->declined_on )
			<td><span class="label label-danger">No asistirá</span></td>
			@elseif ( $invite->confirmed_on )
			<td><span class="label label-success">Asistirá</span></td>
			@else
			<td><span class="label label-default">N/D</span></td>
			@endif
			<td><button class="btn btn-default resend-invite">Reenviar</button> <button class="btn btn-default resend-invite">Recordatorio</button></td>
		</tr>
		@endforeach
	</tbody>
</table>
<div class="pull-right">
	<button class="btn btn-primary send-invites" type="submit">Enviar Invitaciones</button>
</div>
{{ Form::close() }}
@stop
