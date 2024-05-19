<?php $__env->startSection('content'); ?>
<div class="container">

    <div class="tarjeta-editar-perfil mb-3">
        <a href="<?php echo e(route('perfilUsuario.edit')); ?>" class="btn boton-editar-perfil">Editar Información</a>
    </div>

    <div class="tarjeta-perfil">
        <div class="encabezado-tarjeta-usuarios">Datos Usuario</div>
        <div class="card-body">
            <p class="card-text"><strong>Nombre:</strong> <?php echo e($user->name); ?></p>
            <p class="card-text"><strong>Correo:</strong> <?php echo e($user->email); ?></p>
            <!-- <p class="card-text"><strong>Fecha de Registro:</strong> <?php echo e($user); ?></p> -->
            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/perfilUsuario/index.blade.php ENDPATH**/ ?>