<?php
    include 'AES.php'; 
    require 'conexion.php'; //archivo de conexion

    $inputText = $_REQUEST['pass']; $inputText = trim($inputText);

    //$inputText = $_POST['pass'];
    $inputKey = "H6sK5zosF80CTCRH"; //clave inventada 
    $blockSize = 256;
    $aes = new AES($inputText, $inputKey, $blockSize);
    $enc = $aes->encrypt();
    $aes->setData($enc);
    $dec=$aes->decrypt();
    //echo "After encryption: ".$enc."<br/>";
    //echo "After decryption: ".$dec."<br/>";

    $user = $_REQUEST['user']; $user = trim($user); $user=strtolower($user);


    $qry = "SELECT usuario_nombre, password, privilegios FROM usuarios_sistema WHERE  password='$enc' AND usuario_nombre='$user'";

    $result = mysqli_query($conexion, $qry) or die(mysqli_error($conexion));

    $num = mysqli_num_rows($result);
    $data = mysqli_fetch_array($result);
    if ($num == 1) {
        
        echo "Entra al sistema si coincide user y pass encriptado";
        
    }  else {
        echo "Error usuario o password incorrectos";
    }    
    $conexion->close();
?>