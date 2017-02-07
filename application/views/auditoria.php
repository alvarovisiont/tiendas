<div class="row">
	<div class="container-fluid">
		<div class="col-md-12">
			<br>
			<p class="alert alert-warning text-center" style="font-size: 22px">Auditoria del Sistema</p>
			<br>
			<table class="table table-bordered table-hover">
				<thead>
					<th class="text-center">Usuario</th>
					<th class="text-center">Hora de Conexión</th>
					<th class="text-center">Hora final de Conexión</th>
					<th class="text-center">Tiempo de Conexión</th>
				</thead>
				<tbody class="text-center">
					<?php 
						if(!empty($datos))
						{
							$imprimir_hora = "";
							foreach ($datos as $row)
							{

					            if($row->hora_desconexion == "" || NULL)
					            {
					              $imprimir_hora = "Tiempo de Conexión indeterminado";
					            }
					            else
					            {
					              $horaTotal = strtotime($row->hora_desconexion) - strtotime($row->hora_conexion);
					                  if($horaTotal > 60)
					                  {
					                  $horaTotal = $horaTotal/60;
					                  $horaTotal = round($horaTotal);
					                  }
					                  if ($horaTotal < 60) 
					                  {
					                    $imprimir_hora =  $horaTotal." Minutos";  
					                  }
					                  elseif($horaTotal == 60)
					                  {
					                    $imprimir_hora = "1 Hora";
					                  }  
					                  elseif($horaTotal > 60 && $horaTotal < 120)
					                  {
					                     $hora = 60;
					                     $min = $horaTotal - $hora;
					                     $imprimir_hora = "1 hora con ".$min." minutos";
					                  }elseif($horaTotal == 120) 
					                  {
					                    $imprimir_hora = "2 Horas";

					                  }
					                  elseif ($horaTotal > 120 && $horaTotal < 180) 
					                  {
					                     $hora = 120;
					                     $min = $horaTotal - $hora;
					                     $imprimir_hora = "2 horas con ".$min." minutos";
					                  }
					                  elseif ($horaTotal == 180) 
					                  {
					                     $imprimir_hora = "3 Horas";
					                  }
					                  elseif ($horaTotal > 180 && $horaTotal < 240) 
					                  {
					                     $hora = 180;
					                     $min = $horaTotal - $hora;
					                     $imprimir_hora = "3 horas con ".$min." minutos";  
					                  }
					                  elseif ($horaTotal == 240) 
					                  {
					                   $imprimir_hora = "4 horas"; 
					                  }
					                  elseif ($horaTotal > 240 && $horaTotal < 300) 
					                  {
					                     $hora = 240;
					                     $min = $horaTotal - $hora;
					                     $imprimir_hora = "4 horas con ".$min." minutos";   
					                  }
					                  elseif ($horaTotal == 300) 
					                  {
					                    $imprimir_hora = "5 horas"; 
					                  }
					                  elseif ($horaTotal > 300 && $horaTotal < 360) 
					                  {
					                     $hora = 300;
					                     $min = $horaTotal - $hora;
					                     $imprimir_hora = "5 horas con ".$min." minutos";    
					                  }
					                  elseif ($horaTotal == 360) 
					                  {
					                    $imprimir_hora = "6 horas";  
					                  }
					                  elseif ($horaTotal > 360 && $horaTotal < 420) 
					                  {
					                     $hora = 360;
					                     $min = $horaTotal - $hora;
					                     $imprimir_hora = "6 horas con ".$min." minutos";     
					                  }
					                  elseif($horaTotal == 420)
					                  {
					                  	$imprimir_hora = "7 horas";
					                  }
					                  elseif($horaTotal > 420 && $horaTotal < 480)
					                  {
					                  	$hora = 420;
					                    $min = $horaTotal - $hora;
					                    $imprimir_hora = "7 horas con ".$min." minutos";
					                  }
					                  elseif($horaTotal == 480)
					                  {
					                  	$imprimir_hora = "8 horas";	
					                  }
					                  elseif($horaTotal > 480 && $horaTotal < 540)
					                  {
					                  	$hora = 480;
					                    $min = $horaTotal - $hora;
					                    $imprimir_hora = "8 horas con ".$min." minutos";	
					                  }
					                  elseif($horaTotal == 540)
					                  {
					                  	$imprimir_hora = "9 horas";		
					                  }
					                  elseif($horaTotal > 540 && $horaTotal < 600)
					                  {
					                  	$hora = 540;
					                    $min = $horaTotal - $hora;
					                    $imprimir_hora = "9 horas con ".$min." minutos";
					                  }
					                  elseif($horaTotal == 600)
					                  {
					                  	$imprimir_hora = "10 horas";			
					                  }
					                  elseif($horaTotal > 600 && $horaTotal < 660)
					                  {
					                  	$hora = 600;
					                    $min = $horaTotal - $hora;
					                    $imprimir_hora = "10 horas con ".$min." minutos";	
					                  }
					                  elseif($horaTotal == 660)
					                  {
					                  	$imprimir_hora = "11 horas";			
					                  }
					                  elseif($horaTotal > 660 && $horaTotal < 720)
					                  {
					                  	$hora = 660;
					                    $min = $horaTotal - $hora;
					                    $imprimir_hora = "11 horas con ".$min." minutos";		
					                  }
					                  elseif($horaTotal == 720)
					                  {
					                  	$imprimir_hora = "12 horas";	
					                  }
					                  elseif($horaTotal > 720 && $horaTotal < 780)
					                  {
					                  	$hora = 720;
					                    $min = $horaTotal - $hora;
					                    $imprimir_hora = "12 horas con ".$min." minutos";			
					                  }
					                  else
					                  {
					                  	$imprimir_hora = $horaTotal." Segundos";
					                  }
					            }
            
								echo "<tr>
										<td>$row->usuario</td>
										<td>".date('d-m-Y H:i:s A', strtotime($row->hora_conexion))."</td>
										<td>".date('d-m-Y H:i:s A', strtotime($row->hora_desconexion))."</td>
										<td>".$imprimir_hora."</td>
									</tr>";
							}
						}
						else
						{
							echo "<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>";
						}
					 ?>
				</tbody>
			</table>
		</div>
	</div>
</div>