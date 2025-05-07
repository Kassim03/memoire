<?php $__env->startSection('title', 'Créer un(e) Note'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1><?php echo $__env->yieldContent('title'); ?></h1>

    <form action="/notes/store" method="POST">
        <?php echo csrf_field(); ?>

        <div class='form-group'>
    <label for='note'>Note</label>
    <input type='number' name='note' id='note' class='form-control' value='<?php echo e(old('note')); ?>'>
</div>
<div class='form-group'>
    <label for='description'>Description</label>
    <textarea name='description' id='description' class='form-control'><?php echo e(old('description')); ?></textarea>
</div>


        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="<?php echo e(route('notes.index')); ?>" class="btn btn-secondary">Annuler</a>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/wwn-0x5000c5008073af77-part1/STORM_FRAMEWORK/usage/tests/storm/Views/Notes/create.blade.php ENDPATH**/ ?>