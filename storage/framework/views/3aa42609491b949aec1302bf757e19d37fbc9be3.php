<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
       
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4" style="overflow: hidden;">
                        <img src="<?php echo e(asset($jugador->foto)); ?>" class="img-fluid" alt="Foto de <?php echo e($jugador->nombre); ?>" style="height: 100%; object-fit: cover; margin-left: 10px;"> <!-- Añadir un pequeño margen izquierdo -->
                     </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h1 class="card-title"><?php echo e($jugador->nombre); ?></h1>
                            <p class="card-text"><strong>Equipo:</strong> <?php echo e($jugador->equipo->nombre); ?></p>
                            <p class="card-text"><i class="fas fa-futbol"></i> <strong>Posición:</strong> <?php echo e($jugador->posicion); ?></p>
                            <p class="card-text"><i class="fas fa-birthday-cake"></i> <strong>Edad:</strong> <?php echo e($jugador->edad); ?> años</p>
                            <p class="card-text"><strong>Biografía:</strong> <?php echo e($jugador->biografia); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <h2>Estadísticas</h2>
            <div class="row text-center">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($jugador->estadisticas->goles); ?></h5>
                            <p class="card-text">Goles</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($jugador->estadisticas->asistencias); ?></h5>
                            <p class="card-text">Asistencias</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($jugador->estadisticas->amarillas); ?></h5>
                            <p class="card-text">Amarillas</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($jugador->estadisticas->rojas); ?></h5>
                            <p class="card-text">Rojas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/jugadores/show.blade.php ENDPATH**/ ?>