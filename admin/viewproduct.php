<?php


  require 'header.php';
  require "Product.php";
  require "../Config.php";
  $connn=new Dbcon();

?>

<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">View Products</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Products</a></li>
                  <li class="breadcrumb-item active" aria-current="page">View Products</li>
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
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Products Table</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush" id="myTable">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Product Name</th>
                    <th scope="col" class="sort" data-sort="name">Product Category</th>
                    <th scope="col" class="sort" data-sort="budget">Availability</th>
                    <th scope="col" class="sort" data-sort="status">Launch Date</th>
                    <th scope="col">html</th>
                    <th scope="col">websapace</th>
                    <th scope="col">bandwidth</th>
                    <th scope="col">Free domain</th>
                    <th scope="col">Language Support</th>
                    <th scope="col">Mailbox</th>
                    <th scope="col" class="sort" data-sort="completion">Mon Price</th>
                    <th scope="col">Ann Price</th>
                    <th scope="col">Sku</th>
                    <th scope="col">Action1</th>
                    <th scope="col">Action2</th>
                  </tr>
                </thead>
                <tbody class="list">

                <?php
                $prod=new Product();
                $prod1=$prod->createProductTable($connn);

                foreach ($prod1 as $key=>$row) {

                  
                    
                ?>
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        
                        <div class="media-body">
                          <span class="name mb-0 text-sm"><?php  echo $row['prod_name']; ?></span>
                        </div>
                      </div>
                    </th>
                    <td class="budget">
                    <?php  
                       $pid=$row['prod_parent_id'];
                       $pn=new Product();
                       $pn->fetchParentName($connn, $pid);
                    ?>
                    </td>
                    <td>
                      <span class="badge badge-dot mr-4">
                       
                        <span class="status"><?php  
                        if($row['prod_available']==1) {
                            echo "Available";
                        } else {
                            echo "Not Available";
                        }
                        ?></span>
                      </span>
                    </td>
                    <td>
                      <div class="avatar-group">
                      <?php  echo $row['prod_launch_date'];?>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="completion mr-2"><?php  echo $row['html']; ?></span>
                        
                      </div>
                    </td>
                    <?php

                        $js=json_decode($row['description']);
                        
                        foreach ($js as $key1=>$row1) {
                            


                        

                    ?>
                    
                    <td class="budget">
                      <?php  echo $row1; ?>
                    </td>
                    
                    <?php

                    }

                    ?>
                    <td class="budget">
                    <?php  echo $row['mon_price'];?>
                    </td>
                    <td class="budget">
                    <?php  echo $row['annual_price'];?>
                    </td>
                    <td class="budget">
                    <?php  echo $row['sku'];?>
                    </td>
                    <td class="budget">
                      <div class="text-center">
                          <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm<?php echo $row['prod_id']; ?>">
                          Edit</a>
                      </div>
                    </td>
                    <form method="POST">
                        <td class="budget">
                            <input type="hidden" value="<?php echo $row['prod_id']; ?>" name="deleteidfield" class="btn btn-danger btn-md btn-rounded mb-4">
                            <input type="submit" value="Delete" name="delete" class="btn btn-danger btn-md btn-rounded mb-4">
                        </td>
                    </form>
                  </tr>
                  <div class="modal fade" id="modalLoginForm<?php echo $row['prod_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <form method="POST">
                      <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Edit Product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body mx-3">
                      <div class="md-form mb-4">
                          
                          <select id="defaultForm-pass" class="form-control validate" name="selectcat">
                          
                          
                          <?php

                              $ppid=$row['prod_parent_id'];
                              $pi=new Product();
                              $pi1=$pi->fetchParentProductId($connn, $ppid);


                              echo '<option selected hidden>';
                              
                              $pid=$row['prod_parent_id'];
                              $pn=new Product();
                              $pn->fetchParentName($connn, $pid);
                              echo '</option>';

                              

                              

                              $vproductlist=new Product();
                              $vproductlist1=$vproductlist->viewProductsList($connn, $pi1);

                              foreach($vproductlist1 as $key3=>$row3) {
                                $pid1=$row['prod_parent_id'];
                                $pn2=new Product();
                                $pn3=$pn2->fetchParentNameSecond($connn, $pid1);

                                if($row3['prod_name']!=$pn3) {
                                
                            ?>

                               <option value="<?php echo $row3['id']; ?>"><?php echo $row3['prod_name']; ?></option>

                            <?php
                              }
                            }

                          ?>
                          
                          </select>
                          <label data-error="wrong" data-success="right" for="defaultForm-pass">Product Parent Name</label>
                        </div>

                        <div class="md-form mb-4">
                          <input type="text" id="defaultForm-pass" class="form-control validate" value="<?php  echo $row['prod_name']; ?>" name="prodname">
                          <label data-error="wrong" data-success="right" for="defaultForm-pass">Product Name</label>
                        </div>

                        <input type="text" id="defaultForm-pass" class="form-control validate" value="<?php  echo $row['prod_id']; ?>" name="idfield" hidden>

                        <div class="md-form mb-4">
                          <input type="text" id="defaultForm-pass" class="form-control validate" value="<?php  echo $row['html']; ?>" name="prodlink">
                          <label data-error="wrong" data-success="right" for="defaultForm-pass">html</label>
                        </div>

                        <div class="md-form mb-4">
                          
                          <select id="defaultForm-pass" class="form-control validate" name="avail">
                          <?php
                              if($row['prod_available']==1) {
                                  echo '<option value="'.$row['prod_available'].'">Available</option>';
                                  echo '<option value="0">Not Available</option>';
                              } else if($row['prod_available']==0) {
                                echo '<option value="'.$row['prod_available'].'">Not Available</option>';
                                echo '<option value="1">Available</option>';
                              }
                          ?>
                          
                          </select>
                          <label data-error="wrong" data-success="right" for="defaultForm-pass">Product Availability</label>
                        </div>
                        <div class="md-form mb-4">
                          <input type="text" id="defaultForm-pass" class="form-control validate" value="<?php  echo $row['mon_price']; ?>" name="mprice">
                          <label data-error="wrong" data-success="right" for="defaultForm-pass">Monthly Price</label>
                        </div>

                        <div class="md-form mb-4">
                          <input type="text" id="defaultForm-pass" class="form-control validate" value="<?php  echo $row['annual_price']; ?>" name="aprice">
                          <label data-error="wrong" data-success="right" for="defaultForm-pass">Annual Price</label>
                        </div>

                        <div class="md-form mb-4">
                          <input type="text" id="defaultForm-pass" class="form-control validate" value="<?php  echo $row['sku']; ?>" name="esku">
                          <label data-error="wrong" data-success="right" for="defaultForm-pass">Sku</label>
                        </div>

                        <?php

                            $js1=json_decode($row['description']);
                                          
                            foreach ($js1 as $key2=>$row2) {


                        ?>
                        
                        <div class="md-form mb-4">
                          <input type="text" id="defaultForm-pass" class="form-control validate" value="<?php  echo $row2; ?>" name="<?php  echo $key2; ?>">
                          <label data-error="wrong" data-success="right" for="defaultForm-pass"><?php  echo $key2; ?></label>
                        </div>

                        <?php

                            }

                        ?>

                      </div>
                      <div class="modal-footer d-flex justify-content-center">
                        <input type="submit" class="btn btn-default" value="Edit" name="edit">
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                  <?php

                    }

                  ?>
                  
                </tbody>
              </table>
            </div>
            <!-- Card footer -->
            
          </div>
        </div>
      </div>

<?php

    if(isset($_POST['edit'])) {

       $selectcat=isset($_POST['selectcat'])?$_POST['selectcat']:'';
       $idfield=isset($_POST['idfield'])?$_POST['idfield']:'';
       $prodname=isset($_POST['prodname'])?$_POST['prodname']:'';
       $prodlink=isset($_POST['prodlink'])?$_POST['prodlink']:'';
       $avail=isset($_POST['avail'])?$_POST['avail']:'';
       $mprice=isset($_POST['mprice'])?$_POST['mprice']:'';
       $aprice=isset($_POST['aprice'])?$_POST['aprice']:'';
       $esku=isset($_POST['esku'])?$_POST['esku']:'';
       $webspace=isset($_POST['webspace'])?$_POST['webspace']:'';
       $bandwidth=isset($_POST['bandwidth'])?$_POST['bandwidth']:'';
       $freedomain=isset($_POST['freedomain'])?$_POST['freedomain']:'';
       $ltsupport=isset($_POST['ltsupport'])?$_POST['ltsupport']:'';
       $mailbox=isset($_POST['mailbox'])?$_POST['mailbox']:'';

       $editproduct=new Product();
       $editproduct-> editProduct( $connn, $selectcat, $idfield, $prodname, $prodlink, $avail, $mprice,
       $aprice, $esku, $webspace, $bandwidth, $freedomain, $ltsupport, $mailbox );

    }

    if(isset($_POST['delete'])) {
      $deleteidfield=isset($_POST['deleteidfield'])?$_POST['deleteidfield']:'';
      
      $delete=new Product();
      $delete->deleteProduct($connn, $deleteidfield);
      
      
  }


?>



<?php

    require "footer.php";

?>