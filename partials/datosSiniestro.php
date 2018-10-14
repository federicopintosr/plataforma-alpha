<!DOCTYPE html>
<html>
    <head>        

        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/js/modal.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <style>
            #TablaNovedades{
                border:1px  #c7ddef solid;
                height: 29em;
                width: 89%;
                display: block;
                position: absolute;
                overflow: auto;
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
//        echo "<script>alert(".$_GET['NumeroSiniestro'].");</script>"
        //$sql = "Select *,(Select Zona From prestadoras where id=siniestros1.IdPrestadora ) as Zona,(Select Nombre From procedimiento where id=siniestros1.idprocedimiento ) as Procedimiento,(Select Nombre From prestadoras where id=siniestros1.idprestadora ) as NombrePrestadora,(Select Nombre From compania where id=Siniestros1.Compania ) as NombreCompania from Siniestros1 Where Numero=" . $_GET['NumeroSiniestro'] . " limit 1";
        $sql = "Select * from v_siniestros Where Numero=" . $_GET['NumeroSiniestro'] . " limit 1";
        $consulta = $Base->Consulta($sql);

        foreach ($consulta as $row) {
            $date = date_create($row['FechaInicio']);
            $sql = "Select * from Siniestros2 Where IdSiniestro=" . $row['Id'] . " order by Fecha desc";
            $consulta2 = $Base->Consulta($sql);
            ?>

            <div class = "container">
                <div class = "panel panel-success">

                    <div class = "panel-heading ">
                        <p class = "tituloSiniestro"> Datos del caso <input style="right: 10%;position: absolute" type="button" value="cerrar" onclick="window.close();"/></p>
                    </div>
                    <div class = "panel-body">
                        <table class = "table">
                            <thead>
                                <tr>
                                    <th>Numero de caso</th>
                                    <th>Nombre asegurado</th>
                                    <th>Compañia</th>
                                    <th>Empleador</th>
                                    <th>Inicio de Procedimiento</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $row['Numero'] ?></td>
                                    <td><input type="text" value="<?php echo mb_convert_encoding($row['NombreTrabajador'], 'UTF-8', 'windows-1252'); ?>" id="aseg" /></td>
                                    <td><?php echo mb_convert_encoding($row['NombreCompania'], 'UTF-8', 'windows-1252'); ?></td>
                                    <td><?php echo mb_convert_encoding($row['Empresa'], 'UTF-8', 'windows-1252'); ?></td>
                                    <td style="text-align: left;"><?php echo date_format($date, "d-m-Y"); ?></td>
                                </tr>
                            </tbody>

                        </table>

                        <table class = "table">
                            <thead>
                                <tr>
                                    <th>Prestadora</th>
                                    <th>Zona</th>
                                    <th>Procedimiento</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo mb_convert_encoding($row['NombrePrestadora'], 'UTF-8', 'windows-1252'); ?></td>
                                    <td><?php echo mb_convert_encoding($row['Zona'], 'UTF-8', 'windows-1252'); ?></td>
                                    <td><?php echo mb_convert_encoding($row['Procedimiento'], 'UTF-8', 'windows-1252'); ?></td>
                                    <td><?php echo mb_convert_encoding($row['Estado'], 'UTF-8', 'windows-1252'); ?></td>
                                </tr>
                            </tbody>

                        </table>

                        <div class = "panel panel-default">
                            <div class = "panel-heading">
                                <b>Detalle:</b>
                            </div>
                            <div class = "panel-body"><?php echo mb_convert_encoding($row['Detalle'], 'UTF-8', 'windows-1252'); ?></div>
                        </div>

                    </div>
                    
                    <tr>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ingresoNotaModal">Ingresar nota</button>
                    <input type="button" class="btn btn-primary" value="Editar"  src="editarSiniestro.php"></input>                  
                    <button  type="button" class="btn btn-danger"  value="Volver" src="listadoSiniestros.php">Volver</a></button>
                    </tr>


                    <div id ="TablaNovedades">
                        <table id="customers">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Nota</th>
                                    <th>Visible para ART </th>
                                </tr>
                            </thead>
                            <?php
                            if ($consulta2===false ){ // no devuelve resultado
                                goto Sigue;
                            }
                            foreach ($consulta2 as $row2) {
                                $date2 = date_create($row2['Fecha']);
                                ?>
                                <tbody>
                                    <tr>
                                        <td style="width: 150px;"><?php echo date_format($date2, "d-m-Y"); ?></td>
                                        <td><?php echo mb_convert_encoding($row2['Detalle'], 'UTF-8', 'windows-1252'); ?></td>
                                        <td style="width: 90px;">
                                            <div class="form-check">

                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" <?php echo ($row2['Autorizada'] == "1" ? " checked='checked'" : '') ?>/>
                                            </div>
                                        </td>
                                    </tr>



                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    Sigue:
                }
                ?>



            </div>

        </div>

        <div class="container">

            <!-- Modal -->
            <div class="modal fade" id="ingresoNotaModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal Header-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Ingreso nota</h4>
                        </div>
                        <!--           Modal contenido-->
                        <div class="modal-body">


                            <div class="form-group">
                                <label for="usr">Fecha:</label>
                                <form action="/action_page.php">
                                    <input type="date" name="nday">
                                    <input type="submit">
                                </form>
                            </div>
                            <div class="form-group">
                                <label for="usr">Nota:</label>
                                <input type="text" class="form-control" id="note" placeholder="Detalle nota">
                            </div>
                            <div class="form-group">
                                <label for="usr">Visible para ART:</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                </div>
                            </div>


                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" Id="GrabarNota">Ingresar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="$">Cerrar</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </body>
</html>