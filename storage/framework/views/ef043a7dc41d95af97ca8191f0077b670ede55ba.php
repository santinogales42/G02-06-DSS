<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
<div class="alert alert-success">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<div class="row justify-content-center mt-4 ml-4 mr-4">
    <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100" style="background-color: #333333; color: #ffffff;">
            <form action="<?php echo e(route('equipos.agregarFavorito', $equipo->id)); ?>" method="POST">
                <?php if(auth()->guard()->check()): ?>
                <?php if(Auth::user()->equipos->contains($equipo->id)): ?>
                <form action="<?php echo e(route('equipos.eliminarFavorito', $equipo->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-link boton-favorito">
                        <i class="fas fa-heart corazon-lleno"></i>
                    </button>
                </form>
                <?php else: ?>
                <form action="<?php echo e(route('equipos.agregarFavorito', $equipo->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-link boton-favorito">
                        <i class="far fa-heart corazon-vacio"></i>
                    </button>
                </form>
                <?php endif; ?>
                <?php endif; ?>
                <?php echo csrf_field(); ?>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <img src="<?php echo e(asset('images/equipos/' . strtolower(str_replace(' ', '', Str::ascii($equipo->nombre))) . '.png')); ?>" alt="<?php echo e($equipo->nombre); ?>" style="width: 70px; height: 70px; object-fit: contain; margin-bottom: 15px;">
                    <h5><?php echo e($equipo->nombre); ?></h5>
                </div>
                <div class="list-unstyled text-center">
                    <li>Puntos: <?php echo e($equipo->puntos); ?></li>
                    <li>Ganados: <?php echo e($equipo->ganados); ?></li>
                    <li>Goles a favor: <?php echo e($equipo->goles_favor); ?></li>
                </div>
            </form>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/equipos/index.blade.php ENDPATH**/ ?>