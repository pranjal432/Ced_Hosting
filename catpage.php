<?php

    require "header.php";
    require "User.php";
    $connn=new Dbcon();

    if(isset($_GET['id'])) {
        $id=$_GET['id'];
        $cat=new User();
		$cat1=$cat->catDetails($connn, $id); 
		if(isset($cat1)) {

        foreach($cat1 as $key=>$row) {

            echo $row['html'];

        }
  

?>


<div class="tab-prices">
						<div class="container">
							<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
								
								<div id="myTabContent" class="tab-content">
									<div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
										<div class="linux-prices">

										    <?php

												$a=new User();
												$a1=$a->fetchChildId($connn, $id);
												if(isset($a1)) {

												foreach($a1 as $key=>$row) {
													$id1=$row['id'];
													$b=new User();
													$b1=$b->fetchProductDetails($connn, $id1);

													if(isset($b1)) {

													foreach($b1 as $key2=>$row2) {



							

											?>
											<div class="col-md-3 linux-price">
												<div class="linux-top">
												<h4><?php echo $row['prod_name']; ?></h4>
												</div>
												<div class="linux-bottom">
													<h5>Rs. <?php echo $row2['mon_price']; ?>/- <span class="month">per month</span></h5>
													<h5>Rs. <?php echo $row2['annual_price']; ?>/- <span class="month">per year</span></h5>
													<?php $js1=json_decode($row2['description'], true); ?>
													<h6><?php  echo $js1['freedomain']; ?> Domain</h6>
													<?php

													   $js=json_decode($row2['description']);

													   foreach($js as $key3=>$row3) {


													?>
													
													<ul>
													<li><strong><?php  echo $key3; ?> :</strong><?php  echo $row3; ?></li>
													
													<?php
													   }

													?>
													<li><strong>Includes :</strong>  Global CDN</li>
													<li><strong>High Performance :</strong>  Servers</li>
													<li><strong>location</strong> : <img src="images/india.png"></li>
													</ul>
												</div>
												<!-- <a href="cart.php">buy now</a> -->
												<!-- <input type="submit" class="a"> -->
												<a href="" data-toggle="modal" data-target="#modalLoginForm<?php echo $row2['prod_id']; ?>">
                                                   Buy Now</a>
											</div>

											<div class="modal fade" id="modalLoginForm<?php echo $row2['prod_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          
          <input type="email" id="defaultForm-email" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-email">Select plan which you want</label>
        </div>

      </div>
      <center><div class="modal-footer d-flex justify-content-center">
        <a href="" class="a">Buy Now</a>
      </div></center>
    </div>
  </div>
</div>
                                            
											<?php
													}
												}
											}
										}

											?>
											
											
											
											
											<div class="clearfix"></div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					<!-- clients -->
				<div class="clients">
					<div class="container">
						<h3>Some of our satisfied clients include...</h3>
						<ul>
							<li><a href="#"><img src="images/c1.png" title="disney" /></a></li>
							<li><a href="#"><img src="images/c2.png" title="apple" /></a></li>
							<li><a href="#"><img src="images/c3.png" title="microsoft" /></a></li>
							<li><a href="#"><img src="images/c4.png" title="timewarener" /></a></li>
							<li><a href="#"><img src="images/c5.png" title="disney" /></a></li>
							<li><a href="#"><img src="images/c6.png" title="sony" /></a></li>
						</ul>
					</div>
				</div>
       <!-- clients -->
	     <!-- Wordpress Features -->
					<div class="features">
						<div class="container">
							<h3>Wordpress Features</h3>
							<div class="features-grids">
								<div class="col-md-4 features-grid">
									<img src="images/f1.png">
										<h4>Expert Web Design</h4>
										<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
									</div>
									<div class="col-md-4 features-grid">
										<img src="images/f2.png">
										<h4>Expert Web Design</h4>
										<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
									</div>
									<div class="col-md-4 features-grid">
										<img src="images/f3.png">
										<h4>Expert Web Design</h4>
										<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
									</div>
								<div class="clearfix"></div>
							</div>
							<div class="features-grids">
								<div class="col-md-4 features-grid">
									<img src="images/f4.png">
										<h4>Expert Web Design</h4>
										<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
									</div>
									<div class="col-md-4 features-grid">
										<img src="images/f5.png">
										<h4>Expert Web Design</h4>
										<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
									</div>
									<div class="col-md-4 features-grid">
										<img src="images/f6.png">
										<h4>Expert Web Design</h4>
										<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
									</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>

<?php
		} else {
			echo '<script>alert("Please provide existed id to the category page!!");
		window.location="index.php";
		</script>';

		}
	} else {
		echo '<script>alert("Please provide id to the category page!!");
		window.location="index.php";
		</script>';
	}
    

    require "footer.php";

?>