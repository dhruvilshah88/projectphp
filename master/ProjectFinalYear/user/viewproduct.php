<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Product</title>
        <style>
            html,body{


            }
            #content{
                display: block;
                margin:50px auto;
                background-image: url('../img/back.png');
                width:250px;
                border-radius: 3px;
                padding:5px;
                color:#c6b14a;
            }

            #insertcomment{
                width:500px;
                margin:10px auto;
            }

            #comments{
                width:600px;
                margin:10px auto;
                color:#61471c;
            }




        </style>
    </head>
    <body>
        <?php
        include_once '../admin/magic/connection/mongoobject.php';
        if (isset($_REQUEST['item'])) {
            include_once './magic/getsomething.php';
            session_start();


           
            $id = $_REQUEST['item'];
            $query = array("_id" => new MongoId($id));
            $getsomethingobj = new getsomething();
            $cursor = $getsomethingobj->getitnow("inventory", $query, array());

            foreach ($cursor as $value) {
                $title = $value['title'] . '<br>';
                $desc = $value['description'];
                $weight = $value['details']['weight'];
                $color = $value['details']['color'];
                $quantity = $value['quantity'];
                $prupee = $value['pricing']['rupee'];
                $pdollar = $value['pricing']['dollar'];
                $parent = $value['parent']['primary'];
                $subparent1 = $value['parent']['secondary'];
                $subparent2 = $value['parent']['tertiary'];
                $rating = $value['rating'];
                $type = $value['type'];
                $path = $value['path'];
                $imgname = $value['imgname'];
            }
            ?><div id="content"><img src="../img/upload/<?php echo $imgname ?>"><br><?php
            echo 'Title: ' . $title;
            echo 'Description: ' . $desc . '<br>';
            echo 'Weight: ' . $weight . 'g<br>';
            echo 'Quantity Available: ' . $quantity . '<br>';
            echo 'Price: ' . $prupee . '<br>';
            echo 'Rating: ' . $rating . '<br>';
        } else {
            header("Location:main.php");
        }
        if (isset($_SESSION['userid'])) {

            $userid = $_SESSION['userid'];
            ?> <form action="magic/addtocart.php" method="post" name="submit" id="submit">
                    <input type="submit" name="submit" value="Add to Cart"> 
                    <input type="hidden" name="item" value="<?php echo $id; ?>"></form>
                <?php
            } else {
                echo '<a href="../admin/registernlogin.html">Login</a>';
            }
            ?></div>
            <?php
            if (isset($_POST['commsub'])) {
                $queryforfindone = array("_id" => new MongoId($userid));

                $cur = $getsomethingobj->getonlyone("login", $queryforfindone, array("name" => true));
                echo "<br>";
                $nameofuser = $cur['name'];
                $commenttoinsert = $_POST['textar'];
                include_once '../admin/magic/update.php';
                $obj = new updatesomething();
                $condition = array("_id" => new MongoId($id));
                $query = array('$push' => array("comments" => array("user" => $userid, "username" => $nameofuser, "commented" => $commenttoinsert)));
                $cursor = $obj->updateit('inventory', $condition, $query,array());
            }
            ?>
        <div id="comments">
            <?php
            $queryforfind = array("_id" => new MongoId($id));
            $extraforfind = array("comments" => true);
            $cursorcomment = $getsomethingobj->getitnow("inventory", $queryforfind, $extraforfind);
            foreach ($cursorcomment as $value) { {
                    if (isset($value['comments'])) {
                        $tempsizeof = sizeof($value['comments']);
                        for ($i = 0; $i < $tempsizeof; $i++) {
                            echo $value['comments'][$i]['username'] . "&nbsp:";
                            print_r($value['comments'][$i]['commented']);
                            echo '<br>';
                        }
                    }
                }
            }
            ?>
        </div>
        <div id='insertcomment'>
            <form action="" method="post">
                <textarea rows="12" cols="70" name="textar"></textarea><br>
                <input type="hidden" name="item" value="<?php echo $id ?>">
                <input type="submit" name="commsub" value="submit">
            </form>
        </div>
    </body>
</html>
