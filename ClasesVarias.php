<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClasesVarias
 *
 * @author MJD
 */
class ClasesVarias {

    var $IdUsuario = 0;

    function RecordSet($sql) {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        ini_set('mssql.charset', 'windows-1252');
        $cn = new base();
        $Cone = $cn->Conectar();
        //$sql = "SELECT IdProveedor, RazonSocial FROM A_Proveedo where Isnull(RazonSocial, '') <>'' order by RazonSocial ";

        $resultado = sqlsrv_query($Cone, $sql);



        // $cn->Desconectar($Cone);
        return $resultado;
    }

    function FMillares($Valor, $Decimales) {
        if ($Decimales > 0) {
            $p = (string) intval(round($Valor, $Decimales));
        } else {
            $p = (string) round($Valor, 0);
        }
        $contador = 0;
        $posicionDecimal = strpos($p, '.');
        if ($posicionDecimal > 0) {
            $p = substr($p, 0, $posicionDecimal) - 1;
        }
        $res = "";

        for ($i = strlen($p) - 1; $i >= 0; $i--) {
            $contador++;
            $res = substr($p, $i, 1) . $res;

            if ($contador == 3 and $i <> 0) {
                $contador = 0;
                $res = ',' . $res;
            }
        }
        if ($Decimales > 0) {
            $dec = round($Valor, $Decimales) - intval($Valor);
            $dec = round($dec * intval(("1" . str_repeat("0", $Decimales))));
            $repetir = $Decimales - strlen($dec);
            //$dec = (round($dec, $Decimales)) * intval(("1" . str_repeat("0", $Decimales)));
            if ($repetir > 0) {
                $dec = $dec . str_repeat("0", $repetir);
            }
            $res = $res . "." . $dec;
        }
        // return (round(round($Valor,$Decimales)-intval($Valor),$Decimales)) * intval(("1".str_repeat("0",$Decimales) ));
        // 
        Salida:
        return $res;
    }

    function W1252($Texto) {
        return mb_convert_encoding($Texto, 'UTF-8', 'windows-1252');
    }

    function CreaLista($Id, $sql, $mostrar, $valor, $clase, $Estilo, $OrdenTab) {
        $salida = '<select id=' . strtoupper($Id) . ' tabindex="' . $OrdenTab . '" class=' . $clase . '';  // es en mayusculas porque la etiqueta del xml la devuelve en mayuscula (no se porque)
        if ($Estilo > " ") {
            $salida = $salida . " style='" . $Estilo . "' ";
        };
        $salida = $salida . ">";
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        ini_set('mssql.charset', 'UTF-8');
        $Base = new Base;
        // $conn = $Base->Conectar();
        // $sql = mb_convert_encoding($sql, 'windows-1252', 'UTF-8');
        $consulta = $Base->Consulta($sql);
        $ValidarCuit = "";
        $Vincular_A = "";
        foreach ($consulta as $row) {
            $ValidarCuit = "";
            if (strpos($sql, "A_TiposDeDocumentos")) {
                if ($row["ValidaFormato"]) {
                    $ValidarCuit = " class='ValidaCuit' ";
                }
            }
            if (strpos($sql, "A_RubrosAl")) {
                $Vincular_A = $row["IdRubro"];
            }

            $salida = $salida . "<option " . $ValidarCuit . " value = '" . $row[$valor] . "' label='" . mb_convert_encoding($row[$mostrar], 'UTF-8', 'windows-1252') . "' >" . $Vincular_A . "</option>";
        }
        //$Base->Desconectar($conn);
        $salida = $salida . "</select>";
        return $salida;
    }

    function FLike($cadena, $campo) {
        $cadena = $cadena . " ";
        $li = "";
        while (strpos($cadena, " ") > 0):
            $Palabra = ltrim(substr($cadena, 0, strpos($cadena, " ")));
            $li = $li . " " . $campo . " Like |%" . $Palabra . "%| And ";
            $cadena = ltrim(substr($cadena, strpos($cadena, " ") + 1, 255));
        endwhile;
        $li = "(" . substr($li, 0, strlen($li) - 4) . ")";
        // $li = str_replace("|", "'", $li);
        return ($li);
    }

    function FMaxLen() {
        $archivo = __DIR__ . "/modo.txt";
        $archivo = str_replace(chr(92), chr(47), $archivo);
        $modo = file($archivo);
        if ($modo[0] == 2) {  // MySQL
            $ar = array(253, 252, 254);
        } else {  // MSSQL
            $ar = array(12, -2, 1, -151, -4, -8, -10, -9, -150, -1, -11, -3);
        }
        return $ar;
    }

    function FSiguienteAnterior($tabla, $campos, $orden, $campoSA) {
        $archivo = __DIR__ . "/modo.txt";
        $archivo = str_replace(chr(92), chr(47), $archivo);
        $modo = file($archivo);
        if ($modo[0] == 2) {  // MySQL
            $sql = "SELECT " . $campos .
                    ",(Select Isnull(" . $campoSA . ",0) from " . $tabla . " Where " . $orden . " < tabla." . $orden . " order by " . $orden . " desc LIMIT 1 ) AS Anterior " .
                    ",(Select Isnull(" . $campoSA . ",0) from " . $tabla . " Where " . $orden . " > tabla." . $orden . " order by " . $orden . " LIMIT 1 ) AS Proximo " .
                    " FROM " . $tabla . " as tabla order by " . $orden;
            return $sql;
        } else {  // MSSQL
            $sql = "SELECT " . $campos .
                    ",(Select top 1 Isnull(" . $campoSA . ",0) from " . $tabla . " Where " . $orden . " < tabla." . $orden . " order by " . $orden . " desc ) AS Anterior " .
                    ",(Select top 1 Isnull(" . $campoSA . ",0) from " . $tabla . " Where " . $orden . " > tabla." . $orden . " order by " . $orden . "  ) AS Proximo " .
                    " FROM " . $tabla . " as tabla order by " . $orden;
            return $sql;
        }
    }

    function ListaMultiCheck($Titulo, $Id, $sql,$Estilos=array()) {
        while (strpos($sql, "  ") !== FALSE) {
            $sql = str_replace("  ", " ", $sql);
        }

        $salida = "" .
                '    <table id="' . $Id . '">' .
                '        <thead class="tilutoListaMultiCheck">' .
                '            <tr>' .
                '                <th colspan="3" > <span style="float: right" class="glyphicon glyphicon-chevron-down"></span>' . $Titulo . '</th>' .
                '            </tr>' .
                '        </thead>' .
                '        <tbody  class="bodyListaMultiCheck" >';
        $Base = new Base;
        $consulta = $Base->Consulta($sql);
        foreach ($consulta as $row) {
            $salida = $salida .
            '            <tr>';
            $salida=$salida. '               <td><input class="claseCkeckBox" type="checkbox"/></td>' ;
            $estilo="";
            for ($i = 1; $i <= substr_count(strtoupper($sql), "AS CAMPO"); $i++) {
                if (count($Estilos)>0){
                    $estilo=" style= '".$Estilos[$i]."' ";
                }
//                if ($i == 2) {
//                    $estilo = ' style="width:100%;" ';
//                }else if($i==3){
//                     $estilo = ' style="display:none;" ';
//                }
                $salida = $salida .
                        //'               <td style="text-align:right;">' . $row['Campo'.$i] . '</td>' .
                        '               <td ' . $estilo . ' >' . mb_convert_encoding($row['Campo' . $i], 'UTF-8', 'windows-1252') . '</td>';
            }
            $salida = $salida . '            </tr>';
        }

        $salida = $salida .
                '        </tbody>' .
                '    </table>';
        // '</div>';
        return $salida;
    }

}
