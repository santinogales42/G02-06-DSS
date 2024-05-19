<?php $__env->startSection('title', 'Panel de Administrador'); ?>

<?php $__env->startSection('content'); ?>
<div class="jumbotron jumbotron-fluid">
    <div class="container-fluid">
        <h1 class="display-4 font-weight-bold" style="font-size: 2.5rem; color:white; text-align: center">Panel de Administrador</h1>
    </div>
</div>
<div class="circle-container">
    <?php if(auth()->guard()->check()): ?>
    <?php if(Auth::check() && (Auth::user()->role->name === 'noticiero' || Auth::user()->role->name === 'admin')): ?>
    <a href="<?php echo e(route('admin.noticias.index')); ?>"  class="circle"><strong>Noticias</strong></a>
    <?php endif; ?>
    <?php endif; ?>
    
    <?php if(auth()->guard()->check()): ?>
    <?php if(Auth::check() && (Auth::user()->role->name === 'analista' || Auth::user()->role->name === 'admin')): ?>
    <a href="<?php echo e(route('admin.adminjugador')); ?>"  class="circle"><strong>Jugadores</strong></a>
    <a href="<?php echo e(route('admin.equipos.index')); ?>"  class="circle"><strong>Equipos</strong></a>
    <a href="<?php echo e(route('admin.partidos.index')); ?>" class="circle"><strong>Partidos</strong></a>
    <?php endif; ?>
    <?php endif; ?>
    
    <?php if(auth()->guard()->check()): ?>
    <?php if(Auth::check() && Auth::user()->role->name === 'admin'): ?>
    <a href="<?php echo e(route('mostrarMensajes')); ?>" class="circle"><strong>Mensajes</strong></a>
    <a href="<?php echo e(route('admin.usuarios.index')); ?>" class="circle"><strong>Usuarios</strong></a>
    <?php endif; ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/admin/index.blade.php ENDPATH**/ ?>