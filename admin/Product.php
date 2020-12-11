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

            // $sql="INSERT INTO tbl_product () VALUES ";
        }
    }

?>




<?php
// echo '<tr>
// <th scope="row">
//   <div class="media align-items-center">
//     <a href="#" class="avatar rounded-circle mr-3">
//       <img alt="Image placeholder" src="../assets/img/theme/bootstrap.jpg">
//     </a>
//     <div class="media-body">
//       <span class="name mb-0 text-sm">'.$row['id'].'</span>
//     </div>
//   </div>
// </th>
// <td class="budget">
//   '.$row['prod_parent_id'].'
// </td>
// <td>
//   <span class="badge badge-dot mr-4">
//     <i class="bg-warning"></i>
//     <span class="status">'.$row['prod_name'].'</span>
//   </span>
// </td>
// <td>
//   <div class="avatar-group">
//     <a href="'.$row['link'].'" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
      
//     </a>
    
//   </div>
// </td>
// <td>
//   <div class="d-flex align-items-center">
//     <span class="completion mr-2">'.$row['prod_available'].'</span>
//   </div>
// </td>
// <td>
//   <div class="d-flex align-items-center">
//     <span class="completion mr-2">'.$row['prod_available'].'</span>
//   </div>
// </td>
// <td class="text-right">
//   <div class="dropdown">
//     <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
//       <i class="fas fa-ellipsis-v"></i>
//     </a>
//     <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
//       <a class="dropdown-item" href="#">Action</a>
//       <a class="dropdown-item" href="#">Another action</a>
//       <a class="dropdown-item" href="#">Something else here</a>
//     </div>
//   </div>
// </td>
// </tr>';
?>