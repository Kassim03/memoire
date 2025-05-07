<?php $__env->startSection('titre', 'Détails de Tach'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1><?php echo $__env->yieldContent('titre'); ?></h1>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
    <th>Id tache</th>
    <td><?php echo e($item->id_tache); ?></td>
</tr>
<tr>
    <th>Nom</th>
    <td><?php echo e($item->nom); ?></td>
</tr>
<tr>
    <th>Description</th>
    <td><?php echo e($item->description); ?></td>
</tr>
<tr>
    <th>Utilisateur</th>
    <td>
        <?php if($item->utilisateurs): ?>
            <?php echo e($item->utilisateurs->prenom); ?> <?php echo e($item->utilisateurs->nom); ?>

        <?php else: ?>
            N/A
        <?php endif; ?>
    </td>
<tr>
    <th>Created at</th>
    <td><?php echo e($item->created_at); ?></td>
</tr>
<tr>
    <th>Updated at</th>
    <td><?php echo e($item->updated_at); ?></td>
</tr>
<tr>
    <th>Mig</th>
    <td><?php echo e($item->mig); ?></td>
</tr>

                </tbody>
            </table>
        </div>
    </div>

    <a href="<?php echo e(route('taches.index')); ?>" class="btn btn-primary">
        Retour à la liste
    </a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/wwn-0x5000c5008073af77-part1/STORM_FRAMEWORK/usage/tests/storm/Views/Taches/show.blade.php ENDPATH**/ ?>