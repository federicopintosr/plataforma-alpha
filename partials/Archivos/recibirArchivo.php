<?php
//$x=$_SERVER['DOCUMENT_ROOT'];
//echo "<script>alert(". print_r($_SERVER) .");</script>";
//return;
        include $_SERVER['DOCUMENT_ROOT']. '/Alpha-php//BaseDeDatos.php';
        $Base = new Base;
$sql="Select Max(Isnull(Id,0)) From Siniestros1 ";
$id=$Base->Valor($sql);

//$id=$_POST['IdNuevo'];
$cuantos=$_FILES['Archivo']['name'];
for ($i=0;$i<count($cuantos);$i++){
copy($_FILES['Archivo']['tmp_name'][$i],"A".$id."_". $_FILES['Archivo']['name'][$i]);
$nombre = $_FILES['Archivo']['name'][$i];
    
}
echo "El archivo(s) se grabo correctamente.<br>";
//echo "<img src=\"$nombre\">";
echo "<script>alert(".$id.");</script>";
?>
 
 