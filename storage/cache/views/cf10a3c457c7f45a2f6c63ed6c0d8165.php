<?php $__env->startSection('title', 'Modifier Etudiant'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1><?php echo $__env->yieldContent('title'); ?></h1>

    <form action="<?php echo e(url('etudiants/update/' .$item->id)); ?>" method="POST">
        <div class='form-group'>
    <label for='name__email'>Name  email</label>
    <input type='text' name='name__email' id='name__email' class='form-control' value='<?php echo e($item->name__email); ?>'>
</div>
<div class='form-group'>
    <label for='age'>Age</label>
    <input type='number' name='age' id='age' class='form-control' value='<?php echo e($item->age); ?>'>
</div>
<div class='form-group'>
    <label for='note'>Note</label>
    <select name="note" id=""  class="form-select" aria-label="Default select example" value='<?php echo e(old('note')); ?>' id='note'>
        <option value="<?php echo e($item->note); ?>" selected>
            <?php echo e($item->notes->note); ?>

        </option>
        <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($note->note != $item->notes->note): ?>
                <option value="<?php echo e($note->id); ?>"><?php echo e($note->note); ?></option>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>


        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="<?php echo e(route('etudiants.index')); ?>" class="btn btn-secondary">Annuler</a>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/wwn-0x5000c5008073af77-part1/STORM_FRAMEWORK/usage/tests/storm/Views/Etudiants/edit.blade.php ENDPATH**/ ?>