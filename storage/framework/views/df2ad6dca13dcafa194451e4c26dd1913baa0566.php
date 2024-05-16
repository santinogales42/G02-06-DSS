
<style>
    .response-block {
    background-color: #f9f9f9; /* Color de fondo para destacar */
    margin-top: 10px;
    padding: 10px;
    border-radius: 5px; /* Bordes redondeados para sub-respuestas */
    
}
.delete-btn {
        background-color: #dc3545; /* Color rojo para botones de eliminar */
        color: white; /* Texto blanco para mejor contraste */
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .delete-btn:hover {
        background-color: #c82333; /* Color más oscuro al pasar el mouse */
    }
    .response-block {
        background-color: #f9f9f9;
        margin-top: 10px;
        padding: 10px;
        border-radius: 5px;
    }
</style>
<?php if($level == 0): ?>
<div class="card mt-3">
<?php endif; ?>

<div class="response-block" style="margin-left: <?php echo e(20 * $level); ?>px; padding: 20px; border-left: 2px solid #ccc;">
    <pre style="white-space: pre-wrap;"><?php echo e($response->content); ?></pre>
    <small>Respondido por <?php echo e($response->user->name); ?> el <?php echo e($response->created_at->format('d/m/Y H:i')); ?></small>

    <?php if(auth()->check() && (auth()->user()->id == $response->user_id || Auth::user()->role->name === 'admin')): ?>   
    <form method="POST" action="<?php echo e(route('responses.destroy', $response->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="delete-btn" onclick="return confirm('¿Estás seguro de querer eliminar esta respuesta?');">Eliminar</button>
    </form>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('responses.store', $thread->id)); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="parent_id" value="<?php echo e($response->id); ?>">
        <textarea name="content" placeholder="Responder a este mensaje..."></textarea>
        <button type="submit">Responder</button>
    </form>

    <?php $__currentLoopData = $response->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('threads.show_responses', ['response' => $child, 'level' => $level + 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if($level == 0): ?>
</div>
<?php endif; ?>
<?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/threads/show_responses.blade.php ENDPATH**/ ?>