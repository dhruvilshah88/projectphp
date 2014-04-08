<?php

/**
  $server='localhost';
  $username='root';
  $password='';
  $db='admin';
  mysql_connect($server, $username, $password);
  mysql_select_db($db);

  $address_name=$_REQUEST['address_name'];
  $address_status=$_REQUEST['address_state'];
  $address_zip=$_REQUEST['address_zip'];
  $first_name=$_REQUEST['first_name'];
  $payment_status=$_REQUEST['payment_status'];
  $mc_gross=$_REQUEST['mc_gross'];
  //$payment_date=$_REQUEST['payment_date'];
  $payment_gross=$_REQUEST['payment_gross'];


  mysql_query("INSERT INTO paypal (address_name,address_state,address_zip,first_name,payment_status,mc_gross,payment_gross) values('$address_name','$address_status','$address_zip','$first_name,'$payment_status','$mc_gross','$payment_gross')");
 * */

$server = 'localhost';
$username = 'root';
$password = '';
$db = 'admin';
mysql_connect($server, $username,"root");
mysql_select_db($db);
$result=mysql_query("SELECT * FROM orders");
foreach ($result as $value) {
    print_r($value);
}