<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta tags  -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />

    <title><?php echo e(config('app.name')); ?> - Sign In</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/favicon.png')); ?>" />

    <!-- CSS Assets -->
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>" />

    <!-- Javascript Assets -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body x-data class="is-header-blur" x-bind="$store.global.documentBody">
    <!-- App preloader-->
    <div
      class="app-preloader fixed z-50 grid h-full w-full place-content-center bg-slate-50 dark:bg-navy-900"
    >
      <div class="app-preloader-inner relative inline-block h-48 w-48"></div>
    </div>


        <!-- Main Content Wrapper -->
        <main class="main-content px-[var(--margin-x)] pb-8">
            <div class="card px-4 pb-4 sm:px-5">  
                <div class="my-3 flex h-8 items-center justify-between">
                    <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                        <?php echo e(__('Verify Your Email Address')); ?>

                    </h2>
                </div>
                <?php if(session('resent')): ?>
                    <div class="alert flex rounded-lg border border-success/30 bg-success/10 py-4 px-4 text-success sm:px-5">
                        <?php echo e(__('A fresh verification link has been sent to your email address.')); ?>

                    </div>
                <?php endif; ?>
                <p class="mt-1">
                    <?php echo e(__('Before proceeding, please check your email for a verification link.')); ?>

                    <?php echo e(__('If you did not receive the email')); ?>,
                </p>
                
                <form class="d-inline" method="POST" action="<?php echo e(route('verification.resend')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn font-medium text-primary p-0 m-0 align-baseline"><?php echo e(__('click here to request another')); ?></button>.
                </form>
            </div>
        </main>

    <div id="x-teleport-target"></div>
    <script>
      window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>
  </body>
</html>
<?php /**PATH /home/vagrant/web/platinum-club-app/Platinum-Club-App/resources/views/auth/verify.blade.php ENDPATH**/ ?>