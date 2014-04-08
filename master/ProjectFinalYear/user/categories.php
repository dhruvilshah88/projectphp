<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>wtwt</title><style>

            #blockitems a{
                color:black;
                text-decoration: none;
            }
            #blockitems a:visited{
                color:black;
            }
            #blockitems ul li {
                margin:19px;
                box-shadow: 0px 1px 5px rgba(0,0,0,0.4);
            }

            #blockitems ul li:hover{

            }
            #blockitems ul li{
                display: inline-block;
                width:230px;
                height:230px;
                background-repeat: no-repeat;
                background-position: center;


            }
            #blockitems ul li:hover > #textblock{
                text-indent: 0px;
                text-align: center;
                opacity: 1;
                background-color: white
            }
            #blockitems ul{
                width:65%;
                margin:10px auto;
            }
            #textblock{
                text-indent: -100000px;
                transition: text-indent 0.4s;
                padding-top:10px;
                font-weight: bold;
                opacity:1;
                color:black;
                transition: text-indent 0.35s;
                -moz-transition: text-indent 0.35s;
                -webkit-transition: text-indent 0.35s;

            }
        </style>
    </head>
    <body>
        <?php
        include_once '../user/magic/getproducts.php';
        include_once '../admin/magic/connection/mongoobject.php';
        if (!isset($_REQUEST['cat']) && !isset($_REQUEST['gen'])) {
            header("Location:main.php");
        } elseif (!isset($_REQUEST['cat'])) {
            $gen = $_REQUEST['gen'];
            $query = array("parent.primary" => $gen);
        } elseif (!isset($_REQUEST['gen'])) {
             $cat = $_REQUEST['cat'];
              $query = array("parent.secondary" => $cat);
        } else {
            $cat = $_REQUEST['cat'];
            $gen = $_REQUEST['gen'];
            echo $gen . "->" . $cat;
            $query = array("parent.primary" => $gen, "parent.secondary" => $cat);
        }

        $cursor = getprod::getfromquery("inventory", $query);
    //    $cursor = getprod::getfromquery("inventory", $query)->limit(30);

        echo '<div id="blockitems"> <ul>';



        foreach ($cursor as $value) {

            echo '<a href="viewproduct.php?item=' . $value['_id'] . '">';
            ?><li style='background-image: url("../img/upload/<?php echo $value['imgname'] ?>")'<?php
            echo '</a><div id="textblock">Title: ' . $value['title'] . '<p>Price: ' . $value['pricing']['rupee'] .
            '</div></li>';
        }
        echo '</ul></div>';
        ?>
</body>
</html>
