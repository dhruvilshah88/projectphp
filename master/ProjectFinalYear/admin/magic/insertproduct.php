<html>
    <body>
<?php
if (isset($_POST['submitf'])) {
    $id = $_POST['id'];
    if ($_FILES["file"]["error"] > 0) {
        echo "Error: " . $_FILES["file"]["error"] . "<br>";
    } else {

        if (file_exists("upload/" . $_FILES["file"]["name"])) {
            
            echo $_FILES["file"]["name"] . " already exists mc. ";
        } else {

            $n = $_FILES["file"]["name"];
            $n = strstr($n, ".");
            $nam = $id . $n;
            $nam = trim($nam);
            move_uploaded_file($_FILES["file"]["tmp_name"], "../../img/upload/" . $nam);
            echo "Stored in: " . "../../img/upload/" . $id . $n;
            $m = new Mongo();
            $db = $m->admin;
            $collection = $db->inventory;
            $doc=array('$set'=>array("imgname"=>$nam));
            $collection->update(array("_id"=>  new MongoId($id)),$doc);
             echo ' <a href="../insertproduct.php"> Insert New Product </a><br><html><body><a href="../viewinventory.php"><- Go to products</a>';
        }
    }
} else {
    echo 'entered';
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $weight = $_POST['weight'];
    $color = $_POST['color'];
    $quantity = $_POST['quantity'];
    $prupee = $_POST['pricerupee'];
    $pdollar = $_POST['pricedollar'];
    $parent = $_POST['parent'];
    $subparent1 = $_POST['subparent1'];
    $subparent2 = $_POST['subparent2'];
    $rating = $_POST['rating'];
    $type = $_POST['type'];
    $path = $parent . "/" . $subparent1 . "/" . $subparent2;
    $m = new Mongo();
    $db = $m->admin;
    $collection = $db->inventory;
    $document = array("title" => $title, "description" => $desc, "details" => array("weight" => $weight, "color" => $color), "quantity" => $quantity, "pricing" => array("rupee" => $prupee, "dollar" => $pdollar), "parent" => array("primary" => $parent, "secondary" => $subparent1, "tertiary" => $subparent2), "rating" => $rating, "type" => $type, "path" => $path);
    $collection->insert($document);
   
}
?>


        <form action="" method="post"
              enctype="multipart/form-data">
            <label for="file">Filename:</label>
            <input type="file" name="file" id="file"><br>
            <input type="hidden"  name="id" value="<?php echo $document["_id"] ?>">
            <input type="submit" name="submitf" value="Submit">
        </form>

    </body>
</html> 