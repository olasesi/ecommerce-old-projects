<?php
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;

$per_page = 12; 								// Set how many records do you want to display per page.

$startpoint = ($page * $per_page) - $per_page;
 
$select_products3 = mysqli_query($connect,"SELECT * FROM ".$statement." LIMIT $startpoint, $per_page") or die(db_conn_error);


if(mysqli_num_rows($select_products3) > 0){
												
	while($row_set3 = mysqli_fetch_array($select_products3)){
													
		
									echo '<div class="col-md-4 col-xs-6"><div class="product">
											
											
											<div class="product-img">
												<img src="img/'.$row_set3['file_name_goods'].'" alt="'.$row_set3['goods_name'].'" title="'.$row_set3['goods_name'].'">
												<div class="product-label">
													<!--<span class="sale">-30%</span>-->
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<!--<p class="product-category">Category</p>-->
												<h3 class="product-name"><a href="details.php?product='.$row_set3['goods_id'].'">'.$row_set3['goods_name'].'</a></h3>
												<!--<h4 class="product-price"><del class="product-old-price"></del></h4>-->
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													
													<!--<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>-->
													<button class="quick-view"><a href="details.php?product='.$row_set3['goods_id'].'"><i class="fa fa-eye"></i><span class="tooltipp">Details</span></a></button>';
													
													if(isset($_SESSION['user_id'])){
														
														echo '<button class="add-to-wishlist"><a href="edit.php?product_id='.$row_set3['goods_id'].'"><i class="fa fa-edit"></i><span class="tooltipp">Edit</span></a></button>';
													}
													
													
												echo '	
												</div>
											</div>
											
										</div></div>';



												
													
													
												}
												
												
												
												
												
											}else{
												
												echo '<h4 class="text-center">No result found</h4>';
												
											}
