<?php $__env->startSection('title', 'Contacto'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="tarjeta rounded-lg shadow-sm bg-rojo-pastel">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="text-center mb-4">Cuéntanos tu problema</h1>
                            <?php if(session('success')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('success')); ?>

                                </div>
                            <?php endif; ?>
                            <form action="<?php echo e(route('enviarMensaje')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="correo">Correo electrónico:</label>
                                    <input type="email" id="correo" name="correo" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="mensaje">Mensaje:</label>
                                    <textarea id="mensaje" name="mensaje" rows="6" class="form-control" required></textarea>
                                </div>
                                <button type="submit" class="btn boton-enviar-mensaje">Enviar mensaje</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="d-md-none mb-3"></div>
                            <div class="d-none d-md-block border-left ml-md-3 pl-md-3">
                                <h2 class="text-center mb-4">Ubicación</h2>
                                <p>123 Calle Principal, Ciudad, País</p>
                                <div id="map" style="height: 300px; padding: 10px;"></div>
                                <p class="mt-3">Nuestro correo: ejemplo@example.com</p> <!-- Correo electrónico -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-4"></div> <!-- Separación al final de la página -->

<!-- Incluir la biblioteca de Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Script para inicializar el mapa -->
<script>
    var map = L.map('map').setView([40.7128, -74.0060], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([40.7128, -74.0060]).addTo(map)
        .bindPopup('Ubicación de nuestro negocio')
        .openPopup();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/contacto.blade.php ENDPATH**/ ?>