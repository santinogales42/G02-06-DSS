<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="tarjeta">
                <div class="encabezado-tarjeta-usuarios">Actualizar información</div>

                <div class="card-body">
                    <form action="<?php echo e(route('admin.usuarios.update', $usuario->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="form-group">
                            <label for="name">Nuevo nombre:</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo e($usuario->name); ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Nuevo email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo e($usuario->email); ?>">
                        </div>
                        <div class="form-group">
                            <label for="role">Asignar rol:</label>
                            <select class="form-control" id="role" name="role_id">
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->id); ?>" <?php echo e($usuario->role_id == $role->id ? 'selected' : ''); ?>>
                                        <?php echo e(ucfirst($role->name)); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn boton-actualizar-usuarios btn-outline-light ml-auto">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/admin/usuarios/edit.blade.php ENDPATH**/ ?>