<a href='<?php echo site_url("dashboard/home"); ?>'>
<div class='button'>Back to Dashboard</div>
</a>
<section>
    <fieldset style="width:60%; margin-left:20%;">
        <div id="container2">
            <?php echo form_open_multipart(uri_string(), array(
                'autocomplete' => 'off',
            )); ?>
            <h1>ADD <?php echo strtoupper(str_replace("_", " ", $table_name)); ?></h1>
            <?php
            // $form_labels = assoc. array: key form display label, value = label class with label name and label value
            $foreign_form_field_data ?? array();
            $form_labels = $form_labels ?? array();
            $table_name = $table_name ?? "";
            foreach ($foreign_form_field_data as $foreign_form_field) {
                if ($foreign_form_field->is_multi_table == FALSE) { ?>
                    <?php if (!$foreign_form_field->exists) { ?>
                        <p>
                            <a href='<?php echo site_url("/functions/select/{$table_name}/{$foreign_form_field->name}/"); ?>'>
                                <div class='button'>Select <?php echo $foreign_form_field->field;
                                    echo ($foreign_form_field->can_be_null) ? " (Optional)" : " (Required)"; ?></div>
                            </a></p>
                    <?php } else { ?>
                        <div class="table_view_info">
                            <h3><?php echo $foreign_form_field->field; ?> Selected</h3>
                            <?php foreach ($foreign_form_field->columns as $column) { ?>
                                <p>
                                    <label for='<?php echo (substr($column->label, -2) == "id") ? "{$table_name}[{$column->label}]" : ""; ?>'><?php echo $column->field; ?></label>
                                    <input name='<?php echo (substr($column->label, -2) == "id") ? "{$table_name}[{$column->label}]" : ""; ?>'
                                           type='text' id='<?php echo $column->label; ?>' required readonly
                                           value='<?php echo $column->value; ?>'>
                                </p>
                            <?php } ?>
                            <p>
                                <a href='<?php echo site_url("/functions/select/{$table_name}/{$foreign_form_field->name}/"); ?>'>
                                    <div class='button'>Change <?php echo $foreign_form_field->field; ?></div>
                                </a></p>
                        </div>
                    <?php }
                } else { ?>
                    <div class="table_view_info">
                        <h3><?php echo $foreign_form_field->field; ?></h3>
                        <?php foreach ($foreign_form_field->multi_table_cols as $multi_table_col) {
                            if ($multi_table_col->table != "") { ?>
                                <h4>Currently Selected <?php echo $multi_table_col->field; ?>s</h4>
                            <?php }
                            echo $multi_table_col->table; ?>
                            <p>
                                <a href='<?php echo site_url("/functions/select/{$table_name}/{$multi_table_col->name}/"); ?>'>
                                    <div class='button'>Select <?php echo $multi_table_col->field;
                                        echo ($multi_table_col->can_be_null) ? " (Optional)" : " (Required)"; ?></div>
                                </a></p>
                        <?php } ?>

                        <?php if (!$foreign_form_field->is_multi_table && !$foreign_form_field->can_be_null) {
                            break;
                        } ?>
                    </div>
                <?php }
            }
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
            <?php }
            ?>
            <p>
                <button id="submit" class="w3-button w3-light-grey w3-padding-large" type="submit">
                    <i class="fa fa-paper-plane"></i> Submit
                </button>
            </p>
            </form>
        </div>
    </fieldset>
</section>
