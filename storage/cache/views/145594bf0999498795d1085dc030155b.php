<?php $__env->startSection('title', 'Liste des Produits'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1><?php echo $__env->yieldContent('title'); ?></h1>
    
    <a href="<?php echo e(route('produits.create')); ?>" class="btn btn-primary mb-3">
        Créer Produit
    </a>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id produits will</th>
<th>Nom</th>
<th>Prix</th>
<th>Stock</th>
<th>Categorie id</th>
<th>Fournisseur id</th>
<th>Client favori id</th>

                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->id_produits_will); ?></td>
<td><?php echo e($item->nom); ?></td>
<td><?php echo e($item->prix); ?></td>
<td><?php echo e($item->stock); ?></td>
<td><?php echo e($item->categorie_id); ?></td>
<td><?php echo e($item->fournisseur_id); ?></td>
<td><?php echo e($item->client_favori_id); ?></td>
<td>
        <div class='btn-group'>
            <a href="<?php echo e(route('produits.edit', ['id'=>$item->id_produits_will])); ?>" 
               class='btn btn-sm btn-warning'>
                Modifier
            </a>
            <form action="<?php echo e(url('produits/del/' . $item->id_produits_will)); ?>" 
                  method='POST'>
                <button type='submit' 
                        class='btn btn-sm btn-danger'
                        onclick="return confirm('Supprimer cet élément ?')">
                    Supprimer
                </button>
            </form>
        </div>
    </td>
                        <!--<td>
                            <div class="btn-group">
                                <a href="<?php echo e(route('produits.edit', ['id'=>$item->id])); ?>" 
                                   class="btn btn-sm btn-warning">
                                    Modifier
                                </a>
                                <form action="<?php echo e(url('produits/del/' . $item->id)); ?>" 
                                      method="POST">
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Supprimer cet élément ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td> -->
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/wwn-0x5000c5008073af77-part1/STORM_FRAMEWORK/usage/tests/storm/Views/Produits/index.blade.php ENDPATH**/ ?>