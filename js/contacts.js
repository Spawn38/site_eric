function supprContactForm(idContact) {
	var r = confirm("Confirmer la suppression :");
	if(r == true) {
		$.ajax({ url: '/func/deleteContact.php',
	        data: {idcontact : idContact},
	        type: 'post',
	        success: function(output) {
	        	if(output.success) {
				    $("#contact"+idContact).fadeTo(300, 0, function () {
	        			$(this).remove();
	    			});
			        Materialize.toast('L\'élément a été supprimé', 4000);
			    } else {
			    	console.log(output);
			    	Materialize.toast('Une erreur est survenue', 4000);
			    }
			},
	        error: function(output) {
	        	console.log(output);
	            Materialize.toast('Une erreur est survenue', 4000);
	        }
		});
	}
}

function validAddContactForm(label,value,langue) {
	$.ajax({ url: '/func/addContact.php',
        data: {label : label, value : value, langue: langue},
        type: 'post',
        success: function(output) {
        	console.log(output);
        	if(output.success) {
		        Materialize.toast('L\'élément a été ajouté', 4000);
		        $(location).attr('href','admini.php?onglet=1')
		    } else {
		    	console.log(output);
		    	Materialize.toast('Une erreur est survenue', 4000);
		    }
		},
        error: function(output) {
        	console.log(output);
            Materialize.toast('Une erreur est survenue', 4000);
        }
	});
}

function validEditContactForm(idContact,label,value) {
	$.ajax({ url: '/func/editContact.php',
        data: {idcontact : idContact, label : label, value : value},
        type: 'post',
        success: function(output) {
        	if(output.success) {
        		console.log(output);
		        Materialize.toast('L\'élément a été modifié', 4000);
		        $(location).attr('href','admini.php?onglet=1')
		    } else {
		    	Materialize.toast('Une erreur est survenue', 4000);
		    }
		},
        error: function(output) {
        	console.log(output);
            Materialize.toast('Une erreur est survenue', 4000);
        }
	});
}

function editContactForm(idContact, label, value) {
	$('#modalContactForm').openModal();
	tinymce.get('valueContactForm').setContent(value);
	$('#labelContactForm').val(label);
	$('#labelContactForm').trigger('change');
	$('#idContactForm').val(idContact);
	$('#actionContactForm').val('edit');
}

function addContactForm() {
	$('#modalContactForm').openModal();
	tinymce.get('valueContactForm').setContent('');
	$('#labelContactForm').val('');
	$('#labelContactForm').trigger('change');
	$('#idContactForm').val(-1);
	$('#actionContactForm').val('add');
}
