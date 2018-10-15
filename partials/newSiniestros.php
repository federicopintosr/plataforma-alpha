<!-- BOOTSTRAP -->
<html>
    <head>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <LINK REL=StyleSheet HREF="../Estilos.css" TYPE="text/css" MEDIA=screen>
        <script type="text/javascript" src="/../Jquery bajadas/jquery-3.3.1.js"></script>        
        <style>
            #ventanaNotas{
                position: absolute;
                width: 100%;
                height: 100%;
                background-color: #eeeeee;
                opacity: .95;
                z-index: 5;    
            }
        </style>
    </head>
    <body>

        <?php
        include '../BaseDeDatos.php';
        include '../ClasesVarias.php';
        $Base = new Base;
        $cv = new ClasesVarias;
        ?>
        <!-- Modal -->
        <div id ="ventanaNotas" style="display:none">
            <div  id="ingresoNotaModal" role="dialog" >
                <div class="modal-dialog">

                    <!-- Modal Header-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"  onclick="$('#ventanaNotas').css({'display': 'none'});" >&times;</button>
                            <h4 class="modal-title">Ingreso nota</h4>
                        </div>
                        <!--           Modal contenido-->
                        <div class="modal-body">


                            <div class="form-group">
                                <label for="usr">Fecha:</label>
                                <form action="/action_page.php">
                                    <input type="date" Id="FechaNota">

                                </form>
                            </div>
                            <div class="form-group">
                                <label for="usr">Nota:</label>
                                <input type="text" class="form-control" id="DetalleNota" placeholder="Detalle nota">
                            </div>
                            <div class="form-group">
                                <label for="usr">Visible para ART:</label>
                                <div class="form-check">
                                    <select id="VisibleART">
                                        <option  value="1">si</option>
                                        <option value="0">no</option>

                                    </select> 

                                </div>
                            </div>


                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="GrabarNota">Ingresar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#ventanaNotas').css({'display': 'none'});" >Cerrar</button>
                        </div>
                    </div>

                </div>
            </div>   
        </div>                
        <div class="panel panel-success">
            <input type="hidden" value="0" id="VieneDeConsulta"/>
            <div class="panel-heading ">
                <p class="tituloSiniestro"> Datos del siniestro </p>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Numero de caso</th>
                            <th>
                                <?php
                                $estilos = array("display:none;", "text-align:right;", "width:100%;");
                                echo"<text id='IdCompanias' class='divListaMultiCheck' style='display:block;width:100%'>" . $cv->ListaMultiCheck("Compañias", "companias", "Select Id as Campo1,Nombre as Campo2 From compania Order by Id", $estilos) . "</text>";
                                ?>

                            </th>
                            <th>Empleador</th>
                            <th>Inicio de Procedimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control" id="nro" placeholder="Ingrese numero de siniestro"/></td>
                            <td><input type="text" class="form-control" id="cmp" placeholder="compañia" readonly=""/>
                            </td>
                            <td><input type="text" class="form-control" id="emp" placeholder="Ingrese nombre empleador"/></td>
                            <td><input type="date" class="form-control" id="fecha" placeholder="Ingrese fecha de ingreso"/></td>
                        </tr>
                        <tr>
                            <th>Nombre asegurado</th>
                            <th>Localidad</th>
                            <th>Documento</th>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" id="aseg" placeholder="Ingrese nombre del dagnificado"/></td>
                            <td><input type="text" class="form-control" id="localidadTrabajador" placeholder="Localidad" /></td>
                            <td><input type="text" class="form-control" id="dniTrabajador" placeholder="documento"/></td>
                        </tr>
                    </tbody>
                    
                </table>

                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $estilos = array("display:none;", "text-align:right;", "width:100%;", "display:none;", "display:none;");
                                echo"<text id='IdPrestadoras' class='divListaMultiCheck' style='display:block;width:100%'>" . $cv->ListaMultiCheck("Prestadoras", "prestadoras", "Select Id as Campo1,Nombre as Campo2,Zona as Campo3,Domicilio as Campo4 From prestadoras Order by Id", $estilos) . "</text>";
                                ?>
                           <!--      <input type="button" value="ubicación" id="verMapa"/>  -->
                            </th>
                            <th>Zona de derivacion</th>
                            <th>
                                <?php
                                $estilos = array("display:none;", "text-align:right;", "width:100%;");
                                echo"<text id='IdProcedimiento' class='divListaMultiCheck' style='display:block;width:100%'>" . $cv->ListaMultiCheck("Procedimiento", "procedimiento", "Select Id as Campo1,Nombre as Campo2 From procedimiento Order by Id", $estilos) . "</text>";
                                ?>

                            </th>
                            <th>
                                <?php
                                $estilos = array("display:none;", "text-align:right;", "width:100%;");
                                echo"<text id='IdEstado' class='divListaMultiCheck' style='display:block;width:100%'>" . $cv->ListaMultiCheck("Estados", "estados", "Select Id as Campo1,Estado as Campo2 From estados Order by Id", $estilos) . "</text>";
                                ?>

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" class="form-control" id="prest" placeholder="Prestadora" readonly=""/>
                            </td>
                            <td><input type="text" class="form-control" id="zona" readonly=""/></td> 
                            <td> <input type="text" class="form-control" id="proc" placeholder="Procedimiento" readonly=""/></td>
                            <td> <input type="text" class="form-control" id="est" placeholder="Estado" readonly=""/></td>
                        </tr>
                    </tbody>

                </table>
                <label for="comment">Adjuntar informe:</label>
                <form action="../partials/Archivos/recibirArchivo.php" method="post" enctype="multipart/form-data" id="formu" >
                    <input type="file" name="Archivo[]" id="archivo[]" multiple="true" />
                    <!--<input type="submit"> -->
                </form>


                <div class="panel panel-default">
                    <div class="form-group">
                        <label for="comment">Detalle:</label>
                        <textarea class="form-control" rows="2" id="comment"></textarea>
                    </div>
                    
                    <input type="button" class="btn btn-primary" id="grabar" value="Grabar"/>
                </div>
            </div>
            <tr>
                <button type="button" class="btn btn-success" id="IngresarNota" >Ingresar nota</button>
                <button  type="button" class="btn btn-danger"  value="Cerrar" onclick="location.href='listadoSiniestros.php'">Volver</button>
            </tr>

            <script>

                $(document).ready(function () {

                    $("#grabar").click(function () {
                        //$("#formu").submit();
                        //return;
                        if ($("#nro").val() === "" || $("#aseg").val() === "" || $("#localidadTrabajador").val() === "" || $("#emp").val() === "" || $("#cmp").data("id") === undefined || $("#fecha").val() === null || $("#prest").data("id") === undefined || $("#proc").data("id") === undefined) {
                            alert("faltan datos obligatorios");
                            return;
                        }
                        //   alert($("#comment").val());
                        var parametros = {"NumeroSiniestro": $("#nro").val(), "NombreTrabajador": $("#aseg").val(), "LocalidadTrabajador": $("#localidadTrabajador").val(), "DocumentoTrabajador": $("#dniTrabajador").val(), "Empleador": $("#emp").val(), "Compania": $("#cmp").data("id"), "FechaInicio": $("#fecha").val(), "Prestador": $("#prest").data("id"), Procedimientos: $("#proc").data("id"), Estados: $("#est").data("IdEstado"), "Detalle": $("#comment").val(), "VieneDeConsulta": $("#VieneDeConsulta").val()};
                        $.ajax({async: false, cache: false, data: parametros, url: '../partials/GrabarNuevoSiniestro.php', type: 'post',
                            beforeSend: function () {

                            }, success: function (response) {
                                if ($("status", response).text() === "ok") {
                                    alert("Registro grabado");
                                    $("#formu").submit();
                                    $(".form-control").val(null);
                                    $("#cerrado").attr("checked", false);
                                    if ($("#VieneDeConsulta").val() > 0) {
                                        location.replace("listadoSiniestros.php")
                                        //window.close();
                                    } else {
                                        location.reload();
                                    }
                                    //document.load();// "../inicio.php");
                                    //windows.history.back();

                                    return true;
                                } else {
                                    alert("No se grabó el registro. " + $("status", response).text());

                                }

                            }, error: function (response) {
                                alert("error: " + $("status", response).text());


                            }
                        });
                    });

                });
                $("#companias tr").click(function () {
                    if ($(this).find('td').eq(2).text() !== "") {
                        $("#cmp").val($(this).find('td').eq(2).text());
                        $("#cmp").data({"id": $(this).find('td').eq(1).text()});
                        $("#emp").select();
                    }
                });

                $("#prestadoras tr").click(function () {
                    // alert($(this).find('td').eq(2).text());
                    if ($(this).find('td').eq(2).text() !== "") {
                        $("#prest").val($(this).find('td').eq(2).text());
                        $("#zona").val($(this).find('td').eq(3).text());
                        $("#prest").data({"id": $(this).find('td').eq(1).text()});

                    }
                });

                $("#procedimiento tr").click(function () {
                    // alert($(this).find('td').eq(2).text());
                    if ($(this).find('td').eq(2).text() !== "") {
                        $("#proc").val($(this).find('td').eq(2).text());
                        $("#proc").data({"id": $(this).find('td').eq(1).text()});
                    }
                });
                
                $("#estados tr").click(function () {
                    if ($(this).find('td').eq(2).text() !== "") {
                        $("#est").val($(this).find('td').eq(2).text());
                        $("#est").data({"id": $(this).find('td').eq(1).text()});
                        $("#est").select();
                    }
                });
                
                $("#verMapa").click(function () {
                    var dire = escape($("#localidadTrabajador").val());
                    // alert(dire);
                    window.open("VerMapa.php?domicilio=" + dire);
                });
                function MostrarIngresoNotas() {
                    $("#ventanaNotas").css({"display": "block"});

                }
                $("#GrabarNota").click(function () {
                    //////////////////
                    // alert($("#VieneDeConsulta").val());
                    if ($("#VieneDeConsulta").val() <= 0) {
                        return;
                    }
                    //alert($("#VieneDeConsulta").val());
                   // alert($("#VisibleART").val());
                    var parametros = {"FechaNota": $("#FechaNota").val(), "Detalle": $("#DetalleNota").val(), "Autorizada": $("#VisibleART").val(), "IdSiniestro": $("#VieneDeConsulta").val()};
                    $.ajax({async: false, cache: false, data: parametros, url: '../partials/GrabarNota.php', type: 'post',
                        beforeSend: function () {

                        }, success: function (response) {
                            if ($("status", response).text() === "ok") {
                                alert("Nota grabada");
                                  location.replace("newSiniestros.php?IdSiniestro=" + $("#VieneDeConsulta").val());
                            } else {
                                alert("No se grabó la nota. " + $("status", response).text());






                            }

                        }, error: function (response) {
                            alert("error: " + $("status", response).text());


                        }
                    });


                    ///////////////////
                    $('#ventanaNotas').css({'display': 'none'});
                });
            </script>
            <tr>


        <?php
        if (isset($_GET['IdSiniestro']) === true) {
            $sql = "select * from v_siniestros where Id=" . $_GET['IdSiniestro'] . " Limit 1";

            $consulta = $Base->Consulta($sql);
            foreach ($consulta as $row) {
                //echo "<script>alert('" . $_GET['IdSiniestro'] . "');</script>";
                echo "<script>" .
                "$('#nro').val(" . $row['Numero'] . ");" .
                "$('#cmp').val('" . mb_convert_encoding($row['NombreCompania'], 'UTF-8', 'windows-1252') . "');" .
                "$('#emp').val('" . mb_convert_encoding($row['Empresa'], 'UTF-8', 'windows-1252') . "');" .
                "$('#fecha').val('" . substr($row['FechaInicio'], 0, 10) . "');" .
                "$('#aseg').val('" . mb_convert_encoding($row['NombreTrabajador'], 'UTF-8', 'windows-1252') . "');" .
                "$('#localidadTrabajador').val('" . mb_convert_encoding($row['LocalidadTrabajador'], 'UTF-8', 'windows-1252') . "');" .
                "$('#dniTrabajador').val('" . mb_convert_encoding($row['DocumentoTrabajador'], 'UTF-8', 'windows-1252') . "');" .
                "$('#prest').val('" . mb_convert_encoding($row['NombrePrestadora'], 'UTF-8', 'windows-1252') . "');" .
                "$('#zona').val('" . mb_convert_encoding($row['Zona'], 'UTF-8', 'windows-1252') . "');" .
                "$('#proc').val('" . mb_convert_encoding($row['Procedimiento'], 'UTF-8', 'windows-1252') . "');" .
    //            "$('#est').val('" . mb_convert_encoding($row['Estado'], 'UTF-8', 'windows-1252') . "');" .                        
                "$('#comment').val('" . mb_convert_encoding($row['Detalle'], 'UTF-8', 'windows-1252') . "');" .
                "$('#cmp').data({'id':" . $row['Compania'] . "});" .
                "$('#prest').data({'id':" . $row['IdPrestadora'] . "});" .
                "$('#proc').data({'id':" . $row['IdProcedimiento'] . "});" .
    //            "$('#est').data({'id':" . $row['IdEstado'] . "});" .
                "$('#VieneDeConsulta').val(" . $_GET['IdSiniestro'] . ");" .
                "$('#IngresarNota').bind('click',function(){MostrarIngresoNotas();});" .
                "</script>";
                $date = date_create($row['FechaInicio']);
                $sql = "Select * from Siniestros2 Where IdSiniestro=" . $_GET['IdSiniestro'] . " order by Fecha asc";
                $consulta2 = $Base->Consulta($sql);
/////////////////////
                $e = "" .
                        // '<tr>' .
                        // '<button type="button" class="btn btn-success" ' .
                        // '        id="IngresarNota" >Ingresar nota</button>' .
                        // '</tr>' .
                        '<div id ="TablaNovedades">' .
                        '  <table id="customers">' .
                        '       <thead>' .
                        '           <tr>' .
                        '               <th>Fecha</th>' .
                        '               <th style="width:70%;">Nota</th>' .
                        '               <th>Visible para ART </th>' .
                        '           </tr>' .
                        '       </thead>';

                if ($consulta2 === false) { // no devuelve resultado
                    goto Sigue;
                }
                foreach ($consulta2 as $row2) {
                    $date2 = date_create($row2['Fecha']);

                    $e = $e . ' <tbody>' .
                            '<tr class="filaNota">' .
                            '    <td style="width: 150px;">' . date_format($date2, "d-m-Y") . '</td>' .
                            '    <td>' . mb_convert_encoding($row2['Detalle'], 'UTF-8', 'windows-1252') . '</td>' .
                            '    <td style="width: 90px;">' .
                            '        <div class="form-check">' .
                            '            <input type="checkbox" class="form-check-input" id="exampleCheck1"' . ($row2['Autorizada'] == "1" ? " checked='checked'" : '') . '/>' .
                            '        </div>' .
                            '    </td>' .
                            '</tr>';
                }
                $e = $e .
                        '</tbody>' .
                        '</table>' .
                        '</div>';

                Sigue:
                echo $e;

///////////////////            
            }
        }
        function html_alert($type, $message, $dismisable){
	$alert = '';
        $alert_class = 'alert';
	if ( $type ) $alert_class += ' alert-'.$type;
	if ( $dismisable ) $alert_class += ' alert-dismissable';
	$alert = '<div class="'.$alert_class.'">'.$message.'</div>';
	return $alert;
}
?>
        
        
        
       
</body>  

</html>     

