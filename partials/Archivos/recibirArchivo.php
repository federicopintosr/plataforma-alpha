<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <script type="text/javascript" src="/../Jquery bajadas/jquery-1.7.1.min.js"></script>
    </head>
    <body>
        <?php
        $x = $_SERVER['DOCUMENT_ROOT'];
//echo "<script>alert(". print_r($_SERVER) .");</script>";
//return;
        include $x . '/Alpha-php/BaseDeDatos.php';
        $Base = new Base;
        $sql = "Select Ifnull(Max(Id),0) as Ultimo From siniestros1 ";
        $id = $Base->Valor($sql)[0];
        $cuantos = $_FILES['Archivo']['name'];
        if ($_FILES['Archivo']['name'][0] != "") {
            for ($i = 0; $i < count($cuantos); $i++) {
                copy($_FILES['Archivo']['tmp_name'][$i], "Id" . $id . "_" . $_FILES['Archivo']['name'][$i]);
                $nombre = $_FILES['Archivo']['name'][$i];
            }
            
            echo "El archivo(s) se grabo correctamente.<br>";
        }
//echo "<img src=\"$nombre\">";
        //echo "<script>alert('" . $_FILES['Archivo']['name'][0] . "');</script>";
        //Echo "<script>$(document).submit();</script>";
        return;
        ?>
    </body>
</html>

