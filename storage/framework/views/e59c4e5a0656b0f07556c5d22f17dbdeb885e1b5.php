<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1 style="text-align: center;">Administración de Partidos</h1>

        <div class="mb-3">
            <h2>Crear Nuevo Partido</h2>
            <form action="<?php echo e(isset($partido) ? route('admin.partidos.update', $partido->id) : route('admin.partidos.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php if(isset($partido)): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>

                <?php if(Session::has('success')): ?>
                    <script>
                        window.onload = function() {
                            alert("<?php echo e(Session::get('success')); ?>");
                        };
                    </script>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo e(isset($partido) ? $partido->fecha->format('Y-m-d') : ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="hora" class="form-label">Hora</label>
                    <input type="time" class="form-control" id="hora" name="hora" value="<?php echo e(isset($partido) ? $partido->fecha->format('H:i') : ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="estadio" class="form-label">Estadio</label>
                    <input type="text" class="form-control" id="estadio" name="estadio" value="<?php echo e(isset($partido) ? $partido->estadio : ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="equipo_local" class="form-label">Equipo Local</label>
                    <select class="form-control" id="equipo_local" name="equipo_local" required>
                        <option value="">Selecciona un equipo local</option>
                        <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($equipo->id); ?>" <?php echo e(isset($partido) && $partido->equipo_local == $equipo->id ? 'selected' : ''); ?>><?php echo e($equipo->nombre); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="resultado" class="form-label">Resultado</label>
                    <input type="text" class="form-control" id="resultado" name="resultado" value="<?php echo e(isset($partido) ? $partido->resultado : ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="equipo_visitante" class="form-label">Equipo Visitante</label>
                    <select class="form-control" id="equipo_visitante" name="equipo_visitante" required>
                        <option value="">Selecciona un equipo visitante</option>
                        <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($equipo->id); ?>" <?php echo e(isset($partido) && $partido->equipo_visitante == $equipo->id ? 'selected' : ''); ?>><?php echo e($equipo->nombre); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jornada" class="form-label">Jornada</label>
                    <select class="form-control" id="jornada" name="jornada" required>
                        <option value="">Selecciona la jornada</option>
                        <?php for($i = 1; $i <= 38; $i++): ?>
                            <option value="<?php echo e($i); ?>" <?php echo e(isset($partido) && $partido->jornada == $i ? 'selected' : ''); ?>>Jornada <?php echo e($i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Crear Partido</button>
                <a href="<?php echo e(route('admin.partidos.index')); ?>" class="btn btn-secondary">Volver</a>
            </form>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/admin/partidos/create.blade.php ENDPATH**/ ?>