<?php
    $css_default = [
        "styles/style.css"
    ];
    $css = isset($css)?array_merge($css_default, $css):$css_default;
    $title = isset($title)?$title:"Helpdesk";
?>
    <title><?= $title ?></title>
    <?php foreach($css as $c): ?>
    <link rel="stylesheet" href="<?= $c ?>">
    <?php endforeach; ?>