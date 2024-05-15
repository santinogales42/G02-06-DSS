<?php $__env->startSection('title', 'Calendario de Partidos'); ?>

<?php $__env->startSection('content'); ?>
<div class="jumbotron jumbotron-fluid">
    <div class="container-fluid">
        <h1 class="display-4 font-weight-bold text-center" style="font-size: 2.5rem; color:white;">Calendario de La Liga 2023/24</h1>
    </div>
</div>

<div class="container mt-4">
    <div class="row" style="margin-bottom: 1rem;">
        <div class="col-md-6">
            <select class="boton-seleccionar-equipo dropdown-toggle" onchange="location = this.value;">
                <option value="" selected disabled>Selecciona un equipo</option>
                <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(route('calendario.show', ['equipo' => $equipo->id])); ?>"><?php echo e($equipo->nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?php echo e(route('calendario.index', ['jornada' => $jornada_actual - 1])); ?>" class="jornada-anterior">
            <i class="fas fa-arrow-left"></i>
        </a>
        <select onchange="location = this.value;" class="jornada-actual">
            <?php $__currentLoopData = $jornadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jornada): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e(route('calendario.index', ['jornada' => $jornada])); ?>" <?php if($jornada==$jornada_actual): ?> selected <?php endif; ?>>
                Jornada <?php echo e($jornada); ?>

            </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <a href="<?php echo e(route('calendario.index', ['jornada' => $jornada_actual + 1])); ?>" class="jornada-siguiente">
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">Fecha</th>
                    <th scope="col" class="text-center">Hora</th>
                    <th scope="col" class="text-center">Partido</th>
                </tr>
            </thead>
            <tbody>
                <div>
                    <?php $__currentLoopData = $partidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $partido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $claseFila = $index % 2 == 0 ? 'fila-par' : 'fila-impar';
                    ?>
                    <tr class="<?php echo e($claseFila); ?>" data-partido-id="<?php echo e($partido->id); ?>">
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </tbody>
        </table>
    </div>
    <?php $__env->stopSection(); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.ver-estadisticas').on('click', function() {
                var partidoId = $(this).closest('.partido-row').data('partido-id');
                var statsRow = $(this).closest('.partido-row').next('.stats-row');

                if (statsRow.is(':visible')) {
                    statsRow.hide();
                } else {
                    // Aquí deberías realizar una petición AJAX para obtener las estadísticas del partido
                    // y luego actualizar el contenido de .estadisticas-container
                    // Por ejemplo:
                    $.ajax({
                        method: 'GET',
                        url: '/obtener-estadisticas/' + partidoId,
                        success: function(data) {
                            $('#estadisticas-' + partidoId).html(data);
                            statsRow.show();
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });
        });
    </script>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/calendario/index.blade.php ENDPATH**/ ?>