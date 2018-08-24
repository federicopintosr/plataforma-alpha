<?php

class Base {

    //Establishes the connection
    function Conectar() {
        $archivo = __DIR__ . "/modo.txt";
        $archivo = str_replace(chr(92), chr(47), $archivo);
        $modo = file($archivo);

        if ($modo[0] == 2) {  // MySQL
            
            $serverName = "urujuancho.dyndns.org";
            $usuario = "Fede";
            $pass = "2401";
            $baseDeDatos = "Alpha";
            $port = 3306;
            $result = mysqli_connect($serverName, $usuario, $pass, $baseDeDatos, $port) or die("coño: no se conectó");
            //mysql_select_db($baseDeDatos);
            return $result;
        } else {  //MSSQL 
            $serverName = "tcp:marcosj.dyndns.org,970";
            $connectionOptions = array("Database" => "Mendez", "Uid" => "UsuarioMendez", "PWD" => "2400");
//        global $connectionOptions, $serverName;
            $result = sqlsrv_connect($serverName, $connectionOptions);
            if ($result === false) {
                $msg = "Error: ";
                if (($errors = sqlsrv_errors() ) != null) {
                    foreach ($errors as $er) {
                        $msg = $msg . "SQLSTATE: " . $er['SQLSTATE'] . "";
                        $msg = $msg . "code: " . $er['code'] . "";
                        $msg = $msg . "message: " . mb_convert_encoding($er['message'], 'UTF-8', 'windows-1252') . "";
                        $msg = str_replace(chr(34), "`", $msg);
                        $msg = str_replace(chr(39), "`", $msg);
                    }
                }

                return $msg;
            } else {
                return $result;
            }
        }
    }

    function Consulta($sql, $parametros = []) {
        $archivo = __DIR__ . "/modo.txt";
        $archivo = str_replace(chr(92), chr(47), $archivo);
        $modo = file($archivo);
        $s = chr(34);
        $sql = str_replace($s, "'", $sql);
        $sql = mb_convert_encoding($sql, 'windows-1252', 'UTF-8');
        if ($modo[0] == 2) {  // MySQL
            $sql = str_replace("Isnull", "COALESCE", $sql);
            $sql = str_replace("len(", "LENGTH(", $sql);

            $conn = $this->Conectar();
            $consu = mysqli_query($conn, $sql);
            if (mysqli_error($conn) != null) {
                return null;  // sale con null
            }
            $i = 0;
            $arrayauxliar = false; // si falla devuelfe false
            while ($array = mysqli_fetch_array($consu)) {
                //Obtengo las claves del arreglo )
                $claves = array_keys($array);
                //Recorro el arreglo de las claves para ir asignando los datos al arreglo con los nombres de los atributos
                foreach ($claves as $clave) {
                    $arrayauxliar[$i][$clave] = $array[$clave];
                }
                $i++;
            }
            $this->Desconectar($conn);
            return $arrayauxliar;
        } else {
            $conn = $this->Conectar();
            $consu = sqlsrv_query($conn, $sql, $parametros, array("Scrollable" => SQLSRV_CURSOR_CLIENT_BUFFERED));
            if (sqlsrv_errors() != null) {
                return null;  // sale con null
            }
            $i = 0;
            $arrayauxliar = false; // si falla devuelfe false
            while ($array = sqlsrv_fetch_array($consu)) {
                //Obtengo las claves del arreglo )
                $claves = array_keys($array);
                //Recorro el arreglo de las claves para ir asignando los datos al arreglo con los nombres de los atributos
                foreach ($claves as $clave) {
                    $arrayauxliar[$i][$clave] = $array[$clave];
                }
                $i++;
            }
            $this->Desconectar($conn);
            return $arrayauxliar;
        }
    }

    function Desconectar($conn) {
        $archivo = __DIR__ . "/modo.txt";
        $archivo = str_replace(chr(92), chr(47), $archivo);
        $modo = file($archivo);
        if ($modo[0] == 2) {  // MySQL
            mysqli_close($conn) or die("coño: no se desconectó");
        } else {
            sqlsrv_close($conn);
        }
    }

    function Registros($Consulta) {
        $cnn = $this->Conectar();
        $consulta = $this->Consulta($Consulta);
        $this->Desconectar($cnn);
        return $consulta;
        //return sqlsrv_fetch_array($consulta);
    }

    function Valor($sql, $cerrarConexion = false) {
        $archivo = __DIR__ . "/modo.txt";
        $archivo = str_replace(chr(92), chr(47), $archivo);
        $modo = file($archivo);
        if ($modo[0] == 2) {  // MySQL
            $conn = $this->Conectar();
            $consu = mysqli_query($conn, $sql);
            $rst = mysqli_fetch_array($consu);
            if ($cerrarConexion === true) {
                $this->Desconectar($conn);
            }
            return $rst;
        } else {
            $sql = mb_convert_encoding($sql, 'windows-1252', 'UTF-8');
            $conn = $this->Conectar();
            $consu = sqlsrv_query($conn, $sql);
            //$consulta = $this->Consulta($sql);
            $rsp = sqlsrv_fetch_array($consu);
            if ($cerrarConexion === true) {
                $this->Desconectar($conn);
            }
            return $rsp;
        }
    }

    function Eliminar($sql, $conn) {
        $archivo = __DIR__ . "/modo.txt";
        $archivo = str_replace(chr(92), chr(47), $archivo);
        $modo = file($archivo);
        if ($modo[0] == 2) {  // MySQL
        } else {
            $sql = mb_convert_encoding($sql, 'windows-1252', 'UTF-8');
            return sqlsrv_query($conn, $sql);
        }
    }

    function TransaccionBegin() {
        $archivo = __DIR__ . "/modo.txt";
        $archivo = str_replace(chr(92), chr(47), $archivo);
        $modo = file($archivo);
        if ($modo[0] == 2) {  // MySQL
            $conn = $this->Conectar(); // ver si es correcto hacerlo acá o tengo que pasar por parametro la conexion
            mysqli_autocommit($conn, FALSE);
            if (mysqli_begin_transaction($conn) === false) {
                $this->Desconectar($conn);
                return false;
            } else {
                return $conn;  // devuelve la conexion para el commit o rollback
            }
        } else {
            $conn = $this->Conectar(); // ver si es correcto hacerlo acá o tengo que pasar por parametro la conexion
            if (sqlsrv_begin_transaction($conn) === false) {
                $this->Desconectar($conn);
                return false;
            } else {
                return $conn;  // devuelve la conexion para el commit o rollback
            }
        }
    }

    function TransaccionCommit($conn) {
        $archivo = __DIR__ . "/modo.txt";
        $archivo = str_replace(chr(92), chr(47), $archivo);
        $modo = file($archivo);
        if ($modo[0] == 2) {  // MySQL
            $rst = mysqli_commit($conn);
            $this->Desconectar($conn);
            return $rst;
        } else {
            $rst = sqlsrv_commit($conn);
            $this->Desconectar($conn);
            return $rst;
        }
    }

    function TransaccionRollback($conn) {
        $archivo = __DIR__ . "/modo.txt";
        $archivo = str_replace(chr(92), chr(47), $archivo);
        $modo = file($archivo);
        if ($modo[0] == 2) {  // MySQL
            $rst = mysqli_rollback($conn);
            $this->Desconectar($conn);
            return $rst;
        } else {
            $rst = sqlsrv_rollback($conn);
            $this->Desconectar($conn);
            return $rst;
            ;
        }
    }

    function MetaData($sql) {
        $archivo = __DIR__ . "/modo.txt";
        $archivo = str_replace(chr(92), chr(47), $archivo);
        $modo = file($archivo);
        if ($modo[0] == 2) {  // MySQL
            $sql = str_replace("top(1)", " ", $sql) . " LIMIT 1";
            $conn = $this->Conectar();
            $prep = mysqli_prepare($conn, $sql);
            $rst = mysqli_stmt_result_metadata($prep);
            $campos = count($rst->fetch_fields());
            $array = [];
            for ($i = 0; $i < $campos; $i++) {
                $ar = ["Name" => $rst->fetch_fields()[$i]->name, "Type" => $rst->fetch_fields()[$i]->type, "Size" => $rst->fetch_fields()[$i]->length];
                array_push($array, $ar);
            }
            mysqli_free_result($rst);
            $this->Desconectar($conn);
            return $array;
        } else {  // MSSQL
            $conn = $this->Conectar();
            $prep = sqlsrv_prepare($conn, $sql);
            $rst = sqlsrv_field_metadata($prep);
            $campos = count($rst);
            $array = [];
            for ($i = 0; $i < $campos; $i++) {
                $ar = ["Name" => $rst[$i]['Name'], "Type" => $rst[$i]['Type'], "Size" => $rst[$i]['Size']];
                array_push($array, $ar);
            }
            $this->Desconectar($conn);
            return $array;
            /////////////////
        }
    }

    function Error($conn=null) {
        $archivo = __DIR__ . "/modo.txt";
        $archivo = str_replace(chr(92), chr(47), $archivo);
        $modo = file($archivo);
        if ($modo[0] == 2) {  // MySQL
            return mysqli_error($conn);
        } else {
            return sqlsrv_errors();  // ver si es correcto
        }
    }

    function Ejecutar($sql, $conn = false, $parametros = []) {
        $archivo = __DIR__ . "/modo.txt";
        $archivo = str_replace(chr(92), chr(47), $archivo);
        $modo = file($archivo);
        $s = chr(34);
        $sql = str_replace($s, "'", $sql);
        if ($modo[0] == 2) {  // MySQL
            $sql = mb_convert_encoding($sql, 'windows-1252', 'UTF-8');
            if ($conn === false) {
                $conn = $this->Conectar();
            }
            $consu = mysqli_query($conn, $sql);
            if (mysqli_error($conn) != null) {
                return null;  // sale con null
            }
            return true;
        } else {
            $sql = mb_convert_encoding($sql, 'windows-1252', 'UTF-8');
            if ($conn === false) {
                $conn = $this->Conectar();
            }
            $consu = sqlsrv_query($conn, $sql, $parametros, array("Scrollable" => SQLSRV_CURSOR_CLIENT_BUFFERED));
            if (sqlsrv_errors() != null) {
                return null;  // sale con null
            }
            return true;
        }
    }

}
