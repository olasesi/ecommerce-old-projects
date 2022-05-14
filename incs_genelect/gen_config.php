<?php
date_default_timezone_set('UTC');
session_start();


define ('GEN_WEBSITE', 'http://localhost/ecommerce-old-projects/ecommerce');	//http://www.electronicsmobilemasterusa.com
	


	define("Conn_error","could not connect to server at this time"); // all of the rest below may be defined later
	define("db_conn_error","<div id='oops'>
							<h1>We are sorry</h1>
							<h3>Data could not be fetched at this time</h3>
							</div>
							");
	
	//connecting to server
	$connect=mysqli_connect("localhost","root","","gen_shopelect");
	

	$data_select=mysqli_select_db($connect,"gen_shopelect") or die(db_conn_error);		//maximum execution time exceeded on this line
	
	

	
	
	
?>