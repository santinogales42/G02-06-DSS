<?php $__env->startSection('content'); ?>
<?php if(Session::has('success')): ?>
<script>
    window.onload = function() {
        alert("<?php echo e(Session::get('success')); ?>");
    };
</script>
<?php endif; ?>

<div class="jumbotron jumbotron-fluid">
    <div class="container-fluid">
        <h1 class="display-4 text-center" style="font-size: 2.5rem; color:white">Administración de Partidos</h1>
    </div>
</div>

<a href="<?php echo e(route('admin.index')); ?>" class="btn boton-flecha">
    <i class="fa-solid fa-arrow-left-long fa-2xl"></i> <!-- Ícono de flecha -->
</a>

<div class="container mt-4" style="margin-bottom: 6rem;">
    <div class="tarjeta-agregar-usuarios mb-3">
        <a href="<?php echo e(route('admin.partidos.create')); ?>" class="btn boton-agregar">Crear Partido</a>
    </div>
    <div class="d-flex justify-content-between mb-3">
        <form action="<?php echo e(route('admin.partidos.deleteSelected')); ?>" method="POST" id="formEliminarSeleccionados">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <input type="hidden" id="partidosSeleccionados" name="partidosSeleccionados">
            <button type="button" class="btn btn-danger" id="eliminarSeleccionados">Eliminar Seleccionados</button>
        </form>
        <form action="<?php echo e(route('admin.partidos.deleteAll')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-danger" name="action" value="deleteAll" onclick="return confirm('¿Estás seguro de eliminar todos los partidos?')">Eliminar Todos</button>
        </form>
    </div>
    <div class="d-flex justify-content-between mb-3">
        <div class="">
            <select class="boton-seleccionar-equipo dropdown-toggle" onchange="location = this.value;">
                <option value="" selected disabled>Selecciona un equipo</option>
                <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(route('admin.partidos.show', ['equipo' => $equipo->id])); ?>"><?php echo e($equipo->nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <label class="mr-1">Seleccionar Jornada:</label>
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
                    <th scope="col" class="text-center"></th>
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
                    <td class="text-center"><input type="checkbox" name="selectedPartidos[]" class="checkbox-red" value="<?php echo e($partido->id); ?>"></td>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const botonEliminarSeleccionados = document.getElementById('eliminarSeleccionados');
        const formEliminarSeleccionados = document.getElementById('formEliminarSeleccionados');
        const checkboxes = document.querySelectorAll('.checkbox-red');

        botonEliminarSeleccionados.addEventListener('click', function(event) {
            const partidosSeleccionados = [];
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    partidosSeleccionados.push(checkbox.value);
                }
            });

            // Si no hay ningún checkbox seleccionado, mostrar mensaje y cancelar el evento
            if (partidosSeleccionados.length === 0) {
                alert('No has seleccionado ningún partido para eliminar.');
                event.preventDefault();
                return false;
            }

            // Confirmar la eliminación si hay partidos seleccionados
            if (!confirm('¿Estás seguro de que deseas eliminar los partidos seleccionados?')) {
                event.preventDefault();
                return false;
            }

            // Establecer los IDs seleccionados en el campo oculto
            document.getElementById('partidosSeleccionados').value = partidosSeleccionados.join(',');

            // Enviar el formulario de eliminación de partidos seleccionados
            formEliminarSeleccionados.submit();
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/admin/partidos/index.blade.php ENDPATH**/ ?>