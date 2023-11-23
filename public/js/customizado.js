/* Faz funcionar o Data table*/
// //cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json

/*
$(function () {
  var table = $('#geral').DataTable( {
    
    "language": {
      "url": "../traducao-datatable.json",
  },
      //rowReorder: {
      //    selector: 'td:nth-child(2)'
      //},
      "responsive": true,
      "buttons": ['copy', 'excel', 'pdf'],
      // faz aparecer os buttons
      //dom: 'Bfrtip',
  } );
  table
    //.order( [ 2, 'asc' ] )
    .draw();
});

*/

    /* Auto Load Imagem Pessoa */
    $(function() {
        $("#profileImage").click(function(e) {
            $("#imageUpload").click();
        });

        function fasterPreview(uploader) {
            if (uploader.files && uploader.files[0]) {
                $('#profileImage').attr('src',
                    window.URL.createObjectURL(uploader.files[0]));
            }
        }

        $("#imageUpload").change(function() {
            fasterPreview(this);
        });

        $('#cpf').mask('000.000.000-00', {reverse: true});
        $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
        $('#data_agenda').mask('00/00/0000', {reverse: true});

    });

    