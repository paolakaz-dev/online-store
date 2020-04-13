<?php
require_once(__DIR__ . '/db-connect.php'); 
session_start();


if(isset($_SESSION['username'])){

    $sql="DELETE FROM customers WHERE idCustomer=:idCustomer";
    if($stmt = $dbh -> prepare($sql)) {
        $stmt->bindParam(':idCustomer',$_SESSION['username'],PDO::PARAM_STR);
        $stmt -> execute();
        session_destroy(); //MUST HAVE
        header('Location:../main/index.php');
        echo '{"status": 1, "message":"Profile deleted", "line":"'.__LINE__.'"}';
    } else {
        sendErrorMessage('* sql error', __LINE__ );
      
    }
    

}

function sendErrorMessage($sErrorMessage, $iLineNumber){
    echo '{"status": 0, "message":"'.$sErrorMessage.'", "line": '.$iLineNumber.'}';
    exit;
}