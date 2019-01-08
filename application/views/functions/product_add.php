<section>
    <fieldset style="width:60%; margin-left:20%;">
      
      <div id="container2">
      <form action="" method="post" name="form" id="form">
                          <h1>ADD PRODUCT</h1>
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
                              <input name="product_name" type="text" required id="name">
                            </p>
                            <p>
                              <label for="product_desc">Product Description</label>
                              <textarea name="product_desc" cols="55" rows="5" id=""></textarea>
                            </p>
                            <p>
                              <label for="product_spec">Product Specs</label>
                              <textarea name="product_spec" cols="55" rows="5" id=""></textarea>
                            </p>
                            <p>
                              <label for="price">Price €</label>
                              <input name="price" type="text" required id="">
                            </p>
                            <p>
                              <label for="quantity">Quantity</label>
                              <input name="quantity" type="text" required id="">
                            </p>
                            <p>
                            <label for="picture">Product Picture:*</label>
                            <input type="file" name="picture" required>
                            </p>
                            <p>
                              <input type="submit" name="submit" id="submit" value="Submit">
                            </p>
                            <p>* required field</p>
                          </form>
        </div>
    </fieldset>
  </section>
