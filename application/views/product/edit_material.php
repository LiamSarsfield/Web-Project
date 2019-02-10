<main>
    <a href="<?php echo site_url("material/$material_info->material_id") ?>">
        <div class="button">Back to View Material</div>
    </a>

    <?php echo form_open(site_url('Material/edit_material/' . $material_info->material_id)) ?>
    <fieldset class="generic_edit_item_form">
        <p>* is required.</p>
        <legend>Edit Material</legend>
        <div class="table_view_info">
            <h3>Supplier Details</h3>
            <p>
                <label name="" class="generic_item_label">Supplier ID: </label>
                <input name="" class="generic_input" type="text"
                       value="<?php echo $material_info->supplier_id ?>" readonly="readonly">
            </p>
            <p>
                <label name="supplier_name" class="generic_item_label">Supplier Name: </label>
                <input name="supplier_name" class="generic_input" type="text"
                       value="<?php echo $material_info->supplier_name ?>" readonly="readonly">
            </p>
        </div>
        <p>
            <label for="material_id">Material ID: </label>
            <input name="material_id" class="generic_input" type="text"
                   value="<?php echo $material_info->material_id ?>" readonly="readonly">
        </p>
        <p><label name="supplier_id">Change Supplier: </label>
            <select name="supplier_id" class="generic_input">
                <?php foreach ($suppliers as $supplier) { ?>
                    <option value="<?php echo $supplier->supplier_id; ?>"<?php echo ($supplier->supplier_id == $material_info->supplier_id) ? "selected=selected" : ""; ?>><?php echo $supplier->name; ?></option>
                <?php } ?>
            </select>
        </p>
        <p> <?php echo form_error("name"); ?></p>
        <p>
            <label for="name">Name:*</label>
            <input name="name" class="generic_input" type="text"
                   value="<?php echo (empty(set_value("material"))) ? $material_info->name : set_value("name"); ?>">
        </p>
        <p> <?php echo form_error("description"); ?></p>
        <p>
            <label for="description">Description:*</label>
            <input name="description" class="generic_input" type="text"
                   value="<?php echo (empty(set_value("description"))) ? $material_info->description : set_value("description"); ?>">
        </p>
        <p> <?php echo form_error("price"); ?></p>
        <p>
            <label for="price">Price:*</label>
            <input name="price" class="generic_input" type="text"
                   value="<?php echo (empty(set_value("price"))) ? $material_info->price : set_value("price"); ?>">
        </p>
        <p> <?php echo form_error("stock_quantity"); ?></p>
        <p>
            <label for="stock_quantity">Stock Quantity:*</label>
            <input name="stock_quantity" class="generic_input" type="text"
                   value="<?php echo (empty(set_value("stock_quantity"))) ? $material_info->stock_quantity : set_value("stock_quantity"); ?>">
        </p>
        <input class="button submit_button" type="submit">
    </fieldset>
    </form>
</main>
</body>
</html>
