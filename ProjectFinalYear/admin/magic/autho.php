<?php

$m = new Mongo();
$db = $m->admin;
$co = 0;
$collection = $db->login;
//$qry=array("_id"=>$id);
$qry = array("email" => $_POST['email'], "pass" => $_POST['pass']);
$cursor = $collection->find($qry);
$len=($cursor->count());
if ($len>0) {
    foreach ($cursor as $value) {
        $co = $co + 1;
        
        $name = $value['name'];
        
        $id = $value['_id'];
        $isAdmin=(Boolean)$value['isAdmin'];
    }
} else {
    echo 'Not registered OR credentials dont match';
    exit();
}
if ($name && $co == 1 && $id) {

    session_start();
   
    if($isAdmin==true){
         $_SESSION['id'] = $id;
    header('Location:../viewinventory.php');
}else{
     $_SESSION['userid'] = $id;
   header('Location:../../user/main.php');
}
    
} else {
    echo 'oops something went wrong 2 & co='.$co;
     echo 'Not registered';
    exit();
}

?>

