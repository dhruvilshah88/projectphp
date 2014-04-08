<?php
$name=mysql_real_escape_string($_POST['name']);
$lname=mysql_real_escape_string($_POST['lname']);
$regpass=mysql_real_escape_string($_POST['regpass']);
$email=mysql_real_escape_string($_POST['email']);
$repass=mysql_real_escape_string($_POST['repass']);
if(strlen($regpass)<6){
    echo 'minimum length of pass 6 yours is'.strlen($regpass);
    exit();
}
 if(filter_var($email,FILTER_SANITIZE_EMAIL)){
     
 }else{
     echo 'invalid email';
      exit();
 }
if($regpass==$repass){
    
}  else {
    echo 'unequal pass';
     exit();
}
$m=new Mongo();
$db=$m->admin;
$collection=$db->login;
$cursor=$collection->findOne(array("email"=>$email));
echo '<br>';

    $id=($cursor['_id']).'';
    if($cursor['email']==$email){
        echo 'email exists';
        exit();
    }

$document=array("name"=>$name,"lname"=>$lname,"email"=>$email,"pass"=>$regpass);
$collection->insert($document);
echo 'Success!!';
session_start();
$_SESSION['id']=$id;
echo '<a href="../registernlogin.html#login">LOGIN</a>';
?>

