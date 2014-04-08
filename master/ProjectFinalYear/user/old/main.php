<?php
include_once '../admin/magic/connection/mongoobject.php';
$m=  myprojMongoSingleton::getMongoCon();
$collection=$m->admin->inventory;
$cursor=$collection->find();

?>

<html>
    <head>
        <title>Index page</title>
        <meta name="author" content="dhruvil" />
        <link rel="stylesheet" href="css/index.css" type="text/css" />
    </head>
    <body>
        <div id="block20">
            <img src="img/Home_BG_2.jpg"  height="100%">
           

            

                    <ul id="menu">

                        <li><a href="#home">Home</a></li>
                        <li><a href="#home">Men</a>
                            <ul>
                                <li><a href="#home">Rings</a></li>
                                <li><a href="#home">Chains</a></li>
                                <li><a href="#home">Bracelets</a></li>
                            </ul></li>
                        <li><a href="#home">Women</a><ul>
                                <li><a href="#home">Rings</a></li>
                                <li><a href="#home">Chains</a></li>
                                <li><a href="#home">Bracelets</a></li>
                            </ul></li>
                        <li><a href="#home">About us</a></li>
                        <li><a href="#home">Contact us</a></li>

                    </ul>


                </div>
                <div id="block13">
                    <a href="#home">My Cart(0)</a>
                </div>
            <div id="block3">
            
     
<?php

foreach ($cursor as $value) {
     
    
    echo '<div id="block31"><a href="viewproduct.php?item='.$value['_id'].'"><img src="../img/upload/'.$value['imgname'].'"></a></div>';
   
}
?>
            </div>
        
       
    </body>
</html>