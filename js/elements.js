
function editElementForm(label, simple=0,image=0) {
	$('#modalElementForm').openModal();
  $('#simpleElementForm').val(simple);
  $('#imageElementForm').val(image);
  if(simple==0) {
    $('#editComplex').show();
    $('#editSimple').hide();
    tinymce.get('valueElementForm').setContent($('#element'+label).html());
  } else {
    $('#editSimple').show();
    $('#editComplex').hide();
    if (image==1) {
      $('#simpelValueElementForm').val(htmlDecode($('#element'+label+'> img').attr( "src")));
    } else {
      $('#simpelValueElementForm').val(htmlDecode($('#element'+label).html()));
    }
    $('#simpelValueElementForm').trigger('change');
  }
	$('#labelElementForm').val(label);
	$('#labelElementForm').trigger('change');
}

function resetElementForm(label) {
	$.ajax({ url: '/func/resetPageElements.php',
        data: {label : label, langue : $('#langue').val()},
        type: 'post',
        success: function(output) {
        	if(output.success) {
        		console.log(output);
		        Materialize.toast('L\'élément a été réinitialisé', 4000);
		        $(location).attr('href','admini.php?onglet=0')
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

function deleteEngagementForm(idengagement) {
	var r = confirm("Confirmer la suppression :");
	if(r == true) {
		$.ajax({ url: '/func/deleteEngagement.php',
	        data: {idengagement : idengagement},
	        type: 'post',
	        success: function(output) {
	        	if(output.success) {
	        		console.log(output);
			        Materialize.toast('L\'élément a été supprimé', 4000);
			        $(location).attr('href','admini.php?onglet=2')
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

function validAddEngagementForm(titre, icone, block, image, langue) {
	$.ajax({ url: '/func/addEngagement.php',
        data: {titre : titre, icone : icone, block : block, langue : langue,
          image : image},
        type: 'post',
        success: function(output) {
        	if(output.success) {
        		console.log(output);
		        Materialize.toast('L\'élément a été ajouté', 4000);
		        $(location).attr('href','admini.php?onglet=2')
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

function validEditEngagementForm(idengagement, titre, icone, block, image, langue) {
$.ajax({ url: '/func/editEngagement.php',
        data: {idengagement : idengagement, titre : titre, icone : icone,
          block : block, langue : langue, image : image},
        type: 'post',
        success: function(output) {
        	if(output.success) {
        		console.log(output);
		        Materialize.toast('L\'élément a été modifié', 4000);
		        $(location).attr('href','admini.php?onglet=2')
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
