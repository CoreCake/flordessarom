<?php
header('Content-type: text/html; charset=ISO-8859-1');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="ISO-8859-1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Flor de Sarom</title>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/landing-page.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                $("a[href^=#]").click(function (e) {
                    e.preventDefault();
                    var dest = $(this).attr('href');
                    console.log(dest);
                    console.log($(dest));
                    $('html,body').animate({scrollTop: $(dest).offset().top}, 'slow');
                });
                setTimeout(function () {
                    alterarBg();
                }, timeOut);

                $('.carousel').carousel({
                    interval: 3000 //changes the speed
                })

                //$('#myField')[0].checkValidity() // returns true/false
                $("#mailForm input, #mailForm textarea").keyup(function (t) {
                    $(t.target).next("span").find("i").removeClass("green");
                    $(t.target).removeClass("green");
                    if ($(t.target).val().length > 5) {
                        console.log(t.target.checkValidity());
                        if (t.target.checkValidity()) {
                            $(t.target).next("span").find("i").addClass("green");
                            $(t.target).addClass("green");
                        }
                    }
                });

                $("#mailForm").submit(function (e) {
                    e.preventDefault(); //prevent default form submit
                    $('html,body').animate({scrollTop: $('#contato').offset().top}, 'slow');
                    $('#email-container').slideUp();
                    $('#loading-container').slideDown();
                    $.post("email.php", $("#mailForm").serialize())
                            .done(function (data) {
                                $('html,body').animate({scrollTop: $('#contato').offset().top}, 'slow');
                                $('#loading-container').slideUp();
                                if (data.error === 0) {
                                    $('#alert-success').slideDown();
                                    $("#mailForm")[0].reset();
                                    setTimeout(function () {
                                        $('#email-container').slideDown();
                                    }, 3000);
                                    setTimeout(function () {
                                        $('#alert-success').slideUp();
                                    }, 5000);
                                } else {
                                    $('#alert-error').slideDown();
                                    $('#errorMessage').html(data.message);
                                    $('#email-container').slideDown();
                                    setTimeout(function () {
                                        $('#alert-error').slideUp();
                                    }, 10000);
                                }
                            });
                });

            });


            var num = 1;
            var limite = 2;
            var timeOut = 10000;
            function alterarBg() {
                $(".intro-header")
                        .animate({opacity: 0.2}, 'slow', function () {
                            num++;
                            if (num > limite) {
                                num = 1;
                            }
                            $(this)
                                    .css({'background-image': 'url(img/intro-bg' + num + '.jpg)'})
                                    .animate({opacity: 1});
                        });
                setTimeout(function () {
                    alterarBg();
                }, timeOut);
            }
            for (i = 1; i <= limite; i++) {
                $('<img/>')[0].src = 'img/intro-bg' + i + '.jpg';
            }
        </script>
    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
            <div class="container topnav">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand topnav logo logoTopo" href="#"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#about">Sobre Nós</a>
                        </li>
                        <li>
                            <a href="#services">Representações</a>
                        </li>
                        <li>
                            <a href="#contato">Contato</a>
                        </li>
                        <li>
                            <a href="#connect">Conecte-se</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>


        <!-- Header -->
        <a name="about" id="about"></a>
        <div class="intro-header">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="intro-message">
                            <h1 class="logo logoCentro"></h1>
                            <h3>Representações</h3>
                            <hr class="intro-divider">
                            <ul class="list-inline intro-social-buttons">
                                <li>
                                    <a href="https://www.facebook.com/Flordesarom/" class="btn btn-default btn-lg"><i class="fa fa-facebook fa-fw"></i> <span class="network-name">Facebook</span></a>
                                </li>
                                <li>
                                    <a href="#" class="btn btn-default btn-lg"><i class="fa fa-instagram fa-fw"></i> <span class="network-name">Instagram</span></a>
                                </li>
                                <li>
                                    <a href="#contato" class="btn btn-default btn-lg"><i class="fa fa-send fa-fw"></i> <span class="network-name">E-mail</span></a>
                                </li>
                                <li>
                                    <a href="tel:71991300306" class="btn btn-default btn-lg"><i class="fa fa-whatsapp fa-fw"></i> <span class="network-name">(71) 99130-0306</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container -->

        </div>
        <!-- /.intro-header -->

        <!-- Page Content -->

        <a  name="services" id="services"></a>
        <div class="content-section-a">

            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-sm-6">
                        <hr class="section-heading-spacer">
                        <div class="clearfix"></div>
                        <h2 class="section-heading">Vestem:</h2>
                        <h3 class="section-subheading">?MARCA PIONEIRA DO FASHION FITNESS?, mais do que uma roupa, um estado de espírito.</h3>
                        <p class="lead">
                            A Vestem é uma empresa composta por profissionais apaixonados pelo que fazem. Desde o início de suas atividades indo na contra mão da mesmice optou por ter um produto diferenciado e com o máximo critério de qualidade, utilizando uma fórmula mágica: Equipamentos e tecnologias de última geração com matérias primas de altíssima qualidade e Talento.
                        </p>
                    </div>
                    <!-- Full Page Image Background Carousel Header -->
                    <div class="col-lg-5 col-lg-offset-2 col-sm-6 carousel slide" id="myCarousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                            <li data-target="#myCarousel" data-slide-to="4"></li>
                        </ol>

                        <!-- Wrapper for Slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <!-- Set the first background image using inline CSS below. -->
                                <div class="fill" style="background-image:url('http://vestem.vteximg.com.br/arquivos/ids/164142-1000-1000/Conceito9.jpg');"></div>
                            </div>
                            <div class="item">
                                <!-- Set the second background image using inline CSS below. -->
                                <div class="fill" style="background-image:url('http://vestem.vteximg.com.br/arquivos/ids/164150-1000-1000/Conceito10.jpg');"></div>
                            </div>
                            <div class="item">
                                <!-- Set the third background image using inline CSS below. -->
                                <div class="fill" style="background-image:url('http://vestem.vteximg.com.br/arquivos/ids/164130-1000-1000/Conceito8.jpg');"></div>
                            </div>
                            <div class="item">
                                <!-- Set the third background image using inline CSS below. -->
                                <div class="fill" style="background-image:url('http://vestem.vteximg.com.br/arquivos/ids/164112-1000-1000/Conceito1.jpg');"></div>
                            </div>
                            <div class="item">
                                <!-- Set the third background image using inline CSS below. -->
                                <div class="fill" style="background-image:url('http://vestem.vteximg.com.br/arquivos/ids/164161-1000-1000/Conceito12.jpg');"></div>
                            </div>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="icon-next"></span>
                        </a>

                    </div>
                </div>

            </div>
            <!-- /.container -->

        </div>


        <!-- Page Content -->

        <a  name="contato" id="contato"></a>
        <div class="content-section-b">
            <div class="container">
                <div class="row" id="loading-container" style="display: none;"></div>
                <div class="row">
                    <div class="alert alert-success" id="alert-success" style="display: none;"><strong><span class="glyphicon glyphicon-send"></span> Sua mensagem foi enviada com sucesso!</strong></div>	  
                    <div class="alert alert-danger" id="alert-error" style="display: none;"><strong><span class="glyphicon glyphicon-send"></span><span id="errorMessage"></span></strong></div>	  
                </div>
                <div class="row" id="email-container">
                    <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                        <hr class="section-heading-spacer">
                        <div class="clearfix"></div>
                        <h2 class="section-heading">Entre em contato conosco</h2>
                        <p class="lead">
                        <form role="form" action="" method="post" id="mailForm" >
                            <div class="form-group">
                                <label for="InputName">Seu Nome</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="InputName" id="InputName" placeholder="Digite seu nome" required>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback gray"></i></span></div>
                            </div>
                            <div class="form-group">
                                <label for="InputCompanny">Sua Empresa</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="InputCompanny" id="InputName" placeholder="Razão Social / Nome Fantasia" required>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback gray"></i></span></div>
                            </div>
                            <div class="form-group">
                                <label for="InputEmail">Seu e-mail</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" id="InputEmail" name="InputEmail" placeholder="Digite seu e-mail" required  >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback gray"></i></span></div>
                            </div>
                            <div class="form-group">
                                <label for="InputMessage">Mensagem</label>
                                <div class="input-group">
                                    <textarea name="InputMessage" id="InputMessage" class="form-control" rows="5" required></textarea>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback gray"></i></span></div>
                            </div>
                            <?php
                            require_once 'securimage/securimage.php';
                            $options = array(
                                'input_name' => 'ct_captcha',
                                'input_text' => 'Digite o texto da imagem: '
                            );
                            echo Securimage::getCaptchaHtml($options);
                            ?>
                            <button id="submit" class="btn btn-info pull-right">Enviar</button>

                        </form>
                    </div>
                    <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                        <img class="img-responsive" src="img/mailflower.jpg" alt="">
                    </div>
                </div>

            </div>
            <!-- /.container--> 

        </div>
        <a  name="connect" id="connect"></a>
        <div class="banner">

            <div class="container">

                <div class="row">
                    <div class="col-lg-6">
                        <h2>Conecte-se conosco:</h2>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-inline banner-social-buttons">
                            <li>
                                <a href="https://www.facebook.com/Flordesarom/" class="btn btn-default btn-lg"><i class="fa fa-facebook fa-fw"></i> <span class="network-name">Facebook</span></a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-default btn-lg"><i class="fa fa-instagram fa-fw"></i> <span class="network-name">Instagram</span></a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- /.container -->

        </div>
        <!-- /.banner -->

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="list-inline">
                            <li>
                                <a href="#">Home</a>
                            </li>
                            <li class="footer-menu-divider">&sdot;</li>
                            <li>
                                <a href="#about">Sobre Nós</a>
                            </li>
                            <li class="footer-menu-divider">&sdot;</li>
                            <li>
                                <a href="#services">Representações</a>
                            </li>
                            <li class="footer-menu-divider">&sdot;</li>
                            <li>
                                <a href="#contact">Contato</a>
                            </li>
                        </ul>
                        <p class="copyright text-muted small">Copyright &copy; Flor de Sarom 2016. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </footer>

    </body>

</html>
