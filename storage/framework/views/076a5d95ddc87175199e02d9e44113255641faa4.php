
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

  <?php if($errors->any()): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      toastr.error("<?php echo e($error); ?>");
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>
  <?php if(session()->has('success')): ?>
  		toastr.success("<?php echo e(session()->get('success')); ?>");
  <?php endif; ?>


  <?php if(session()->has('info')): ?>
  		toastr.info("<?php echo e(session()->get('info')); ?>");
  <?php endif; ?>


  <?php if(session()->has('warning')): ?>
  		toastr.warning("<?php echo e(session()->get('warning')); ?>");
  <?php endif; ?>


  <?php if(session()->has('error')): ?>
  		toastr.error("<?php echo e(session()->get('error')); ?>");
  <?php endif; ?>
</script>
<?php $__env->stopPush(); ?><?php /**PATH /media/deepx/deepx/codepaper/Platinum-Club-App/resources/views/layouts/alertMsg.blade.php ENDPATH**/ ?>