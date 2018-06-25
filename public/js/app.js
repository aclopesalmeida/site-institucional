$(function() {

    $overlay = $('#overlay');
    $loader = $('#loader');
    $lingua = $('body').data('idioma');
    $iconeMenuResponsivo = $('.icone-menu');
    $botaoFecharMenu = $('.fechar-nav-btn');
    $logotipo = $('#logotipo-container img');
    $painelControlo = $('#painel-controlo');
    windowHeight = $(window).height();
    adminNavHeight = $('#admin-nav').outerHeight();


    
    setTimeout(retirarLoader, 500);

    function retirarLoader()
    {
        $overlay.add($loader).addClass('end').delay(2000).queue(function(next) {
            $overlay.add($loader).css('display', 'none');
            next();
        });

    }
    

    function alterarPosicaoPainelControloAdmin() 
    {
        $painelControlo.height(windowHeight - adminNavHeight);
    }


    function alterarTamanhoLotipoResponsivo() {
        if($(window).outerWidth() < 576) {
            $logotipo.attr('src', 'imagens/logotipo-sm.png');
        }
        else {
            $logotipo.attr('src', '/imagens/logotipo.png');
        }  
    }


    function ativarMenuResponsivo() {
        $seccaoSite = $('body').attr('id') == 'admin' ? 'admin' : 'frontend';
        $width = $seccaoSite == 'frontend' ? 1230 : 768;

        if($(window).outerWidth() <= $width) {
            $iconeMenuResponsivo.addClass('fixed');    
        }
        else {
            $iconeMenuResponsivo.removeClass('fixed');
        }
    }


    $(window).on({
        load: function() {
            ativarMenuResponsivo();
            alterarTamanhoLotipoResponsivo();
            alterarPosicaoPainelControloAdmin();
        },
        resize: function() {
            ativarMenuResponsivo();
            alterarTamanhoLotipoResponsivo();
        }
    });

    $('#idioma-controlos').on('click', 'a', function() {
        $('a.selecionado').removeClass('selecionado');
        $(this).addClass('selecionado');
        
        $idioma = $(this).text();
        $('body').data('idioma', $idioma);
    });

    $iconeMenuResponsivo.click(function() {
        $nav = $(this).siblings('#admin-nav-ul-container, #nav-ul-container');
        $nav.add($botaoFecharMenu).addClass('fixed');
    });

    $('.fechar-nav-btn').click(function() {
        $nav = $(this).siblings('#admin-nav-ul-container, #nav-ul-container');
        $nav.add($botaoFecharMenu).removeClass('fixed');
    })



    $('#form-btn-contactos').click(function(e) {
        e.preventDefault();
        $formulario = $('#form');
        $formularioMsg = $('#form-msg');

        $.ajax({
            method:"post",
            url: "/contactos",
            data: $formulario.serialize(),
            dataType: 'json',
            success: function($data) {
                $formularioMsg.empty();

                if($data.erros != null) {
                    for(erro in $data.erros) { // data.erros is an object
                        $formularioMsg.append('<span class="msg-erro">' + $data.erros[erro] + '</span>');
                    }
                }
                else {
                    $formularioMsg.text($data.status);
                }
            },
            error: function($data) {
                $formularioMsg.text($data.status);
            }
        });
    });

    /*posts - filtering*/
    $('select[name="sort"]').on('change', function() {
        $sort = $(this).val();

        var seccaoSite = $(this).parents('body').attr('id') == 'admin' ? 'admin' : 'frontend';
        if(seccaoSite == 'admin') 
        {
            var url = '/admin/posts';
            $htmlElement = $('#admin-posts');
        }
        else {
            var url = '/blog';
            $htmlElement = $('.posts');
        }
        

        $.ajax({
            method: 'GET',
            url: url,
            data: {sort : $sort},
            success: function(data) {
                $htmlElement.fadeOut('slow', function() {
                    $(this).html(data);
                }).fadeIn('slow');
            }
        });
    });

    $('#formulario-apagar-tag button').click(function() {
        var alerta = confirm("Tem a certeza que deseja apagar esta tag?");
        return alerta == true ? true : false;
    })

    $('#formulario-apagar-utilizador button').click(function() {
        var alerta = confirm("Tem a certeza que deseja apagar este utilizador?");
        return alerta == true ? true : false;
    })

    
    /* ---------------- TinyMCE ------------- */

    var editor_config = {
        path_absolute : "/",
        selector: "textarea.posts-editor",
        language: "pt_PT",
        plugins: [
          "advlist autolink lists link charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars code fullscreen",
          "insertdatetime media nonbreaking save table contextmenu directionality",
          "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
        relative_urls: false
      };
    
      tinymce.init(editor_config);




    


 




        var tagsModal = {
        autoOpen : false, 
        modal : true, 
        show : "blind", 
        hide : "blind", 
        buttons: { 'Editar': function() {
            //$(this) is $('.admin-tag-dialog')
            $id = $(this).find('input[name=tid]').val();
            $token = $(this).find('input[name=_token]').val();
            $nome = $(this).find('input[name=nome]').val();
            editarTag($id, $nome, $token);
            $(this).dialog('close');
        }}
        };

        function editarTag($input)
        {
            $.ajax({
                method: 'POST',
                url: '/admin/tags/editar/' + $id,
                data: {'id': $id, 'nome': $nome, '_token': $token},
                dataType: 'json'
            });
        }


        /* changes the value of the input on keyup */
          $('.admin-tag-dialog').on('keyup', 'input[name=nome]', function(){
              this.value = this.value;
          });

          $('#admin-tags').on('click', '.admin-tags-editar',  function(e) { 
            e.preventDefault();

             $modal = $(this).parents('.admin-tag').children('.admin-tag-dialog');
             console.log($modal);
             $modal.dialog(tagsModal).dialog('open');         
        });


        
    });