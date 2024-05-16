<?php $__env->startSection('content'); ?>
    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <h2>Editar Partido</h2>
        <hr>

        <!-- Mostrar detalles del partido si existe -->
        <h3>Detalles del Partido</h3>
        <form action="<?php echo e(route('admin.partidos.update', ['id' => $partido->id])); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo e($partido->fecha); ?>">
            </div>
            <div class="form-group">
                <label for="hora">Hora:</label>
                <input type="time" name="hora" id="hora" class="form-control" value="<?php echo e($partido->hora); ?>">
            </div>
            <div class="form-group">
                <label for="estadio">Estadio:</label>
                <input type="text" name="estadio" id="estadio" class="form-control" value="<?php echo e($partido->estadio); ?>">
            </div>
            <div class="form-group">
                <label for="resultado">Resultado:</label>
                <input type="text" name="resultado" id="resultado" class="form-control" value="<?php echo e(old('resultado', $partido->resultado)); ?>">
                <?php $__errorArgs = ['resultado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label for="jornada">Jornada:</label>
                <select name="jornada" id="jornada" class="form-control">
                    <?php for($i = 1; $i <= 38; $i++): ?>
                        <option value="<?php echo e($i); ?>" <?php echo e($partido->jornada == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="equipo_local">Equipo Local:</label>
                <select name="equipo_local" id="equipo_local" class="form-control">
                    <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($equipo->id); ?>" <?php echo e($partido->equipo_local_id == $equipo->id ? 'selected' : ''); ?>>
                            <?php echo e($equipo->nombre); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="equipo_visitante">Equipo Visitante:</label>
                <select name="equipo_visitante" id="equipo_visitante" class="form-control">
                    <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($equipo->id); ?>" <?php echo e($partido->equipo_visitante_id == $equipo->id ? 'selected' : ''); ?>>
                            <?php echo e($equipo->nombre); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="d-flex align-items-center mb-3">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
                <form action="<?php echo e(route('admin.partidos.delete', ['id' => $partido->id])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger" style="margin-left: 0.5rem;" onclick="return confirm('¿Estás seguro de eliminar este partido?')">Eliminar</button>
                </form>
                <div>
                    <a href="<?php echo e(route('admin.partidos.index')); ?>" class="btn btn-secondary" style="margin-left: 53rem;">Cancelar</a>
                </div>
            </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/admin/partidos/edit.blade.php ENDPATH**/ ?>