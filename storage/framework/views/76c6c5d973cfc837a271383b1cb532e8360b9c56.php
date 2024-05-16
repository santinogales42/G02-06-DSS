<?php $__env->startSection('content'); ?>
<a href="<?php echo e(route('admin.index')); ?>" class="btn boton-flecha">
    <i class="fa-solid fa-arrow-left-long fa-2xl"></i> <!-- Ícono de flecha -->
</a>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 position-relative">

            <!-- Botón de retorno -->

            <!-- Formulario de búsqueda -->
            <form action="<?php echo e(route('admin.usuarios.index')); ?>" method="GET" class="mb-3 d-flex justify-content-end">
                <input type="text" name="salida" class="buscador" placeholder="Buscar por nombre o correo" value="<?php echo e(request('salida')); ?>">
                <button type="submit" class="btn boton-buscar">Buscar</button>
            </form>



            <!-- Tarjeta de agregar usuarios -->
            <div class="tarjeta-agregar-usuarios mb-3">
                <a href="<?php echo e(route('admin.usuarios.create')); ?>" class="btn boton-agregar">Agregar Usuario</a>
            </div>

            <!-- Botones para eliminar usuarios -->
            <div class="d-flex justify-content-between mb-3">
                <form action="<?php echo e(route('admin.usuarios.eliminar-seleccionados')); ?>" method="POST" id="formEliminarSeleccionados">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="usuarios_seleccionados" id="usuariosSeleccionados">
                    <button type="button" class="btn btn-danger" id="eliminarSeleccionados" onclick="return confirm('¿Estás seguro de que deseas eliminar los usuarios seleccionados?')">Eliminar Seleccionados</button>
                </form>
                <form action="<?php echo e(route('admin.usuarios.eliminar-todos')); ?>" method="POST" id="formEliminarTodos">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar todos los usuarios excepto el administrador?')">Eliminar Todos</button>
                </form>
            </div>


            <!-- Tarjeta de usuarios -->
            <div class="tarjeta mb-3">
                <div class="encabezado-tarjeta-usuarios">Lista de Usuarios</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr style="margin-bottom: auto;">
                                <th>Seleccionar</th>
                                <th>
                                    <button id="ordenarNombre" class="btn boton-nombre">Nombre </button>
                                </th>
                                <th>Correo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php if(!$usuario->isAdmin): ?>
                                    <input type="checkbox" name="usuarios_seleccionados[]" value="<?php echo e($usuario->id); ?>" class="checkbox-red">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($usuario->name); ?></td>
                                <td><?php echo e($usuario->email); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.usuarios.edit', $usuario->id)); ?>" class="btn boton-editar">
                                        <i class="fas fa-pencil-alt"></i> <!-- Ícono de lápiz -->
                                    </a>
                                    <form action="<?php echo e(route('admin.usuarios.destroy', ['id' => $usuario->id])); ?>" method="POST" style="display: inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-link text-danger btn-eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                            <i class="fas fa-trash-alt"></i> <!-- Ícono de la papelera -->
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Agrega la paginación aquí -->
            <div id="pagination-links" class="d-flex justify-content-center">
                <?php echo e($usuarios->links()); ?>

            </div>
        </div>
    </div>
</div>

<?php if(Session::has('success')): ?>
<script>
    window.onload = function() {
        alert("<?php echo e(Session::get('success')); ?>");
    };
</script>
<?php endif; ?>

<script>
    $(document).ready(function() {
        $('.checkbox-red').change(function() {
            if ($(this).is(':checked')) {
                $(this).addClass('checked-red');
            } else {
                $(this).removeClass('checked-red');
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const botonOrdenarNombre = document.getElementById('ordenarNombre');
        let ordenAscendenteNombre = true;

        botonOrdenarNombre.addEventListener('click', function() {
            // Cambia la dirección del orden para el nombre
            ordenAscendenteNombre = !ordenAscendenteNombre;

            // Redirige con el nuevo parámetro de orden solo para el nombre y el estado actual para el correo electrónico
            window.location.href = '<?php echo e(route("admin.usuarios.index")); ?>' + '?ordenNombre=' + (ordenAscendenteNombre ? 'asc' : 'desc');
        });

        // Verificar si hay parámetros de orden en la URL y establecer el estado del ordenAscendente en consecuencia solo para el nombre
        const urlParams = new URLSearchParams(window.location.search);
        const ordenNombreParam = urlParams.get('ordenNombre');
        if (ordenNombreParam === 'desc') {
            ordenAscendenteNombre = false;
        }
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const botonEliminarSeleccionados = document.getElementById('eliminarSeleccionados');
        const formEliminarSeleccionados = document.getElementById('formEliminarSeleccionados');
        const checkboxes = document.querySelectorAll('.checkbox-red');

        botonEliminarSeleccionados.addEventListener('click', function(event) {
            const usuariosSeleccionados = [];
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    usuariosSeleccionados.push(checkbox.value);
                }
            });

            // Si no hay ningún checkbox seleccionado, mostrar mensaje y cancelar el evento
            if (usuariosSeleccionados.length === 0) {
                alert('No has seleccionado ningún usuario para eliminar.');
                event.preventDefault();
                return false;
            }

            // Confirmar la eliminación si hay usuarios seleccionados
            if (!confirm('¿Estás seguro de que deseas eliminar los usuarios seleccionados?')) {
                event.preventDefault();
                return false;
            }

            // Establecer los IDs seleccionados en el campo oculto
            document.getElementById('usuariosSeleccionados').value = usuariosSeleccionados.join(',');

            // Enviar el formulario de eliminación de usuarios seleccionados
            formEliminarSeleccionados.submit();
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/admin/usuarios/index.blade.php ENDPATH**/ ?>