<?php
session_start();
if(isset($_SESSION['id']))
{
    $universalid=$_SESSION['id'];
}
if(isset($universalid)){
    echo $universalid.' <a href="magic/logout.php">Logout</a>';
?>
<?php
include_once './magic/connection/mongoobject.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="dhruvil" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0" />
        <link rel="stylesheet" href="css/smoothtran.css" type="text/css"/>
        <title>d</title>
        <script type="text/javascript"  charset="utf-8"
                >

                    function confirmDelete(Id) {
                        var deleteP = confirm('Are you sure?');
                        if (deleteP) {
                            window.location.href = 'magic/deleteproduct.php?id=' + Id + '&db=admin&coll=inventory';
                        }

                    }


        </script>
    </head>

    <body class="body">
        <div id="toppart">
            <header>
                <img src="img/products.png">   

            </header>
           
            <div id="wrapper">
                <ul>
                    <li><a href="admin.php">Users</a> </li>

                    <li><a href="orders.php">Orders </a></li>
                    <div id="active">		<li><a href="viewinventory.php">Products</a> </li></div>
                    <li><a href="smoothtran3.html">About us</a> </li>
                    <li><a href="smoothtran4.html">Contact us</a></li>
                </ul>
            </div>
        </div>	 <a href="insertproduct.php">Insert new Product</a>
        <div id="content">

            <p>

                <?php
                $m = myprojMongoSingleton::getMongoCon();
                $db = $m->admin;
                $collection = $db->inventory;
                $cur = $collection->find();
                echo '<table border="0.2" id="tableid">
            <th>title</th>
            <th>Description</th>
            <th>weight</th>
            <th>color</th>
            <th>image</th>
            <th>parent</th>
            <th>mrp</th>
            <th>quantity</th>
            <th>Rating</th>';

                foreach ($cur as $value) {
                    $idp = $value['_id'] . '';

                    echo '<tr><td>' . $value['title'] . '</td>';
                    echo '<td>' . $value['description'] . '</td>';
                    echo '<td>' . $value['details']['weight'] . '</td>';
                    echo '<td>' . $value['details']['color'] . '</td>';
                    if (isset($value['imgname'])) {
                        echo '<td><img src="../img/upload/' . $value['imgname'] . '" width="150px" height="150px">' . '</td>';
                    } else {
                        echo '<td>' . 'Not available' . '</td>';
                    }

                    echo '<td>' . $value['path'] . '</td>';
                    echo '<td>' . $value['pricing']['rupee'] . '</td>';
                    echo '<td>' . $value['quantity'] . '</td>';
                    echo '<td>' . $value['rating'] . '</td>';
                    echo '<td>'
                    ?><a href="magic/editproduct.php?id=<?php echo $idp ?>" > edit </a>

                    <a href="#" onclick="confirmDelete('<?php echo
                   $idp
                    ?>')"> Delete</a>
                    <?php
                }
                 }  else {
     echo 'you are not authorised login first';
     exit();
} ?>