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
		</tr>
		@endforeach
	</tbody>
</table>
<div class="pull-right">
	<input type="hidden" id="reminder-flag" name="reminder" value="0">
	<button class="btn btn-default send-invites" type="submit">Enviar Invitaciones</button>
	<button class="btn btn-primary send-reminders" type="submit">Enviar Recordatorios</button>
</div>
{{ Form::close() }}
@stop
