<!DOCTYPE html>
<html>
    <head>        
        <meta charset="windows-1252">
        <title>AlphaOcupacional</title>
        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">
        <script src="../bootstrap/js/bootstrap.min.js"></script>

        <script type="text/javascript" src="/../Jquery bajadas/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="/../Jquery bajadas/ajax.microsoft.com_ajax_jquery.ui_1.8.6_jquery-ui.min.js"></script>
        <link type="text/css" rel="Stylesheet" href="../Jquery bajadas/ajax.microsoft.com_ajax_jquery.ui_1.8.6_themes_smoothness_jquery-ui.css"/>
        <LINK REL=StyleSheet HREF="Estilos.css" TYPE="text/css" MEDIA=screen>
        <script src="/../Jquery bajadas/JAlert.js"></script>
        <script src="/../FuncionesVarias/FuncionesJs.js"></script>
        <link rel="stylesheet" href="/../Jquery bajadas/JAlert.css" />
        <link rel="shortcut icon" href="./images/icono.ico">
        <link rel="stylesheet" type="text/css" href="./css/style.css">


        <script type="text/javascript">

            function FEnter(event, elemento) {
                var x = event.which || event.keyCode;
                if (x === 13) {
                    //alert(elemento.name);
                    if (elemento.name === 'pass') {
                        $('#BotonIngresar').focus();
                    } else {
                        $('#idPass').focus();
                    }
                }

            }
            function FIngresar() {
                document.getElementsByName('FMenu').submit();

            }


//            $(document).ready(function () {
//            });
        </script>

    </head>
    <body>        
        <?php
        //  include 'ClasesVarias.php';
        //  include 'BaseDeDatos.php';
        //   $Base = new Base;
        //   $menu = "";
        //$Conexion = $Base->Conectar();
//    $Sql = "Select count(*) as Registros From M_Usuarios Where nombre='" . $_SESSION['nombre'] . "' and Pass='" . $_SESSION['pass'] . "'";
        //  $fila = $Base->Valor($Sql);

        $serverName = "marcosj.dyndns.org";
        $usuario = "Fede";
        $pass = "2401";
        $baseDeDatos = "alpha";
        $port = 3306;
        $conn = mysqli_connect($serverName, $usuario, $pass, $baseDeDatos, $port) or die("coño: no se conectó");



        //     $sql = "Select * From usuarios";
        //     while ($campos = mysqli_fetch_array($conn)) {
        //          echo $campos['nombre'] . "<br>";
        //          }    
//Se utiliza para mantener la sesiÃ³n en todas las paginas
        if (!isset($_SESSION)) {
            session_start();
        }

//Iniciamos la sesiÃ³n despues de enviar el formulario
        if (isset($_POST['usuario'])) {
            $_SESSION['username'] = $_POST['usuario'];
            $_SESSION['password'] = $_POST['pass'];
            header('Location: ' . $_SERVER['PHP_SELF']);
        }

//Cerramos la sesiÃ³n despues de hacer click en Desconectar
        if (isset($_GET['cerrar'])) {
            $_SESSION['username'] = null;
            unset($_SESSION['username']);
            $_SESSION['password'] = null;
            unset($_SESSION['password']);
            header('Location: ' . $_SERVER['PHP_SELF']);
            session_destroy();
        }

//Si no existe la sesiÃ³n de usuario mostramos el formulario de loguin
        if (!isset($_SESSION['username'])) {
            ?>
        <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
              
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="idFormInicioSesion">

                <div class="panel panel-success" style='width:35%;height: 28rem;' >


                    <div class="panel-heading ">
                        <p class="tituloSiniestro"> Gestion web </p>
                    </div>

                    <div class="panel-body">

                        <ul>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input  type="text" id='usuario' name="usuario" class="form-control" onkeyup="FEnter(event, this);" ><br><br>
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" id='pass' name="pass" class="form-control" onkeyup="FEnter(event, this);" ><br><br>
                                </ul>

                                <br>
                                <br>

                                <div class="modal-footer">

                                    <input type="button" class="btn btn-success" id='BotonIngresar' name="boton" value="Ingresar" class="botonInicial"  onclick="submit();">

                                    <br>

                                    <p Id='mensaje'></p>

                                    <script>document.getElementById('FMenu').style = 'display:none';</script>
                                </div>

                            </div>
                            </form>
                       </section>

        </div>

                            <?php
                            // echo  MostrarMenu();
                        } else {
                            $sql = "Select count(*) as Registros From  Usuarios Where Nombre='" . $_SESSION['username'] . "' and Password='" . $_SESSION['password'] . "'";
                            $consu = mysqli_query($conn, $sql);
                            $fila = mysqli_fetch_array($consu, MYSQLI_NUM);
                            if ($fila[0] == 0) {
                                $_SESSION['username'] = null;
                                unset($_SESSION['username']);
                                $_SESSION['password'] = null;
                                unset($_SESSION['password']);
                                header('Location: ' . $_SERVER['PHP_SELF']);
                                // $Base->Desconectar($Conexion);
                                return " ";
                            } else {
                                echo '<script type="text/javascript">window.location="inicio.php";</script>';
                            }


                            //Si existe la sesiÃ³n mostramos el nombre de usuario y la opciÃ³n desconectar                        
//            echo MostrarMenu();
//        $sql = "Select * From usuarios";
//        $consu = mysqli_query($conn, $sql);
                            //      while ($campos = mysqli_fetch_array($consu)) {
//            echo $campos['nombre'] . "<br>";
                            //        //echo ($campos[0] == 1 ? "UNO" : "DOS" ); // iif 
//            if (count($campos) > 0) {
//                echo "Dos campos " . count($campos);
                            //           } else {
//                echo "ningun campo";
//            }
//            for ($x = 0; $x < 10; $x++) {
//                echo $x . "<br>";
                            //           }
                        }
                        ?>



