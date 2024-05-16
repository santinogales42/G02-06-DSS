<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="tarjeta">
                <div class="encabezado-tarjeta-usuarios">¿Desea cerrar sesión?</div>

                <div class="card-body">
                    <p>Hasta la próxima, <?php echo e(Session::get('userName')); ?></p>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group d-flex justify-content-between">
                            <a href="<?php echo e(route('home')); ?>" class="btn boton-cancelar">Cancelar</a>
                            <button type="submit" class="btn boton-inicio">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/logout/logout.blade.php ENDPATH**/ ?>