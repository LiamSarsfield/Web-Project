<section>
    <fieldset style="width:60%; margin-left:20%;">
        <div id="container2">
            <?php echo form_open_multipart(uri_string()); ?>
            <h1>ADD CUSTOMER ORDER</h1>
            <?php
            // $form_labels = assoc. array: key form display label, value = label class with label name and label value
            $foreign_form_field_data ?? array();
            $form_labels = $form_labels ?? array();
            $table_name = $table_name ?? "";
            foreach ($foreign_form_field_data as $foreign_form_field) {
                if ($foreign_form_field->exists && $foreign_form_field->is_multi_table == FALSE) {
                    foreach ($foreign_form_field->columns as $column) { ?>
                        <p>
                            <?php echo form_error("{$table_name}[{$column->label}]"); ?>
                            <label for='<?php echo ($column->label != "name") ? "{$table_name}[{$column->label}]" : ""; ?>'><?php echo $column->field; ?></label>
                            <input name='<?php echo ($column->label != "name") ? "{$table_name}[{$column->label}]" : ""; ?>'
                                   type='text' id='<?php echo $column->label; ?>' value='<?php echo $column->value; ?>'>
                        </p>
                    <?php }
                } else { ?>
                    <p><a href='<?php echo site_url("/functions/select/{$table_name}/{$foreign_form_field->name}"); ?>'>
                            <div class='button'>Select <?php echo $foreign_form_field->field;
                                echo ($foreign_form_field->can_be_null) ? " (Optional)" : " (Required)"; ?></div>
                        </a></p>
                    <?php if (!$foreign_form_field->is_multi_table && !$foreign_form_field->can_be_null) {
                        break;
                    }
                }

            }
            foreach ($form_field_data as $form_field) { ?>
                <?php echo form_error("{$table_name}[{$form_field->label}]"); ?>
                <p>
                <?php if ($form_field->label == "image_path") { ?>
                    <label for="<?php echo $form_field->label; ?>">Picture:</label>
                    <input type="file" name="<?php echo $form_field->label; ?>">
                <?php } else { ?>
                    <label for='<?php echo "{$table_name}[{$form_field->label}]" ?>'><?php echo $form_field->field; ?></label>
                    <input name='<?php echo "{$table_name}[{$form_field->label}]"; ?>'
                           type='text' <?php // echo $form_field->is_required; ?>
                           id='<?php echo $form_field->label; ?>' value='<?php // echo $form_field->value; ?>'>
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
