<?php $__env->startSection('content'); ?>
<div class="container">

    <?php if(isset($equiposFavoritos) && $equiposFavoritos->isNotEmpty()): ?>
    <h1 class="texto-h1-favoritos">Mis Equipos Favoritos</h1>
    <div class="row">
        <?php $__currentLoopData = $equiposFavoritos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 mb-4 tarjeta-contenedor">
            <div class="tarjeta-favoritos">
                <!-- Botón del corazón -->
                <form action="<?php echo e(route('favoritos.edit', $equipo->nombre)); ?>" method="GET">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-link boton-favorito">
                        <i class="fas fa-heart corazon-lleno" ;"></i>
                    </button>
                </form>
                <div class="text-center"> <!-- Contenedor para centrar la imagen -->
                    <?php
                    $nombreLimpioLocal = Str::ascii($equipo->nombre);
                    $nombreArchivoLocal = strtolower(str_replace(' ', '', $nombreLimpioLocal)) . '.png';
                    ?>
                    <img src="<?php echo e(asset('images/equipos/' . $nombreArchivoLocal)); ?>" alt="<?php echo e($equipo->nombre); ?>" style="width: 70px; height: 70px; object-fit: contain; margin-right: 20px;">
                </div>
                <!-- Contenido del equipo -->
                <div class="cuerpo-tarjetas-favoritos">
                    <h5 class="tarjeta-favoritos-nombreEquipo"><?php echo e($equipo->nombre); ?></h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Puntos: <?php echo e($equipo->puntos); ?></li>
                        <li class="list-group-item">Partidos jugados: <?php echo e($equipo->partidos_jugados); ?></li>
                        <li class="list-group-item">Goles a favor: <?php echo e($equipo->goles_favor); ?></li>
                        <li class="list-group-item">Goles en contra: <?php echo e($equipo->goles_contra); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php elseif(isset($warning)): ?>
    <div class="alert alert-warning text-center" role="alert">
        <?php echo e($warning); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/favoritos/index.blade.php ENDPATH**/ ?>