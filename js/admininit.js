(function($){
  $(function(){

    const toolBar = "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | fontselect fontsizeselec | removeformat | bullist, numlist, outdent, indent | forecolor backcolor | link";

    $('ul.tabs').tabs();
    $(".sort-scroll-container").sortScroll({
      animationDuration: 1000,// duration of the animation in ms
      cssEasing: "ease-in-out",// easing type for the animation
      keepStill: true,// if false the page doesn't scroll to follow the element
      fixedElementsSelector: ""// a jQuery selector so that the plugin knows your fixed elements (like the fixed nav on the left)
    });

    $(".sort-scroll-container").on("sortScroll.sortEnd", function(event, element, initialOrder, destinationOrder){
      handleBlockChangeOrder(element, initialOrder, destinationOrder);
    });

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
      if($('#simpleElementForm').val() == 0) {
        value = tinymce.get('valueElementForm').getContent();
      } else {
        value = $('#simpelValueElementForm').val();
      }

      validEditElementForm(
        $('#labelElementForm').val(),
        value,
        $('#langue').val(),
        $('#simpleElementForm').val(),
        $('#imageElementForm').val()
      );
    });

    $('#engagementFormAdmin').on('submit', function(e){
      e.preventDefault();
      if($('#actionEngagementForm').val() == 'add') {
        validAddEngagementForm(
          tinymce.get('titreEngagementForm').getContent(),
          $('#iconeEngagementForm').val(),
          tinymce.get('valueEngagementForm').getContent(),
          $('#fondEngagementForm').val(),
          $('#langue').val());
      }
      else if($('#actionEngagementForm').val() == 'edit') {
        validEditEngagementForm(
          $('#idEngagementForm').val(),
          tinymce.get('titreEngagementForm').getContent(),
          $('#iconeEngagementForm').val(),
          tinymce.get('valueEngagementForm').getContent(),
          $('#fondEngagementForm').val(),
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

    $('#referenceFormAdmin').on('submit', function(e){
      e.preventDefault();
      if($('#actionReferenceForm').val() == 'add') {
        validAddReferenceForm(
          $('#textRefrenceForm').val(),
          $('#imageReference').val(),
          $('#langue').val());
      }
      else if($('#actionReferenceForm').val() == 'edit') {
        validEditReferenceForm(
          $('#idReferenceForm').val(),
          $('#textRefrenceForm').val(),
          $('#imageReference').val(),
          $('#langue').val());
      }
    });

    $('#blockFormAdmin').on('submit', function(e){
      e.preventDefault();
      if($('#actionBlockForm').val() == 'add') {
        validAddBlockForm(
          ($('#typeBlock').is(':checked'))?1:0,
          $('#fondBlockForm').val(),
          $('#textBlockForm').val(),
          $('#titreBlockForm').val(),
          tinymce.get('valueBlockForm').getContent(),
          $('#langue').val());
      }
      else if($('#actionBlockForm').val() == 'edit') {
        validEditBlockForm(
          $('#idBlockForm').val(),
          ($('#typeBlock').is(':checked'))?1:0,
          $('#fondBlockForm').val(),
          $('#textBlockForm').val(),
          $('#titreBlockForm').val(),
          tinymce.get('valueBlockForm').getContent(),
          $('#langue').val());
      }
    });

    tinymce.init({
      selector: '#valueContactForm',
      menubar: false,
      forced_root_block : "",
      link_title: false,
      toolbar: toolBar,
      plugins: [
        'textcolor colorpicker link hr anchor nonbreaking paste autoresize'
      ]
    });

    tinymce.init({
      selector: '#valueElementForm',
      menubar: false,
      forced_root_block : "",
      link_title: false,
      toolbar: toolBar,
      plugins: [
        'textcolor colorpicker link hr anchor nonbreaking paste autoresize'
      ]
    });

    tinymce.init({
      selector: '#valueEngagementForm',
      menubar: false,
      forced_root_block : "",
      link_title: false,
      toolbar: toolBar+" image",
      plugins: [
        'textcolor colorpicker link hr anchor nonbreaking paste autoresize image'
      ]
    });

    tinymce.init({
      selector: '#valueJoueurForm',
      menubar: false,
      forced_root_block : "",
      link_title: false,
      toolbar: toolBar,
      plugins: [
        'textcolor colorpicker link hr anchor nonbreaking paste autoresize'
      ]
    });

    tinymce.init({
      selector: '#valueBlockForm',
      menubar: false,
      forced_root_block : "",
      link_title: false,
      toolbar: toolBar,
      plugins: [
        'textcolor colorpicker link hr anchor nonbreaking paste autoresize'
      ]
    });

    tinymce.init({
      selector: '#titreEngagementForm',
      menubar: false,
      forced_root_block : "",
      link_title: true,
      inline: true,
      toolbar: toolBar,
      plugins: [
        'textcolor colorpicker link hr anchor nonbreaking paste autoresize'
      ]
    });

    // Upload Plugin itself
    $('#file-upload').dmUploader({
      url: '/func/upload.php',
      dataType: 'json',
      allowedTypes: 'image/*',
      fileName: 'filejoueur',
      onInit: function(){},
      onBeforeUpload: function(id){},
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
        alert('Ce navigateur ne supporte pas cette fonctionnalité : ' + message);
      }
    });

    $('#main').css('display', 'inline');

    $( document ).ready(function() {
      $('#loading').hide();
    });
  })
})(jQuery);

function logout() {
  $.ajax({ url: '/func/logout.php',
  type : 'get'});
}

function exportConfig() {
  $.ajax({ url: '/func/export.php',
    type: 'post',
    success: function(output) {
      if(output.success) {
        console.log(output);
        Materialize.toast('Export réalisé', 4000);
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

function updateIcon() {
  $('#iconEngagement').html($('#iconeEngagementForm').val());
}

function htmlDecode(value) {
  return $("<div/>").html(value).text();
}

function htmlEncode(value) {
  return $('<div/>').text(value).html();
}
