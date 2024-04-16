$( document ).ready(function() {

    var fileInput = $('.file-input');
    var droparea = $('.file-drop-area');
  
  // highlight drag area
  fileInput.on('dragenter focus click', function() {
    droparea.addClass('is-active');
  });
  
  // back to normal state
  fileInput.on('dragleave blur drop', function() {
    droparea.removeClass('is-active');
  });
  
  // change inner text
  fileInput.on('change', function() {
    var filesCount = $(this)[0].files.length;
    var textContainer = $(this).prev();
  
    if (filesCount === 1) {
      // if single file is selected, show file name
      var fileName = $(this).val().split('\\').pop();
      textContainer.text(fileName);
    } else {
      // otherwise show number of files
      textContainer.text(filesCount + ' archivo seleccionado');
    }
  });

  
  $(document).on("click", ".excel", function(e){
  
    var table = $(".table").prop('outerHTML');
        var ajaxurl = 'include/excel.php',
        data =  {'table': table};
                $.post(ajaxurl, data, function (response) {
                    $(".excel").html("Descargar Excel");
                    $(".excel").addClass("btn-warning").removeClass("btn-success").attr("href", "files/resultado.xls");
                });
            
        }); 

  

        $('.submit').on('click', function(e) {
            e.preventDefault();
            let tienda1 = $('.tienda1').prop('files')[0];
            let tienda2 = $('.tienda2').prop('files')[0];
            let diferencia = $('#diferencia').val();
            if(!diferencia){
                diferencia = .10;
            }

            if(tienda1 != undefined && tienda2 !=undefined) {
                var form_data = new FormData();                  
                form_data.append('tienda1', tienda1);
                form_data.append('tienda2', tienda2);
                form_data.append('diferencia', diferencia);

                $.ajax({
                    type: 'POST',
                    url: 'include/upload.php',
                    contentType: false,
                    processData: false,
                    data: form_data,
                    beforeSend: function ( xhr ) {    
                        $(".loading").css('display', 'flex');
                   },
                    success:function(response) {
                         $(".response").html(response);
  
                        $('.tienda1').val('');
                        $('.tienda2').val('');

                    }, 
                    complete:function(data){
                        $(".loading").hide();
                       }
                });

               
            }
            return false;
        });


  }); 