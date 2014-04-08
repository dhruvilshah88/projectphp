<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once '../admin/magic/connection/mongoobject.php';
        $id = $_REQUEST['item'];
        $query = array("_id" => new MongoId($id));
        $m = myprojMongoSingleton::getMongoCon();
        $collection = $m->admin->inventory;
        $cursor = $collection->find($query);
        foreach ($cursor as $value) {
            $title = $value['title'].'<br>';
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
        }
        echo 'Title: ' . $title;
        echo 'Description: ' . $desc . '<br>';
        echo 'Weight: ' . $weight . 'g<br>';
        echo 'Quantity Available: ' . $quantity . '<br>';
        echo 'Price: ' . $prupee . '<br>';
        echo 'Rating: ' . $rating . '<br>';
        ?>
    </body>
</html>
