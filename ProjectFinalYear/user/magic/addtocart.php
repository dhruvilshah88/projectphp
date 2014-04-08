<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../css/addtocart.css">
    </head>
    <body>



        <?php
        include_once '../../admin/magic/connection/mongoobject.php';
        include_once '../../admin/convertcurrency.php';
        include_once '../magic/getsomething.php';
        include_once '../../admin/magic/update.php';
        session_start();
        $grandtotal = 0;
        $userid = $_SESSION['userid'];
        $updateobj = new updatesomething();

        if (isset($_POST['remove'])) {
            $remove = $_POST['idel'];
            $deletid = $_POST['deletid'];

            $updateobj->updateit("users", array("_id" => new MongoId($userid)), array('$pull' => array('orderid' => new MongoId($deletid))), array());
        }

        $exists = false;
        if (isset($_SESSION['userid'])) {
            $getsomobj = new getsomething();
            $userid = $_SESSION['userid'];
            $cursor = $getsomobj->getonlyone("users", array("_id" => new MongoId($userid)), array());
            $tempsize = sizeof($cursor['orderid']);
            for ($i = 0; $i < $tempsize; $i++) {

                if (isset($_REQUEST['item'])) {
                    $item = $_REQUEST['item'];
                    if ($cursor['orderid'][$i] == $item) {
                        echo 'The item is already in your cart .<br>';

                        $exists = true;
                    }
                }
            }
            if (isset($_REQUEST['item'])) {
                $item = $_REQUEST['item'];
                if (!$exists) {
                    echo 'added';
                    $updateobj->updateit("users", array("_id" => $userid), array('$push' => array("orderid" => new MongoId($item))), array("safe" => true));

                    header("Location:../magic/addtocart.php");
                }
            }



            $cursor2 = $getsomobj->getonlyone("users", array("_id" => new MongoId($userid)), array());
            if (isset($cursor2['orderid'])) {
                ?><ul><?php
                    $grandtotal = 0;
                    for ($i = 0; $i < $tempsize; $i++) {
                        $query = array("_id" => new MongoId($cursor2['orderid'][$i]));
                        $cursor1 = $getsomobj->getitnow("inventory", $query, array("title" => true, "description" => true, "details" => true, "quantity" => true, "imgname" => true, "pricing" => true, "rating" => true));
                        foreach ($cursor1 as $value) {
                            $title = $value['title'] . '<br>';
                            $desc = $value['description'];
                            $weight = $value['details']['weight'];
                            $imgname = $value['imgname'];
                            $quantity = $value['quantity'];
                            $prupee = $value['pricing']['rupee'];
                            $pdollar = $value['pricing']['dollar'];
                            $rating = $value['rating'];
                            $grandtotal = $grandtotal + $prupee;
                            ?><li><?php
                                echo '<form method="post" action=""><input type="submit" name="remove" value="x" ><input type="hidden" name="idel" value="' . $i . '"><input type="hidden" name="deletid" value="' . $value['_id'] . '"></form><img src="../../img/upload/' . $imgname . '">'
                                . '<br>';
                                echo 'Title: ' . $title;
                                echo 'Description: ' . $desc . '<br>';
                                echo 'Weight: ' . $weight . 'g<br>';
                                echo 'Quantity Available: ' . $quantity . '<br>';
                                echo 'Price: ' . $prupee . '<br>';
                                echo 'Rating: ' . $rating . '<br></li>';
                            }
                            $cursor1 = null;
                        }
                        echo '</ul>';
                    }
                }
                $dollar = convert_currency($grandtotal, 'USD', 'INR');
                ?>
                <div id="total">
                    Total is: <?php echo $grandtotal ?> INR or <?php
                    $dollartotal = round($grandtotal / $dollar);
                    echo $dollartotal
                    ?> USD<br>The rate of Dollar is <?php echo $dollar ?>  requested from yahoo 

                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr"  method="post">
                        <input type="hidden" name="cmd" value="_xclick" />
                        <input type="hidden" name="business" value="dhruvilshah888@gmail.com" />
                        <input type="hidden" name="currency_code" value="USD" />
                        <input type="hidden" name="amount" value="<?php echo $dollartotal ?>" />
                        <input type="hidden" name="rm" value="2" />
                        <input type="hidden" name="return" value="" />
                        <input type="hidden" name="notify_url" value="http://multishop.in/dhruvil/paypal/paypal.php" />
                        <input type="hidden" name="cancel_return" value="http://localhost/user/main.php" /> <br />
                        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="Make payments with PayPal  its fast, free and secure!" />
                        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
                    </form>
                    <img src="../img/paypal__secure.jpg" alt="Pay through paypal" >           </div>
                </body>
                </html>
