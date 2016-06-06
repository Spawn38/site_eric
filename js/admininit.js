(function($){
  $(function(){

  	$('ul.tabs').tabs();

  	$('#contactFormAdmin').on('submit', function(e){
	    e.preventDefault();
	    if($('#actionContactForm').val() == 'add') {
	    	validAddContactForm($('#labelContactForm').val(),
	    		tinymce.get('valueContactForm').getContent(),
	    		$('#langue').val());
	    } else if($('#actionContactForm').val() == 'edit') {
			validEditContactForm($('#idContactForm').val(),
				$('#labelContactForm').val(),
				tinymce.get('valueContactForm').getContent());
	    }
	});

	$('#elementFormAdmin').on('submit', function(e){
	    e.preventDefault();
      let value='';
      if($('#simpleElementForm').val() === 0) {
        value = tinymce.get('valueElementForm').getContent();
      } else {
        value = $('#simpelValueElementForm').val();
      }

	    validEditElementForm($('#labelElementForm').val(),
	    					value,
	    					$('#langue').val());
	});

	$('#engagementFormAdmin').on('submit', function(e){
	    e.preventDefault();
	    if($('#actionEngagementForm').val() == 'add') {
	    	validAddEngagementForm(
	    					$('#titreEngagementForm').val(),
	    					$('#iconeEngagementForm').val(),
	    					tinymce.get('valueEngagementForm').getContent(),
	    					$('#langue').val());
	    }
	    else if($('#actionEngagementForm').val() == 'edit') {
	    	validEditEngagementForm(
	    					$('#idEngagementForm').val(),
	    					$('#titreEngagementForm').val(),
	    					$('#iconeEngagementForm').val(),
	    					tinymce.get('valueEngagementForm').getContent(),
	    					$('#langue').val());
	    }
	});

	$('#joueurFormAdmin').on('submit', function(e){
	    e.preventDefault();
	    if($('#actionJoueurForm').val() == 'add') {
	    	validAddJoueurForm(
	    					$('#nomJoueurForm').val(),
	    					$('#lienJoueurForm').val(),
	    					$('#cibleJoueurForm').val(),
	    					tinymce.get('valueJoueurForm').getContent(),
	    					$('#imageJoueur').val(),
	    					$('#langue').val());
	    }
	    else if($('#actionJoueurForm').val() == 'edit') {
	    	validEditJoueurForm(
	    					$('#idJoueurForm').val(),
	    					$('#nomJoueurForm').val(),
	    					$('#lienJoueurForm').val(),
	    					$('#cibleJoueurForm').val(),
	    					tinymce.get('valueJoueurForm').getContent(),
	    					$('#imageJoueur').val(),
	    					$('#langue').val());
	    }
	});


	tinymce.init({
    	selector: '#valueContactForm',
    	menubar: false,
    	forced_root_block : "",
    	link_title: false,
    	plugins: [
      	'autolink link hr anchor pagebreak',
      	'nonbreaking',
      	'directionality paste'
    	]

  	});

  	tinymce.init({
    	selector: '#valueElementForm',
    	menubar: false,
    	forced_root_block : "",
    	link_title: false,
    	plugins: [
      	'autolink link hr anchor pagebreak',
      	'nonbreaking',
      	'directionality paste'
    	]

  	});

  	tinymce.init({
    	selector: '#valueEngagementForm',
    	menubar: false,
    	forced_root_block : "",
    	link_title: false,
    	plugins: [
      	'autolink link hr anchor pagebreak',
      	'nonbreaking',
      	'directionality paste'
    	]

  	});

  	tinymce.init({
    	selector: '#valueJoueurForm',
    	menubar: false,
    	forced_root_block : "",
    	link_title: false,
    	plugins: [
      	'autolink link hr anchor pagebreak',
      	'nonbreaking',
      	'directionality paste'
    	]

  	});

  	  // Upload Plugin itself
    $('#file-upload').dmUploader({
        url: '/func/upload.php',
        dataType: 'json',
        allowedTypes: 'image/*',
        fileName: 'filejoueur',

        onInit: function(){

        },
        onBeforeUpload: function(id){

        },
        onNewFile: function(id, file){
      		$('#progress-image').css('width','0%');
        },
        onComplete: function(){
          console.log('All pending tranfers finished');
          $('#progress-image').css('width','100%');
        },
        onUploadProgress: function(id, percent){
          $('#progress-image').css('width',percent+'%');
          var percentStr = percent + '%';
        },
        onUploadSuccess: function(id, data){
          console.log('Upload of file #' + id + ' completed');
          console.log('Server Response for file #' + id + ': ' + JSON.stringify(data));
          $('#imageJoueur').val(data.filename);
        },
        onUploadError: function(id, message){
          console.log('Failed to Upload file #' + id + ': ' + message);
        },
        onFileTypeError: function(file){
          console.log('File \'' + file.name + '\' cannot be added: must be an image');
        },
        onFileSizeError: function(file){
          console.log('File \'' + file.name + '\' cannot be added: size excess limit');
        },
        onFallbackMode: function(message){
          alert('Browser not supported(do something else here!): ' + message);
        }
      });

	$('#main').css('display', 'inline');
	$('#loading').hide();
  })
})(jQuery);

function supprContactForm(row, idContact) {
	var r = confirm("Confirmer la suppression :");
	if(r == true) {
		$.ajax({ url: '/func/deleteContact.php',
	        data: {idcontact : idContact},
	        type: 'post',
	        success: function(output) {
	        	if(output.success) {
				    $("#contactRow"+row).fadeTo(300, 0, function () {
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

function validEditElementForm(label,value,langue) {
	$.ajax({ url: '/func/editPageElements.php',
        data: {label : label, value : value, langue : langue},
        type: 'post',
        success: function(output) {
        	if(output.success) {
        		console.log(output);
		        Materialize.toast('L\'élément a été modifié', 4000);
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

function validAddEngagementForm(titre, icone, block, langue) {
	$.ajax({ url: '/func/addEngagement.php',
        data: {titre : titre, icone : icone, block : block, langue : langue},
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

function validEditEngagementForm(idengagement, titre, icone, block, langue) {
$.ajax({ url: '/func/editEngagement.php',
        data: {idengagement : idengagement, titre : titre, icone : icone, block : block, langue : langue},
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

function editElementForm( label, simple=0) {
	$('#modalElementForm').openModal();
  $('#simpleElementForm').val(simple);
  if(simple==0) {
    $('#editComplex').show();
    $('#editSimple').hide();
    tinymce.get('valueElementForm').setContent($('#element'+label).html());
  } else {
    $('#editSimple').show();
    $('#editComplex').hide();
    $('#simpelValueElementForm').val($('#element'+label).html());
    $('#simpelValueElementForm').trigger('change');
  }
	$('#labelElementForm').val(label);
	$('#labelElementForm').trigger('change');
}

function resetElementForm(label) {
	alert ($('#langue').val());
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

function addEngagementForm() {
	$('#modalEngagementForm').openModal();
	$('#titreEngagementForm').html('');
	$('#titreEngagementForm').trigger('change');
	$('#iconeEngagementForm').val('');
	$('#iconeEngagementForm').trigger('change');
	tinymce.get('valueEngagementForm').setContent('');
	$('#idEngagementForm').val('');
	$('#actionEngagementForm').val('add');
}

function editEngagementForm(idengagement) {
	$('#modalEngagementForm').openModal();
	$('#titreEngagementForm').val($('#engagement'+idengagement+'>span').html());
	$('#titreEngagementForm').trigger('change');
	$('#iconeEngagementForm').val($('#engagement'+idengagement+'>i').html());
	$('#iconeEngagementForm').trigger('change');
	$('#iconeEngagementForm').focus();
	$('#iconeEngagementForm').blur();
	tinymce.get('valueEngagementForm').setContent($('#engagement'+idengagement+'>div').html());
	$('#idEngagementForm').val(idengagement);
	$('#actionEngagementForm').val('edit');
}

function addJoueurForm() {
	$('#modalJoueurForm').openModal();
	$('#nomJoueurForm').val('');
	$('#lienJoueurForm').val('');
	$('#cibleJoueurForm').val('');
	$('#imageJoueur').val('');
	tinymce.get('valueJoueurForm').setContent('');
	$('#actionJoueurForm').val('');
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
	$('#imageJoueur').val($('#imageJoueur'+idjoueur+'>img').attr('src').slice(7));
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

function logout() {
	$.ajax({ url: '/func/logout.php',
	type : 'get'});
}

function updateIcon() {
	$('#iconEngagement').html($('#iconeEngagementForm').val());
}
