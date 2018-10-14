<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <script type="text/javascript" src="/../Jquery bajadas/jquery-3.3.1.js"></script>        
    </head>
    <body>
        <?php
        include '../BaseDeDatos.php';
        include '../ClasesVarias.php';
        $Base = new Base;
        $cv = new ClasesVarias;
        $aut = $_POST['Autorizada'];
        $sql = "Insert Into siniestros2(Fecha,Detalle,Autorizada,IdSiniestro) values('" .
                $_POST['FechaNota'] . "','" . $_POST['Detalle'] . "'," . $aut . "," . $_POST['IdSiniestro'] . ")";
        $conn = $Base->TransaccionBegin();

        if ($Base->Ejecutar($sql, $conn) === null) {
            goto SaleConError;
        }
        $Base->TransaccionCommit($conn);
        $rsp = "<?xml version='1.0' encoding='utf-8'?>" .
                "<respuesta>" .
                "<status>ok</status>" .
                "</respuesta>";
        echo $rsp;
        return;
///////////////////////////////////////////////////// termina
        SaleConError:

        $rsp = "<?xml version='1.0' encoding='utf-8'?>" .
                "<respuesta>" .
                "<registros>Ninguno</registros>";
        $errors = $Base->Error($conn);
        $rsp = $rsp . "<status>" . $errors . "</status>";
        $rsp = $rsp . "</respuesta>";

        echo $rsp;
        $Base->TransaccionRollback($conn);
        return $rsp;
        ?>
    </body>        
</html>