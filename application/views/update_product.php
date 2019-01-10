<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Product</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>/assests/CSS/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript"src="<?php echo base_url(); ?>/assests/script/navs.js"></script>
</head>

<body>
<?php
require_once('adminmenu.php');
?>
<!-- Navbar on small screens (Hidden on medium and large screens) -->
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
  <div class="w3-bar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
    <a href="#" class="w3-bar-item w3-button" style="width:25% !important">HOME</a>
    <a href="#about" class="w3-bar-item w3-button" style="width:25% !important">ABOUT</a>
  
    <a href="#contact" class="w3-bar-item w3-button" style="width:25% !important">CONTACT</a>
  </div>
</div>

<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-padding-32 w3-center w3-black" id="home">
        <img src="<?php echo base_url(); ?>/assests/Images/banner2.png" alt="boy" class="w3-image" width="620" height="420">
   
    
  </header>
<br>

<section>
                        <fieldset>

                          <div >
                             
                          <?php echo form_open_multipart('Product/update_product');?>        
                          
                          <h1>UPDATE  PRODUCT</h1>
                          <?php if(isset($error)){echo '<center><span style="color:red" >'.$error.'</span></center>';}?>
                            <p>
                              <label for="category_id">Product Category:*</label>
                              <select name="category_id" type="text" required id="">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                            </select>  
                            </p>                 
                            <p>
                              <label for="product_name">Product Name:*</label>
                              <input name="product_name" type="text" value="<?php echo $query->product_name;?>" required id="name">
                            </p>
                            <p>
                              <label for="product_desc">Product Description</label>
                              <textarea name="product_desc" cols="55" rows="5" id=""><?php echo $query->product_desc;?></textarea>
                            </p>
                            <p>
                              <label for="product_specs">Product Specs</label>
                              <textarea name="product_specs" cols="55" rows="5" id=""><?php echo $query->product_specs;?></textarea>
                            </p>
                            <p>
                              <label for="product_price">Price €</label>
                              <input name="product_price" type="text" value="<?php echo $query->product_price;?>" required id="">
                            </p>
                            <p>
                              <label for="quantity">Quantity</label>
                              <input name="quantity" type="text" value="<?php echo $query->quantity;?>" required id="">
                            </p>
                            <p>
                            <label for="picture">Product Picture:*</label>
                            <input type="file" name="picture" required>
                            
                            </p>
                            <p>
                              <input type="submit" name="submit" id="submit" value="Update">
                            </p>
                            <p>* required field</p>
                          </form>
                            </div>
                        </fieldset>
                      </section>

<footer style=" margin-left:20%;">
  <p>Copyright © 2018 Website by Dream Team </p>
</footer>
</div>

</body>
</html>