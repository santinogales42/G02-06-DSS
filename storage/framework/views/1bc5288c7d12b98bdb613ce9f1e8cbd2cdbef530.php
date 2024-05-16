<?php $__env->startSection('content'); ?>
<style>
    .container {
        max-width: 800px;
        margin: auto;
        padding-top: 20px;
    }
    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        overflow: hidden;
    }
    .card-header {
        background-color: #007bff;
        color: #ffffff;
        padding: 10px 20px;
        font-size: 24px;
        font-weight: bold;
    }
    .card-body {
        padding: 20px;
        line-height: 1.6;
        color: #333;
    }
    .card-body small {
        display: block;
        margin-top: 10px;
        color: #666;
    }
    textarea {
        width: 100%;
        height: 100px;
        padding: 10px;
        margin-top: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    button {
        display: block;
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        margin-top: 10px;
        cursor: pointer;
    }
    button:hover {
        background-color: #218838;
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h4><?php echo e($thread->topic); ?></h4>
        </div>
        <div class="card-body" style="overflow-x: auto;">
    <pre style="white-space: pre-wrap;"><?php echo e($thread->content); ?></pre>
    <small>Publicado por <?php echo e($thread->user->name); ?> el <?php echo e($thread->created_at->format('d/m/Y H:i')); ?></small>
</div>


        <div class="response-form">
            <form method="POST" action="<?php echo e(route('responses.store', $thread->id)); ?>">
                <?php echo csrf_field(); ?>
                <textarea name="content" placeholder="Escribe tu respuesta aquí..."></textarea>
                <button type="submit">Responder</button>
            </form>
        </div>
        </div>
        <hr>
        
        <?php $__currentLoopData = $thread->responses->whereNull('parent_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $response): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('threads.show_responses', ['response' => $response, 'level' => 0], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/threads/show.blade.php ENDPATH**/ ?>