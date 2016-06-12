function addJoueurForm() {
	$('#modalJoueurForm').openModal();
	$('#nomJoueurForm').val('');
	$('#lienJoueurForm').val('');
	$('#cibleJoueurForm').val('');
	$('#imageJoueur').val('');
	tinymce.get('valueJoueurForm').setContent('');
	$('#actionJoueurForm').val('add');
}

function editJoueurForm(idjoueur) {
	$('#modalJoueurForm').openModal();
	$('#nomJoueurForm').val($('#joueur'+idjoueur+'>span').html());
	$('#nomJoueurForm').trigger('change');
	$('#lienJoueurForm').val($('#joueur'+idjoueur+'>a').html());
	$('#lienJoueurForm').trigger('change');
	$('#cibleJoueurForm').val($('#joueur'+idjoueur+'>a').attr('href'));
	$('#cibleJoueurForm').trigger('change');
	$('#imageJoueur').val($('#imageJoueur'+idjoueur+'>img').attr('src'));
	$('#imageJoueur').trigger('change');
	tinymce.get('valueJoueurForm').setContent($('#joueur'+idjoueur+'>p').html());
	$('#idJoueurForm').val(idjoueur);
	$('#actionJoueurForm').val('edit');
}

function deleteJoueurForm(idjoueur) {
	var r = confirm("Confirmer la suppression :");
	if(r == true) {
		$.ajax({ url: '/func/deleteJoueur.php',
	        data: {idjoueur : idjoueur},
	        type: 'post',
	        success: function(output) {
	        	if(output.success) {
	        		console.log(output);
			        Materialize.toast('L\'élément a été supprimé', 4000);
			        $(location).attr('href','admini.php?onglet=4')
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

function validAddJoueurForm(nomJoueur, lienJoueur, cibleJoueur, block, image, langue) {
	$.ajax({ url: '/func/addJoueur.php',
        data: {nomjoueur:nomJoueur, lienjoueur:lienJoueur,
        	ciblejoueur:cibleJoueur, block:block, image : image, langue:langue},
        type: 'post',
        success: function(output) {
        	if(output.success) {
        		console.log(output);
		        Materialize.toast('L\'élément a été ajouté', 4000);
		        $(location).attr('href','admini.php?onglet=4')
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

function validEditJoueurForm(idJoueur, nomJoueur, lienJoueur, cibleJoueur, block, image, langue) {
	$.ajax({ url: '/func/editJoueur.php',
        data: {idjoueur:idJoueur, nomjoueur:nomJoueur, lienjoueur:lienJoueur,
        	ciblejoueur:cibleJoueur, block:block, image: image, langue: langue},
        type: 'post',
        success: function(output) {
        	if(output.success) {
        		console.log(output);
		        Materialize.toast('L\'élément a été modifié', 4000);
		        $(location).attr('href','admini.php?onglet=4')
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
