<?php $__env->startSection('title', 'Tabla de Clasificación de La Liga 2023/24'); ?>

<?php $__env->startSection('content'); ?>
    <div class="jumbotron jumbotron-fluid" style="background-color: #333333; color: #ffffff;">
        <div class="container-fluid">
            <!-- Eliminé el contenedor para el título y lo coloqué directamente en el jumbotron -->
            <h1 class="display-4 font-weight-bold" style="font-size: 2.5rem;">Tabla de Clasificación de La Liga 2023/24</h1>
            <!-- Agrega botones para ordenar la tabla -->
            <div class="mt-5">
		    <a href="<?php echo e(route('clasificacion', ['order' => 'puntos'])); ?>" class="btn btn-primary <?php echo e(isset($order) && $order == 'puntos' ? 'active' : ''); ?>" style="background-color: <?php echo e(isset($order) && $order == 'puntos' ? '#ff0000' : '#ffffff'); ?>; color: <?php echo e(isset($order) && $order == 'puntos' ? '#ffffff' : '#000000'); ?>; margin-right: 5px; border-color: <?php echo e(isset($order) && $order == 'puntos' ? '#ffffff' : '#ffffff'); ?>;">Puntos</a>
		    <a href="<?php echo e(route('clasificacion', ['order' => 'goles_favor'])); ?>" class="btn btn-primary <?php echo e($order == 'goles_favor' ? 'active' : ''); ?>" style="background-color: <?php echo e($order == 'goles_favor' ? '#ff0000' : '#ffffff'); ?>; color: <?php echo e($order == 'goles_favor' ? '#ffffff' : '#000000'); ?>; margin-right: 5px; border-color: <?php echo e($order == 'goles_favor' ? '#ffffff' : '#ffffff'); ?>;">Goles a Favor</a>
		    <a href="<?php echo e(route('clasificacion', ['order' => 'goles_contra'])); ?>" class="btn btn-primary <?php echo e($order == 'goles_contra' ? 'active' : ''); ?>" style="background-color: <?php echo e($order == 'goles_contra' ? '#ff0000' : '#ffffff'); ?>; color: <?php echo e($order == 'goles_contra' ? '#ffffff' : '#000000'); ?>; border-color: <?php echo e($order == 'goles_contra' ? '#ffffff' : '#ffffff'); ?>;">Goles en Contra</a>
		</div>
        </div>
    </div>
    <div class="container">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" style="width: 100%; cursor: pointer;">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center">Pos</th>
                    <th class="text-center">Equipo</th>
                    <th class="text-center">PJ</th>
                    <th class="text-center">PG</th>
                    <th class="text-center">PE</th>
                    <th class="text-center">PP</th>
                    <th class="text-center">GF</th>
                    <th class="text-center">GC</th>
                    <th class="text-center">Dif</th>
                    <th class="text-center">Pts</th>
                    <th class="text-center">Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="transition: background-color 0.3s;">
                        <td class="text-center"><?php echo e($equipo->posicion_original); ?></td>
                        <td class="text-center"><?php echo e($equipo->nombre); ?></td>
                        <td class="text-center"><?php echo e($equipo->partidos_jugados); ?></td>
                        <td class="text-center"><?php echo e($equipo->ganados); ?></td>
                        <td class="text-center"><?php echo e($equipo->empatados); ?></td>
                        <td class="text-center"><?php echo e($equipo->perdidos); ?></td>
                        <td class="text-center"><?php echo e($equipo->goles_favor); ?></td>
                        <td class="text-center"><?php echo e($equipo->goles_contra); ?></td>
                        <td class="text-center"><?php echo e($equipo->goles_favor - $equipo->goles_contra); ?></td>
                        <td class="text-center"><?php echo e($equipo->puntos); ?></td>
                        <td class="text-center">
                            <?php if($equipo->posicion_original <= 4): ?>
                                <span class="badge badge-primary">Champions</span>
                            <?php elseif($equipo->posicion_original == 5): ?>
                                <span class="badge badge-warning">Europa League</span>
                            <?php elseif($equipo->posicion_original == 6): ?>
                                <span class="badge badge-success">Conference League</span>
                            <?php elseif($equipo->posicion_original > count($equipos) - 3): ?>
                                <span class="badge badge-danger">Descendido</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    </div>
    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/clasificacion/index.blade.php ENDPATH**/ ?>