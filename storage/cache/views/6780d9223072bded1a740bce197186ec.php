<?php $__env->startSection('title', 'Créer un(e) Livre'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1><?php echo $__env->yieldContent('title'); ?></h1>

    <form action="/livres/store" method="POST">


        <div class='form-group'>
    <label for='titre'>Titre</label>
    <input type='text' name='titre' id='titre' class='form-control' value='<?php echo e(old('titre')); ?>'>
</div>
<div class='form-group'>
    <label for='auteur_id'>Auteur id</label>
    <input type='number' name='auteur_id' id='auteur_id' class='form-control' value='<?php echo e(old('auteur_id')); ?>'>
</div>
<div class='form-group'>
    <label for='isbn'>Isbn</label>
    <input type='text' name='isbn' id='isbn' class='form-control' value='<?php echo e(old('isbn')); ?>'>
</div>


        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="<?php echo e(route('livres.index')); ?>" class="btn btn-secondary">Annuler</a>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/wwn-0x5000c5008073af77-part1/STORM_FRAMEWORK/usage/tests/storm/Views/Livres/create.blade.php ENDPATH**/ ?>