<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Customer</title>
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

          <?php echo form_open('Staff_controller/add_customer');?>        

          <h1>ADD CUSTOMER</h1>
          <?php if(isset($error)){echo '<center><span style="color:red" >'.$error.'</span></center>';}?>
            <p>
                    <label for="first_name">First Name:*</label>
                  <input name="first_name" type="text" required id=""></p>
                  <p>
                    <label for="last_name">Last Name:</label>
                    <input name="last_name" type="text" required id=""></p>
                  </p>
                  <p>
                    <label for="email">Email:*</label>
                    <input name="email" type="email" required id="">
                  </p>
                  <p>
                    <label for="phone">Phone No:*</label>
                    <input name="phone" type="tel" required id="">
                  </p>                 
                  <p>
                    <label for="address1">Address 1:*</label>
                    <input name="address1" type="text" required id="">
                  </p>
                  <p>
                    <label for="address2">Address 2:*</label>
                    <input name="address2" type="text" required id="">
                  </p>
                  <p>
                    <label for="town">Town:*</label>
                    <input name="town" type="text" required id="">
                  </p>
                  <p>
                    <label for="city">City:*</label>
                    <input name="city" type="text" required id="">
                  </p>               
                  <p>
                    <input type="submit" name="submit" id="submit" value="Submit">
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