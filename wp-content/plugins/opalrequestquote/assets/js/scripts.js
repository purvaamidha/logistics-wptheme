(function($) {
  "use strict";
  $(document).ready(function() {
    var short_form = $(".requestquote_short_form");
      /**
      * Validate Short form 
      */
      short_form.validate({
      errorPlacement: function errorPlacement(error, element) { element.before(error); },
      errorContainer: ".mesagetooltips",
        errorLabelContainer: ".mesagetooltips",
      rules: {
        opal_requestquote_movingon: {
          required: true,
          date: true
        },
        opal_requestquote_type: {
          required: true,
        }
      }, // end Rule
      });

    //=====================================================================
    // -- All Selector Process 
    //=====================================================================
    $('.opal_requestquote_type').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        var loading = '<div class="bedroom-loading"><img src="'+pluginurl+'assets/img/bx_loader.gif"  border=0><br>Data is loading...</div>';
        $('#bedroom-filter').html(loading);
        $.ajax({
              url: ajaxurl,
              type:'POST',
              dataType: 'html',
              data:  'action=bedroom_filter&id=' + valueSelected,
              error: function(jqXHR, textStatus, errorThrown){                                       
              console.error("The following error occured: " + textStatus, errorThrown);                                                       
        },
          }).done(function(reponse) {
              $('#bedroom-filter').html( reponse );
          });
    });


    //---------------------------------
    // load address filter by googlemap
    $('#opal_requestquote_movingfrom').geocomplete();

    $('#opal_requestquote_movingto').geocomplete();
    /* end */
    //-----------------------------   
    // load datetime picker
    $('.opal_requestquote_movingon').each(function(){
      $(this).datetimepicker({
          timepicker:false,
          format:'m/d/Y'
        });
    });
    $('.opal_requestquote_time').datetimepicker({
        datepicker:false,
        format:'H:i'
    });

    /**
    * Light Box for Video
    */
    $('.popup-youtube').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    });

  });
}(jQuery));