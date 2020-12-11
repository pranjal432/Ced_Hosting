<?php
  require 'header.php';
  require "Product.php";
  require "../Config.php";
  $connn=new Dbcon();

?>

  <!-- Main content -->

    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Add Product</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Products</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div>
          </div>
          
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="col-xl-12 order-xl-1">
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">Enter Product Details</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Select Product Category</label>
                        <!-- <input type="text" id="input-username" class="form-control" placeholder="Username" value="lucky.jesse"> -->
                        <select name="selectcategory" id="" class="form-control">
                        <option value="" selected disabled hidden>--Select Category--</option>
                        <?php

                            $productlist=new Product();
                            $productlist1=$productlist->productList($connn);

                            foreach($productlist1 as $key=>$row) {

                              if($row['id']==1) {
                                continue;
                              }

                              echo '<option value="'.$row['id'].'">'.$row['prod_name'].'</option>';



                            }

                        ?>
                            
                            
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Enter Product Name</label>
                        <input type="text" id="input-email" name="productname" class="form-control" placeholder="Enter Product Name">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Page URL</label>
                        <input type="text" id="input-first-name" name="pageurl" class="form-control" placeholder="Page URL">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Product Description (Enter Product Description Below)</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Enter Monthly Price</label>
                        <input type="text" id="input-username" class="form-control" name="monthlyprice" placeholder="ex: 23">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Enter Annual Price</label>
                        <input type="text" id="input-email" class="form-control" name="annualprice" placeholder="ex: 23">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">SKU</label>
                        <input type="text" id="input-first-name" class="form-control" name="sku" placeholder="SKU">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Features</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Web Space(in GB)</label>
                        <input type="text" id="input-username" class="form-control" name="webspace" placeholder="Web Space(in GB)">
                        <h6 class="heading-small text-muted mb-4">Enter 0.5 for 512 MB</h6>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Bandwidth (in GB)</label>
                        <input type="text" id="input-email" class="form-control" name="bandwidth" placeholder="Bandwidth (in GB)">
                        <h6 class="heading-small text-muted mb-4">Enter 0.5 for 512 MB</h6>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Free Domain</label>
                        <input type="text" id="input-first-name" class="form-control" name="freedomain" placeholder="Free Domain">
                        <h6 class="heading-small text-muted mb-4">Enter 0 if no domain available in this service</h6>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Language / Technology Support</label>
                        <input type="text" id="input-first-name" class="form-control" name="ltsupport" placeholder="Free Domain">
                        <h6 class="heading-small text-muted mb-4">Separate by (,) Ex: PHP, MySQL, MongoDB</h6>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Mailbox</label>
                        <input type="text" id="input-first-name" class="form-control" name="mailbox" placeholder="Free Domain">
                        <h6 class="heading-small text-muted mb-4">Enter Number of mailbox will be provided, enter 0 if none</h6>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                      <input type="submit" value="Add Product" name="addproduct" class="btn btn-primary">
                    </div>
                </div>
              </form>
            </div>

          </div>
        </div>


<?php

    if(isset($_POST['addproduct'])) {

        $selectcategory=isset($_POST['selectcategory'])?$_POST['selectcategory']:'';
        $productname=isset($_POST['productname'])?$_POST['productname']:'';
        $pageurl=isset($_POST['pageurl'])?$_POST['pageurl']:'';
        $monthlyprice=isset($_POST['monthlyprice'])?$_POST['monthlyprice']:'';
        $annualprice=isset($_POST['annualprice'])?$_POST['annualprice']:'';
        $sku=isset($_POST['sku'])?$_POST['sku']:'';
        $webspace=isset($_POST['webspace'])?$_POST['webspace']:'';
        $bandwidth=isset($_POST['bandwidth'])?$_POST['bandwidth']:'';
        $freedomain=isset($_POST['freedomain'])?$_POST['freedomain']:'';
        $ltsupport=isset($_POST['ltsupport'])?$_POST['ltsupport']:'';
        $mailbox=isset($_POST['mailbox'])?$_POST['mailbox']:'';

        $addproduct=new Product();
        $addproduct-> addProduct($connn, $selectcategory, $productname, $pageurl, $monthlyprice, $annualprice, $sku,
        $webspace, $bandwidth, $freedomain, $ltsupport, $mailbox );

    }

?>


<?php
  require 'footer.php';
?>