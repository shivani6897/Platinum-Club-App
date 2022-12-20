
<?php $__env->startSection('heading', 'Subscription'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div>
            <a href="<?php echo e(route('add-subscription.index')); ?>"
                class="btn px-2 py-1 space-x-2 border border-primary font-medium text-primary float-right">
                <i class="fa-solid fa-circle-plus"></i>
                <span>Add subscription</span>
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>

    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\platinum\resources\views/subscription/index.blade.php ENDPATH**/ ?>