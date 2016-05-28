<?php
session_start();

include('./func/checkLogin.php');
$usernameForm = $_POST['login'];
$passwordForm = $_POST['pwd'];

$msg ='';
if(isset($usernameForm, $passwordForm)) {
       
    $res =  checkLogin($usernameForm, $passwordForm);
    if($res) {
        $_SESSION['login'] = $usernameForm;
        $_SESSION['password']= $passwordForm;        
        header("location:admini.php");        
    }
    else {
        $msg = "Les données saisies sont incorrectes. Vérifier la saisie de vos identifiants";
        header("location:admin.php?msg=$msg");        
    }    
}
else {
    header("location:admin.php?msg=Vérifier la saisie de vos identifiants");    
}
?>