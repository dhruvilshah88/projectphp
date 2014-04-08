<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script>

            $(function() {

                $("#json-one").change(function() {

                    var dropdown = $(this);
                    var name = dropdown.val();
                    $.getJSON("categories_php.php", {"name": name}, function(data) {
                        var $jsontwo = $("#json-two");
                        vals = data.name.split(",");
                        $jsontwo.empty();
                        $jsontwo.append("<option>Please select</option>")
                        $.each(vals, function(index, value) {
                            $jsontwo.append("<option>" + value + "</option>");
                        });




                    });
                });
                $("#json-two").change(function() {

                    var dropdown = $(this);
                    var name = dropdown.val();

                    $.getJSON("categories_php.php", {"name": name}, function(data) {
                        var $jsonthree = $("#json-three");
                        vals = data.name.split(",");

                        $jsonthree.empty();
                        $jsonthree.append("<option>Please select</option>")
                        $.each(vals, function(index, value) {
                            $jsonthree.append("<option>" + value + "</option>");
                        });




                    });
                });
            });





        </script>
    </head>
<?php
include_once './connection/mongoobject.php';
if (isset($_REQUEST['submit'])) {
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
    $id = $_REQUEST['id'];
    $m = myprojMongoSingleton::getMongoCon();
    $collection = $m->admin->inventory;
    $criteria = array("_id" => new MongoId($id));
    $document = array("title" => $title, "description" => $desc, "details" => array("weight" => $weight, "color" => $color), "quantity" => $quantity, "pricing" => array("rupee" => $prupee, "dollar" => $pdollar), "parent" => array("primary" => $parent, "secondary" => $subparent1, "tertiary" => $subparent2), "rating" => $rating, "type" => $type, "path" => $path);
    $collection->update($criteria, array('$set'=>$document));
    echo 'updated!!';
    echo '<a href="../viewinventory.php">Go to Inventory </a>';
    exit();
} else {
    $id = $_REQUEST['id'];
    $m = myprojMongoSingleton::getMongoCon();
    $collection = $m->admin->inventory;
    $document = array("_id" => new MongoId($id));
    $cur = $collection->findOne($document);
    
}
?>
    <body>


        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $id ?>">
            Title<input type="text" name="title" value="<?php echo $cur['title']; ?>"><br>
            description  <input type="text" name="description" value="<?php echo $cur['description']; ?>"><br>
            weight  <input type="text" name="weight" value="<?php echo $cur['details']['weight']; ?>"><br>
            color  <input type="text" name="color" value="<?php echo $cur['details']['color']; ?>"><br>
            quantity  <input type="number" name="quantity" value="<?php echo $cur['quantity']; ?>"><br>
            price rupee   <input type="text" name="pricerupee" value="<?php echo $cur['pricing']['rupee']; ?>"><br>
            price dollar   <input type="text" name="pricedollar" value="<?php echo $cur['pricing']['dollar']; ?>"><br>
            Parent<select name="parent" id="json-one">
                <option >Please choose</option>
                <?php
                if ($cur['parent']['primary'] == 'men') {
                    echo ' <option selected="true" >men</option>
                <option>women</option>';
                } else {
                    echo '
                    <option>men</option>
                <option selected="true">women</option> ';
                }
                ?>

            </select><br>
            Sub-parent<select name="subparent1"  id="json-two"><option>Please select from above</option> 
                <?php echo '<option selected="true">' . $cur['parent']['secondary'] . '</option>' ?>
            </select> 
            <br>  Sub-parent<select name="subparent2"  id="json-three"><option>Please select from above</option>
                <?php echo '<option selected="true">' . $cur['parent']['tertiary'] . '</option>' ?>
            </select> 
            <br> 
            rating  <input type="number" name="rating" value="<?php echo $cur['rating']; ?>"><br>
            type     <input type="text" name="type" value="<?php echo $cur['type']; ?>"><br>

            <input type="submit" name="submit">
        </form>
    </body>
</html>


