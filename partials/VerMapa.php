<!DOCTYPE html>
<html>
    <head>
        <style>
            #map {
                height: 400px;
                width: 100%;
            }
        </style>
        <script type="text/javascript" src="/../Jquery bajadas/jquery-1.7.1.min.js"></script>
        <script src="/../FuncionesVarias/FuncionesJs.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        

    </head>
    <body>        
        <h3>Consultado 
            <input type="text" Id="Consultado" style="width:30%;" class ="Titulos" readonly=""/>
            Domicilio 
            <input type="text" Id="IdDireccion" style="width:35%;" class ="Titulos" />
        </h3>
        <div id="map"></div>
        <?php
        //$array = explode('|', $_POST['Domicilio']); // convierte  cadena en matriz
        $direcciones = $_GET["domicilio"];
        echo "<script>$('#IdDireccion').val('" . $direcciones . "') </script>";
        include '../BaseDeDatos.php';
        include '../ClasesVarias.php';
        $Base = new Base;
        $cv = new ClasesVarias;
        $estilos = array("display:none;", "text-align:right;", "width:20%;", "display:inline;width:20%;", "display:inline;width:40%;");
        echo"<text id='IdPrestadoras' class='divListaMultiCheck' style='display:block;width:100%'>" . $cv->ListaMultiCheck("Prestadoras", "prestadoras", "Select Id as Campo1,Nombre as Campo2,Zona as Campo3,Domicilio as Campo4 From prestadoras Order by Nombre", $estilos) . "</text>";
        ?>
        <div id="map"></div>



        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGLqhUCYtJkhl_jHVd_DX_pRmLj3WXPCQ&callback=MostrarMapa">
        </script>
        <script>
            // $('#IdDireccion').val('ee');
            $(document).ready(function () {

            });
            $("#IdDireccion").keypress(function (e) {
                if (e.keyCode === 13) {
                    MostrarMapa(16);
                }
            });
            
            function MostrarMapa(zm) {
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 3,
                    center: {lat: 0, lng: 0}
                });

                var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                var markers = direcciones.map(function (location, i) {
                    return new google.maps.Marker({
                        position: location,
                        label: "c"
                                //label: labels[i % labels.length]
                    });
                });

                // Add a marker clusterer to manage the markers.
                var Marcadores = new MarkerClusterer(map, markers,
                        {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
            }
            ////////////////////////
            alert(77);
            $("#prestadoras tr").each(function () {
                var address = "Dorrego 967, Martinez";
                geocoder.geocode({'address': address}, function (results, status) {
                    if (status === 'OK') {
                        alert(results[0].geometry.location);
                        //resultsMap.setCenter(results[0].geometry.location);
                        //var marker = new google.maps.Marker({
                        //    map: resultsMap,
                        //    position: results[0].geometry.location
                        });
                    }
                });

            });
            
            
            
            var direcciones = [

                {lat: -34.498531, lng: -58.5093258},
                {lat: -33.727111, lng: 150.371124},
                {lat: -33.848588, lng: 151.209834},
                {lat: -33.851702, lng: 151.216968},
                {lat: -34.671264, lng: 150.863657},
                {lat: -35.304724, lng: 148.662905},
                {lat: -36.817685, lng: 175.699196},
                {lat: -36.828611, lng: 175.790222},
                {lat: -37.750000, lng: 145.116667},
                {lat: -37.759859, lng: 145.128708},
                {lat: -37.765015, lng: 145.133858},
                {lat: -37.770104, lng: 145.143299},
                {lat: -37.773700, lng: 145.145187},
                {lat: -37.774785, lng: 145.137978},
                {lat: -37.819616, lng: 144.968119},
                {lat: -38.330766, lng: 144.695692},
                {lat: -39.927193, lng: 175.053218},
                {lat: -41.330162, lng: 174.865694},
                {lat: -42.734358, lng: 147.439506},
                {lat: -42.734358, lng: 147.501315},
                {lat: -42.735258, lng: 147.438000},
                {lat: -43.999792, lng: 170.463352}
            ];






        </script>
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGLqhUCYtJkhl_jHVd_DX_pRmLj3WXPCQ&callback=MostrarMapa">



        </script>

    </body>

</html>