<?php 
include './init/db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET"){

    $Email = $_GET['q'];

    $sql = "SELECT * from users where username ='$Email'";
$res = $db->query($sql);
if($result = $res->fetch()){
    echo 'email is taken';
    
    
}else {
    echo 'email is not registered';
}
$db= null;

}





?>