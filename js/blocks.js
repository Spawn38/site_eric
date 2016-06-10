
function addBlockForm() {
	$('#modalBlockForm').openModal();
  $('fondBlockForm').val('');
  $('textBlockForm').val('');
  $('#titreBlockForm').val('');
  tinymce.get('valueBlockForm').setContent('');
  $('#idBlockForm').val(-1);
	$('#actionBlockForm').val('add');
}

function editBlockForm(idBlock, typeBlock, image) {
	$('#modalBlockForm').openModal();
  $('#typeBlock').prop('checked', typeBlock);
  if(typeBlock) {
    $('titreBlockForm').val('');
    tinymce.get('valueBlockForm').setContent('');
    $('#fondBlockForm').val(htmlDecode(image));
    $('#fondBlockForm').trigger('change');
    $('#textBlockForm').val($('#block'+idBlock+'>h4').html());
    $('#textBlockForm').trigger('change');
  } else {
    $('#titreBlockForm').val($('#block'+idBlock+'>span').html());
    $('#titreBlockForm').trigger('change');
    tinymce.get('valueBlockForm').setContent($('#block'+idBlock+'>div').html());
    $('#fondBlockForm').val('');
    $('#textBlockForm').val('');
  }
  changeTypeBlock();
	$('#idBlockForm').val(idBlock);
	$('#actionBlockForm').val('edit');
}

function deleteBlockForm(idBlock) {
	var r = confirm("Confirmer la suppression :");
	if(r == true) {
		$.ajax({ url: '/func/deleteBlock.php',
	        data: {idBlock : idBlock},
	        type: 'post',
	        success: function(output) {
	        	if(output.success) {
	        		console.log(output);
			        Materialize.toast('L\'élément a été supprimé', 4000);
			        $(location).attr('href','admini.php?onglet=3')
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

function changeTypeBlock() {
  if($('#typeBlock').is(':checked')) {
    $('#blockImage').show();
    $('#blockTexte').hide();
  } else {
    $('#blockImage').hide();
    $('#blockTexte').show();
  }
}

function handleBlockChangeOrder(element, initialOrder, destinationOrder) {
  var idBlock = element.find('input#idBlock').val();  
  $.ajax({ url: '/func/changeOrderBlock.php',
        data: {
          idBlock : idBlock,
          initialOrder : initialOrder,
          destinationOrder : destinationOrder
        },
        type: 'post',
        success: function(output) {
          if(output.success) {
            console.log(output);
            Materialize.toast('L\'élément a été modifié', 4000);
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
