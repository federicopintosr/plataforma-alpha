<!DOCTYPE html>
<html>
    <head>        
        <meta charset="windows-1252">
        <title>Mendez</title>
        <script type="text/javascript" src="/../Jquery bajadas/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="/../Jquery bajadas/ajax.microsoft.com_ajax_jquery.ui_1.8.6_jquery-ui.min.js"></script>
        <link type="text/css" rel="Stylesheet" href="../Jquery bajadas/ajax.microsoft.com_ajax_jquery.ui_1.8.6_themes_smoothness_jquery-ui.css"/>
        <LINK REL=StyleSheet HREF="Estilos.css" TYPE="text/css" MEDIA=screen>
        <script src="/../Jquery bajadas/JAlert.js"></script>
        <script src="/../FuncionesVarias/FuncionesJs.js"></script>
        <link rel="stylesheet" href="/../Jquery bajadas/JAlert.css" />           

        <style>
            #desconectar{
                color:#999999;
                text-decoration: none;
            }
            #desconectar:hover{
                color:#FF7788;
            }
            #Panel1{
                background-color:#2282ea;
                width: 60%;
                height: 50%;
                top:25%;
                left:20%;
                margin: 0;
                position:absolute;
                display: none;
            }
            .modal3-contenido{
                background-color:  rgba(100,80,100,0.3);
                width:300px;
                padding: 20px 30px;
                margin: 20% auto;
                position: relative;
                z-index: 5;
                border: brown;
                border-style:  ridge;
            }
            .botonInicial{
                background-color: #800000;
                color:yellow;
                padding: 5px 5px;
                border-style:  ridge;
                position: absolute;
            }
            #desconectar:hover{
                color: #C00000;
            }

            .up{
                text-align: left;
                align-content:  flex-start;
                display:list-item;
                float:left;
            }
            .PantallaMax{
                background: url('.//Imagenes/pantalla.png');
                background-repeat:  no-repeat;
                background-position:  center;
                -webkit-background-size: contain;
                -moz-background-size: contain;
                -o-background-size: contain;    
                background-color: rgb(200,200,100);
                opacity: .5;

            }
        </style>    
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
        include 'ClasesVarias.php';
        include 'BaseDeDatos.php';
        $Base = new Base;
        $menu = "";
         $Conexion = $Base->Conectar();
//Se utiliza para mantener la sesión en todas las paginas
        if (!isset($_SESSION)) {
            session_start();
        }

//Iniciamos la sesión despues de enviar el formulario
        if (isset($_POST['usuario'])) {
            $_SESSION['nombre'] = $_POST['usuario'];
            $_SESSION['pass'] = $_POST['pass'];
            header('Location: ' . $_SERVER['PHP_SELF']);
        }

//Cerramos la sesión despues de hacer click en Desconectar
        if (isset($_GET['cerrar'])) {
            $_SESSION['nombre'] = null;
            unset($_SESSION['nombre']);
            $_SESSION['pass'] = null;
            unset($_SESSION['pass']);
            header('Location: ' . $_SERVER['PHP_SELF']);
            session_destroy();
        }

//Si no existe la sesión de usuario mostramos el formulario de loguin
        if (!isset($_SESSION['nombre'])) {
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="idFormInicioSesion">

                <div class='modal3-contenido' style='width:35%;height: 17rem;'>
                    <p class='logo' style='width:100%;text-align: center'>Gestión web</p>
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
            //Si existe la sesión mostramos el nombre de usuario y la opción desconectar                        
            echo MostrarMenu();
        }
        ?>
        <script >
            $(document).ready(function () {
               // FSeleccionarMenu(document.getElementById('L0102')); // para que muestre al inicio (temporal)
//                FSeleccionarMenu(document.getElementById('L010405')); // para que muestre al inicio (temporal)
                $("ul  > li ").click(function () {
                    FSeleccionarMenu(this);
                });
                function FSeleccionarMenu(este) {
                    var href = $(este).find("a").attr('href');
                    var titulo = $(este).find("a").text();
                    //alert(href);
                    if (href.length > 6) { // 
                        var url = "http://marcosj.dyndns.org/Mendez/" + href.substr(2, href.length - 3);
                        url.replace('"', "");
                        //$("#Panel1").hide("slow", function () {});
                        //$("#Panel1").attr("src", url);
                        //$("#Panel1").show("slow", function () {});
                        var ancho = 1000;
                        var alto = 600;
                        if (url.indexOf('FClientes') > 0 || url.indexOf('FProductos') > 0 || url.indexOf('FProveedores') > 0 || url.indexOf('FPlanDeCuentas') > 0) {
                            ancho = $('body').width();
                            alto = $('iframe').height() + 280;
                        }
                        ; //Hace el frame más grande
                        HuboCambiosAlCerrar = false;
                        var $dialog = $("<div id='IdDivFrame' style='top;20%;color:red;'></div>")
                                .html('<iframe id="IdFrame1" style="border: 0px;width:100%; height:98%" src="' + url + '"  ></iframe>')
                                .dialog({
                                    autoOpen: false,
                                    modal: true,
                                    height: alto,
                                    width: ancho,
                                    title: titulo,
                                    open: function () {
                                        $(this).parent().find('div.ui-dialog-titlebar').addClass('Titulos');
                                    }, // le agrega una clase a la ventana
                                    beforeClose: function () {
                                        if (HuboCambiosAlCerrar) {
                                            return confirm('Cancela los cambios ');
                                        }
                                        //var estado = $(this).children('.ClaseEstado').val();
                                        //if (estado === 'ok') {
                                        //    return true;
                                        //} else {
                                        //    return false;
                                        //}

                                    },
                                    close: function () {
                                        // return confirm('cerrar?');


                                    }

                                });
                        // $dialog.dialog({appendTo:"<input type='text' class='ClaseEstado' id='IdEstado'  value='ok'/>"});
                        $dialog.on("close[*]", function (event, ui) {
                            // return confirm("cerrar");
                        });
                        $dialog.dialog('open');
                        //return false;
                    }

                }
                $("ul  > li ").dblclick(function () {
                    ////////////////////////////SELECCION DE MENU ACTIVO
                    if (this.id.length > 3) {  // no es el menu de arriba. es submenu
                        var activo;
                        if ($(this).hasClass('menu_anulado')) {  // esta tachado
//                            if ($(this).children("a").css('text-decoration').indexOf('line-through') > -1) {  // esta tachado
                            //  $(this).children("a").css('text-decoration', 'none');
                            //$(this).class="" ;
                            $(this).removeClass("menu_anulado");
                            activo = true;
                        } else
                        {
                            //    $(this).children("a").css('text-decoration', 'line-through');
                            //$(this).class="menu_anulado";
                            $(this).addClass("menu_anulado");
                            activo = false;
                        }
                        var mid = [];
                        var mactivo = [];
                        mid.push(this.id.substr(1, 500));
                        mactivo.push(activo);
                        FCambiaMenu(mid, mactivo);
                        return false;
                    }


                });
//                document.getElementById('IdUsuario').select();
                function FCambiaMenu(id, activo) {
                    var parametros = {"id": id, "activo": activo};
                    $.ajax({data: parametros, url: 'Tablas/ConfiguracionMenu.php', type: 'post',
                        beforeSend: function () {
                        }, success: function (response) {
                            //alert($("status", response).text());
                            //  location.reload();                               
                            //jAlert($("status", response).text(), 'respuesta: Cambios en el menú', function () {
                            //});
                        }
                    });
                }
                $(".PantallaMax").click(function () {
                    alterna_modo_de_pantalla();
                });
            });

        </script>
    </body>
</html>
<?php

function MostrarMenu() {
    global $Base;

    $Sql = "Select count(*) as Registros From M_Usuarios Where nombre='" . $_SESSION['nombre'] . "' and Pass='" . $_SESSION['pass'] . "'";
    $fila = $Base->Valor($Sql);
    //print_r( $fila['Registros']);
    //return;
    //echo $fila;
    if ($fila[0] == 0) {
        $_SESSION['nombre'] = null;
        unset($_SESSION['nombre']);
        $_SESSION['pass'] = null;
        unset($_SESSION['pass']);
        header('Location: ' . $_SERVER['PHP_SELF']);
       // $Base->Desconectar($Conexion);
        return " ";
    } else {
        return CargaMenu();
    }
}

function CargaMenu() {
    $cv = new ClasesVarias;
    global $menu, $Base;
    $M_Parametros = $Base->Valor("Select Empresa,Domicilio From M_Parametros");
    $menu = "" .
            "<form style='display: compact' id='FMenu' >" .
            "<div class='menu'>" .
            "   <table style='width: 100%'>" .
            "       <tr >" .
            "           <td class='logo' style='width:65%;text-align: center'>" . $cv->W1252($M_Parametros['Empresa']) . ' domicilio: ' . $cv->W1252($M_Parametros['Domicilio']) . "</td> " .
            "           <td style='width: 10%;text-align: right;' class='logo' style='font-size:small;'>Usuario:</td> " .
            "           <td id='NombreUsuario' class='logo'  >" . $_SESSION['nombre'] . "</td> " .
            "           <td style='width: 10%;text-align: right;' class='logo'> <a id='desconectar' href='?cerrar' >Desconectar</a></td>" .
            "           <td style='width:2em;' class='logo'><input type='button'   style='width:3em;' class='logo PantallaMax'/></td>" .
            "       </tr>" .
            "   </table>" .
            "   <nav id='menu_gral' > <ul id='umenu' class ='mi-menu'>";
    $menu = $menu . "   </ul>  " .
            "   </nav>" .
            "</div>" .
            "" .
            "<div id='dvframe'><iframe id='Panel1' >" .
            "</iframe></div>" .
            "</form>" .
            "";

    $menu = $menu . "<script> ";
    AgregarPunto();
    $menu = $menu . "</script>";
    return $menu;
}

function AgregarPunto() {
//return "";
    global $Base;
    $Sql = "Select Id,Item,Texto,Posicion,Parent,href,ToolTip,Estado,Isnull(Activo,0) as Activo from MenuWeb where posicion <>'0' order by len(posicion),posicion";
//    $Sql = "Select Id,Item,Texto,Posicion,Parent,href,ToolTip,Estado,Isnull(Activo,0) as Activo from MenuWeb where posicion <>'0' order by len(posicion),posicion";
    $consulta = $Base->Consulta($Sql);
    $ul = "";
    $pertenece = "";
    $cant=0;
//    print_r(count($consulta));
//    return;
    foreach ( $consulta as $fila) {
        $cant++;
        global $menu;
        if ($ul <> "u" . $fila['Parent']) {
            if ($fila['Parent'] === "menu") {
                $pertenece = "u" . $fila['Posicion'];
                $menu = $menu . "$('#u" . $fila['Parent'] . "').append('<ul class=" . chr(34) . "clase" . strlen($fila['Posicion']) . chr(34) . " id=u" . $fila['Posicion'] . "></ul>');";
            } else {
                $pertenece = "u" . $fila['Posicion'] . " ";
                $menu = $menu . "$('#L" . $fila['Parent'] . "').append('<ul class=" . chr(34) . "clase" . strlen($fila['Posicion']) . chr(34) . " id=u" . $fila['Posicion'] . "></ul>');";
            }
        }
        $menu = $menu . "$('#" . $pertenece . "  ').append('<li   id=L" . $fila['Posicion'] .
                " class=" . $fila['Estado'] . ">" .
                "<a  href=#" . chr(34) . mb_convert_encoding($fila['href'], 'UTF-8', 'windows-1252') . chr(34) .
                " title=" . chr(34) . mb_convert_encoding($fila['ToolTip'], 'UTF-8', 'windows-1252') . chr(34) . ">" .
                mb_convert_encoding($fila['Texto'], 'UTF-8', 'windows-1252') . "</a></li>');";
        $ul = "u" . $fila['Parent'];
       // echo $cant;
    }
}
