<?php
//MYSQLI extension
//PDO

$db_server = "localhost";
$db_user = "root";
$db_pass="";
$db_name="project";
$conn="";//connection name in DB ( comes under red line in home.php becus of extension used )

try{
    $conn = mysqli_connect($db_server, 
                           $db_user,
                           $db_pass,
                           $db_name);
}catch(Exception $e){
    //$error=$e->getMessage();
    echo "Could not make a connection!".$e->getMessage();
}

// if($conn){ 
// echo "you are connected!"; 
// } 
// To check whehter connection established or not

?>


