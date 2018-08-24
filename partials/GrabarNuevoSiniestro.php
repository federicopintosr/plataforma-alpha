<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <script type="text/javascript" src="/../Jquery bajadas/jquery-1.7.1.min.js"></script>
    </head>
    <body>
        <?php
        include '../BaseDeDatos.php';
        include '../ClasesVarias.php';
        $Base = new Base;
        $cv = new ClasesVarias;
        $sql = "Insert Into Siniestros1(Numero,Compania,Empresa,FechaInicio,IdPrestadora,IdProcedimiento,Estado,Detalle,NombreTrabajador,DocumentoTrabajador,LocalidadTrabajador) values(" .
                $_POST['NumeroSiniestro'] . "," . $_POST['Compania'] . ",'" . $_POST['Empleador'] . "','" . $_POST['FechaInicio'] . "'," . $_POST['Prestador'] . "," . $_POST['Procedimientos'] . ",0,'" . $_POST['Detalle'] . "','" . $_POST['NombreTrabajador'] .
                "','" . $_POST['DocumentoTrabajador'] . "','" . $_POST['LocalidadTrabajador'] . "')";

        $conn = $Base->TransaccionBegin();

        if ($Base->Ejecutar($sql, $conn) === null) {
            goto SaleConError;
        }
        $Base->TransaccionCommit($conn);
                $rsp = "<?xml version='1.0' encoding='utf-8'?>" .
                "<respuesta>" .
                "<status>ok</status>"        .
                "</respuesta>" ;
        echo $rsp;
        return;
///////////////////////////////////////////////////// termina
        SaleConError:

        $rsp = "<?xml version='1.0' encoding='utf-8'?>" .
                "<respuesta>" .
                "<registros>Ninguno</registros>";
        $errors = $Base->Error($conn);

        $rsp = $rsp . "<status>" . $errors . "</status>";

//        foreach ($errors as $er) {
//            $rsp = $rsp . "<status>" . mb_convert_encoding($er['SQLSTATE'], 'UTF-8', 'windows-1252') . "\n" . mb_convert_encoding($er['code'], 'UTF-8', 'windows-1252') . "\n" . mb_convert_encoding($er['message'], 'UTF-8', 'windows-1252') . "\n"  . $msg . "</status>";
//        }
//            $rsp = $rsp . "<status>" .  $sql . "</status>";
        $rsp = $rsp . "</respuesta>";

        echo $rsp;
        $Base->TransaccionRollback($conn);
        return $rsp;
        ?>
    </body>        
</html>