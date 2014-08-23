<section id="rsvp" data-_party-100p="transform:translate(0,100%);" data-_party-200p="transform:translate(0,0%)" class="rsvp">
<div class="bg-line"></div>
	<div class="container">
		<div class="content">
			{{ HTML::image('assets/images/rsvp.png', 'RSVP', array('class' => 'big-image')) }}
			<div class="info">
				<h2>Asistencia</h2>
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim</p>
			</div>
			@if( $invites )
			<div class="invites">
				<h3>Invitados</h3>
				@foreach( $invites as $invite )
				<div class="invitation-card" data-invitation-id="{{ $invite->id }}">
					<div class="status {{ ($invite->confirmed_on || $invite->declined_on)?'replied':'' }}">
						<div>
							{{ $invite->first_name }}
							@if( $invite->confirmed_on )
							<span class="status-msg">Asistirá</span>
							@elseif($invite->declined_on)
							<span class="status-msg">No Asistirá</span>
							@else
							<span class="status-msg"></span>
							@endif
						</div>
						<button class="btn btn-link change-rsvp">Cambiar</button>
					</div>
					<h4>{{ $invite->first_name }} {{ $invite->last_name }}</h4>
					<button class="btn btn-success confirm"><span class="glyphicon glyphicon-ok"></span> Asistirá</button>
					<button class="btn btn-danger decline"><span class="glyphicon glyphicon-remove"></span> No Asistirá</button>
				</div>
				@endforeach
			</div>
			@endif
		</div>
	</div>
</section>
