<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="tarjeta">
        <div class="encabezado-tarjeta-usuarios">¿Seguro que quieres eliminar '<?php echo e($nombreEquipo); ?>' de tus favoritos?</div>
        <div class="card-body">
            <!-- Formulario para enviar la confirmación de eliminación -->
            <form action="<?php echo e(route('favoritos.delete', $nombreEquipo)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <div class="form-group d-flex justify-content-between">
                    <a href="<?php echo e(route('favoritos.index')); ?>" class="btn boton-cancelar">Cancelar</a>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/favoritos/edit.blade.php ENDPATH**/ ?>