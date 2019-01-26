<br>
<div class="row">
    <?php 
        if($this->session->userdata('nivel') == 1)
        {
        ?>
            <div class="col-lg-3 col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-truck fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $datos->inventario; ?></div>
                                <div>Inventario</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url().'Inventario'; ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Ver detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        <?php    
        }
        elseif($this->session->userdata('nivel') == 2)
        {
        ?>
            <div class="col-lg-3 col-md-3 col-lg-offset-1 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-truck fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $datos->inventario; ?></div>
                                <div>Inventario</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url().'Inventario'; ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Ver detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        <?php
        }
     ?>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $datos->ventas; ?></div>
                        <div>Ventas</div>
                    </div>
                </div>
            </div>
            <?php 
                if($this->session->userdata('nivel') == 2)
                {
                ?>
                    <a href="<?php echo base_url().'Ventas_historial'; ?>">        
                <?php
                }
                else
                {
                ?>
                    <a href="<?php echo base_url().'Ventas'; ?>">
                <?php
                }
             ?>
                <div class="panel-footer">
                    <span class="pull-left">Ver Detalles</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <?php 

        if($this->session->userdata('nivel') != 3)
        {
        ?>
            <div class="col-lg-3 col-md-3">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-cart-plus fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $datos->compras; ?></div>
                                <div>Compras</div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        if($this->session->userdata('nivel') == 2)
                        {
                        ?>
                            <a href="<?php echo base_url().'Compras_vista'; ?>">
                        <?php
                        }
                        else
                        {
                        ?>
                            <a href="<?php echo base_url().'Compras'; ?>">
                        <?php
                        }
                     ?>
                        <div class="panel-footer">
                            <span class="pull-left">Ver detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        <?php  
        }
     ?>
    <?php 
        if($this->session->userdata('nivel') == 1)
        {
        ?>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-cog fa-spin fa-5x fa-fw"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"></div>
                                <div>Configuración</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url().'Configuracion'; ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        <?php
        }
     ?>
    <?php 
        if($this->session->userdata('nivel') == 1)
        {
        ?>
                <div class="form-group">
                <div class="col-md-12">
                    <div class="panel panel-purple">
                        <div class="panel-heading">
                            <h3>Trabajadores Registrados</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <th class="text-center">Nombre Completo</th>
                                    <th class="text-center">Télefono</th>
                                    <th class="text-center">Sueldo</th>
                                    <th class="text-center">Comisión</th>
                                </thead>
                                <tbody class="text-center">
                                    <?php 
                                            foreach ($empleados as $row)
                                            {
                                                echo "<tr>
                                                            <td>$row->nombre_apellido</td>
                                                            <td>$row->telefono</td>
                                                            <td>".number_format($row->sueldo,2,',','.')."</td>
                                                            <td>$row->comision %</td>
                                                        </tr>";
                                            }
                                        
                                     ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
     ?>
            
    <div class="form-group">
        <div class="col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <h3>Comparación de compras y Ventas en el año</h3>
                </div>
                <div class="panel-body">
                    <div id="chartdiv" style="width:100%; height:600px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-black">
                <div class="panel-heading">
                    <h3>Retenciones de Iva</h3>
                </div>
                <div class="panel-body">
                    <?php 
                        if($this->session->userdata('retencion') == 0)
                        {
                            echo "<h3 class='text-center'>No posee</h3>";
                        }
                     ?>
                </div>
            </div>
        </div>
    </div>
</div>

