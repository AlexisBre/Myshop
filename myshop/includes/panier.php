<?php



if(filter_input(INPUT_POST, 'add_to_cart')){
  if(isset($_SESSION['shopping_cart'])){
    $count=count($_SESSION['shopping_cart']);
    $product_ids = array_column($_SESSION['shopping_cart'], 'id');
      if(!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
        $_SESSION['shopping_cart'][$count] = array
    (
      'id' =>filter_input(INPUT_GET, 'id'),
      'name' =>filter_input(INPUT_POST, 'name'),
      'price' =>filter_input(INPUT_POST, 'price'),
      'quantity' =>filter_input(INPUT_POST, 'quantity'),
    );
      }else{
        for($i=0; $i < count($product_ids); $i++){
          if($product_ids[$i] == filter_input(INPUT_GET, 'id')){
            $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
          }
        }
      }

  }else{
    $_SESSION['shopping_cart'][0] = array
    (
      'id' =>filter_input(INPUT_GET, 'id'),
      'name' =>filter_input(INPUT_POST, 'name'),
      'price' =>filter_input(INPUT_POST, 'price'),
      'quantity' =>filter_input(INPUT_POST, 'quantity'),
    );
  }
}

 //removing products from the shopping cart session
 if(filter_input(INPUT_GET,'action'))
 {
      if(filter_input(INPUT_GET,'action') == 'delete')
      {
           //loop through all products in the shopping cart until it matches GET id variable
           foreach($_SESSION['shopping_cart'] as $key => $product)
           {
                if($product['id'] == filter_input(INPUT_GET,'id'))
                {
                     //remove product from the shopping cart when it matches with the GET id
                     unset($_SESSION['shopping_cart'][$key]);
                }
           }
           //reset session array keys so they match with $product_ids numeric array
           $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
      }
 }
function pre_r($array){
  echo "<pre>";
  print_r($array);
  echo "</pre>";
}
// pre_r($_SESSION);
?>

<!DOCTYPE html>
<html>
<body>
  <div class="container" id="product-section">
       <div class="row">
        <div class="searchbar">
            <form method="POST" class="block-search">
                <div class="col-2 col-md-1">
                    <button type="submit" class="btn">
                        <img src="images/search.png" alt="Search icon" class="block-search__search-icon">
                    </button>
                </div>
               <div class="col-4 position-absolute">
                    <input type="search" class="form-control" placeholder="Que cherchez-vous ?" name="postSearch">
                </div>
<!-- </form> -->
            <div id="filter by" class="col-md-4 ">
               <div class=" form col-12 position-relative" id="tri" >
                    <select name="postOrderBy" class=form-select>
                            <option value="id" selected>Tri</option>
                            <option value="name ASC">Ordre alphabetique</option>
                            <option value="name DESC">Ordre alphabetique inversé</option>
                            <option value="price ASC">Prix croissant</option>
                            <option value="price DESC">Prix décroissant</option>
                    </select>
<!--                         <div class="form-actions">
                        <button type="submit" class="btn btn-purple">Valider les filtres</button> -->
                        </div>
                      </div>
               </form>
             </div>
            </div>
        </div>
    <?php

$postOrderBy = "id";
$postSearch="";
$db = mysqli_connect('127.0.0.1', 'root', 'root', 'my_shop', 8889);
$product_ids = array();


if (!empty($_POST))
{
    if(!empty($_POST['postOrderBy']))
    {
    $postOrderBy = $_POST['postOrderBy'];
    }
    else
    {
      $postOrderBy = "id";
    }
    if(!empty($_POST['postSearch']))
    {
    $postSearch = $_POST['postSearch'];
    }
    else
    {
      $postSearch="";
    }
}


$query = 'SELECT * FROM products WHERE name LIKE "%'.$postSearch.'%" OR description LIKE "%'.$postSearch.'%" ORDER BY '.$postOrderBy ;


    $result = mysqli_query($db, $query);
    if ($result){
      if(mysqli_num_rows($result) > 0 ){
        while($product = mysqli_fetch_assoc($result)){
        ?>
        <div  class="products col-md-3 " >
          <form method="POST" action="index.php?action=add&id=<?php echo $product["id"];?>" >

              <div class="card-img-top position-relative" >
               <img src="images/ <?php echo $product['image']; ?> " class="img-responsive" >
              <div  id="product">
               <h4 class="text_article"> <?php echo $product['name']; ?>
               </h4>
               <h4>€<?php echo $product['price']; ?>
               </h4>
               <input type="text" name="quantity" class="form-control" value="1" />
               <input type="hidden" name="name" value="<?php echo $product['name']; ?> " />
               <input type="hidden" name="price" value="<?php echo $product['price']; ?> " />
               <input type="submit" name="add_to_cart" class="btn btn-purple" style="margin-top: 20px" value="Ajouter au Panier" />
              </div>
          </div>
        </form>
      </div>


        <?php
        }
      }
    }

    ?>
      </div>
    </div>
    <div id="shoppingcart" style="clear:both"></div>
        <br />
        <div class="table-responsive">
        <table class="table">
            <tr><th colspan="5"><h3>Détails</h3></th></tr>
        <tr>
             <th width="40%">Nom du produit</th>
             <th width="10%">Quantité</th>
             <th width="20%">Prix</th>
             <th width="15%">Total</th>
             <th width="5%">Action</th>
        </tr>
        <?php
        if(!empty($_SESSION['shopping_cart'])):

             $total = 0;

             foreach($_SESSION['shopping_cart'] as $key => $product):
        ?>
        <tr>
           <td><?php echo $product['name']; ?></td>
           <td><?php echo $product['quantity']; ?></td>
           <td>€ <?php echo $product['price']; ?></td>
           <td>€ <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>
           <td>
               <a href="index.php?action=delete&id=<?php echo $product['id']; ?>">
                    <div class="btn-danger">Remove</div>
               </a>
           </td>
        </tr>
        <?php
                  $total = $total + ($product['quantity'] * $product['price']);
             endforeach;
        ?>
        <tr>
             <td colspan="3" align="right">Total</td>
             <td align="right">€ <?php echo number_format($total, 2); ?></td>
             <td></td>
        </tr>
        <tr>
            <!-- Show checkout button only if the shopping cart is not empty -->
            <td colspan="5">
             <?php
                if (isset($_SESSION['shopping_cart'])):
                if (count($_SESSION['shopping_cart']) > 0):
             ?>
                <a href="#checkout" class="button">Checkout</a>
             <?php endif; endif; ?>
            </td>
        </tr>
        <?php
        endif;
        ?>
        </table>
        </div>
</div>
   </div>
</body>
</html>
