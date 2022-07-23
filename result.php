<?php
	include ("conn/conn.php");
	setlocale (LC_TIME,"spanish");
	header('Content-Type:text/html; charset=UTF-8');
	
	$FECHAACTUAL = date('Y-m-d');
	$QUE_BUSCAR			= $_GET['q'] ;
	$CRITERIO_BUSQUEDA 	= $_GET['c'];
	
	switch ($_GET['s']) {
		case 'smc':	// PRODUCTIVIDAD ASISTENCIAL
			$VISTA_A_UTILIZAR = "view_with_result_smc_grouped";
			$BASE_UTILIZADA = " en base de datos SMC";
			break;
		case 'full':	// PRODUCTIVIDAD FRONTERA
			$VISTA_A_UTILIZAR = "view_with_result_generales_grouped";
			$BASE_UTILIZADA = " en base de datos General";
			break;
	}

	$CONSULTA_MYSQL = "SELECT * FROM $VISTA_A_UTILIZAR WHERE $QUE_BUSCAR LIKE '%$CRITERIO_BUSQUEDA%' ORDER BY nombre ASC";

	$ResultadoCovid = $mysqli->query($CONSULTA_MYSQL);


	if (mysqli_num_rows($ResultadoCovid)>0)
	{	
		$totalRows_ResultadoCovid=mysqli_num_rows($ResultadoCovid);
		if (mysqli_num_rows($ResultadoCovid)==1)
		{
			$TITULO = $totalRows_ResultadoCovid . "&nbsp;resultado para&nbsp;<i><b>" . strtoupper($CRITERIO_BUSQUEDA) . "</b></i>" . $BASE_UTILIZADA;
		} else {
			$TITULO = $totalRows_ResultadoCovid . "&nbsp;resultados para&nbsp;<i><b>" . strtoupper($CRITERIO_BUSQUEDA) . "</b></i>" . $BASE_UTILIZADA;
		}	
				
	} else {
		$totalRows_ResultadoCovid=0;
		$TITULO="No existen reultados para&nbsp;<i><b>" . strtoupper($CRITERIO_BUSQUEDA) . "</b></i>";
    }	

	//INICIO DE CONFIGURACION DEL MENU CON BOTONES
	$BOTONES_NAVEGACION = "
	<div class='col-md-12' align='center'>
		<div class='btn-group btn-group-sm'>
			<a class='btn btn-success' href='https://www.cmw.smcsalud.cu' role='button' data-toggle='tooltip' data-placement='top' title='Clic aqu&iacute; para acceder a la Web SMC'>Web SMC</a>
			<a class='btn btn-primary' href='.' role='button' data-toggle='tooltip' data-placement='top' title='Regresar'>Realizar otra b&uacute;squeda</a>
		</div>
	</div>";
	//FIN DE CONFIGURACION DEL MENU CON BOTONES
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<!-- Etiquetas <meta> obligatorias para Bootstrap -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="img/favicon.svg">
		<title>Buscador COVID-19</title>

		<!-- Enlazando el CSS de Bootstrap -->
		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="css/main.css" rel="stylesheet" media="screen">
		<link href="css/icons.css" rel="stylesheet" media="screen">
		<link href="css/signin.css" rel="stylesheet" media="screen">
		<!-- Definiendo el alto de la tabla -->
		<style type="text/css"> 
			thead tr th {position: sticky; top: 0; z-index: 10; background-color: #17a2b8; color:#eeeeee;}
			.table-responsive {height:412px;}
        </style> 
		<!-- Definiendo el alto de la tabla -->
		<!-- Enlazando el CSS de Bootstrap -->
		
		<!-- Opcional: enlazando el JavaScript de Bootstrap -->
		<script src="js/jquery-3.5.1.js"></script>
		<script src="js/popper.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/main.js"></script>
		<script src="js/icons.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('[tool-tip-toggle="tooltip"]').tooltip({
					placement : 'top'
				});
			});
		</script>

	</head>

	<body>
		<div class="container-fluid" align="center">
			<div class="content" align="center">
				<!-- Inicio de Encabezado -->
				<div class="row quitar_espacios">
					<div class="col" align="center"><i class='fas fa-head-side-mask fa-7x text-danger'></i></div>
				</div>	
				
				<div align="center" style="color:#666666; font-size:24px"><?php echo $TITULO; ?></div>
				<div align="center" style="color:#eeeeee; font-size:4px">&nbsp;</div>	
				<!-- Fin de Encabezado -->

				<div class="row">
					<div class="col-md-12" align="center">
						<div class="table-responsive">
							<table class='table table-hover table-sm'>
								<thead class="thead-danger">
									<tr>
										<th class="pt-0">NOMBRE(S) Y APELLIDOS</th>
										<th class="pt-0">ID</th>
										<th class="pt-0">FTM</th>
										<th class="pt-0">DIRECION</th>
										<th class="pt-0">MUNICIPIO</th>
										<th class="pt-0">RESULTADO</th>
										<?php 
											if ($_GET['s']== "smc"){
												echo "<th class='pt-0'>PLACA</th>";
												echo "<th class='pt-0'>ID LAB</th>";
											}
										?>
									</tr>
								</thead>
								<tbody>
									<?php
										if($totalRows_ResultadoCovid == 0)
										{
											echo '<tr><td colspan="8">&nbsp;No se encontraron resultados</td></tr>';
										} else {
											while($row = mysqli_fetch_assoc($ResultadoCovid))
											{
												$RESULTADO = strtoupper($row['resultado']);
												switch (strtoupper($row['resultado'])) 
												{
													case "POSITIVO":
														$COLOR_FILA = "class='table-danger'";
														$COLOR_FONTAWESOME = "text-danger";
														$COLOR_BOTON = "btn-danger";
														break;
													case "NEGATIVO":
														$COLOR_FILA = "class='table-success'";
														$COLOR_FONTAWESOME = "text-success";
														$COLOR_BOTON = "btn-success";
														break;
													default:
														$COLOR_FILA = "class='table-info'";
														$COLOR_FONTAWESOME = "text-info";
														$COLOR_BOTON = "btn-info";
															
														if (strlen(trim($row['resultado']))==0) {
															$COLOR_FILA = "class='table-secondary'";
															$COLOR_FONTAWESOME = "text-secondary";
															$COLOR_BOTON = "btn-secondary";
															$RESULTADO = "NO DEFINIDO";
														}	
												}

												if (strlen(trim($row['direccion'])) > 50){
													$DIRECCION =  substr(trim(strtoupper($row['direccion'])), 0, 50) . "...";
												} else {
													$DIRECCION = trim(strtoupper($row['direccion']));
												}
												
												echo "<tr " . $COLOR_FILA . ">";
													echo "<td class='pt-0 pb-0'>" . trim(strtoupper($row['nombre'])) . "</td>";
													echo "<td class='pt-0 pb-0'>" . trim(strtoupper($row['id'])) . "</td>";
													echo "<td class='pt-0 pb-0'>" . date("d/m/Y",strtotime($row['ftm'])) . "</td>";
													echo "<td class='text-break pt-0 pb-0'>" . $DIRECCION . "</td>";
													echo "<td class='pt-0 pb-0'>" . trim(strtoupper($row['municipio'])) . "</td>";
													echo "<td class='pt-0 pb-0 " . $COLOR_FONTAWESOME ."'><b>" . $RESULTADO . "</b></td>";
													if ($_GET['s']== "smc"){
														echo "<td class='pt-0 pb-0'>" . trim(strtoupper($row['placa'])) . "</td>";
														echo "<td class='pt-0 pb-0'>" . trim(strtoupper($row['id_lab'])) . "</td>";
													}
												echo "</tr>";
											}
										}
									?>
								</tbody>
							</table>
						</div>	
					</div>	
				</div>
				
				<div style="color:#eeeeee; font-size:10px">.</div>
			</div>
			
			<script type='text/javascript'>
				$(document).ready(function(){
					$('.pacienteinfo').click(function(){
						var userid = $(this).data('id');
						// AJAX request
						$.ajax({
							url: 'modal_detail.php',
							type: 'post',
							data: {userid: userid},
							success: function(response){ 
								// Add response in Modal body
								$('.modal-body').html(response); 
								// Display Modal
								$('#DetailModal').modal('show'); 
							}
						});
					});
				});
			</script>

			
			<!-- Inicio del Pie de Página -->
			<div id="footer">
				<?php echo $BOTONES_NAVEGACION; ?>
			</div>
			<!-- Fin del Pie de Página -->
		</div>	
	</body>
</html>