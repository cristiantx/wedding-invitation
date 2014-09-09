@extends('admin.layout')

@section('content')
<h1>Lista de Invitados <small>{{ $totalGlobal }} Confirmados</small></h1>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Anfitrion</th>
			<th>Grupo</th>
			<th>Estado</th>
			<th>Accion</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $invitations as $invite )
		<tr class="invitation">
			<td>{{ $invite->first_name }}</td>
			<td>{{ $invite->last_name }}</td>
			<td>
				{{ $invite->host->first_name }}
			</td>
			<td>{{ ($invite->group)?$invite->group->id:'-' }}</td>
			@if( $invite->declined_on )
			<td><span class="label label-danger">No asistirá</span></td>
			@elseif ( $invite->confirmed_on )
			<td><span class="label label-success">Asistirá</span></td>
			@else
			<td><span class="label label-default">N/D</span></td>
			@endif
			<td><button class="btn btn-success resend-invite">Confirmar</button></td>
		</tr>
		@endforeach
	</tbody>
</table>
@stop
