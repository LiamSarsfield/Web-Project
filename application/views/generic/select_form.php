<?php if (isset($_SESSION["{$table_name}_add_uris"])) {
    $uri_strings = implode(",", $_SESSION["{$table_name}_add_uris"]);
    ?> <a href="<?php echo site_url("functions/add/{$table_name}/$uri_strings/") ?>" class="select_back_button">
        <div class="button">Back</div>
    </a>
<?php }
echo $table;