<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?= $title ?></title>
        <meta name="description" content="<?= $description ?>" />
        <meta name="keywords" content="<?= $keywords ?>" />
        <link rel="shortcut icon" href="/media/img/favicon.ico" type="image/x-icon" />

        <link rel="stylesheet" type="text/css" href="/media/css/reset.css">
        <link rel="stylesheet" type="text/css" href="/media/css/style.css">
        <link rel="stylesheet" type="text/css" href="/media/css/slider.css">
        
        <?php foreach ($styles as $style): ?>
            <?= HTML::style($style) ?>
        <?php endforeach ?>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,700&subset=cyrillic,latin' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Slab&subset=cyrillic' rel='stylesheet' type='text/css'>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.js"></script>
    </head>

    <body>
        <?php if (isset($v_body)): ?><?= $v_body ?><?php endif; ?>
        <?php foreach ($scripts as $script): ?>
            <?= HTML::script($script) ?>
        <?php endforeach ?>
    </body>
</html>