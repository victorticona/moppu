<?php $__env->startSection('contenido'); ?>

<miperfil-vico session="<?php echo e(session('per_name').' '.session('per_lastname')); ?> "></miperfil-vico>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-vuetify-master\resources\views/miperfil/index.blade.php ENDPATH**/ ?>