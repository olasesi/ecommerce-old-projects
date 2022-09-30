<?php
date_default_timezone_set('UTC');
session_start();


define ('GEN_WEBSITE', 'https://basicecommerce.herokuapp.com');	//http://www.electronicsmobilemasterusa.com



	define("Conn_error","could not connect to server at this time"); // all of the rest below may be defined later
	define("db_conn_error","<div id='oops'>
							<h1>We are sorry</h1>
							<h3>Data could not be fetched at this time</h3>
							</div>
							");
	
	//connecting to server
	$connect=mysqli_connect("us-cdbr-east-06.cleardb.net","b891234191848a","6e89cd66","heroku_27610844d4fb5fa");		//1wT%qw..E5
	//localhost - us-cdbr-east-06.cleardb.net
	//root - b891234191848a
	//gen_shopelect - heroku_27610844d4fb5fa
	//password - 6e89cd66
	$data_select=mysqli_select_db($connect,"heroku_27610844d4fb5fa") or die(db_conn_error);		//maximum execution time exceeded on this line
