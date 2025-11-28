<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'PHP MVC ISEI' ?></title>
    <!-- CSS General -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/styles.css">
    <?php if(isset($css_specific)): ?>
        <!-- CSS específico de la vista -->
        <link rel="stylesheet" href="<?= BASE_URL ?>/css/<?= $css_specific ?>.css">
    <?php endif; ?>
</head>
<body>
    <div class="container">
        <?php include $content; ?>
    </div>
</body>
</html>
