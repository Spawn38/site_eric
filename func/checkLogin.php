<?
function checkLogin($usernameForm, $passwordForm) {
    ob_start();
    include(__DIR__.'/../admin/config.php');
    
    $myusername = stripslashes($usernameForm);
    $mypassword = stripslashes($passwordForm);

    $myusername = mysqli_real_escape_string($dbC, $myusername);
    $mypassword = mysqli_real_escape_string($dbC, $mypassword);

    $sql="SELECT * FROM user_login WHERE user_name='".$myusername."' and user_pass=SHA1('".$mypassword."')";
    
    $result=mysqli_query($dbC, $sql);
    $count=mysqli_num_rows($result);
    
    ob_end_flush();    
    return ($count==1);        
}
?>