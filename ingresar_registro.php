<?php
    include 'AES.php';
    require 'conexion.php';

    $inputText = $_POST['pass']; $inputText = trim($inputText);
    $inputKey = "H6sK5zosF80CTCRH"; //clave inventada 
    $blockSize = 256;
    $aes = new AES($inputText, $inputKey, $blockSize);
    $enc = $aes->encrypt();
    $aes->setData($enc);
    $dec=$aes->decrypt();
    //echo "After encryption: ".$enc."<br/>";
    //echo "After decryption: ".$dec."<br/>";

    $user = $_POST['usuario']; $user = trim($user);
    $priv= $_POST['priv']; $priv = trim($priv);
    $id =$_POST['id'];

    $qry = "INSERT INTO usuarios_sistema(`id`, `usuario_nombre`, `password`, `privilegios`) VALUES ($id, '$user', '$enc', '$priv')";

    $result = mysqli_query($conexion, $qry) or die(mysqli_error($conexion));

    if ($result) {
        
        echo "Insertar registro con el pass encriptado";
        
    } else{

        echo "Fallas al intentar Insertar registro con el pass encriptado";
    }
    
    $conexion->close();
    
?>