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
              <form method="POST">
                <h6 class="heading-small text-muted mb-4">Enter Product Details</h6>

                <h6 class="heading-small text-muted mb-4"><u>Note :</u><strong>* means required</strong></h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Select Product Category</label>
                        <!-- <input type="text" id="input-username" class="form-control" placeholder="Username" value="lucky.jesse"> -->
                        <select name="selectcategory" id="select" class="form-control">
                        <option value="" hidden>--Select Category--</option>
                        <?php

                            $productlist=new Product();
                            $productlist1=$productlist->productList($connn);

                            foreach($productlist1 as $key=>$row) {

                              if($row['id']==1) {
                                continue;
                              }
                              if($row['prod_parent_id']==1) {

                                echo '<option value="'.$row['id'].'">'.$row['prod_name'].'</option>';

                              }

                              



                            }

                        ?>
                            
                            
                        </select>
                        <p id="prodCategory"></p>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Enter Product Name</label>
                        <input type="text" name="productname" class="form-control" placeholder="Enter Product Name" id="proname">
                        <p id="prodname"></p>

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Page URL</label>
                        <input type="text" name="pageurl" class="form-control" placeholder="Page URL">
                        <p id="produrl"></p>
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
                        <input type="text" class="form-control" maxlength="15" name="monthlyprice" placeholder="ex: 23" id="proprice">
                        <p id="prodprice"></p>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Enter Annual Price</label>
                        <input type="text" class="form-control" maxlength="15" name="annualprice" placeholder="ex: 23" id="proannualprice">
                        <p id="prodallprice"></p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">SKU</label>
                        <input type="text" class="form-control" name="sku" placeholder="SKU" id="prosku">
                        <p id="prodsku"></p>
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
                        <input type="text" class="form-control" name="webspace" maxlength="5" placeholder="Web Space(in GB)" id="proweb">
                        <h6 class="heading-small text-muted mb-4">Enter 0.5 for 512 MB</h6>
                        <p id="prodweb"></p>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Bandwidth (in GB)</label>
                        <input type="text" class="form-control" name="bandwidth" maxlength="5" placeholder="Bandwidth (in GB)" id="proband">
                        <h6 class="heading-small text-muted mb-4">Enter 0.5 for 512 MB</h6>
                        <p id="prodband"></p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Free Domain</label>
                        <input type="text" class="form-control" name="freedomain" placeholder="Free Domain" id="profree">
                        <h6 class="heading-small text-muted mb-4">Enter 0 if no domain available in this service</h6>
                        <p id="prodfree"></p>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Language / Technology Support</label>
                        <input type="text" class="form-control" name="ltsupport" placeholder="Language / Technology Support" id="prolang">
                        <h6 class="heading-small text-muted mb-4">Separate by (,) Ex: PHP, MySQL, MongoDB</h6>
                        <p id="prodlang"></p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Mailbox</label>
                        <input type="text" class="form-control" name="mailbox" placeholder="Mailbox" id="promail">
                        <h6 class="heading-small text-muted mb-4">Enter Number of mailbox will be provided, enter 0 if none</h6>
                        <p id="prodmail"></p>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                      <input type="submit" id="add" value="Add Product" name="addproduct" class="btn btn-primary">
                    </div>
                </div>
              
            </div>
            </form>

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

        $monthlyprice=(float)$monthlyprice;
        $annualprice=(float)$annualprice;

        if($monthlyprice>=$annualprice) {
          echo '<script>alert("monthly price cant be greater than annual price!!");
          $("#proprice").val("");
          </script>';
        } else {

          $addproduct=new Product();
          $addproduct-> addProduct($connn, $selectcategory, $productname, $pageurl, $monthlyprice, $annualprice, $sku,
          $webspace, $bandwidth, $freedomain, $ltsupport, $mailbox );

        }

        
        //echo '<script>alert("heelllooo");</script>';

    }

?>




<?php
  require 'footer.php';
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
$("#prodname").hide();
$("#produrl").hide();
$("#prodprice").hide();
$("#prodallprice").hide();
$("#prodsku").hide();
$("#prodweb").hide();
$("#prodband").hide();
$("#prodfree").hide();
$("#prodlang").hide();
$("#prodmail").hide();
$("#add").attr("disabled",true);

// $("#proname").value();

$("#select").focusout(function() {
$categoryid = $("#select").val();
if ($categoryid == "") {
    $("#prodCategory").html("*Select Category");
    $("#prodCategory").show();
    $("#add").attr("disabled",true);
    $(this).css('border', 'solid 3px red');
    count1=0;
} else {
  
  count1=1;
    //$("#add").attr("disabled",false);
    $("#prodCategory").hide();
    $(this).css('border', 'solid 3px green');
}
a();
});

$("#proname").focusout(function() {
$proname = $(this).val();
if ($proname == "") {
    $("#prodname").html("*Enter Product Name");
    $("#prodname").show();
    $("#add").attr("disabled",true);
    $(this).css('border', 'solid 3px red');
    count2=0;
}
else if(!$proname.match(/^[a-zA-Z_]+( [a-zA-Z_]+)*(-[0-9]+(?!-)+)*$/))
{
    $("#prodname").html("*Enter Valid Product Name");
    $("#prodname").show();
    $("#add").attr("disabled",true);
    $(this).css('border', 'solid 3px red'); 
    count2=0;
}



else {
  
  count2=1;
    //$("#add").attr("disabled",false);
    $("#prodname").hide();
    $(this).css('border', 'solid 3px green');
}
a();



});

$("#proprice").focusout(function() {
$proprice = $("#proprice").val();


if ($proprice == "") {
    $("#prodprice").html("*Select Product price");
    $("#prodprice").show();
    $("#add").attr("disabled",true);
    $(this).css('border', 'solid 3px red');
    count3=0;
}  
else if(!$proprice.match(/^[0-9]\d*(\.\d+)?$/))
{
    $("#prodprice").html("*Select Valid Product price");
    $("#prodprice").show();
    $("#add").attr("disabled",true);
    $(this).css('border', 'solid 3px red'); 
    count3=0;
}


else {
  
  count3=1;
    //$("#add").attr("disabled",false);
    $("#prodprice").hide();
    $(this).css('border', 'solid 3px green');
}
a();



});


$("#proannualprice").focusout(function() {
$proprice = $("#proannualprice").val();
if ($proprice == "") {
    $("#prodallprice").html("*Enter Product Annual price");
    $("#prodallprice").show();
    $("#add").attr("disabled",true);
    $(this).css('border', 'solid 3px red');
    count4=0;
}  
else if(!$proprice.match(/^[0-9]\d*(\.\d+)?$/))
{
    $("#prodallprice").html("*Enter Valid Product Annual price");
    $("#prodallprice").show();
    $("#add").attr("disabled",true);
    $(this).css('border', 'solid 3px red'); 
    count4=0;
}

else {
  
  count4=1;
    //$("#add").attr("disabled",false);
    $("#prodallprice").hide();
    $(this).css('border', 'solid 3px green');
}
a();



});


$("#proweb").focusout(function() {
$proprice = $("#proweb").val();
if ($proprice == "") {
    $("#prodweb").html("*Select Web Space in G.B");
    $("#prodweb").show();
    $("#add").attr("disabled",true);
    $(this).css('border', 'solid 3px red');
    count5=0;
}  
else if(!$proprice.match(/^[0-9]\d*(\.\d+)?$/))
{
    $("#prodweb").html("*Select Valid Web Space price");
    $("#prodweb").show();
    $("#add").attr("disabled",true);
    $(this).css('border', 'solid 3px red'); 
    count5=0;
}



else {
  
  count5=1;
    //$("#add").attr("disabled",false);
    $("#prodweb").hide();
    $(this).css('border', 'solid 3px green');
}
a();



});



$("#proband").focusout(function() {
    $proband = $("#proband").val();
    if ($proband == "") {
        $("#prodband").html("*Enter band Space in G.B");
        $("#prodband").show();
       $("#add").attr("disabled",true);

        $(this).css('border', 'solid 3px red');
        count6=0;
    }  
    else if(!$proband.match(/^[0-9]\d*(\.\d+)?$/))
    {
        $("#prodband").html("*Enter Valid band Space");
        $("#prodband").show();
       $("#add").attr("disabled",true);

        $(this).css('border', 'solid 3px red'); 
        count6=0;
    }
    else if($proband<.5)
    {
        $("#prodband").html("*Enter Valid band Space");
        $("#prodband").show();
       $("#add").attr("disabled",true);

        $(this).css('border', 'solid 3px red'); 
        count6=0;
    }

    
    
    else {
      
      count6=1;
        //$("#add").attr("disabled",false);
        $("#prodband").hide();
        $(this).css('border', 'solid 3px green');
    }
    a();



});

$("#profree").focusout(function() {
    $profree = $("#profree").val();
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
        $("#prodfree").html("*Enter Free Domain as 0 if not required");
        $("#prodfree").show();
       $("#add").attr("disabled",true);

        $(this).css('border', 'solid 3px red');
        count7=0;
    }  else if(!$profree.match($pattern))
    {
        $("#prodfree").html("*Enter Valid Free Domain");
        $("#prodfree").show();
       $("#add").attr("disabled",true);

        $(this).css('border', 'solid 3px red');
        count7=0;
    }
  

    
    
    else {
      
      count7=1;
        //$("#add").attr("disabled",false);
        $("#prodfree").hide();
        $(this).css('border', 'solid 3px green');
    }
    a();



});


$("#prolang").focusout(function() {
    $prolang = $("#prolang").val();
    if ($prolang == "") {
        $("#prodlang").html("*Enter lang Space in G.B");
        $("#prodlang").show();
       $("#add").attr("disabled",true);

        $(this).css('border', 'solid 3px red');
        count8=0;
    }  
    else if(!$prolang.match(/^[a-zA-Z, ]+[_a-zA-Z]+$/))
    {
        $("#prodlang").html("*Enter Valid language");
        $("#prodlang").show();
       $("#add").attr("disabled",true);

        $(this).css('border', 'solid 3px red'); 
        count8=0;
    }
    else if($prolang<.5)
    {
        $("#prodlang").html("*Enter Valid language");
        $("#prodlang").show();
       $("#add").attr("disabled",true);

        $(this).css('border', 'solid 3px red'); 
        count8=0;
    }
   

    
    
    else {
      
      count8=1;
        //$("#add").attr("disabled",false);
        $("#prodlang").hide();
        $(this).css('border', 'solid 3px green');
    }
    a();



});



$("#promail").focusout(function() {
    $promail = $("#promail").val();
    if ($promail == "") {
        $("#prodmail").html("*Enter Mail");
        $("#prodmail").show();
       $("#add").attr("disabled",true);

        $(this).css('border', 'solid 3px red');
        count9=0;
    }  
    else if(!$promail.match(/^([a-zA-Z0-9])+$/))
    {
        $("#prodmail").html("*Enter Valid Mail box no.");
        $("#prodmail").show();
       $("#add").attr("disabled",true);

        $(this).css('border', 'solid 3px red'); 
        count9=0;
    }
  
    
    
    else {
      
      count9=1;
        //$("#add").attr("disabled",false);
        $("#prodmail").hide();
        $(this).css('border', 'solid 3px green');
    }
    a();



});


$("#prosku").focusout(function() {
    $prosku = $("#prosku").val();
    $prosku1=$prosku.substr(0,1);
    if ($prosku == "") {
        $("#prodsku").html("*Enter sku");
        $("#prodsku").show();
       $("#add").attr("disabled",true);

        $(this).css('border', 'solid 3px red');
        count10=0;
    } else if($prosku.length>1 && $prosku.startsWith("#")) {

      count10=1;
        //$("#add").attr("disabled",false);
        $("#prodsku").hide();
        $(this).css('border', 'solid 3px green');

    } else if($prosku.length>1 && $prosku.startsWith("-")) {

      count10=1;
      //$("#add").attr("disabled",false);
      $("#prodsku").hide();
      $(this).css('border', 'solid 3px green');

    }
    else if(!$prosku.match(/^[a-zA-z0-9]+[a-zA-Z0-9#-]+$/))
    {
        $("#prodsku").html("*Enter Valid sku");
        $("#prodsku").show();
       $("#add").attr("disabled",true);

        $(this).css('border', 'solid 3px red'); 
        count10=0;
    }
  
    
    
    else {
      
      count10=1;
        //$("#add").attr("disabled",false);
        $("#prodsku").hide();
        $(this).css('border', 'solid 3px green');
    }
    a();



});


function a() {
  if((count1+count2+count3+count4+count5+count6+count7+count8+count9+count10)==10) {

    $("#add").attr("disabled",false);

  }

}







});


// if(count>=8) {
//   $("#add").attr("disabled",false);
// }

</script>