<?php

    class Product {


        function createCategoryTable($connn) {
            $arr=array();
            $sql="SELECT * from tbl_product";
            $result=$connn->con->query($sql);
            if($result->num_rows >0) {
                while($row=$result->fetch_assoc()) {
                   
                    array_push($arr, $row);

                }
                return $arr;
            }

        }

        function productParent($connn, $pp) {

            $arr=array();
            $sql="SELECT * from tbl_product";
            $result=$connn->con->query($sql);
            if($result->num_rows >0) {
                while($row=$result->fetch_assoc()) {

                    array_push($arr, $row);
                }
                return $arr;
            }

        }

        function addSubCategory($connn, $selectedcategory, $subcategory, $link) {

            //echo '<script>alert("helloooooooooo");</script>';
            date_default_timezone_set("Asia/Calcutta");
            $dat=date("Y-m-d h:i:s");

            $sql="INSERT INTO tbl_product (`prod_parent_id`,`prod_name`,`link`,`prod_available`,`prod_launch_date`)
            VALUES ('".$selectedcategory."',
            '".$subcategory."','".$link."',1,'".$dat."')";
            if($connn->con->query($sql)==true) {
                echo '<script>alert("Category added successfully!!");
                window.location="category.php";
                </script>';

            }

        }

        function editSubCategory($connn, $avail, $prodname, $prodlink, $idfield) {

            $sql="UPDATE tbl_product SET `prod_available`='".$avail."' , `prod_name`='".$prodname."' , 
            `link`='".$prodlink."' WHERE `id`='".$idfield."'";
            if($connn->con->query($sql)==true) {
                echo '<script>
                alert("Sub-Category Updated!!");
                window.location="category.php";
                </script>';
            }
        }

        function deleteSubCategory($connn, $deleteidfield) {

            $sql="DELETE from tbl_product WHERE `id`='".$deleteidfield."'";
        
            if($connn->con->query($sql)==true) {
                echo '<script>
                alert("Sub-Category Deleted!!");
                window.location="category.php";
                </script>';
                return true;
            }
        }

        function productList($connn) {
            $arr=array();

            $sql="SELECT * from tbl_product";
            $result=$connn->con->query($sql);
            if($result->num_rows >0) {
                while($row=$result->fetch_assoc()) {
                    array_push($arr, $row);
                }
                return $arr;
            }

        }

        function addProduct($connn, $selectcategory, $productname, $pageurl, $monthlyprice, $annualprice, $sku,
        $webspace, $bandwidth, $freedomain, $ltsupport, $mailbox ) {

            date_default_timezone_set("Asia/Calcutta");
            $dat=date("Y-m-d h:i:s");

            $sql="INSERT INTO tbl_product (`prod_parent_id`,`prod_name`,`prod_available`,`prod_launch_date`,`link`)
             VALUES('".$selectcategory."','".$productname."',1,'".$dat."','".$pageurl."')";

            if($connn->con->query($sql)==true) {
                $lastindex=$connn->con->insert_id;
                
            }
            

            $arr=array("webspace"=>$webspace,"bandwidth"=>$bandwidth,"freedomain"=>$freedomain,
          "ltsupport"=>$ltsupport,"mailbox"=>$mailbox);

           $js=json_encode($arr);
           //echo '<script>alert("'.$js.'");</script>';

           $sql="INSERT INTO tbl_product_description (`prod_id`,`description`,`mon_price`,`annual_price`,`sku`)
            VALUES('".$lastindex."','".$js."','".$monthlyprice."','".$annualprice."','".$sku."')";

            if($connn->con->query($sql)==true) {
                echo '<script>
                alert("Product added successfully!!");
                window.location="viewproduct.php";</script>';
                 
            }
        }

        function createProductTable($connn) {

            $arr=array();
            $sql="SELECT * from tbl_product INNER JOIN tbl_product_description ON tbl_product.id=tbl_product_description.prod_id";
            $result=$connn->con->query($sql);
            if($result->num_rows >0) {
                while($row=$result->fetch_assoc()) {
                   
                    array_push($arr, $row);

                }
                return $arr;
            }

        }

        function fetchParentName($connn, $pid) {
            $sql="SELECT * from tbl_product WHERE `id`='".$pid."'";
            $result=$connn->con->query($sql);
            if($result->num_rows >0) {
                while($row=$result->fetch_assoc()) {
                    echo $row['prod_name'];
                }
            }
        }

        function fetchParentNameSecond($connn, $pid) {
            $sql="SELECT * from tbl_product WHERE `id`='".$pid."'";
            $result=$connn->con->query($sql);
            if($result->num_rows >0) {
                while($row=$result->fetch_assoc()) {
                    return $row['prod_name'];
                }
            }
        }

        function fetchParentProductId($connn, $ppid) {

            $sql="SELECT * from tbl_product WHERE `id`='".$ppid."'";
            $result=$connn->con->query($sql);
            if($result->num_rows >0) {
                while($row=$result->fetch_assoc()) {
                    return $row['prod_parent_id'];
                }
            }
        }

        function viewProductsList($connn, $pi1) {
            $arr=array();
            $sql="SELECT * from tbl_product WHERE `prod_parent_id`='".$pi1."'";
            $result=$connn->con->query($sql);
            if($result->num_rows >0) {
                while($row=$result->fetch_assoc()) {
                    array_push($arr, $row);
                }
                return $arr;
            }

        }

        function editProduct($connn, $selectcat, $idfield, $prodname, $prodlink, $avail, $mprice,
        $aprice, $esku, $webspace, $bandwidth, $freedomain, $ltsupport, $mailbox ) {

            $sql="UPDATE tbl_product SET `prod_parent_id`='".$selectcat."' , `prod_name`='".$prodname."' , 
            `prod_available`='".$avail."' , `link`='".$prodlink."' WHERE `id`='".$idfield."'";
            if($connn->con->query($sql)==true) {
                
            }

            $arr=array("webspace"=>$webspace,"bandwidth"=>$bandwidth,"freedomain"=>$freedomain,
            "ltsupport"=>$ltsupport,"mailbox"=>$mailbox);

            $js=json_encode($arr);

            $sql1="UPDATE tbl_product_description SET `description`='".$js."' , `mon_price`='".$mprice."' , 
            `annual_price`='".$aprice."' , `sku`='".$esku."' WHERE `prod_id`='".$idfield."'";
            if($connn->con->query($sql1)==true) {

                echo '<script>alert("Product Updated!!");
                window.location="viewproduct.php";
                </script>';
                
            }
        }

        function deleteProduct($connn, $deleteidfield) {

            $sql="DELETE from tbl_product WHERE `id`='".$deleteidfield."'";
        
            if($connn->con->query($sql)==true) {
                
            }

            

            $sql1="DELETE from tbl_product_description WHERE `prod_id`='".$deleteidfield."'";
        
            if($connn->con->query($sql1)==true) {
                echo '<script>
                alert("Product Deleted!!");
                window.location="viewproduct.php";
                </script>';
                return true;
            }
            


        }
    }

?>




