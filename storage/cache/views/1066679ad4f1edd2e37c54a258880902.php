<?php $__env->startSection('titre', 'Welcome'); ?>

<?php $__env->startSection('content'); ?>
    <div id="sec">
        <h1>Bonjour, Emery  <?php echo e($username); ?>!</h1>
        <p>Ton email est : <?php echo e($email); ?></p>

        <h2>Liste des fruits :</h2>
        <ul>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Liste des fruits
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fruit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               

                        <li><a class="dropdown-item" href="#"><?php echo e($fruit); ?></a></li>

                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            </div>
        </ul>

        <?php if($number > 12): ?>
            <p><?php echo e($number); ?></p>
        <?php else: ?>
            <p>Different</p>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo e(route('user.store')); ?>">
        
            <button type="submit" class="btn btn-success ">
                <i class="fa-solid fa-plus"></i>
        <span class="text">Ajouter des employés</span>

            </button>
            
        </form>
        

        <a href="<?php echo e(route('user.index')); ?>" class="btn btn-secondary mt-3">Aller à la page d'index</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('base.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/wwn-0x5000c5008073af77-part1/STORM_FRAMEWORK/usage/tests/storm/Views/index.blade.php ENDPATH**/ ?>