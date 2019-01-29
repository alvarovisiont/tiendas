<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="./css/bootstrap.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="./css/metisMenu.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./css/jquery.dataTables.min.css">
    
    <!-- Alerts whit style -->
    <link href="./css/sweetalert2.css" rel="stylesheet">

    <!-- Selects with seach inteligence -->
    <link href="./css/select2.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./css/sb-admin-2.css" rel="stylesheet">
    <link href="./css/bootstrap-datepicker.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="./css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="./css/estilos.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url()?>Admin" width="100%"><img src="./img/<?php echo $this->session->userdata('logo'); ?>" alt="" width="40px" style="float: left;"> <span style=""><?php echo $this->session->userdata('empresa'); ?></span>
                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url()?>Usuarios_administracion"><i class="fa fa-user fa-fw"></i> Usuarios</a>
                        </li>
                        <li><a href="<?php echo base_url().'Configuracion'; ?>"><i class="fa fa-gear fa-fw"></i> Configuración</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url().'Login/salir';?>"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo base_url()?>Admin"><i class="fa fa-dashboard fa-fw"></i> Escritorio</a>
                        </li>
                <?php
                    if($this->session->userdata('nivel') == 1)
                    {

                    ?>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Almancen<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url()?>Proveedores">Proveedores</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>Inventario">Inventario</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>lista">Lista de Precio</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>Reportes_inventario">Reportes detallados</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Caja<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url()?>Caja">Movimientos de la Caja</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>Clientes">Clientes</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-shopping-cart"></i> Compras<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url()?>Compras"> Realizar Compra</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>Compras_vista">Historial de Compras</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>Compras_estadisticas">Estadísticas de Compras</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-shopping-cart"></i>  Ventas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url()?>Ventas">Realizar Venta</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>Ventas_historial">Historial de Ventas</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>Caja_estadisticas">Gráficos estadísticos</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users"></i>  Usuarios<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url()?>Usuarios_agregar">Agregar Usuarios</a>   
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>Usuarios_administracion">Administración de Usuarios</a>   
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users"></i>  Empleados<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url()?>Empleados">Administración de empleados</a>   
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cog fa-spin fa-1x fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">Saving. Hang tight!</span> Configuración<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url().'Configuracion'; ?>">Datos de la Empresa</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url().'Configuracion_finanza'; ?>">Configuración de moneda</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url().'Configuracion_descuento'; ?>">Configuración de Descuento</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li><a href="<?php echo base_url().'Comisiones'; ?>"><i class='fa fa-money'></i>&nbsp;Comisiones</a></li>
                        
                        <li><a href="<?php echo base_url().'Auditoria'; ?>"><i class='fa fa-book'></i>&nbsp;Auditoria del Sistema</a></li>
                <?php
                    }
                    elseif($this->session->userdata('nivel') == 2)
                    {
                    ?>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Almancen<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url()?>Inventario">Inventario</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>Reportes_inventario">Reportes detallados</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Caja<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url()?>Caja">Movimientos de la Caja</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>Caja_chica">Caja Chica</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-shopping-cart"></i> Compras<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url()?>Compras_vista">Historial de Compras</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>Compras_estadisticas">Estadísticas de Compras</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-shopping-cart"></i>  Ventas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url()?>Ventas_historial">Historial de Ventas</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>Caja_estadisticas">Gráficos estadísticos</a>
                                </li>
                            </ul>
                        </li>
                <?php
                    }
                    else
                    {
                    ?>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Caja<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url()?>Caja">Movimientos de la Caja</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>Clientes">Clientes</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-shopping-cart"></i>  Ventas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url()?>Ventas">Realizar Venta</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>Ventas_historial">Historial de Ventas</a>
                                </li>
                            </ul>
                        </li>
                <?php
                    }
                    ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">