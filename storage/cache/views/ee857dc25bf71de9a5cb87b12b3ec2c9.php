<?php $__env->startSection('title', 'Créer un(e) Etudiant'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1><?php echo $__env->yieldContent('title'); ?></h1>

    <form action="/etudiants/store" method="POST">
        <?php echo csrf_field(); ?>

        <div class='form-group'>
    <label for='name__email'>Name  email</label>
    <input type='text' name='name__email' id='name__email' class='form-control' value='<?php echo e(old('name__email')); ?>'>
</div>
<div class='form-group'>
    <label for='age'>Age</label>
    <input type='number' name='age' id='age' class='form-control' value='<?php echo e(old('age')); ?>'>
</div>
<div class='form-group'>
    <label for='note'>Note</label>
    
    <select name="note" id=""  class="form-select" aria-label="Default select example" value='<?php echo e(old('note')); ?>' id='note'>
        <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($note->id); ?>"><?php echo e($note->note); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
    


        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="<?php echo e(route('etudiants.index')); ?>" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/wwn-0x5000c5008073af77-part1/STORM_FRAMEWORK/usage/tests/storm/Views/Etudiants/create.blade.php ENDPATH**/ ?>