$(document).ready(function() {

	$('.group-select').on('change', onGroupChange );

	window.empty = $('.empty-template').clone().removeClass('empty-template');

	$('.add-invite').click(function(e) {

		e.preventDefault();
		var toInsert = empty.clone();
		toInsert.find('.group-select').on('change', onGroupChange );
		toInsert.find('.remove-invite').click( onRemoveClick );
		toInsert.find('input').click( changedInput );
		$('table tbody').append( toInsert );

	});

	$('.remove-invite').click( onRemoveClick );
	$('.save-invites').click( onSaveInvites );
	$('tr input').on('change', changedInput );


});

function changedInput( e ) {
	setChanged( $(this) );
}

function onSaveInvites( e ) {

	e.preventDefault();
	var invites = [];

	$('.invitation').each(function( i ) {

		var invite = {};
		var row = $(this);
		invite.id = parseInt(row.find('[name="id"]').val()) || null;
		invite.remove = (row.find('[name="remove"]').val()!='false');
		invite.nombre = row.find('[name="nombre"]').val();
		invite.apellido = row.find('[name="apellido"]').val();
		invite.email = row.find('[name="email"]').val();
		invite.host_id = parseInt(row.find('[name="host"]').val());
		invite.group_id = parseInt(row.find('[name="group"]').val());

		invites.push( invite );

	});

	$.post('/invitados', { data: invites }, function() {
		window.location.reload();
	});

}

function onRemoveClick( e ) {
	e.preventDefault();

	setChanged( $(this) );

	$parent = $(this).parents('tr');
	$parent.find('[name="remove"]').val('true');
	$parent.hide();
}

function setChanged( $el ) {
	$parent = $el.parents('tr');
	$parent.find('[name="changed"]').val('true')
}

function onGroupChange( e ) {

	$el = $(this);

	setChanged( $el );

	if( $el.find(':selected').val() == 'new' ) {

		$.post('/invitados/grupo', null, function( response ) {

			var id = response.data.id;

			window.empty.find('.group-select :last-child').before( $('<option>'+id+'</option>') );

			$('.group-select').each(function ( i, select ) {
				$(select).find(':last-child').before( $('<option>'+id+'</option>') );
			});

			$el.val( id );

		});
	}

}
