<?php $__env->startSection('title', 'Mensajes recibidos'); ?>

<?php $__env->startSection('content'); ?>

<a href="<?php echo e(route('admin.index')); ?>" class="btn boton-flecha">
    <i class="fa-solid fa-arrow-left-long fa-2xl"></i> <!-- Ícono de flecha -->
</a>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="tarjeta">
                <div class="encabezado-tarjeta-usuarios">
                   Mensajes recibidos
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php $__empty_1 = true; $__currentLoopData = $mensajes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mensaje): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="list-group-item"><?php echo e($mensaje); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="list-group-item">No hay mensajes recibidos</li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="card-footer">
                    <form action="<?php echo e(route('limpiarMensajes')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn boton-limpiar-mensajes">Limpiar mensajes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/admin/mensajes.blade.php ENDPATH**/ ?>