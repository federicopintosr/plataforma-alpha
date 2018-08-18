<!DOCTYPE html>
<html>
    <head>        
        <meta charset="windows-1252">
        <title>AlphaOcupacional</title>
        <script type="text/javascript" src="/../Jquery bajadas/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="/../Jquery bajadas/ajax.microsoft.com_ajax_jquery.ui_1.8.6_jquery-ui.min.js"></script>
        <link type="text/css" rel="Stylesheet" href="../Jquery bajadas/ajax.microsoft.com_ajax_jquery.ui_1.8.6_themes_smoothness_jquery-ui.css"/>
        <LINK REL=StyleSheet HREF="Estilos.css" TYPE="text/css" MEDIA=screen>
        <script src="/../Jquery bajadas/JAlert.js"></script>
        <script src="/../FuncionesVarias/FuncionesJs.js"></script>
        <link rel="stylesheet" href="/../Jquery bajadas/JAlert.css" />
        <link rel="shortcut icon" href="./images/icono.ico">


       
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
   
    $serverName = "192.168.0.47";
    $usuario = "Fede";
    $pass = "2401";
    $baseDeDatos = "art";
    $port = 3306;
    
//Se utiliza para mantener la sesiÃ³n en todas las paginas
        if (!isset($_SESSION)) {
            session_start();
        }

//Iniciamos la sesiÃ³n despues de enviar el formulario
        if (isset($_POST['usuario'])) {
            $_SESSION['nombre'] = $_POST['usuario'];
            $_SESSION['pass'] = $_POST['pass'];
            header('Location: ' . $_SERVER['PHP_SELF']);
        }

//Cerramos la sesiÃ³n despues de hacer click en Desconectar
        if (isset($_GET['cerrar'])) {
            $_SESSION['nombre'] = null;
            unset($_SESSION['nombre']);
            $_SESSION['pass'] = null;
            unset($_SESSION['pass']);
            header('Location: ' . $_SERVER['PHP_SELF']);
            session_destroy();
        }

//Si no existe la sesiÃ³n de usuario mostramos el formulario de loguin
        if (!isset($_SESSION['nombre'])) {
            ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="idFormInicioSesion">

                <div class='modal3-contenido' style='width:35%;height: 17rem;'>
                    <p class='logo' style='width:100%;text-align: center'>GestiÃ³n web</p>
                    <br>
                    <ul>
                        <li class="lista" id="l1">
                            Nombre: <br>
                            <input  type="text" id='IdUsuario' name="usuario" class="logo up"   onkeyup="FEnter(event, this);" ><br><br>
                        </li>
                        <li class="lista" id="l2">
                            Clave: <br>
                            <input type="password" id='idPass' name="pass" class="logo up"   onkeyup="FEnter(event, this);" ><br><br>
                        </li>
                        <li>
                            <input type="button" id='BotonIngresar' name="boton" value="Ingresar" class="botonInicial"  onclick="submit();">
                        </li>

                    </ul>
                    <br><br>
                    <p Id='mensaje'></p>
                    <script>document.getElementById('FMenu').style = 'display:none';</script>
                </div>
            </form>
        
            <?php
            

                
            // echo  MostrarMenu();
        } else {
            //Si existe la sesiÃ³n mostramos el nombre de usuario y la opciÃ³n desconectar                        
//            echo MostrarMenu();
            
             echo '<script type="text/javascript">window.location="inicio.php";</script>';          
    
  }  
          
        
        ?>

        
        
        <link rel="stylesheet" type="text/css" href="./css/styleLogin.css">
