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
                          
                          <select id="select1" class="form-control validate" name="selectcat">
                          
                          
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
                          <label data-error="wrong" data-success="right" for="defaultForm-pass">Product Category Name</label>
                          <p id="prodCategory"></p>
                        </div>

                        <div class="md-form mb-4">
                          <input type="text" id="proname1" class="form-control validate" value="<?php  echo $row['prod_name']; ?>" name="prodname">
                          <label data-error="wrong" data-success="right" for="defaultForm-pass">Product Name</label>
                          <p id="prodname1"></p>
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
                          <input type="text" id="proprice1" class="form-control validate" value="<?php  echo $row['mon_price']; ?>" name="mprice">
                          <label data-error="wrong" data-success="right" for="defaultForm-pass">Monthly Price</label>
                          <p id="prodprice1"></p>
                        </div>

                        <div class="md-form mb-4">
                          <input type="text" id="proannualprice1" class="form-control validate" value="<?php  echo $row['annual_price']; ?>" name="aprice">
                          <label data-error="wrong" data-success="right" for="defaultForm-pass">Annual Price</label>
                          <p id="prodallprice1"></p>
                        </div>

                        <div class="md-form mb-4">
                          <input type="text" id="prosku1" class="form-control validate" value="<?php  echo $row['sku']; ?>" name="esku">
                          <label data-error="wrong" data-success="right" for="defaultForm-pass">Sku</label>
                          <p id="prodsku1"></p>
                        </div>

                        <?php

                            $js1=json_decode($row['description']);
                                          
                            foreach ($js1 as $key2=>$row2) {


                        ?>
                        
                        <div class="md-form mb-4">
                          <input type="text" id="defaultForm-pass" class="form-control validate" id="<?php  echo $row2; ?>1" value="<?php  echo $row2; ?>" name="<?php  echo $key2; ?>">
                          <label data-error="wrong" data-success="right" for="defaultForm-pass"><?php  echo $key2; ?></label>
                          <p id="<?php  echo $row2; ?>12"></p>
                        </div>

                        <?php

                            }

                        ?>

                      </div>
                      <div class="modal-footer d-flex justify-content-center">
                        <input type="submit" class="btn btn-default" value="Update" id="edit1" name="edit">
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

<script>

var count1=0;
var count2=0;
var count3=0;
var count4=0;
var count5=0;
var count6=0;
var count7=0;
var count8=0;
var count9=0;
var count10=0;



$(document).ready(function(){

  




$("#prodCategory").hide();
$("#prodname1").hide();
$("#produrl").hide();
$("#prodprice1").hide();
$("#prodallprice1").hide();
$("#prodsku1").hide();
$("#webspace1").hide();
$("#bandwidth1").hide();
$("#freedomain1").hide();
$("#ltsupport1").hide();
$("#mailbox1").hide();
//$("#edit1").attr("disabled",true);

// $("#proname").value();

$("#select1").focusout(function() {
$categoryid = $("#select1").val();
if ($categoryid == "") {
    $("#prodCategory1").html("*Select Category");
    $("#prodCategory1").show();
    //$("#edit1").attr("disabled",true);
    $(this).css('border', 'solid 3px red');
    count1=0;
} else {
  
  count1=1;
    //$("#add").attr("disabled",false);
    $("#prodCategory1").hide();
    $(this).css('border', 'solid 3px green');
}
a();
});

$("#proname1").focusout(function() {
$proname = $(this).val();
if ($proname == "") {
    $("#prodname1").html("*Enter Product Name");
    $("#prodname1").show();
    //$("#edit1").attr("disabled",true);
    $(this).css('border', 'solid 3px red');
    count2=0;
}
else if(!$proname.match(/^[a-zA-Z_]+( [a-zA-Z_]+)*(-[0-9]+(?!-)+)*$/))
{
    $("#prodname1").html("*Enter Valid Product Name");
    $("#prodname1").show();
    //$("#edit1").attr("disabled",true);
    $(this).css('border', 'solid 3px red'); 
    count2=0;
}



else {
  
  count2=1;
    //$("#add").attr("disabled",false);
    $("#prodname1").hide();
    $(this).css('border', 'solid 3px green');
}
a();



});

$("#proprice1").focusout(function() {
$proprice = $("#proprice1").val();


if ($proprice == "") {
    $("#prodprice1").html("*Select Product price");
    $("#prodprice1").show();
    //$("#edit1").attr("disabled",true);
    $(this).css('border', 'solid 3px red');
    count3=0;
}  
else if(!$proprice.match(/^[0-9]\d*(\.\d+)?$/))
{
    $("#prodprice1").html("*Select Valid Product price");
    $("#prodprice1").show();
    //$("#edit1").attr("disabled",true);
    $(this).css('border', 'solid 3px red'); 
    count3=0;
}


else {
  
  count3=1;
    //$("#add").attr("disabled",false);
    $("#prodprice1").hide();
    $(this).css('border', 'solid 3px green');
}
a();



});


$("#proannualprice1").focusout(function() {
$proprice = $("#proannualprice1").val();
$proprice1 = $("#proprice1").val();
if ($proprice == "") {
    $("#prodallprice1").html("*Enter Product Annual price");
    $("#prodallprice1").show();
    //$("#edit1").attr("disabled",true);
    $(this).css('border', 'solid 3px red');
    count4=0;
}  
else if(!$proprice.match(/^[0-9]\d*(\.\d+)?$/))
{
    $("#prodallprice1").html("*Enter Valid Product Annual price");
    $("#prodallprice1").show();
    //$("#edit1").attr("disabled",true);
    $(this).css('border', 'solid 3px red'); 
    count4=0;
}

else {
  
  count4=1;
    //$("#add").attr("disabled",false);
    $("#prodallprice1").hide();
    $(this).css('border', 'solid 3px green');
    if($($proprice1 > $proprice)) {
       alert("monthly price cant be more than annual price!!");
       $("#proprice1").val("");
       $("#proprice1").css('border', 'solid 3px red'); 
       count3=0;
    }
}
a();



});


$("#webspace1").focusout(function() {
$proprice = $("#webspace1").val();
if ($proprice == "") {
    $("#webspace12").html("*Select Web Space in G.B");
    $("#webspace12").show();
    //$("#edit1").attr("disabled",true);
    $(this).css('border', 'solid 3px red');
    count5=0;
}  
else if(!$proprice.match(/^[0-9]\d*(\.\d+)?$/))
{
    $("#webspace12").html("*Select Valid Web Space price");
    $("#webspace12").show();
    //$("#edit1").attr("disabled",true);
    $(this).css('border', 'solid 3px red'); 
    count5=0;
}



else {
  
  count5=1;
    //$("#add").attr("disabled",false);
    $("#webspace12").hide();
    $(this).css('border', 'solid 3px green');
}
a();



});



$("#bandwidth1").focusout(function() {
    $proband = $("#bandwidth1").val();
    if ($proband == "") {
        $("#bandwidth12").html("*Enter band Space in G.B");
        $("#bandwidth12").show();
       //$("#edit1").attr("disabled",true);

        $(this).css('border', 'solid 3px red');
        count6=0;
    }  
    else if(!$proband.match(/^[0-9]\d*(\.\d+)?$/))
    {
        $("#bandwidth12").html("*Enter Valid band Space");
        $("#bandwidth12").show();
       //$("#edit1").attr("disabled",true);

        $(this).css('border', 'solid 3px red'); 
        count6=0;
    }
    else if($proband<.5)
    {
        $("#bandwidth12").html("*Enter Valid band Space");
        $("#bandwidth12").show();
       //$("#edit1").attr("disabled",true);

        $(this).css('border', 'solid 3px red'); 
        count6=0;
    }

    
    
    else {
      
      count6=1;
        //$("#add").attr("disabled",false);
        $("#bandwidth12").hide();
        $(this).css('border', 'solid 3px green');
    }
    a();



});

$("#freedomain1").focusout(function() {
    $profree = $("#freedomain1").val();
    $first=$profree.substr(0,1);
    console.log($first);
    
    if($first.match(/^[a-zA-Z]+$/))
    {
       $pattern=/^[a-zA-Z]+$/;
    }
    else if($first.match(/^[0-9]+$/))
    {
       $pattern=/^[0-9]+$/;
    } 
    if ($profree == "") {
        $("#freedomain12").html("*Enter Free Domain as 0 if not required");
        $("#freedomain12").show();
       //$("#edit1").attr("disabled",true);

        $(this).css('border', 'solid 3px red');
        count7=0;
    }  else if(!$profree.match($pattern))
    {
        $("#freedomain12").html("*Enter Valid Free Domain");
        $("#freedomain12").show();
       //$("#edit1").attr("disabled",true);

        $(this).css('border', 'solid 3px red');
        count7=0;
    }
  

    
    
    else {
      
      count7=1;
        //$("#add").attr("disabled",false);
        $("#freedomain12").hide();
        $(this).css('border', 'solid 3px green');
    }
    a();



});


$("#ltsupport1").focusout(function() {
    $prolang = $("#ltsupport1").val();
    if ($prolang == "") {
        $("#ltsupport12").html("*Enter language!!");
        $("#ltsupport12").show();
       //$("#edit1").attr("disabled",true);

        $(this).css('border', 'solid 3px red');
        count8=0;
    } 
    else if(!$prolang.match(/^(((?!\s)+[a-zA-Z0-9]+[a-zA-Z0-9*(+*, )]+))+$/))
    {
        $("#ltsupport12").html("*Enter Valid language");
        $("#ltsupport12").show();
        //$("#edit1").attr("disabled",true);
        $(this).css('border', 'solid 3px red');
        count8=0;
        
    }
    else if($prolang<.5)
    {
        $("#ltsupport12").html("*Enter Valid language");
        $("#ltsupport12").show();
       //$("#edit1").attr("disabled",true);

        $(this).css('border', 'solid 3px red');
        count8=0;
    }
   

    //[a-zA-Z, ]+[a-zA-Z0-9] 
    //([a-zA-Z0-9]+(, [a-zA-z0-9]+)) 
    
    else {
      
      count8=1;
        //$("#add").attr("disabled",false);
        $("#ltsupport12").hide();
        $(this).css('border', 'solid 3px green');
        if($prolang.endsWith(",")) {
          $("#ltsupport12").html("*Enter Valid language");
        $("#ltsupport12").show();
       //$("#edit1").attr("disabled",true);

        $(this).css('border', 'solid 3px red');
        count8=0;
        } else if($prolang.endsWith(" ")) {
          $("#ltsupport12").html("*Enter Valid language");
        $("#ltsupport12").show();
       //$("#edit1").attr("disabled",true);

        $(this).css('border', 'solid 3px red');
        count8=0;
        }
    }
    a();



});



$("#mailbox1").focusout(function() {
    $promail = $("#mailbox1").val();
    $first=$("#mailbox1").val().substr(0,1);
    if($first.match(/^[a-zA-Z]+$/))
    {
       $pattern=/^[a-zA-Z]+$/;
    }
    else if($first.match(/^[0-9]+$/))
    {
       $pattern=/^[0-9]+$/;
    }
    if ($promail == "") {
        $("#mailbox12").html("*Enter Mail");
        $("#mailbox12").show();
       //$("#edit1").attr("disabled",true);

        $(this).css('border', 'solid 3px red');
        count9=0;
    }  
    else if(!$promail.match($pattern))
    {
        $("#mailbox12").html("*Enter Valid Mail box no.");
        $("#mailbox12").show();
       //$("#edit1").attr("disabled",true);

        $(this).css('border', 'solid 3px red'); 
        count9=0;
    }
  
    
    
    else {
      
      count9=1;
        //$("#add").attr("disabled",false);
        $("#mailbox12").hide();
        $(this).css('border', 'solid 3px green');
    }
    a();



});


$("#prosku1").focusout(function() {
    $prosku = $("#prosku1").val();
    $prosku1=$prosku.substr(0,1);
    
    if ($prosku == "") {
        $("#prodsku1").html("*Enter sku");
        $("#prodsku1").show();
       //$("#edit1").attr("disabled",true);

        $(this).css('border', 'solid 3px red');
        count10=0;
    }
    // else if($prosku.length>1 && $prosku.startsWith("#")) {

    //   count10=1;
    //     //$("#add").attr("disabled",false);
    //     $("#prodsku").hide();
    //     $(this).css('border', 'solid 3px green');

    // } else if($prosku.length>1 && $prosku.startsWith("-")) {

    //   count10=1;
    //   //$("#add").attr("disabled",false);
    //   $("#prodsku").hide();
    //   $(this).css('border', 'solid 3px green');

    // }
    else if(!$prosku.match(/^([#-]*[a-zA-z0-9])+[a-zA-Z0-9#-]+$/))
    {
        $("#prodsku1").html("*Enter Valid sku");
        $("#prodsku1").show();
       //$("#edit1").attr("disabled",true);

        $(this).css('border', 'solid 3px red'); 
        count10=0;
        if($prosku.match(/^[a-zA-Z]+$/)) {
          count10=1;
          //$("#add").attr("disabled",false);
          $("#prodsku1").hide();
          $(this).css('border', 'solid 3px green');
        }
    }
  
    
    
    else {
      
      count10=1;
        //$("#add").attr("disabled",false);
        $("#prodsku1").hide();
        $(this).css('border', 'solid 3px green');
    }
    a();



});


// function a() {
//   if((count1+count2+count3+count4+count5+count6+count7+count8+count9+count10)==10) {

//     $("#edit1").attr("disabled",false);

//   }

// }







});


// if(count>=8) {
//   $("#add").attr("disabled",false);
// }

</script>
