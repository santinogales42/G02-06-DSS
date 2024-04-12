<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <!-- Sección de Noticias -->
        <div class="col-md-8">
            <h2>Noticias</h2>
            <div class="news-section">
<!--                <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newsItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article>
                        <h3><?php echo e($newsItem->title); ?></h3>
                        <p><?php echo e($newsItem->content); ?></p>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                <h3>¿POR QUÉ LA SUPERLIGA GENERA TANTA INCERTIDUMBRE EN EL MODELO EUROPEO DEL FÚTBOL?</h3>
                <p>La Superliga ha quedado vista para sentencia. Todo lo que no sea un modelo totalmente abierto, 
                    con acceso a todas las competiciones europeas, temporada a temporada, es un formato cerrado, 
                    contrario a los valores europeos del deporte. LALIGA pide a la Comisión Europea medidas legislativas 
                    para proteger la estabilidad y futuro del fútbol europeo.</p>
                    <h3>¿POR QUÉ LA SUPERLIGA GENERA TANTA INCERTIDUMBRE EN EL MODELO EUROPEO DEL FÚTBOL?</h3>
                <p>La Superliga ha quedado vista para sentencia. Todo lo que no sea un modelo totalmente abierto, 
                    con acceso a todas las competiciones europeas, temporada a temporada, es un formato cerrado, 
                    contrario a los valores europeos del deporte. LALIGA pide a la Comisión Europea medidas legislativas 
                    para proteger la estabilidad y futuro del fútbol europeo.</p>
            </div>
        </div>
        
        <!-- Sección de Clasificación -->
        <div class="col-md-4">
            <h2>Clasificación</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Posición</th>
                        <th>Equipo</th>
                        <th>Puntos</th>
                    </tr>
                </thead>
                <tbody>

                    <!--<?php $__currentLoopData = $classification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($team->foto); ?></td>
                            <td><?php echo e($team->nombre); ?></td>
                            <td><?php echo e($team->puntos); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                    <tr>
                    <td>1</td>
                        <td><div class="row align-items-center">
                            <div class="col-auto">
                                <img src="<?php echo e(asset('images/ligaicono.png')); ?>" alt="Logo La Liga" style="width: 30px; height: auto;">
                            </div>
                            <div class="col">
                                Villareal
                            </div>
                        </div>
                        </td>
                        <td>70</td>
                    </tr>
                    <tr>
                    <td>2</td>
                        <td><div class="row align-items-center">
                            <div class="col-auto">
                                <img src="<?php echo e(asset('images/ligaicono.png')); ?>" alt="Logo La Liga" style="width: 30px; height: auto;">
                            </div>
                            <div class="col">
                                Osasuna
                            </div>
                        </div>
                        </td>
                        <td>67</td>
                    </tr>
                    <tr>
                    <td>1</td>
                        <td><div class="row align-items-center">
                            <div class="col-auto">
                                <img src="<?php echo e(asset('images/ligaicono.png')); ?>" alt="Logo La Liga" style="width: 30px; height: auto;">
                            </div>
                            <div class="col">
                                Real Sociedad
                            </div>
                        </div>
                        </td>
                        <td>50</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/home.blade.php ENDPATH**/ ?>