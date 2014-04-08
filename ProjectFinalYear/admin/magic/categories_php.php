<?php
$name= $_REQUEST['name'];
$m=new Mongo();
$db=$m->admin;
$collection=$db->categories;
$document=array("name"=>$name);
$cur=$collection->find($document);
foreach ($cur as $value) {
    $out['name']=$value['sub'];
}

print_r(json_encode($out));
 ?>
