<?php $__env->startSection('titre', 'Modifier une Course'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Modifier une Course</h1>

    <!-- Formulaire de modification -->
    <form action="<?php echo e(route('courses.update', ['id' => $item->id])); ?>" method="POST">

        <!-- Champ pour le nom de la course -->
        <div class="form-group">
            <label for="name">Nom de la course :</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo e($item->point_depart); ?>">
        </div>

        <!-- Champ pour la description de la course -->
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea id="description" name="description" class="form-control"><?php echo e($item->point_arrivee); ?></textarea>
        </div>

        <!-- Bouton de soumission -->
        <input type="submit" value="Modifier" class="btn btn-primary" name="submit">
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/wwn-0x5000c5008073af77-part1/STORM_FRAMEWORK/usage/tests/storm/Views/Courses/edit.blade.php ENDPATH**/ ?>