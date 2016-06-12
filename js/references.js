function addReferenceForm() {
	$('#modalReferenceForm').openModal();
  $('#textRefrenceForm').val('');
	$('#imageReference').val('');
  $('#idReferenceForm').val(-1);
	$('#actionReferenceForm').val('add');
}

function editReferenceForm(idreference) {
	$('#modalReferenceForm').openModal();
	$('#textRefrenceForm').val($('#reference'+idreference+'>td>span').html());
	$('#textRefrenceForm').trigger('change');
	$('#imageReference').val($('#reference'+idreference+'>td>img').attr('src'));
	$('#imageReference').trigger('change');
	$('#idReferenceForm').val(idreference);
	$('#actionReferenceForm').val('edit');
}

function deleteReferenceForm(idreference) {
	var r = confirm("Confirmer la suppression :");
	if(r == true) {
		$.ajax({ url: '/func/deleteReference.php',
	        data: {idreference : idreference},
	        type: 'post',
	        success: function(output) {
	        	if(output.success) {
	        		console.log(output);
			        Materialize.toast('L\'élément a été supprimé', 4000);
			        $(location).attr('href','admini.php?onglet=5')
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

function validAddReferenceForm(textrefrence, imagereference, langue) {
	$.ajax({ url: '/func/addReference.php',
        data: {textrefrence:textrefrence, imagereference:imagereference,
        	langue:langue},
        type: 'post',
        success: function(output) {
        	if(output.success) {
        		console.log(output);
		        Materialize.toast('L\'élément a été ajouté', 4000);
		        $(location).attr('href','admini.php?onglet=5')
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

function validEditReferenceForm(idreference, textrefrence, imagereference, langue) {
	$.ajax({ url: '/func/editReference.php',
        data: {idreference:idreference, textrefrence:textrefrence,
          imagereference:imagereference, langue: langue},
        type: 'post',
        success: function(output) {
        	if(output.success) {
        		console.log(output);
		        Materialize.toast('L\'élément a été modifié', 4000);
		        $(location).attr('href','admini.php?onglet=5')
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
