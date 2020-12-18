<?php

  session_start();
  require "header.php";
  if(isset($_SESSION['cart'])) {
    $cart=$_SESSION['cart'];

    

    

?>

<div class="table-responsive">
              <table class="table align-items-center table-flush" id="myTable">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Product Name</th>
                    <th scope="col" class="sort" data-sort="budget">Plan in Rs.</th>
                    <!-- <th scope="col" class="sort" data-sort="status">Status</th>
                    <th scope="col">Users</th>
                    <th scope="col" class="sort" data-sort="completion">Completion</th>
                    <th scope="col"></th> -->
                  </tr>
                </thead>
                <tbody class="list">
                <?php
                    foreach($cart as $key=>$value) {
                      ?>

                      <tr>
                      <?php
                      foreach($value as $key2=>$value2) {

                ?>
                  
                    <td>

                    <?php echo $value2;  ?>

                    </td>
                    
                  
                  <?php  
                    }
                    ?>
                    </tr>
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
    
  }
    require "footer.php";

?>