
$(".capa").change(function(){
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#view-img').attr('src', e.target.result);
        }
    reader.readAsDataURL(this.files[0]);
    }
});
$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // 
    // https://www.webslesson.info/2019/07/how-to-upload-multiple-images-with-progress-bar-in-laravel-58.html?m=1
    // http://jquery.malsup.com/form/
    // lib usada para ajaxForm e barra de progresso
    // 

    $('#formAlbum').ajaxForm({
        url: 'novoAlbumSave',
        type: 'post',
        beforeSend:function(){
            $('#success').empty();
            $('.progress-bar').text('0%');
            $('.progress-bar').css('width', '0%');
            console.log(1);
        },
        uploadProgress:function(event, position, total, percentComplete){
            console.log(2)
            $('.progress-bar').text(percentComplete + '%');
            $('.progress-bar').css('width', percentComplete + '%');
        },
        error:function(error){
            $('.progress-bar').text('## ERROR ##');
            $('.progress-bar').css('width', '100%');
            $('.progress-bar').css('background-color', 'red');

        },
        success:function(data)
        {
            console.log(3)
            if(data.success)
            {
                console.log(4)
                $('#success').html('<div class="text-success text-center"><b>'+data.success+'</b></div><br /><br />');
                data.image.forEach(element => {
                    $('.imageSucess').append('<img style="display: inline;" class="img-fluid imageUp" src="'+element+'">');

                });
                $('.progress-bar').text('Uploaded');
                $('.progress-bar').css('width', '100%');
                $('.progress-bar').css('background-color', 'green');

            }
        }
    });


    $('#formAlbumEdit').ajaxForm({
        url: 'atualizarAlbum',
        beforeSend:function(){
            $('#success').empty();
            $('.progress-bar').text('0%');
            $('.progress-bar').css('width', '0%');
            console.log(1);
        },
        uploadProgress:function(event, position, total, percentComplete){
            console.log(2)
            $('.progress-bar').text(percentComplete + '%');
            $('.progress-bar').css('width', percentComplete + '%');
        },
        error:function(error, ajaxOptions, thrownError){
            $('.progress-bar').text('## ERROR ##');
            $('.progress-bar').css('width', '100%');
            $('.progress-bar').css('background-color', 'red');
            console.log(error);
            var o = $.parseJSON(error.responseText);
            if( o.message == "Image source not readable"){
                $('.progress-bar').text('Uploaded');
                $('.progress-bar').css('width', '100%');
                $('.progress-bar').css('background-color', 'green');
            }

        },
        success:function(data)
        {
            console.log(data.image)
            if(data.success)
            {
                console.log(4)
                $('#success').html('<div class="text-success text-center"><b>'+data.success+'</b></div><br /><br />');
                data.image.forEach(element => {
                    $('.imageSucessEdit').append('<img class="img-fluid imageUp" src="../'+element+'">');

                });
                $('.progress-bar').text('Uploaded');
                $('.progress-bar').css('width', '100%');
                $('.progress-bar').css('background-color', 'green');

            }
        }
    });
    

    console.log('s');

    $('.delete').click(function() {
        var a = $('#valorDelete').val();
        $.confirm({
            title: 'Delete',
            content: 'Confimer para deletar o album',
            buttons: {
                cancelar: function () {
                },
                confirmar: function () {
                    $.ajax({
                        url: '/album/delete/' + a,
                        type: 'DELETE',
                        success: function(result) {
                            location.reload(true);

                        }
                    });
                }
            }
        });
    });
    
$('#GooAnali').click(function() {
    window.open("https://analytics.google.com/analytics/web/?authuser=3#/report-home/a160442615w225273671p213365843");
});
    
});