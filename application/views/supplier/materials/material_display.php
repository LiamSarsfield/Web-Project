<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Materials</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>/assests/CSS/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript"src="<?php echo base_url(); ?>/assests/script/navs.js"></script>
</head>

<body>

<h1>MATERIALS</h1>
<br>
<section>
    <table style="width:60%; margin-left:20%;">
  <tr>
    <th>Name</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Add</th>
  </tr>
  <tr>
    <td>Socket 1</td>
    <td> <select name="amount" class="w3-input w3-padding-16">
        <option selected="selected" value="One">1</option>
        <option value="Two">2</option>
        <option value="Three">3</option>
        <option value="Four">4</option>
        <option value="Five">5</option>
        <option value="Six">6</option>
        <option value="Seven">7</option>
        <option value="Eight">8</option>
        <option value="Nine">9</option>
        <option value="Ten">10</option></td>
    <td>600</td>
    <td><input type="checkbox" name="amount" value="Add"></td>
  </tr>
  <tr>
    <td>Socket 2</td>
    <td> <select name="amount" class="w3-input w3-padding-16">
        <option selected="selected" value="One">1</option>
        <option value="Two">2</option>
        <option value="Three">3</option>
        <option value="Four">4</option>
        <option value="Five">5</option>
        <option value="Six">6</option>
        <option value="Seven">7</option>
        <option value="Eight">8</option>
        <option value="Nine">9</option>
        <option value="Ten">10</option></td>
    <td>400</td>
    <td><input type="checkbox" name="amount" value="Add"></td>
  </tr>
  <tr>
    <td>Socket 3</td>
    <td> <select name="amount" class="w3-input w3-padding-16">
        <option selected="selected" value="One">1</option>
        <option value="Two">2</option>
        <option value="Three">3</option>
        <option value="Four">4</option>
        <option value="Five">5</option>
        <option value="Six">6</option>
        <option value="Seven">7</option>
        <option value="Eight">8</option>
        <option value="Nine">9</option>
        <option value="Ten">10</option></td>
    <td>1000</td>
    <td><input type="checkbox" name="amount" value="Add"></td>
  </tr>
</table>
<div class="pagination">
<p>1.2.3.4</p>
</div>
<br/>
<button style="margin-left:47%;" id="submit" class="w3-button w3-light-grey w3-padding-large" type="submit">
    <i class="fa fa-paper-plane"></i> Submit
    </button>

  </section>

<footer style=" margin-left:20%;">
  <p>Copyright © 2018 Website by Dream Team </p>
</footer>


</body>
</html>