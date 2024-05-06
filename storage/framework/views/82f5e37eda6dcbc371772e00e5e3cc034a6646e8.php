<?php $__env->startSection('content'); ?>
<?php if(Session::has('success')): ?>
<script>
    window.onload = function() {
        alert("<?php echo e(Session::get('success')); ?>");
    };
</script>
<?php endif; ?>

<div class="jumbotron jumbotron-fluid" style="background-color: #333333; color: #ffffff;">
    <div class="container-fluid">
        <h1 class="display-4 text-center" style="font-size: 2.5rem;">Administración de Partidos</h1>
    </div>
</div>

<div class="container mt-4" style="margin-bottom: 6rem;">
    <div class="row" style="margin-bottom: 1rem;">
        <div class="col-md-6">
            <select class="btn btn-secondary dropdown-toggle" onchange="location = this.value;">
                <option value="" selected disabled>Selecciona un equipo</option>
                <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(route('admin.partidos.show', ['equipo' => $equipo->id])); ?>"><?php echo e($equipo->nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?php echo e(route('admin.partidos.create')); ?>" class="btn btn-danger">Crear Partido</a>

        <div>
            <label class="mr-2">Seleccionar Jornada:</label>
            <select onchange="location = this.value;" class="jornada-actual">
                <?php $__currentLoopData = $jornadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jornada): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(route('admin.partidos.index', ['jornada' => $jornada])); ?>" <?php if($jornada==$jornada_actual): ?> selected <?php endif; ?>>
                    Jornada <?php echo e($jornada); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">Fecha</th>
                    <th scope="col" class="text-center">Hora</th>
                    <th scope="col" class="text-center">Partido</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $partidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $partido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $claseFila = $index % 2 == 0 ? 'fila-par' : 'fila-impar';
                ?>
                <tr class="<?php echo e($claseFila); ?>">
                    <td class="text-center"><?php echo e($partido->fecha_nueva); ?></td>
                    <td class="text-center"><?php echo e($partido->hora_nueva); ?></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="col text-end me-2">
                                <?php
                                $nombreLimpioLocal = Str::ascii($partido->equipoLocal->nombre);
                                $nombreArchivoLocal = strtolower(str_replace(' ', '', $nombreLimpioLocal)) . '.png';
                                ?>
                                <img src="<?php echo e(asset('images/equipos/' . $nombreArchivoLocal)); ?>" alt="<?php echo e($partido->equipoLocal->nombre); ?>" style="width: 30px; height: auto;" class="me-2">
                                <strong><?php echo e($partido->equipoLocal->nombre); ?></strong>
                            </div>
                            <div class="col-auto text-center">
                                <span><?php echo e($partido->resultado); ?></span>
                            </div>
                            <div class="col text-start ms-2">
                                <strong><?php echo e($partido->equipoVisitante->nombre); ?></strong>
                                <?php
                                $nombreLimpioVisitante = Str::ascii($partido->equipoVisitante->nombre);
                                $nombreArchivoVisitante = strtolower(str_replace(' ', '', $nombreLimpioVisitante)) . '.png';
                                ?>
                                <img src="<?php echo e(asset('images/equipos/' . $nombreArchivoVisitante)); ?>" alt="<?php echo e($partido->equipoVisitante->nombre); ?>" style="width: 30px; height: auto;" class="me-2">
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="<?php echo e(route('admin.partidos.edit', ['id' => $partido->id])); ?>" class="btn">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="<?php echo e(route('admin.partidos.delete', ['id' => $partido->id])); ?>" method="POST" style="display: inline-block;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-link text-danger btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este partido?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/admin/partidos/index.blade.php ENDPATH**/ ?>