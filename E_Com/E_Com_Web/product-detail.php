<!-- Header file include -->
<?php 
  include_once("partials-user-front-end/user-header.php");
?>

  <!-- Product Details -->
  <?php 
    // check product id is set or not 
    if(isset($_GET['pid']))
    {
        // id is set 
        $pid=$_GET['pid'];
        ?>

        <!-- Categories and Product Quickview -->
      <section class="container p-4">
        <div class="container-80">
          <div class="main-content-table"> 
            <h5 class="p-2">Category</h5>      
            <table class="table table-hover table-bordered">
              <tbody>
                <?php 
                  // Fetch Data from DB
                  $sql_category = "select * from tbl_categories";
                  // Execute SQL Query
                  $res_catgory = mysqli_query($conn,$sql_category);
                  // Check Whether We have categories to display or not
                  $count_category = mysqli_num_rows($res_catgory);
                  // Check count is greate zero 
                  if($count_category > 0)
                  {
                    // We have categories 
                    // Display category data
                    while($row_category=mysqli_fetch_assoc($res_catgory))
                    {
                      ?>
                        <tr>
                          <td>
                            <a href="<?php echo SITEURL; ?>category-products.php?id=<?php echo $row_category['cat_id']; ?>" class="tbl-a-style-remove">
                              <?php echo $row_category['cat_title']; ?>
                            </a>
                          </td> 
                          </tr>
                      <?php
                    }
                    
                  }
                  else
                  {
                    // We not have category
                    echo "<tr><td class='error text-center'>Categories not found</td></tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>


        <div class="container mt-5">
            <div class="row">
              <div class="col-md-6">
                <?php 
                  // Fetch Product
                  $sql_product = "select * from tbl_products where product_id=$pid";
                  // Execute SQL Query
                  $res_product = mysqli_query($conn,$sql_product);
                  // Count products
                  $count_product = mysqli_num_rows($res_product);
                  // Check Products are available or not
                  if($count_product == 1)
                  {
                    // Products are available for display
                    while($row_product=mysqli_fetch_assoc($res_product))
                    {

                        // Image Display 
                        // Check Whether image is available or not
                        if($row_product['product_image']!="")
                        {
                          // Image is available
                          // Display an image
                          ?>
                              <a href="#">
                                <img src="<?php echo SITEURL; ?>images/product_images/<?php echo $row_product['product_image']; ?>" alt="Product Image" class="product-img"/>
                              </a>
                          <?php
                        }
                          else
                          {
                            // Image is not availble
                            // Dispaly an error message
                            echo "<p class='error text-center'>Image is not found!</p>";
                          }
                          ?>
                          <br><br>
                          <a href="<?php SITEURL; ?>manage-cart.php?pid=<?php echo $row_product['product_id']; ?>" class="btn btn-primary">Add to cart</a>
              </div>
                          <div class="col-md-6 product-detail-data">
                          <p style="color:rgb(0, 77, 153); font-size: 1.2em;"><?php echo $row_product['product_title'] ?></p>
                          <i class="fa-sharp fa-solid fa-indian-rupee-sign">
                            <span><?php echo $row_product['product_price'] ?></span>
                          </i>
                          
                          <hr/>
                          <p class="font-weight-bold" style="color:rgb(51, 119, 255);">Description:</p>
                          <p><?php echo $row_product['product_description'] ?></p>
                          <?php
                    }
                  }
                ?>
              </div>
            </div>
            <div class="product-div-review">
              <hr>
              <!-- Reviews -->
              <p style="color:rgb(51, 119, 255);">Reviews</p>
            </div>
         </div>
      </section>

      <?php
    }
    else
    {
      // product id is not set so display an error
      echo "<div class='text-center error'>Product not Found</div>";
    }
  ?>

<!-- Include Footer Section -->
<?php 
  include_once("partials-user-front-end/user-footer.php");
?>