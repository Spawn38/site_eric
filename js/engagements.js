
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


function removeEngagementsNumber() {
  let numberEng = parseInt($('#numberEngagement').text());
  if(numberEng > 1) {
    numberEng--;
    $('#numberEngagement').text(numberEng);
    $.ajax({ url: '/func/editEngagementsNumber.php',
          data: {number : numberEng},
          type: 'post',
          success: function(output) {
            if(output.success) {
              console.log(output);
              Materialize.toast('Modification enregistrée', 4000);
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

function addEngagementsNumber() {
  let numberEng = parseInt($('#numberEngagement').text());
  if(numberEng < 12) {
    numberEng++;
    $('#numberEngagement').text(numberEng);
    $.ajax({ url: '/func/editEngagementsNumber.php',
          data: {number : numberEng},
          type: 'post',
          success: function(output) {
            if(output.success) {
              console.log(output);
              Materialize.toast('Modification enregistrée', 4000);
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


function addEngagementForm() {
	$('#modalEngagementForm').openModal();
	$('#titreEngagementForm').html('');
	$('#titreEngagementForm').trigger('change');
	$('#iconeEngagementForm').val('');
	$('#iconeEngagementForm').trigger('change');
  $('#fondEngagementForm').val('');
	$('#fondEngagementForm').trigger('change');
	tinymce.get('valueEngagementForm').setContent('');
	$('#idEngagementForm').val('');
	$('#actionEngagementForm').val('add');
}

function editEngagementForm(idengagement,image) {
	$('#modalEngagementForm').openModal();
	$('#titreEngagementForm').val($('#engagement'+idengagement+'>span').html());
	$('#titreEngagementForm').trigger('change');
	$('#iconeEngagementForm').val($('#engagement'+idengagement+'>i').html());
	$('#iconeEngagementForm').trigger('change');
	$('#iconeEngagementForm').focus();
	$('#iconeEngagementForm').blur();
  $('#fondEngagementForm').val(htmlDecode(image));
  $('#fondEngagementForm').trigger('change');
	tinymce.get('valueEngagementForm').setContent($('#engagement'+idengagement+'>div').html());
	$('#idEngagementForm').val(idengagement);
	$('#actionEngagementForm').val('edit');
}
