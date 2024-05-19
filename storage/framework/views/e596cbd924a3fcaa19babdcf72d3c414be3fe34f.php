<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Jugadores</h2>
    <input type="text" id="searchBox" class="form-control" placeholder="Buscar jugadores...">
    <ul id="playersList" class="list-group mt-3">
        <?php $__currentLoopData = $jugadores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jugador): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item"><?php echo e($jugador->nombre); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    
    <?php echo e($jugadores->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function() {
    $('#searchBox').on('keyup', function() {
        var value = $(this).val();

        $.ajax({
            url: '<?php echo e(url("/jugadores")); ?>',
            type: 'GET',
            data: { term: value },
            success: function(data) {
                $('#playersList').empty();
                $.each(data, function(key, jugador) {
                    $('#playersList').append('<li class="list-group-item">' + jugador.nombre + '</li>');
                });
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/jugadores.blade.php ENDPATH**/ ?>