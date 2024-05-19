<style>
    .card {
        margin-top: 10px;
        background-color: #f9f9f9;
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: box-shadow 0.3s ease-in-out;
    }
    .card:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    .card-header {
    background-color: #f8f9fa; /* Nuevo color gris claro */
    color: #333; /* Cambiando el color del texto a gris oscuro para mejor contraste */
    font-size: 20px;
    padding: 10px 15px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

    .card-body {
        padding: 15px;
        line-height: 1.5;
        color: #333;
    }
    .card-footer {
        background-color: #f8f9fa;
        padding: 10px 15px;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }
    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    .btn {
        margin-right: 5px;
    }
</style>

<?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="card mb-3" id="thread-<?php echo e($thread->id); ?>">
        <div class="card-header">
            <h4><?php echo e($thread->topic); ?></h4>
        </div>
        <div class="card-body">
            <p><?php echo e(substr($thread->content, 0, 100)); ?><?php echo e(strlen($thread->content) > 100 ? '...' : ''); ?></p>
            <small>Publicado por <?php echo e($thread->user->name); ?> el <?php echo e($thread->created_at->format('d/m/Y H:i')); ?></small>
        </div>
        <div class="card-footer">
            <!-- Botón para ver detalles del hilo, disponible para todos los usuarios -->
            <a href="<?php echo e(route('threads.show', $thread->id)); ?>" class="btn btn-primary">Ver Hilo</a>

            <?php if(auth()->guard()->check()): ?>
                <!-- Condicionales para mostrar el botón de eliminar -->
                <?php if(auth()->user()->id == $thread->user_id || (Auth::user()->role->name === 'admin' && auth()->user()->id != $thread->user_id)): ?>
                    <button type="button" class="btn btn-danger delete-btn" data-thread-id="<?php echo e($thread->id); ?>">Eliminar</button>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/threads/thread_list.blade.php ENDPATH**/ ?>