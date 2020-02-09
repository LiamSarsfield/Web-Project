<a href='<?php echo site_url("dashboard/home"); ?>'>
    <div class='button'>Back to Dashboard</div>
</a>
<section>
    <fieldset style="width:60%; margin-left:20%;">
        <div id="container2">
            <?php echo form_open_multipart(uri_string(), array(
                'autocomplete' => 'off',
            )); ?>
            <h1>EDIT <?php echo strtoupper(str_replace("_", " ", $table_name)); ?></h1>
            <?php
            foreach ($table_info as $table_info_name => $table_cols) {
                echo $table_info_name;
                foreach ($table_cols as $table_col_value => $table_col_name) { ?>
                    <label for='<?php echo (substr($column->label, -2) == "id") ? "{$table_name}[{$column->label}]" : ""; ?>'><?php echo $column->field; ?></label>
                    <input name='<?php echo (substr($column->label, -2) == "id") ? "{$table_name}[{$column->label}]" : ""; ?>'
                           type='text' id='<?php echo $column->label; ?>' required readonly
                           value='<?php echo $column->value; ?>'>
                <?php } ?>

            <?php }
            if ($all_required_foreign_fields_present) {
                foreach ($form_field_data as $form_field) { ?>
                    <?php echo form_error("{$table_name}[{$form_field->label}]"); ?>
                    <p>
                    <?php if ($form_field->label == "image_path") { ?>
                        <label for="<?php echo $form_field->label; ?>">Picture:</label>
                        <input type="file" name="<?php echo $form_field->label; ?>">
                    <?php } else {
                        $data_type = "";
                        if ($form_field->label == "password") {
                            $data_type = "password";
                        } else if ($form_field->data_type == "date") {
                            $data_type = "date";
                        } else if ($form_field->data_type == "text") {
                            $data_type = "text";
                        } ?>
                        <label for='<?php echo "{$table_name}[{$form_field->label}]" ?>'><?php echo $form_field->field;
                            echo ($form_field->is_required) ? "*" : ""; ?></label>
                        <input autocomplete="false" name='<?php echo "{$table_name}[{$form_field->label}]"; ?>'
                               type='<?php echo $data_type; ?>' <?php if ($form_field->is_required) echo "required"; ?>
                               id='<?php echo $form_field->label; ?>'
                               value='<?php echo ($form_field->data_type == "date") ? date("Y-m-d") : set_value("{$table_name}[{$form_field->label}]"); ?>'>
                        </p>
                    <?php } ?>
                <?php } ?>
                <p>
                    <button id="submit" class="w3-button w3-light-grey w3-padding-large" type="submit">
                        <i class="fa fa-paper-plane"></i> Submit
                    </button>
                </p>
            <?php }
            ?>

            </form>
        </div>
    </fieldset>
</section>
