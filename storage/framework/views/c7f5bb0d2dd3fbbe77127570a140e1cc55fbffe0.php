

<?php $__env->startSection('heading', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<div class="my-3 flex h-8 items-center justify-between">
    <h2
        class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base"
    >
    <label class="flex items-center space-x-2">
        <?php echo e(__('You are logged in!')); ?>

  </label>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/web/platinum-club-app/Platinum-Club-App/resources/views/home.blade.php ENDPATH**/ ?>