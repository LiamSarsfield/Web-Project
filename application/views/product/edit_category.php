<main>
    <a href="<?php echo site_url("functions/view/category/$category_info->category_id") ?>">
        <div class="button">Back to View Category</div>
    </a>

    <?php echo form_open(site_url('Category/edit_category/' . $category_info->category_id)) ?>
    <fieldset class="generic_edit_item_form">
        <p>* is required.</p>
        <legend>Edit Customer</legend>
        <p>
            <label for="category_id">Category ID: </label>
            <input name="category_id" class="generic_input" type="text"
                   value="<?php echo $category_info->category_id ?>" readonly="readonly">
        </p>
        <p> <?php echo form_error("name"); ?></p>
        <p>
            <label for="name">Name:*</label>
            <input name="name" class="generic_input" type="text"
                   value="<?php echo (empty(set_value("category"))) ? $category_info->name : set_value("name"); ?>">
        </p>
        <input class="button submit_button" type="submit">
    </fieldset>
    </form>
</main>
</body>
</html>
