<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <a href="<?php echo e(route('calendario.index')); ?>" class="btn boton-volver-a-calendario">Volver</a>
    <?php $__currentLoopData = $partidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title text-center">Jornada <?php echo e($partido->jornada); ?></h5>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">Fecha</th>
                        <th scope="col" class="text-center">Hora</th>
                        <th scope="col" class="text-center">Partido</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center"><?php echo e($partido->fecha_nueva); ?></td>
                        <td class="text-center"><?php echo e($partido->hora_nueva); ?></td>
                        <td class="text-center">
                            <a href="<?php echo e(route('partidos', ['id' => $partido->id])); ?>" style="text-decoration: none; color: black;">
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
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/calendario/show.blade.php ENDPATH**/ ?>