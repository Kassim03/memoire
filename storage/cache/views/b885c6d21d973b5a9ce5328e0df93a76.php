<?php $__env->startSection('title', 'Créer un(e) Produit'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1><?php echo $__env->yieldContent('title'); ?></h1>

    <form action="/produits/store" method="POST">
        <?php echo csrf_field(); ?>

        <div class='form-group'>
    <label for='nom'>Nom</label>
    <input type='text' name='nom' id='nom' class='form-control' value='<?php echo e(old('nom')); ?>'>
</div>
<div class='form-group'>
    <label for='prix'>Prix</label>
    <input type='text' name='prix' id='prix' class='form-control' value='<?php echo e(old('prix')); ?>'>
</div>
<div class='form-group'>
    <label for='stock'>Stock</label>
    <input type='number' name='stock' id='stock' class='form-control' value='<?php echo e(old('stock')); ?>'>
</div>
<div class='form-group'>
    <label for='categorie_id'>Categorie id</label>
    <input type='number' name='categorie_id' id='categorie_id' class='form-control' value='<?php echo e(old('categorie_id')); ?>'>
</div>
<div class='form-group'>
    <label for='fournisseur_id'>Fournisseur id</label>
    <input type='number' name='fournisseur_id' id='fournisseur_id' class='form-control' value='<?php echo e(old('fournisseur_id')); ?>'>
</div>
<div class='form-group'>
    <label for='client_favori_id'>Client favori id</label>
    <input type='number' name='client_favori_id' id='client_favori_id' class='form-control' value='<?php echo e(old('client_favori_id')); ?>'>
</div>


        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="<?php echo e(route('produits.index')); ?>" class="btn btn-secondary">Annuler</a>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/wwn-0x5000c5008073af77-part1/STORM_FRAMEWORK/usage/tests/storm/Views/Produits/create.blade.php ENDPATH**/ ?>