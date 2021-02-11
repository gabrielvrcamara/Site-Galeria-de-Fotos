$(document).ready(function() {
    var albuns;
    $(".fadeIn").hide().delay(500).fadeIn(2200);


    $("#gallery").unitegallery({
        gallery_theme: "tiles"
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url : "/albuns",
        type : 'POST',
        data : {
        },
        beforeSend : function(){
            $(".albuns").html('<div class="spinner-border text-light"></div>');
        }
        })
        .done(function(msg){
            albuns(msg);
        })
        .fail(function(jqXHR, textStatus, msg){
            console.log(jqXHR);
        });
        windowResize();
        $(window).on('resize',function(){
            windowResize();
        });
        $('#formContato').ajaxForm({
            url: '/contato',
            beforeSend:function(data){
                $('.enviado').html('<div class="spinner-border text-light"></div>');
                console.log(data);
            },
            error:function($error){
                $('.enviado').html('<div style="display: inline;" class="alert alert-danger" role="alert">Erro!</div>');

            },
            uploadProgress:function(event, position, total, percentComplete){
                $('.enviado').html('<div class="spinner-border text-light"></div>');
            },
            success:function(data)
            {
                $('.enviado').html('<div style="display: inline;" class="alert alert-success" role="alert">E-mail enviado com sucesso!</div>');
                console.log(each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                }));

            }
        });

    function albuns(msg){
        tag = $(".albuns");
        json = JSON.parse(msg);
        html = "<div class='container'>";
        var cont = 0;
        for (let i = 0; i < Object.keys(json).length; i++) {
            if(cont == 0){
                html+= "<div class='row'>";
            }
                var x = Object.keys(json)[i];
                var id = json[x]['id'];
                var nome = json[x]['nome'];
                var capa = json[x]['capa'];
            
            html+= '<div class="col-sm-12 col-md-3 album"><a href="/album/'+ id +'">';
            html+= "<div><img class='imagemAlbum' src='" + capa + "'></div>";
            html+= "<div class='nomeAlbum'>" + nome + "</div>";
            html+='</a></div>';

            cont+=1;
            if(cont == 3){
                html+= "</div>";
                cont = 0;
            }
        }
        html+= "</div>";
        tag.html(html);
    }

    function windowResize(){
        if($(window).width() < 576){
            $(".albuns").css("margin-left", 10);
            $(".enviado").css("margin-top", 20)

        }
        console.log($(window).width());
    }


});

