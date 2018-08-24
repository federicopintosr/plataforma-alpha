<!-- BOOTSTRAP -->
<html>
    <head>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <LINK REL=StyleSheet HREF="../Estilos.css" TYPE="text/css" MEDIA=screen>
        <script type="text/javascript" src="/../Jquery bajadas/jquery-1.7.1.min.js"></script>
    </head>
    <body>

        <?php
        include '../BaseDeDatos.php';
        include '../ClasesVarias.php';
        $Base = new Base;
        $cv = new ClasesVarias;
        ?>
        <div class="panel panel-success">

            <div class="panel-heading ">
                <p class="tituloSiniestro"> Datos del siniestro </p>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Numero de siniestro</th>
                            <th>
                                <?php
                                echo"<text id='IdCompanias' class='divListaMultiCheck' style='display:block;width:100%'>" . $cv->ListaMultiCheck("Compañias", "companias", "Select Id as Campo1,Nombre as Campo2 From compania Order by Nombre") . "</text>";
                                ?>

                            </th>
                            <th>Empleador</th>
                            <th>Inicio de Procedimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control" id="nro" placeholder="Ingrese numero de siniestro"></td>
                            <td><input type="text" class="form-control" id="cmp" placeholder="compañia" readonly="">
                            </td>
                            <td><input type="text" class="form-control" id="emp" placeholder="Ingrese nombre empleador"></td>
                            <td><input type="date" class="form-control" id="fecha" placeholder="Ingrese fecha de ingreso"></td>
                        </tr>
                        <tr>
                            <th>Nombre asegurado</th>
                            <th>Localidad</th>
                            <th>Documento</th>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" id="aseg" placeholder="Ingrese nombre del dagnificado"></td>
                            <td><input type="text" class="form-control" id="localidadTrabajador" placeholder="Localidad" ></td>
                            <td><input type="text" class="form-control" id="dniTrabajador" placeholder="documento"></td>
                        </tr>
                    </tbody>
                    <!-- pskdnpasdmnasd -->
                </table>

                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                echo"<text id='IdPrestadoras' class='divListaMultiCheck' style='display:block;width:100%'>" . $cv->ListaMultiCheck("Prestadoras", "prestadoras", "Select Id as Campo1,Nombre as Campo2,Zona as Campo3 From prestadoras Order by Nombre") . "</text>";
                                ?>

                            </th>
                            <th>Zona de derivacion</th>
                            <th>
                                <?php
                                echo"<text id='IdProcedimiento' class='divListaMultiCheck' style='display:block;width:100%'>" . $cv->ListaMultiCheck("Procedimiento", "procedimiento", "Select Id as Campo1,Nombre as Campo2 From procedimiento Order by Nombre") . "</text>";
                                ?>

                            </th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" class="form-control" id="prest" placeholder="Prestadora" readonly="">
                            </td>
                            <td><input type="text" class="form-control" id="zona" readonly=""></td> 
                            <td> <input type="text" class="form-control" id="proc" placeholder="Procedimiento" readonly=""></td>
                            <td><label class="checkbox-inline form-control"> <input type="checkbox" value="" id="cerrado">Cerrado</label></td>
                        </tr>
                    </tbody>

                </table>
                <label for="comment">Adjuntar informe:</label>
                <form action="../partials/Archivos/recibirArchivo.php" method="post" enctype="multipart/form-data" id="formu" >
                    <input type="file" name="Archivo[]" id="archivo[]" multiple="true" >
                    <input type="hidden" name="IdNuevo" value="33" />
                    <!--<input type="submit"> -->
                </form>


                <div class="panel panel-default">
                    <div class="form-group">
                        <label for="comment">Detalle:</label>
                        <textarea class="form-control" rows="5" id="comment"></textarea>
                    </div>
                    <input type="button" id="grabar" value="Grabar"/>
                </div>
            </div>
            <script>

                $(document).ready(function () {

                    $("#grabar").click(function () {
     $("#formu").submit();
return;
                        if ($("#nro").val() === "" || $("#aseg").val() === "" || $("#localidadTrabajador").val() === "" || $("#emp").val() === "" || $("#cmp").data("id") === undefined || $("#fecha").val() === null || $("#prest").data("id") === undefined || $("#proc").data("id") === undefined) {
                            alert("faltan datos obligatorios");
                            return;
                        }
                        var parametros = {"NumeroSiniestro": $("#nro").val(), "NombreTrabajador": $("#aseg").val(), "LocalidadTrabajador": $("#localidadTrabajador").val(), "DocumentoTrabajador": $("#dniTrabajador").val(), "Empleador": $("#emp").val(), "Compania": $("#cmp").data("id"), "FechaInicio": $("#fecha").val(), "Prestador": $("#prest").data("id"), Procedimientos: $("#proc").data("id"), "Cerrado": $("#cerrado").attr("checked"), "Detalle": $("#comment").text()};
                        $.ajax({async: false, cache: false, data: parametros, url: '../partials/GrabarNuevoSiniestro.php', type: 'post',
                            beforeSend: function () {

                            }, success: function (response) {
                                if ($("status", response).text() === "ok") {
                                    alert("ok");
                                    $("#formu").submit();
                                    $(".form-control").val(null);
                                    $("#cerrado").attr("checked", false);
                                } else {
                                }
                                $("#coment").val($("status", response).text());

                            }, error: function (response) {
                                $("#coment").val($("status", response).text());

                                return false;
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

            </script>
    </body>  

</html>     

