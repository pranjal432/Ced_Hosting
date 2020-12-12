<?php
    require "header.php";
    require "Product.php";
    require "../Config.php";
    $connn=new Dbcon();

?>



 
      <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Create category</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#"></a>Products</li>
                  <li class="breadcrumb-item active" aria-current="page">Sub-Categories</li>
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
    <div class="col-lg-11 ml-lg-5 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-header bg-transparent pb-5">
              
             <h3 class="text-center">Add Category</h3>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              
              <form role="form" method="POST">

              <div class="form-group">
                  <div class="input-group input-group-merge 
                  input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"></span>
                    </div>
                    <select class="form-control" name="selectcategory" required>
                    <option value="" selected disabled hidden>--Please Select Parent Category--</option>

                    <?php
                      $cat=new Product();
                      $cat1=$cat->createCategoryTable($connn);

                      foreach ($cat1 as $key=>$row) {
                        if($row['id']==1) {

                    
                    
                ?>
                 <option style="height:85px;" value="<?php echo $row['prod_parent_id']; ?>">
                    <?php echo $row['prod_name']; ?></option>
                    <?php
                        }
                      }
                    
                    ?>
                    </select>
                  </div>
                </div>


                <div class="form-group">
                  <div class="input-group input-group-merge 
                  input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"></span>
                    </div>
                    <input class="form-control" pattern="^[a-zA-Z_]+( [a-zA-Z_]+)*$" name="subcategory" 
                    placeholder="Please Enter Sub-Category Name" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge 
                  input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"></span>
                    </div>
                    <input class="form-control" placeholder="Link" type="text" name="link">
                  </div>
                </div>
                
                <div class="text-center">
                  <input type="submit" 
                  class="btn btn-primary mt-4" name="btnaddsubcategory" value="Add Sub Category">
                </div>
              </form>
            </div>
          </div>
        </div>

    
            <!-- Card header -->
            

     
      <div class="row">
        <div class="col">
          <div class="card ">
          <div class="card-header border-0">
              <h3 class="mb-0">Sub-category table</h3>
            </div>
            <div class="table-responsive">
            <table class="table align-items-center table-flush" id="myTable">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Product Id</th>
                    <th scope="col" class="sort" 
                    data-sort="budget">Parent Product Name</th>
                    <th scope="col" class="sort" 
                    data-sort="status">Product Name </th>
                    <th scope="col">Link</th>
                    <th scope="col">Product Availability</th>
                    <th scope="col" class="sort" 
                    data-sort="completion">Product Launch Date</th>
                    <th scope="col">Action1</th>
                    <th scope="col">Action2</th>
                   
                  </tr>
                </thead>
                <tbody class="list">
                <?php
                $cat=new Product();
                $cat1=$cat->createCategoryTable($connn);

                foreach ($cat1 as $key=>$row) {

                  
                  if($row['id']==1) {
                    continue;
                  }
                    
                    
                ?>
                
                  <tr>
                    <th scope="row">
                        <?php echo $row['id']; ?>
                    </th>
                    <td class="budget">
                    <?php 
                    $pp=$row['prod_parent_id'];
                    $productparent=new Product();
                    $productparent1=$productparent->productParent($connn, $pp);

                    foreach($productparent1 as $key=>$row2) {
                      if($row2['id']==1) {
                        echo $row2['prod_name'];
                      }

                    }
                     ?>
                    </td>
                    <td>
                    <?php echo $row['prod_name']; ?>
                     
                    </td>
                    <td>

                    <?php 
                    if ($row['link']=="") {
                        $link="Null";
                    } else {
                        $link=$row['link'];

                    }

                    echo $link;
                    
                    ?>
                      
                    </td>
                    <td>

                    <?php 
                    
                    if($row['prod_available']==1) {
                      echo "Available";

                    } else if($row['prod_available']==0) {
                      echo "Not Available";
                    }
                     ?>
                      
                    </td>
                    <td class="text-left">
                    <?php echo $row['prod_launch_date']; ?>
                    </td>
                    
                    <td>
                    <div class="text-center">
                        <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm<?php echo $row['id']; ?>">
                        Edit</a>
                    </div>
                    </td>
                    <form method="POST">
                    <td>
                    <div class="text-center">

                    
                        <input type="hidden" value="<?php echo $row['id']; ?>" name="deleteidfield" class="btn btn-danger btn-md btn-rounded mb-4">
                        <input type="submit" value="Delete" name="delete" class="btn btn-danger btn-md btn-rounded mb-4">
                    
                        
                    </div>
                    </td>
                    </form>
                  </tr>
                  
                  <div class="modal fade" id="modalLoginForm<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <form method="POST">
                      <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Edit subcategory</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                          <input type="text" id="defaultForm-email" class="form-control validate" value="Hosting" disabled>
                          <label data-error="wrong" data-success="right" for="defaultForm-email">Service</label>
                        </div>

                        <div class="md-form mb-4">
                          <input type="text" id="defaultForm-pass" class="form-control validate" value="<?php  echo $row['prod_name']; ?>" name="prodname">
                          <label data-error="wrong" data-success="right" for="defaultForm-pass">Sub-category Name</label>
                        </div>

                        <input type="text" id="defaultForm-pass" class="form-control validate" value="<?php  echo $row['id']; ?>" name="idfield" hidden>

                        <div class="md-form mb-4">
                          <input type="text" id="defaultForm-pass" class="form-control validate" value="<?php  echo $row['link']; ?>" name="prodlink">
                          <label data-error="wrong" data-success="right" for="defaultForm-pass">Link</label>
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
          </div>
        </div>
      </div>
  </div>
  </div>
  </div>
  </div>

<?php

    if (isset($_POST['btnaddsubcategory'])) {

        $selectedcategory=isset($_POST['selectcategory'])?$_POST['selectcategory']:'';
        $subcategory=isset($_POST['subcategory'])?$_POST['subcategory']:'';
        $link=isset($_POST['link'])?$_POST['link']:'';
        //echo '<script>alert("'.$link.'");</script>';

        $addsubcategory=new Product();
        $addsubcategory->addSubCategory($connn, $selectedcategory, $subcategory, $link);
        
    }

    if(isset($_POST['edit'])) {
        $avail=isset($_POST['avail'])?$_POST['avail']:'';
        $prodname=isset($_POST['prodname'])?$_POST['prodname']:'';
        $prodlink=isset($_POST['prodlink'])?$_POST['prodlink']:'';
        $idfield=isset($_POST['idfield'])?$_POST['idfield']:'';

        $edit=new Product();
        $edit->editSubCategory($connn, $avail, $prodname, $prodlink, $idfield);
    }

    if(isset($_POST['delete'])) {
        $deleteidfield=isset($_POST['deleteidfield'])?$_POST['deleteidfield']:'';
        
        $delete=new Product();
        $delete->deleteSubCategory($connn, $deleteidfield);
        
        
    }

?>


<?php
    require "footer.php";
?>