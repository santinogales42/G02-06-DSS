<?php $__env->startSection('content'); ?>
<div class="container mt-5">
<a href="<?php echo e(url('/adminjugadores')); ?>" class="btn btn-secondary">Volver</a>
            
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h1 class="mb-0">Editar Jugador</h1>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('jugadores.actualizar', $jugador->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo e($jugador->nombre); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="posicion" class="form-label">Posición:</label>
                        <input type="text" class="form-control" id="posicion" name="posicion" value="<?php echo e($jugador->posicion); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nacionalidad" class="form-label">Nacionalidad:</label>
                        <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" value="<?php echo e($jugador->nacionalidad); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edad" class="form-label">Edad:</label>
                        <input type="number" class="form-control" id="edad" name="edad" value="<?php echo e($jugador->edad); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="equipo_id" class="form-label">Equipo:</label>
                        <select class="form-select" id="equipo_id" name="equipo_id">
                            <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($equipo->id); ?>" <?php echo e($equipo->id == $jugador->equipo_id ? 'selected' : ''); ?>><?php echo e($equipo->nombre); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                    <label for="foto" class="form-label">Foto:</label>
                     <input type="text" class="form-control" id="foto" name="foto" value="<?php echo e($jugador->foto); ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="biografia" class="form-label">Biografía:</label>
                    <textarea class="form-control" id="biografia" name="biografia" rows="4"><?php echo e($jugador->biografia); ?></textarea>
                </div>

                <h2 class="mb-3">Estadísticas</h2>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="goles" class="form-label">Goles:</label>
                        <input type="number" class="form-control" id="goles" name="goles" value="<?php echo e($jugador->estadisticas->goles ?? 0); ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="asistencias" class="form-label">Asistencias:</label>
                        <input type="number" class="form-control" id="asistencias" name="asistencias" value="<?php echo e($jugador->estadisticas->asistencias ?? 0); ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="amarillas" class="form-label">Amarillas:</label>
                        <input type="number" the form-control" id="amarillas" name="amarillas" value="<?php echo e($jugador->estadisticas->amarillas ?? 0); ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="rojas" class="form-label">Rojas:</label>
                        <input type="number" class="form-control" id="rojas" name="rojas" value="<?php echo e($jugador->estadisticas->rojas ?? 0); ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Jugador</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/editar.blade.php ENDPATH**/ ?>