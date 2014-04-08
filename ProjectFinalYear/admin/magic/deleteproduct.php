<?php
include_once './connection/editdelete.php';
include_once './connection/mongoobject.php';

class deleteP {

    function deletepro($idf,$dba,$coll) {
        $m = myprojMongoSingleton::getMongoCon();
        $db = $m->$dba;
        $collection = $db->$coll;

        $r = $collection->remove(array("_id" => new MongoId($idf)), array("justOne" => True));
       
        return $r;
    }

}

$id = $_REQUEST['id'];
$d = new deleteP();
$r = $d->deletepro($id,$_REQUEST['db'],$_REQUEST['coll']);
echo $r;
if($r){
     echo $id . 'Delete succesfully!!<br>';
}else{
    echo 'Something went wrong';
}
?>
<html><body><a href="../viewinventory.php"><- Go Back</a>