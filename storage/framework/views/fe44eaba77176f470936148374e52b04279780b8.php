<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="tarjeta">
                <div class="encabezado-tarjeta-usuarios">Actualizar información</div>
                <div class="card-body">
                    <form action="<?php echo e(route('perfilUsuario.update', $user->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="form-group">
                            <label for="nombre">Nuevo nombre:</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo e($user->name); ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Nuevo email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo e($user->email); ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Nueva Contraseña:</label>
                            <div class="input-group">
                                <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password" name="password">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-eye" id="togglePassword"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Nueva Contraseña:</label>
                            <div class="input-group">
                                <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password_confirmation" name="password_confirmation">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-eye" id="togglePasswordConfirmation"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-between">
                            <a href="<?php echo e(route('home')); ?>" class="btn boton-cancelar">Cancelar</a>
                            <button type="submit" class="btn boton-actualizar-usuarios btn-outline-light ml-auto">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const togglePasswordConfirmation = document.querySelector('#togglePasswordConfirmation');
    const password = document.querySelector('#password');
    const passwordConfirmation = document.querySelector('#password_confirmation');

    togglePassword.addEventListener('click', function(e) {
        // Cambiar el tipo de entrada del campo de contraseña
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // Cambiar el icono del ojo
        this.classList.toggle('fa-eye-slash');
    });

    togglePasswordConfirmation.addEventListener('click', function(e) {
        // Cambiar el tipo de entrada del campo de confirmación de contraseña
        const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirmation.setAttribute('type', type);
        // Cambiar el icono del ojo
        this.classList.toggle('fa-eye-slash');
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/perfilUsuario/edit.blade.php ENDPATH**/ ?>