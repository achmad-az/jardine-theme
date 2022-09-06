(function($) {

  $(document).ready(function() {
    custom_css_modal();
    if( $('#add-custom-css').length > 0) {
      if( $('textarea[name="custom-css-code"]').val().trim() != '' ) {
        $('#add-custom-css').text('Edit Custom CSS');
      }
    }
  })

  function custom_css_modal() {
    var modal_template = '<div class="custom-modal-overlay"><div class="custom-modal">'+
                            '<div class="custom-modal-head"><h2>CUSTOM CSS</h2> <a href="#" class="custom-modal-close"><span class="dashicons dashicons-no"></span></a> <a href="#" class="custom-modal-minimize"><span class="dashicons dashicons-minus"></span></a></div>' +
                            '<div class="custom-modal-content">' +
                              '<textarea id="css-code" cols="10" rows="10"></textarea>' +
                            '</div>' +
                            '<div class="custom-modal-footer"><a href="#" class="custom-modal-close">Close</a><a href="#" class="custom-modal-save">Save</a> <span>(Note: it will be outputted only on this particular page).</span></div>' +
                         '</div></div>';


    $('#add-custom-css').click(function(e) {
      e.preventDefault();
      $('.custom-modal-minimized').remove();
      if($('.custom-modal-overlay').length == 0) {
        $('body').prepend(modal_template);
        $('body .custom-modal-overlay').find('#css-code').val( $('textarea[name="custom-css-code"]').val() );
        var editor = CodeMirror.fromTextArea(document.getElementById("css-code"), {
            theme: 'monokai',
            lineNumbers: true,
            mode: 'css',
            autoCloseBrackets: true,
            autofocus: true,
            extraKeys: {
            "F11": function(cm) {
              cm.setOption("fullScreen", !cm.getOption("fullScreen"));
            },
            "Esc": function(cm) {
              if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
            }
          }
        });
      } else {
        $('.custom-modal-overlay').show();
      }
    })

    $('body').on('click', '.custom-modal-close', function(e) {
      e.preventDefault();
      var editor = $('.CodeMirror')[0].CodeMirror;
      var textarea_outside = $('textarea[name="custom-css-code"]').val().trim();
      if( editor.getValue().trim() != '' && textarea_outside != editor.getValue().trim() ) {
        var confirm_close = confirm('Your custom CSS will gone if you not save it');

        if(confirm_close) {
          $('.custom-modal-overlay').remove();
          $('.custom-modal-minimized').remove();
        }
      } else {
         $('.custom-modal-overlay').remove();
         $('.custom-modal-minimized').remove();
      }
    })

    $('body').on('click', '.custom-modal-minimize', function(e) {
      e.preventDefault();
      $(this).closest('.custom-modal-overlay').hide();
      $('body').prepend('<div class="custom-modal-minimized"><a href="#" class="custom-modal-maximize"><h2>CUSTOM CSS</h2></a> <a href="#" class="custom-modal-close"><span class="dashicons dashicons-no"></span></a></div>');
    })

    $('body').on('click', '.custom-modal-maximize', function(e) {
      e.preventDefault();
      $('body').find('.custom-modal-overlay').show();
      $(this).closest('.custom-modal-minimized').remove();
    })

    $('body').on('click', '.custom-modal-save', function(e) {
      e.preventDefault();
      var editor = $('.CodeMirror')[0].CodeMirror;
      $('textarea[name="custom-css-code"]').val( editor.getValue() );
      $(this).closest('.custom-modal-overlay').remove();

      if( $('textarea[name="custom-css-code"]').val().trim() != '' ) {
        $('#add-custom-css').text('Edit Custom CSS');
      } else {
        $('#add-custom-css').text('Add Custom CSS');
      }
    });
    $('a.import-cfs-button').click(function(e){
      e.preventDefault();
      import_cfs();
      return false;
    });
    function import_cfs(){
      var datas = {
              action : 'cfs_ajax_handler',
              action_type : 'import',
              import_code : $('input[name="importCFS"]').val()
          };
    jQuery.ajax({
            type : "post",
            url : izeadm_ajax.ajax_url,
            data : datas,
            success: function(response) {
               alert(response);
            }
        });
    }
  }

})( jQuery );
