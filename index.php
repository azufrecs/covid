<?php 
	//INICIO DE CONFIGURACION DEL MENU CON BOTONES
	$BOTONES_NAVEGACION = "
	<div class='col-md-12' align='center'>
		<div class='btn-group btn-group-sm'>
			<a class='btn btn-success' href='https://www.cmw.smcsalud.cu' role='button' data-toggle='tooltip' data-placement='top' title='Clic aqu&iacute; para acceder a la Web SMC'>Web SMC</a>
		</div>
	</div>";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Etiquetas <meta> obligatorias para Bootstrap -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/favicon.svg">
    <title>Buscador COVID-19</title>

    <!-- Enlazando el CSS de Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
    <link href="css/icons.css" rel="stylesheet" media="screen">
    <!-- Enlazando el CSS de Bootstrap -->

    <!-- Opcional: enlazando el JavaScript de Bootstrap -->
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/main.js"></script>
    <script src="js/icons.js"></script>
    <!-- Opcional: enlazando el JavaScript de Bootstrap -->
</head>

<body>
    <div class="container" align="center">
        <div class="content" align="center">
            <!-- Inicio de Encabezado -->
            <div class="row quitar_espacios">
                <div class="col" align="center"><i class='fas fa-head-side-mask fa-10x text-danger'></i></div>
            </div>

            <div align="center" class="display-4">Buscador COVID-19</div>
            <!-- Fin de Encabezado -->

            <?php
                if(isset($_POST['search'])){                    
                    header("Location:result.php?s=" . $_POST['cboBase'] . "&q=" . $_POST['cboBusqueda'] . "&c=" . $_POST['txtCriterio']);
                }
            ?>

            <!-- INICIO DEL FORMULARIO DE BUSQUEDA -->
            <form id="frmBuscar" name="frmBuscar" method="post" action="">
                <div align="center" style="color:#eeeeee; font-size:5px">&nbsp;</div>	
                <div class="form-row" align="center">
                    <div class="col-sm"></div>
                    <div class="col-md-4" align="center">
                        <div style="font-size:6px">&nbsp;</div>
                        <div class="form-row ml-0 mr-0">
                            <div class="input-group input-group">
                                <div class="input-group-prepend"><div class="input-group-text text-secondary text-monospace">Buscar en&nbsp;</div></div>
                                <select name="cboBase" id="cboBase" class="custom-select" required>
                                    <option disabled value="" selected hidden>Realice una selecci&oacute;n...</option>
                                    <option value="smc">BASE SMC</option>
                                    <option value="full">BASE GENERAL</option>
                                    <!-- <option value="area">AREA DE SALUD</option> -->
                                </select>
                            </div>
                        </div>
						<div style="font-size:3px">&nbsp;</div>
						<div class="form-row ml-0 mr-0">
                            <div class="input-group input-group">
                                <div class="input-group-prepend"><div class="input-group-text text-secondary text-monospace">Buscar por</div></div>
                                <select name="cboBusqueda" id="cboBusqueda" class="custom-select" required>
                                    <option disabled value="" selected hidden>Realice una selecci&oacute;n...</option>
                                    <option value="id">CI O PASAPORTE</option>
                                    <option value="nombre">NOMBRE(S) O APELLIDOS</option>
                                    <!-- <option value="area">AREA DE SALUD</option> -->
                                </select>
                            </div>
                        </div>
                        <div style="font-size:3px">&nbsp;</div>
                    </div>
                    <div class="col-sm"></div>
                </div>
                
                <div class="form-row" align="center">
                    <div class="col-sm"></div>
                    <div class="col-md-4">
                        <div class="form-row ml-0 mr-0">
                            <div class="input-group input-group">
                                <div class="input-group-prepend"><div class="input-group-text text-secondary text-monospace">Criterio&nbsp;&nbsp;</div></div>
                                <input name="txtCriterio" id="txtCriterio" class="form-control input" placeholder="Escriba el criterio de b&uacute;squeda..." autocomplete="off" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm"></div>
                </div>
                <div style="color:#EEEEEE; font-size:10px" align="center">&nbsp;</div>

                <div class="form-row">
                    <div class='col-md'></div>
                    <div class='col-md-4' align='center'>
                        <button type='submit' name='search' class='btn btn-primary btn-block btn-lg'><i class='fas fa-search'></i>&nbsp;&nbsp;&nbsp;Listar resultados</button>
                    </div>
                    <div class='col-md'></div>
                </div>
                <br>
                <br>
                <div class="font-weight-light text-secondary">Los resultados estar&aacute;n limitados por incoherencias, faltas de datos y faltas de ortograf&iacute;a.</div>
                <div class="font-weight-light blockquote-footer text-secondary">Al realizar la b&uacute;squeda no escriba el valor a buscar literalmente, escriba parte del criterio de b&uacute;squeda con el fin de magnificar el resultado.</div>
            </form>
            <!-- FINALIZA EL FORMULARIO DE BUSQUEDA -->
        </div>
        <!-- Inicio del Pie de Página -->
        <div id="footer">
            <?php echo $BOTONES_NAVEGACION; ?>
        </div>
        <!-- Fin del Pie de Página -->
    </div>
</body>

</html>