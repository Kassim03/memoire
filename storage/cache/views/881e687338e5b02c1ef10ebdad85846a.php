<?php $__env->startSection('titre', 'Liste des Tâches'); ?>

<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('taches.create')); ?>" 
    method="GET"
    >
  <?php echo csrf_field(); ?>
  <button type="submit" class="btn btn-sm btn-info">
      Creer
  </button>
</form>
<div class="container">
    <h1><?php echo $__env->yieldContent('titre'); ?></h1>
    
    

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Utilisateur</th>
                    <th>Migration</th>
                    <th>Créé le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($item->id_tache); ?></td>
                        <td><?php echo e($item->nom); ?></td>
                        <td><?php echo e($item->description, 50); ?></td>
                        <td>
                            <?php if($item->utilisateurs): ?>
                                <?php echo e($item->utilisateurs->prenom); ?> <?php echo e($item->utilisateurs->nom); ?>

                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($item->migrations): ?>
                                <?php echo e($item->migrations->migration); ?>

                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($item->created_at->format('d/m/Y H:i')); ?></td>
                        <td>
                            <div class="btn-group">

                                <!-- Lien pour afficher --> 
                                <a href="<?php echo e(route('taches.show', ['id' => $item->id_tache])); ?>" 
                                   class="btn btn-sm btn-info">
                                    Détails
                                <!-- Lien pour éditer -->
                                <a href="<?php echo e(route('taches.edit', ['id' => $item->id_tache])); ?>" 
                                   class="btn btn-sm btn-warning">
                                    Modifier

                                </a>
                                 
                                <!-- Formulaire de suppression -->
                                <form action="<?php echo e(route('taches.destroy', $item->id_tache)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center">Aucune tâche trouvée</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('base.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/wwn-0x5000c5008073af77-part1/STORM_FRAMEWORK/usage/tests/storm/Views/Taches/index.blade.php ENDPATH**/ ?>