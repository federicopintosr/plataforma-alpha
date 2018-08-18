<!doctype html>
<html lang="en" ng-app="siniestrosApp">

    <head>
        <meta charset="utf-8">
        <title>AlphaOcupacional</title>

        <!-- JQUERY 
        <script src="node_modules/jquery/dist/jquery.min.js"></script> -->

        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">
        <script src="./bootstrap/js/bootstrap.min.js"></script>

        <!-- ANGULAR 
        <script src="node_modules/angular/angular.min.js"></script>
        <script src="node_modules/angular-ui-router/release/angular-ui-router.min.js"></script>  -->

        <!-- LODASH  
        <script src="node_modules/lodash/lodash.min.js"></script>  -->

        <link rel="shortcut icon" href="./images/icono.ico">
    </head>

<body>

    <header id="main-header">  
        <nav class="navbar navbar-inverse ph">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#"> Sistema de Siniestros OnLine</a></li>
       <!--       <img class="iconoTabla" src="./images/logooriginal2.jpg"> -->
            </div>
            <ul class="nav navbar-nav">
                <li><a href="#" onclick="Seleccion('partials/listadoSiniestros.php');"> <span class="glyphicon glyphicon-list"></span> Listado de Siniestros</a></li>
                <li><a href="#" onclick="Seleccion('partials/newSiniestros.php');"> <span class="glyphicon glyphicon-plus"></span> Crear siniestro</a></li>
            </ul>
          </div>
        </nav>
      </header>
    
    <body>
        <iframe id="cuadro" src="partials/listadoSiniestros.php" width="100%" height="1000"> 
        </iframe>

        
    </body>


    </div>

    <!-- js 

    <script src="routes.js"></script>
    <script src="app.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/style.css">-->
 <link rel="stylesheet" type="text/css" href="./css/style.css">
 <script> 
            function Seleccion(url){ 
                document.getElementById("cuadro").src=url;
            } 
  </script>

</body>
</html>