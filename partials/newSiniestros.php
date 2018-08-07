        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">

<div class="panel panel-success">

    <div class="panel-heading ">
        <p class="tituloSiniestro"> Datos del siniestro </p>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Numero de siniestro</th>
                    <th>Nombre asegurado</th>
                    <th>Compañia</th>
                    <th>Empleador</th>
                    <th>Inicio de Procedimiento</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="numeroSiniestro" class="form-control" id="nro" placeholder="Ingrese numero de siniestro"></td>
                    <td><input type="asegurado" class="form-control" id="aseg" placeholder="Ingrese nombre del dagnificado"></td>
                    <td>
                        <select class="form-control" id="sel1">
                          <option>La segunda</option>
                          <option>Experta</option>
                          <option>Galeno</option>
                        </select>
                    </td>
                    <td><input type="empleador" class="form-control" id="emp" placeholder="Ingrese nombre empleador"></td>
                    <td><input type="fechaInicio" class="form-control" id="fecha" placeholder="Ingrese fecha de ingreso"></td>
                </tr>
            </tbody>
<!-- pskdnpasdmnasd -->
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th>Prestadora</th>
                    <th>Zona de derivacion</th>
                    <th>Procedimiento</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="prestador" class="form-control" id="pdr" placeholder="Ingrese prestadora"></td>
                    <td><input type="zona" class="form-control" id="zona" placeholder="Ingrese zona de derivacion"></td>
                    <td><input type="procedimiento" class="form-control" id="proc" placeholder="Ingrese procedimiento"></td>
                    <td><label class="checkbox-inline"> <input type="checkbox" value="">Cerrado</label></td>
                    </tr>
            </tbody>

        </table>
        <label for="comment">Adjuntar informe:</label>
        <form action="/action_page.php">
            <input type="file" name="pic" accept="image/*">
            <input type="submit">
          </form>


        <div class="panel panel-default">
            <div class="form-group">
                <label for="comment">Detalle:</label>
                <textarea class="form-control" rows="5" id="comment"></textarea>
            </div>

        </div>