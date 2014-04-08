<?php
session_start();
include_once '../admin/magic/connection/mongoobject.php';
include_once './magic/getproducts.php';
$m = myprojMongoSingleton::getMongoCon();
$collection = $m->admin->inventory;
$cursor=  getprod::getData("inventory");

$coll = $m->admin->users;
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
 
    $result = $coll->findOne(array("_id" => new MongoId($userid)), array("orderid" => true));
    if (isset($result['orderid'])) {
        
        $cartsize = sizeof($result['orderid']);
    }else{
        $cartempty=true;
    }
}
?>
<!DOCTYPE html>

<html>
    
    <head>
        <title>Index page</title>
        <meta name="author" content="dhruvil" />
        <link rel="stylesheet" href="css/index.css" type="text/css" />
    </head>
    <body>
        <div id="block20">
            <img src="img/Home_BG_2.jpg" alt="Loading" >




            <ul id="menu">

                <li><a href="#home">Home</a></li>
                <li><a href="categories.php?">Men</a>
                    <ul>
                        <li><a href="categories.php?gen=men&cat=rings">Rings</a></li>
                        <li><a href="categories.php?gen=men&cat=chains">Chains</a></li>
                        <li><a href="categories.php?gen=men&cat=bracelets">Bracelets</a></li>
                    </ul></li>
                <li><a href="#home">Women</a><ul>
                        <li><a href="categories.php?gen=women&cat=rings">Rings</a></li>
                        <li><a href="categories.php?gen=women&cat=chains">Chains</a></li>
                        <li><a href="categories.php?gen=women&cat=bracelets">Bracelets</a></li>
                         <li><a href="categories.php?gen=women&cat=Necklace">Necklace</a></li>
                    </ul></li>
                <li><a href="#home">About us</a></li>
                <li><a href="#home">Contact us</a></li>

            </ul>


        </div>
        <div id="block13">
            <?php if (isset($_SESSION['userid'])) {
                ?>
                <a href="magic/addtocart.php">My Cart(<?php if(isset($cartempty)){
                    echo '0';
                    }else{echo $cartsize; }?>)</a><br><a href="../admin/magic/logout.php">Logout</a>

                <?php
            } else {
                echo '<a href="../admin/registernlogin.html">Login</a>';
            }
            ?>
        </div>
        <div id="blockitems">
            <ul >


                <?php
                foreach ($cursor as $value) {

                    echo '<a href="viewproduct.php?item=' . $value['_id'] . '">';
                    ?><li style='background-image: url("../img/upload/<?php echo $value['imgname'] ?>")'<?php
                        echo '</a><div id="textblock">Title: ' . $value['title'] . '<p>Price: ' . $value['pricing']['rupee'] .
                        '</div></li>';
                    }
                    ?>
        </ul>
    </div>
</div>


</body>
</html>