<?php
session_start();
if(isset($_SESSION['id']))
{
    $universalid=$_SESSION['id'];
}
if(isset($universalid)){
    echo $universalid.' <a href="magic/logout.php">Logout</a>';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="author" content="dhruvil" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		<link rel="stylesheet" href="css/smoothtran.css" type="text/css"/>
		<title>d</title>
	</head>

	<body class="body">
		<header>
			Header
		</header>
			
				<div id="wrapper">
					<ul>
						<li><a href="admin.php">Users</a> </li>
					
					<li><a href="orders.php">Orders </a></li>
			<div id="active">		<li><a href="products.php">Products</a> </li></div>
					<li><a href="smoothtran3.html">About us</a> </li>
					<li><a href="smoothtran4.html">Contact us</a></li>
				</ul>
				</div>
				
		<div id="content">
			<h3>Products</h3>
			<p>
                            <?php
     $server='localhost';
     $username='root';
     $password='';
     $db='classicmodels';
     mysql_connect($server, $username, $password);
     mysql_select_db($db);
     $result=mysql_query("select * from products");
     ?><table border="0.2" id="tableid">
                            <h3><th>check</th><th>productName</th><th>productLine</th>
                               <th>productVendor</th> <th>
                                    productDescription
                                </th><th>quantityInStock</th>
                                <th>buyPrice</th><th>MSRP</th>
                                <th>Operations</th></h3><hr>
         
             <form method="post" action="multi.php?page=products" id="adminform">  
             ejueje
     <?php
         
     while ($row1 = mysql_fetch_assoc($result)) {
         $id1=$row1['productCode'];
         ?>
                 <tr>
                     <td>  <input type="checkbox" name="check[]" value="<?php echo $id1;?>"></td>
                     <td> <?php print $row1['productName']; ?>  
             </td>
             <td>    <?php print $row1['productLine']; ?>   </td>  
             <td>  <?php print $row1['productVendor']; ?>   </td>
             <td><?php print $row1['productDescription']; ?></td>
             <td>     <?php print $row1['quantityInStock']; ?></td>
              <td>   <?php print $row1['buyPrice']; ?></td>
              <td>   <?php print $row1['MSRP']; ?></td>
               <td>  <a href="edit.php?id=<?php
        echo $id1; ?>&page=products">      edit      </a><a href="delete.php?id=<?php
        echo $id1; ?>&page=products"> delete</a> </td>
         </tr>
      <?php
    
}   
?> 
             </table>
             <input type="submit" value="Delete Selected" id="subadmin">
         </form>
			</p>	
		
			   </div>
	
			
	</body>
</html>
<?php }  else {
     echo 'you are not authorised login first';
     exit();
} ?>