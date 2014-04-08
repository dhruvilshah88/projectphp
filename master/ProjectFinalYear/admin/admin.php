<?php
session_start();
if(isset($_SESSION['id']))
{
    $universalid=$_SESSION['id'];
}
if(isset($universalid)){
     echo $universalid.' <a href="magic/logout.php">Logout</a>';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="dhruvil" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0" />
        <link rel="stylesheet" href="css/smoothtran.css" type="text/css"/>
        <title>d</title>
    </head>

    <body class="body">
        <div id="toppart">
            <header>
                <img src="img/products.png">   

            </header>

            <div id="wrapper">
                <ul>
                  <div id="active">    <li><a href="admin.php">Users</a> </li></div>

                  	  <li><a href="orders.php">Orders </a></li>
                  	<li><a href="viewinventory.php">Products</a> </li>
                    <li><a href="smoothtran3.html">About us</a> </li>
                    <li><a href="smoothtran4.html">Contact us</a></li>
                </ul>
            </div>
        </div>	
        <div id="content">

            <p>
            </p></div>
    </body>
</html><?php }  else {
     echo 'you are not authorised login first';
     exit();
} ?>