<?php if (isset($_SESSION["{$table_name}_add_uris"])) {
    $uri_strings = implode(",", $_SESSION["{$table_name}_add_uris"]);
    ?> <a href="<?php echo site_url("functions/add/{$table_name}/$uri_strings/") ?>" class="select_back_button">
        <div class="button">Back</div>
    </a>
<?php }
?>
<?php if (!empty($selected_data_rows)) { ?>
    <div class="table_select_basket_info">
        <?php foreach ($selected_data_rows as $data_row) { ?>
            <p><?php echo str_replace("Id", "ID", ucwords(str_replace("_", " ", $data_row['table_name']))); ?></p>
            <div class="table_select_basket_info"><?php foreach ($data_row as $data_row_col => $data_row_value) {
                    if ($data_row_col !== "table_name") { ?>
                        <p><?php echo str_replace("Id", "ID", ucwords(str_replace("_", " ", $data_row_col))); ?>
                            : <?php echo str_replace("Id", "ID", ucwords(str_replace("_", " ", $data_row_value))); ?></p>
                    <?php }
                } ?>
            </div>
        <?php } ?>
    </div>
<?php }
?>

<?php echo $table;