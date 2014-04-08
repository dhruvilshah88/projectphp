<?php
session_start();
if (isset($_SESSION['userid'])) {
    include_once './connection/mongoobject.php';
    $m = myprojMongoSingleton::getMongoCon();
    $collectionorder = $m->admin->orders;
    $dollartotal = $_POST['dollartotal'];
    ?>
<!DOCTYPE html>
    <html><body>
            <script 
                data-env="sandbox" 
                data-currency="USD"
                data-callback="localhost/user/main.php" 
                data-button="buynow" src="https://www.paypalobjects.com/js/external/paypal-button.min.js?merchant=dhruvilshah888@gmail.com"
                data-amount="<?php echo $dollartotal; ?>"
            ></script>


        </body>
    </html>








<?php
} else {
    header("Location:../user/main.php");
}
?>