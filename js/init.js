var hidePopup = false;

(function($){
  $(function(){

    $('.button-collapse').sideNav();
    $('.parallax').parallax();        
  	$('#contactForm').on('submit', function(e){
	    e.preventDefault();

	    var name = $('#name').val();
	    var email = $('#email').val();
	    var message = $('#message').val();

		if(name == "") {
		  Materialize.toast('Veuillez renseigner un nom !', 4000);
		  $('#name').focus();
		  return false;
		}

		if(email == "") {
		  Materialize.toast('Veuillez renseigner un email !', 4000);
		  $('#email').focus();
		  return false;
		}
		if(message == "") {
		  Materialize.toast('Veuillez renseigner un message !', 4000);
		  $('#message').focus();
		  return false;
		}

		$.ajax({ url: '/func/sendContact.php',
	        data: {message: message, name : name, email : email},
	        type: 'post',
	        success: function(output) {
	        	if(output.success) {
			        $("#modalContact").closeModal();
			        $("#contactForm").get(0).reset();
			        $("#message").removeAttr('style');
			        Materialize.toast('Le message a été envoyé', 4000);
			    } else {
			    	Materialize.toast('Une erreur est survenue', 4000);
			    }
			},
	        error: function() {
	            Materialize.toast('Une erreur est survenue', 4000);
	        }
		});
	});
	$('.modal-trigger').leanModal({dismissible: false});

	 var $win = $(window);

     $win.scroll(function () {
         if ($win.height() + $win.scrollTop()+250
                        > $(document).height()) {
         	$('#messagepopup').hide();
     	}
        else if(!hidePopup){
            $('#messagepopup').show();
        }
     });
  }); // end of document ready
}
)(jQuery);

function onHidePopup() {
	hidePopup = true;
	$('#messagepopup').hide();
}

function openContact() {
	$('#modalContact').openModal();
}

$(document).ready(function(){
	$('.collapsible').collapsible({	accordion : false	});
});

function resetForm() {
	$("#modalContact").closeModal();
	$("#contactForm").get(0).reset();
	$("#message").removeAttr('style');
}
