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
        if ($_POST['VieneDeConsulta'] > 0) {
            //$sql = "delete from siniestros1 where id=" . $_POST['VieneDeConsulta'];
            //$Base->Ejecutar($sql);
            $sql="Update siniestros1 set Numero=".$_POST['NumeroSiniestro'].
                    ",Compania=". $_POST['Compania'] .
                    ",Empresa='". $_POST['Empleador']."'".
                    ",FechaInicio='".  $_POST['FechaInicio']."'".
                    ",IdPrestadora=". $_POST['Prestador']."".
                    ",IdProcedimiento=". $_POST['Procedimientos']."".
                    ",Detalle='". $_POST['Detalle']."'".
                    ",NombreTrabajador='". $_POST['NombreTrabajador']."'".
                    ",DocumentoTrabajador='". $_POST['DocumentoTrabajador']."'".
                    ",LocalidadTrabajador='". $_POST['LocalidadTrabajador']."'".
                    " where Id=". $_POST['VieneDeConsulta'];
        } else {
            $sql = "Select Count(compania) From  siniestros1 where compania=" . $_POST['Compania'] . " and Numero=" . $_POST['NumeroSiniestro'];
            $x = $Base->Valor($sql);
            if ($x[0] != 0) {
                $rsp = "<?xml version='1.0' encoding='utf-8'?>" .
                        "<respuesta>" .
                        "<status>El número de siniestro ya existe.</status>" .
                        "</respuesta>";
                echo $rsp;
                return;
            }
            $sql = "Insert Into Siniestros1(Numero,Compania,Empresa,FechaInicio,IdPrestadora,IdProcedimiento,Estado,Detalle,NombreTrabajador,DocumentoTrabajador,LocalidadTrabajador) values(" .
                    $_POST['NumeroSiniestro'] . "," . $_POST['Compania'] . ",'" . $_POST['Empleador'] . "','" . $_POST['FechaInicio'] . "'," . $_POST['Prestador'] . "," . $_POST['Procedimientos'] . ",0,'" . $_POST['Detalle'] . "','" . $_POST['NombreTrabajador'] .
                    "','" . $_POST['DocumentoTrabajador'] . "','" . $_POST['LocalidadTrabajador'] . "')";
        }
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