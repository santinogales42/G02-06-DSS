<!-- resources/views/clasificacion/index.blade.php -->



<?php $__env->startSection('title', 'Clasificación'); ?>



<?php $__env->startSection('title', 'La Liga'); ?>

<?php $__env->startSection('content'); ?>
    <h2>Clasificación</h2>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Pos</th>
                    <th>Equipo</th>
                    <th>PJ</th>
                    <th>PG</th>
                    <th>PE</th>
                    <th>PP</th>
                    <th>GF</th>
                    <th>GC</th>
                    <th>Pts</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>
                        <td><?php echo e($equipo->nombre); ?></td>
                        <td><?php echo e($equipo->partidos_jugados); ?></td>
                        <td><?php echo e($equipo->ganados); ?></td>
                        <td><?php echo e($equipo->empatados); ?></td>
                        <td><?php echo e($equipo->perdidos); ?></td>
                        <td><?php echo e($equipo->goles_favor); ?></td>
                        <td><?php echo e($equipo->goles_contra); ?></td>
                        <td><?php echo e($equipo->puntos); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/clasificacion.blade.php ENDPATH**/ ?>