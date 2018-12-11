<html capture-installed="true">
<head>
    <meta charset="utf-8">
    <?php
    $title = $title ?? "";
    ?> <Title><?php echo $title ?></Title>
    <?php
    $css_data = $css_data ?? array();
    foreach ($css_data as $css_style_instance) { ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $css_style_instance ?>">
    <?php } ?>


    <script>
        <?php if (isset($js_data)) {
            foreach ($js_data as $js_script) {
                echo $js_script;
            }
        } ?>
    </script>
</head>