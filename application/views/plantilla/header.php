<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>
		<?php 
		$nombre_empresa = "Sistema para el control de citas médicas";
		if (!isset($titulo))
		{
			echo $nombre_empresa;
		}
		else
		{
			echo "$titulo - $nombre_empresa";
		}
		?>
	</title>
	<!--ICONS-->
	<link rel="shorcut icon" href="<?= base_url() ?>assets/images/favicons/favicon.png">
    <link rel="icon" href="<?= base_url() ?>assets/images/favicons/icono_144x144.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= base_url() ?>assets/images/favicons/icono_57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url() ?>assets/images/favicons/icono_72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url() ?>assets/images/favicons/icono_114x114.png">
	<!--END ICONS-->
	<!--CASCADE STYLESHEETS-->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
	 <!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css" media="screen">
    <!--[if lte IE 7]><link rel="stylesheet" href="style.ie7.css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.responsive.css" media="all">
    <!--END CASCADE STYLESHEETS-->
    <!--JAVASCRIPTS-->
	<script src="<?= base_url() ?>assets/js/jquery-1.11.3.min.js"></script>
	<script src="<?= base_url() ?>assets/js/script.js"></script>
    <script src="<?= base_url() ?>assets/js/script.responsive.js"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
	<!--END JAVASCRIPTS-->
</head>
<div id="main">
	<!--HEADER-->
    <header class="header">
        <div class="shapes">
            <div class="object1179421063">
                <img src="<?= base_url() ?>assets/images/logotipo.png" alt="">
            </div>
        </div>
        <h1 class="headline">
            <a href="<?= base_url() ?>">Sistema para el control de citas médicas</a>
        </h1>               
    </header>
    <!--END HEADER-->
    <div class="sheet clearfix">
        <div class="layout-wrapper">
            <div class="content-layout">
                <div class="content-layout-row">
<!-- SIDEBAR-->
<?php if(!isset($no_sidebar)): ?>
<div class="layout-cell sidebar1">
    <?php if(isset($menu)): ?>
    <div class="vmenublock clearfix">
        <div class="vmenublockheader">
            <h3 class="t">Menu Principal</h3>
        </div>
        <div class="vmenublockcontent">
            <ul class="vmenu">
                <li><a href="<?= base_url() ?>admin">Panel Principal</a></li>
                <li><a href="<?= base_url() ?>pacientes" <?php if($menu == "pacientes") :?> class="active" <?php endif ?>>Pacientes</a></li>
                <li><a href="<?= base_url() ?>medicos" <?php if($menu == "medicos") :?> class="active" <?php endif ?>>Médicos</a></li>
                <li><a href="<?= base_url() ?>especialidades" <?php if($menu == "especialidades") :?> class="active" <?php endif ?>>Especialidades</a></li>
                <li><a href="<?= base_url() ?>citas" <?php if($menu == "citas") :?> class="active" <?php endif ?>>Citas</a></li>
                <li><a href="<?= base_url() ?>consultas" <?php if($menu == "consultas") :?> class="active" <?php endif ?>>Consultas</a></li>
                <li><a href="<?= base_url() ?>pagos" <?php if($menu == "pagos") :?> class="active" <?php endif ?>>Pagos</a></li>
                <li><a href="<?= base_url() ?>usuarios" <?php if($menu == "usuarios") :?> class="active" <?php endif ?>>Usuarios</a></li>
                <!--<li><a href="<?= base_url() ?>configuracion" <?php if($menu == "configuracion") :?> class="active" <?php endif ?>>Configuración</a></li>-->
            </ul>     
        </div>
    </div>
    <?php endif ?>
    <div class="block clearfix">
            <div class="blockheader">
                <h3 class="t"><?= $this->session->userdata('username') ?></h3>
            </div>
            <div class="blockcontent">
                <div class="text-center" id="image">
                    <?= img(
                    array(
                        'src' => 'assets/images/personas/'.$this->session->userdata('foto'),
                        'width' => '150',
                        'height'=> '150',
                        'class' => 'lightbox',
                        )
                    ) ?>
                </div>
            </div>
    </div>
    <!--<div class="block clearfix">
            <div class="blockheader">
                <h3 class="t">Nuevo Bloque</h3>
            </div>
            <div class="blockcontent"><p><br></p></div>
    </div>-->
</div>
<?php endif ?>
<!--END SIDEBAR-->
<!--CONTENT-->
<div class="layout-cell content">
    <article class="post article">
        <div class="postmetadataheader">
            <h2 class="postheader">
                <?php
                if (!isset($titulo))
                {
                    echo $nombre_empresa;
                }
                else
                {
                    echo $titulo;
                }
                ?>
            </h2>
        </div>                                    
        <div class="postcontent postcontent-0 clearfix">