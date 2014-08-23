$(document).ready(function() {

	$('.group-select').on('change', onGroupChange );

	window.empty = $('.empty-template').clone().removeClass('empty-template');

	$('.add-invite').click(function(e) {

		e.preventDefault();
		var toInsert = empty.clone();
		toInsert.find('.group-select').on('change', onGroupChange );
		toInsert.find('.remove-invite').click( onRemoveClick );
		$('table tbody').append( toInsert );

	});

	$('.remove-invite').click( onRemoveClick );
	$('.save-invites').click( onSaveInvites );


});

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
	$parent = $(this).parents('tr');
	$parent.find('[name="remove"]').val('true');
	$parent.hide();
}

function onGroupChange( e ) {

	$el = $(this);

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
