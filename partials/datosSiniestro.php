        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/js/modal.js"></script>
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
</head>

        <link rel="stylesheet" type="text/css" href="../css/style.css">


<div class="container">
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
            <td>125124</td>
            <td>Federico Pintos</td>
            <td>La segunda</td>
            <td>Molinos Tarquini</td>
            <td>07/10/2013</td>
          </tr>
        </tbody>

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
            <td>Prestadora X </td>
            <td>Villa Ballester</td>
            <td>Recategorizacion</td>
            <td>En tramite</td>
          </tr>
        </tbody>

      </table>

      <div class="panel panel-default">
        <div class="panel-heading">
          <b>Detalle:</b>
        </div>
        <div class="panel-body">La ART le brinda asistencia traumatológica, le realizaron estudios diagnósticos ecográficos, radiológicos y RNM (no
          sabe explicarlo con presición. No recuerda). Le dan fisioterapia por aproximadamente 10 sesiones. Le otorgan el
          alta médica. Regresó a su actividad habitual. Se presenta en sede de la CM 024 Jurisdiccional de la SRT en trámite
          de Divergencia en el Alta solicitando nuevamente prestaciones. Manifiesta el trabajador que el médico traumatólogo
          interviniente le sugirió realizar una cirugía del hombro izquierdo, pero la ART no lo autorizó</div>
      </div>

    </div>




    <table id="customers">
      <tr>
        <th>Fecha</th>
        <th>Nota</th>
        <th>Visible para ART </th>
      </tr>
      <tr>
        <td style="width: 150px;">12/06/2018</td>
        <td>Derive a prestador</td>
        <td style="width: 90px;">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
          </div>
        </td>
      </tr>


    </table>
    <tr>
      <button type="button" class="btn btn-success" data-toggle="modal" 
              data-target="#ingresoNotaModal">Ingresar nota</button>
    </tr>
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
            <button type="button" class="btn btn-success">Ingresar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div>