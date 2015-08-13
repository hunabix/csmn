<!doctype html>
<html lang=""es>

<head>
    <!-- Basic Page Needs
    ================================================== -->  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Centro de Seguimiento - Musinetwork</title>
    <!-- CSS
    ================================================== -->
    <link href="views/css/style.css" rel="stylesheet" /> 

    <!-- Favicon
    ================================================== -->  
</head>
    
<body>
    
    <!-- HEADER -->
    <header id="header" class="header">
        <div class="header-content">
            <!-- Logo -->
            <figure class="logo animated flipInY">
                <a href="<?= cs_url; ?>"><img src="views/img/logo.png" alt="Musinetwork School of Music"></a>
            </figure>
            <!-- Título -->
            <h1 class="main-title">Centro de Seguimiento</h1>

            <!-- Si el usuario está logeado se muestra el menú de navegación -->
            <?php if (isset($user)) : ?>            
                <!-- Main Nav -->
                <nav id="main-nav" class="main-nav">
                    <ul>
                        <!-- Home -->
                        <li><a href="<?= cs_url; ?>"><i class="fa fa-home"></i></a></li>
                        <!-- Nuevo registro -->
                        <li><a href="<?= cs_url; ?>/nuevo-registro"><i class="fa fa-user-plus"></i></a></li>
                        <!-- Buscar -->
                        <!-- <li><a href="#"><i class="fa fa-search "></i></a></li> -->
                        <!-- Crear notificación -->
                        <li>
                            <a href="#" id="notificacion-nueva" data-toggle="modal" data-target="#modal-notificacion"><i class="fa fa-bell"></i></a>
                        </li>
                        <!-- Consultas -->
                        <!-- <li><a href="#"><i class="fa fa-archive"></i></a></li> -->
                        <!-- Configuración -->
                        <?php if ($user['tipo'] == 'administrador') :?>
                            <li><a href="<?= cs_url; ?>/configuracion"><i class="fa fa-cog"></i></a></li>
                        <?php endif; ?>
                        <li>
                            <a href="<?= cs_url; ?>/plantillas"><i class="fa fa-clipboard"></i></a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </header>   
    
    <main class="main">
        
        <!-- Herramientas
        ================================================== --> 
        <?php if (isset($user)) : ?>
            <?php require_once("herramientas.php");  ?>
        <?php endif; ?>
        <!-- Contenido principal
        ================================================== --> 
        <section class="main-content">
            
            <?php // var_dump($user); ?>
            <?php // var_dump($notifications['vencidas']['llamada']); ?>
