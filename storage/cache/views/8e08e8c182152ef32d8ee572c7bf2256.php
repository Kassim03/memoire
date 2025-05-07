<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/icons/boxicons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/icons/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

</head>
<body>

    <div class="container mt-4">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="<?php echo e(asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
</body>
</html>
<?php /**PATH /mnt/wwn-0x5000c5008073af77-part1/STORM_FRAMEWORK/usage/tests/storm/Views/layouts/app.blade.php ENDPATH**/ ?>