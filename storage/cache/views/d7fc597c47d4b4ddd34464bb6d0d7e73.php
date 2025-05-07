<?php $__env->startSection('title', 'Créer un(e) Tach'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1><?php echo $__env->yieldContent('title'); ?></h1>

    <form action="/taches/store" method="POST">
        <?php echo csrf_field(); ?>

        <div class='form-group'>
    <label for='id_tache'>Id tache</label>
    <input type='number' 
           name='id_tache' 
           id='id_tache' 
           class='form-control'
           value='<?php echo e(old('id_tache')); ?>'>
</div>
<div class='form-group'>
    <label for='nom'>Nom</label>
    <input type='text' 
           name='nom' 
           id='nom' 
           class='form-control'
           value='<?php echo e(old('nom')); ?>'>
</div>
<div class='form-group'>
    <label for='description'>Description</label>
    <input type='textarea' 
           name='description' 
           id='description' 
           class='form-control'
           value='<?php echo e(old('description')); ?>'>
</div>
<div class='form-group'>
    <label for='id_user'>Id user</label>
    <input type='number' 
           name='id_user' 
           id='id_user' 
           class='form-control'
           value='<?php echo e(old('id_user')); ?>'>
</div>
<div class='form-group'>
    <label for='mig'>Mig</label>
    <input type='number' 
           name='mig' 
           id='mig' 
           class='form-control'
           value='<?php echo e(old('mig')); ?>'>
</div>


        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="<?php echo e(route('taches.index')); ?>" class="btn btn-secondary">Annuler</a>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/wwn-0x5000c5008073af77-part1/STORM_FRAMEWORK/usage/tests/storm/Views/Taches/create.blade.php ENDPATH**/ ?>