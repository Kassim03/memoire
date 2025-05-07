<?php $__env->startSection('titre', 'Créer un(e) <?php echo e(ucfirst($tableName)); ?>'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Créer un(e) <?php echo e(ucfirst($tableName)); ?></h1>

    <form action="<?php echo e(route(strtolower($tableName) . 'courses.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <!-- Génération dynamique des champs du formulaire -->
        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!in_array($column, ['id', 'created_at', 'updated_at'])): ?>
                <div class="form-group">
                    <label for="<?php echo e($column); ?>"><?php echo e(ucfirst($column)); ?></label>
                    <input type="text" name="<?php echo e($column); ?>" id="<?php echo e($column); ?>" class="form-control">
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/wwn-0x5000c5008073af77-part1/STORM_FRAMEWORK/usage/tests/storm/Views/Courses/create.blade.php ENDPATH**/ ?>