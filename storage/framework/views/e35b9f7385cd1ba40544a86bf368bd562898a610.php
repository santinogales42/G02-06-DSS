<?php $__env->startSection('content'); ?>
<div class="jumbotron jumbotron-fluid" style="background-color: #333333; color: #ffffff;">
    <div class="container-fluid">
        <div class="display-4 font-weight-bold text-center">
            <img src="<?php echo e(asset('images/equipos/' . strtolower(str_replace(' ', '', Str::ascii($partido->equipoLocal->nombre))) . '.png')); ?>" alt="<?php echo e($partido->equipoLocal->nombre); ?>" style="width: 100px; height: auto;" class="me-2">
            <strong style="font-size: 30px;"><?php echo e($partido->equipoLocal->nombre); ?></strong>

            <span class="mx-3" style="font-size: 24px;"><?php echo e($partido->resultado); ?></span>

            <strong style="font-size: 24px;"><?php echo e($partido->equipoVisitante->nombre); ?></strong>
            <img src="<?php echo e(asset('images/equipos/' . strtolower(str_replace(' ', '', Str::ascii($partido->equipoVisitante->nombre))) . '.png')); ?>" alt="<?php echo e($partido->equipoVisitante->nombre); ?>" style="width: 100px; height: auto;" class="ms-2">

            <p style="font-size: 18px;"><?php echo e($partido->fecha_nueva); ?> <?php echo e($partido->hora_nueva); ?></p>
            <p style="font-size: 18px;"> <?php echo e($partido->estadio); ?></p>
            <?php if($partido->resultado == ' - '): ?>
            <p style="font-size: 18px;">Estado: Sin Empezar</p>
            <?php else: ?>
            <p style="font-size: 18px;">Estado: Finalizado</p>
            <?php endif; ?>
        </div>

        <?php if(Auth::check()): ?>
        <?php if($partido->resultado == ' - '): ?>
        <?php if(!$haVotado): ?>
        <!-- Mostrar formulario de predicción si el usuario no ha votado -->
        <div class="container">
            <div class="card-header text-center" style="background-color: #646464;">
                <strong style="font-size: 20px;">¿Quién ganará?</strong>
                <hr>
                <div class="prediccion">
                    <div>
                        <!-- Botón para votar por equipo local -->
                        <button class="circulo-equipo" onclick="votar('local')">
                            <img src="<?php echo e(asset('images/equipos/' . strtolower(str_replace(' ', '', Str::ascii($partido->equipoLocal->nombre))) . '.png')); ?>" alt="<?php echo e($partido->equipoLocal->nombre); ?>" style="width: 40px; height: auto;">
                        </button>
                        <strong style="font-size: 14px;"><?php echo e($partido->equipoLocal->nombre); ?></strong>
                    </div>
                    <div>
                        <!-- Botón para votar por empate -->
                        <button class="circulo-equipo" onclick="votar('empate')">
                            X
                        </button>
                        <strong style="font-size: 14px;">Empate</strong>
                    </div>
                    <div>
                        <!-- Botón para votar por equipo visitante -->
                        <button class="circulo-equipo" onclick="votar('visitante')">
                            <img src="<?php echo e(asset('images/equipos/' . strtolower(str_replace(' ', '', Str::ascii($partido->equipoVisitante->nombre))) . '.png')); ?>" alt="<?php echo e($partido->equipoVisitante->nombre); ?>" style="width: 40px; height: auto;">
                        </button>
                        <strong style="font-size: 14px;"><?php echo e($partido->equipoVisitante->nombre); ?></strong>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if($haVotado): ?>
        <!-- Mostrar porcentajes de votos si el usuario ha votado -->
        <div class="container">
            <div class="card-header text-center" style="background-color: #646464;">
                <strong style="font-size: 20px;">Porcentajes de Votos</strong>
                <hr style="color: white;">
                <div class="prediccion-resultados">
                    <div class="prediccion-item">
                        <div class="equipo-info">
                            <img src="<?php echo e(asset('images/equipos/' . strtolower(str_replace(' ', '', Str::ascii($partido->equipoLocal->nombre))) . '.png')); ?>" alt="<?php echo e($partido->equipoLocal->nombre); ?>" style="width: 40px; height: auto;">
                            <strong><?php echo e($partido->equipoLocal->nombre); ?></strong>
                        </div>
                        <div class="barra-progreso">
                            <div class="relleno" style="width: <?php echo e($porcentajeLocalFormatted); ?>%;"></div>
                        </div class="porcentajeFinal">
                        <strong><?php echo e($porcentajeLocalFormatted); ?>%</strong>
                    </div>

                    <div class="prediccion-item">
                        <div class="equipo-info">
                            <strong style="font-size: 17px;">Empate</strong>
                        </div>
                        <div class="barra-progreso">
                            <div class="relleno" style="width: <?php echo e($porcentajeEmpateFormatted); ?>%;"></div>
                        </div>
                        <strong><?php echo e($porcentajeEmpateFormatted); ?>%</strong>
                    </div>

                    <div class="prediccion-item">
                        <div class="equipo-info">
                            <img src="<?php echo e(asset('images/equipos/' . strtolower(str_replace(' ', '', Str::ascii($partido->equipoVisitante->nombre))) . '.png')); ?>" alt="<?php echo e($partido->equipoVisitante->nombre); ?>" style="width: 40px; height: auto;">
                            <strong><?php echo e($partido->equipoVisitante->nombre); ?></strong>
                        </div>
                        <div class="barra-progreso">
                            <div class="relleno" style="width: <?php echo e($porcentajeVisitanteFormatted); ?>%;"></div>
                        </div>
                        <strong><?php echo e($porcentajeVisitanteFormatted); ?>%</strong>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php if($partido->resultado != ' - '): ?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <img src="<?php echo e(asset('images/equipos/' . strtolower(str_replace(' ', '', Str::ascii($partido->equipoLocal->nombre))) . '.png')); ?>" alt="<?php echo e($partido->equipoLocal->nombre); ?>" style="width: 50px; height: auto;" class="me-2">
                    <strong><?php echo e($partido->equipoLocal->nombre); ?></strong>
                </div>
                <div class="card-body">
                    <p>Goles: <?php echo e($estPartido->goles_local); ?></p>
                    <p>Amarillas: <?php echo e($estPartido->amarillas); ?></p>
                    <p>Rojas: <?php echo e($estPartido->rojas); ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <img src="<?php echo e(asset('images/equipos/' . strtolower(str_replace(' ', '', Str::ascii($partido->equipoVisitante->nombre))) . '.png')); ?>" alt="<?php echo e($partido->equipoVisitante->nombre); ?>" style="width: 50px; height: auto;" class="me-2">
                    <strong><?php echo e($partido->equipoVisitante->nombre); ?></strong>
                </div>
                <div class="card-body">
                    <p>Goles: <?php echo e($estPartido->goles_visitante); ?></p>
                    <p>Amarillas: <?php echo e($estPartido->amarillas); ?></p>
                    <p>Rojas: <?php echo e($estPartido->rojas); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
    function votar(opcion) {
        fetch('<?php echo e(route("guardarVoto")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({
                    partido_id: '<?php echo e($partido->id); ?>',
                    opcion: opcion
                })
            })
            .then(response => response.json())
            .then(data => {
                location.reload();
            })
            .catch(error => {
                console.error('Error al votar:', error);
            });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/partidos.blade.php ENDPATH**/ ?>