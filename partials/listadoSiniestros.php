<!DOCTYPE html>
<html>
    <head>        

        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script type="text/javascript" src="/../Jquery bajadas/jquery-3.3.1.js"></script>        
        <style>
            .IdSiniestro{
                width: 10em;    
                border: none;
                background-color: white;
                color:blue;
            }
        </style>
    </head>
    <body>
        <?php
        include '..//CheckLogin.php';
        include '..//ClasesVarias.php';
        include '..//BaseDeDatos.php';
        $Base = new Base; // tiene el mismo descripcion de la clase pero no es necesario que sea así. Solo costumbre
        $cv = new ClasesVarias;
        ?>
        <div class="panel panel-success">

            <div class="panel-heading ">
                <p class="tituloSiniestro"> Listado de casos  <text id="registros" style="right:20%;position: absolute;">0</text></p>
            </div>

            <div class="container">
                <h2>Casos:</h2>
                
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Ingrese numero de caso o nombre del damnificado" id="buscar">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="button" id="botonBuscar">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                
                <table class="table table-striped table-hover" id="tabla">
                    <thead>
                        <tr>
                            <th style="text-align: left;width: 35%;">Damnificado</th>
                            <th style="text-align: center;width: 15%;">Fecha Inicio</th>
                            <th style="text-align: right;width: 20%;">Número de caso</th>
                            <th style="text-align: center;width: 10%;">Estado</th>
                            <th style="text-align: center;width: 5%;">Numero de caso interno</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $filtro = "";
                        if (isset($_GET['buscar'])) {
                            echo "<script>$('#buscar').val('" . $_GET['buscar'] . "')</script>";
                            $filtro = "Where NombreTrabajador like '%" . $_GET['buscar'] . "%' or Numero like '%" . $_GET['buscar'] . "%'";
                            //echo $filtro;
                        }

                        $sql = "Select Id,NombreTrabajador,Numero,Estado,FechaInicio from v_siniestros " . $filtro . "  Order by Id desc limit 5000 ";
                        $consulta = $Base->Consulta($sql);

                        $fila = 1;
                        foreach ($consulta as $row) {
                            ?>
                            <tr class="filaTr" >
                                <td style="text-align: left;width: 40%;"><?php echo mb_convert_encoding($row['NombreTrabajador'], 'UTF-8', 'windows-1252'); ?> </td>
                                <td style="text-align: right;" ><?php echo mb_convert_encoding($row['FechaInicio'], 'UTF-8', 'windows-1252'); ?></td>
                                <td style="text-align: center;width:20%;"><?php echo mb_convert_encoding($row['Numero'], 'UTF-8', 'windows-1252'); ?></td>
                                <td style="text-align: center;width:20%;"><?php echo mb_convert_encoding($row['Estado'], 'UTF-8', 'windows-1252'); ?></td>
                                <td style="text-align: right;" ><Input type="button" class="IdSiniestro" value=" <?php echo mb_convert_encoding($row['Id'], 'UTF-8', 'windows-1252'); ?>"/></td>
                            </tr>
                            <?php
                            $fila++;
                        }
                        ?>
                    </tbody>


                    </tbody>
                </table>
            </div>

        </div>

        <script>
            $(document).ready(function () {
                $("#registros").text("se muestran " + ($("#tabla tr").length - 1).toString() + " registros");
                $("#botonBuscar").click(function () {
                    location.replace("listadoSiniestros.php?buscar=" + $("#buscar").val());
                });
            });
            $(".IdSiniestro").click(function () {
                 location.replace("newSiniestros.php?IdSiniestro=" + $(this).val());
               // window.open("newSiniestros.php?IdSiniestro=" + $(this).val());
                // alert($(this).val());
            });
            $("#buscar").keypress(function (e) {
                
                if (e.keyCode === 13) {
                    location.replace("listadoSiniestros.php?buscar=" + $("#buscar").val());
                }
            });
        </script>

    </body>
</html>