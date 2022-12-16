

<?php $__env->startSection('heading', 'Events'); ?>

<?php $__env->startSection('breadcrums'); ?>
    <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
    </div>
    <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
        <li class="flex items-center space-x-2">
            <a
                class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                href="<?php echo e(route('home')); ?>"
            >Dashboard</a
            >
            <svg
                x-ignore
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>
        </li>
        <li>Events</li>
    </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


























    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6 xl:grid-cols-4 my-5">
        <?php $__empty_1 = true; $__currentLoopData = $event; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$events): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="card">
                <div class="card-body">
                    <div class="p-2 py-4" style="border-radius: 5px;font-size: 18px;
                        text-transform: uppercase;text-align: center;font-weight: 500;letter-spacing: .05em;background: #f4f3f9;">
                        <?php echo e($events->name); ?> <?php echo e($events->event_date_time ? '- ' . ($events->event_date_time?->format('d/m/Y')) : ''); ?></div>
                </div>
                <div class="py-4 flex grow flex-col items-center px-4 pb-5 sm:px-5">









                    <h4
                        class="pt-3 pb-3 text-md text-slate-700 dark:text-navy-100"
                    >
                        <span class="font-medium">Date</span> : <?php echo e($events->event_date_time ? ($events->event_date_time?->format('d M Y')) : ''); ?>

                    </h4>


                    <h5
                        class="pt-3 pb-3 text-md text-slate-700 dark:text-navy-100"
                    >
                        <span class="font-medium">Time</span> : <?php echo e($events->event_date_time ? ($events->event_date_time?->format('h:m a')) : ''); ?>

                    </h5>


                    <h5
                        class="pt-3 pb-3 text-md text-slate-700 dark:text-navy-100"
                    >
                    <?php echo e($events->description ? ( substr($events->description, 0 , 40)) : ''); ?>

                    </h5>


                    



















                    <?php if($events->event_date_time < Carbon\Carbon::today()): ?>
                        <?php if(isset( $events->link)): ?>
                            <div class="mt-6 grid w-full grid-cols-1 gap-2">
                                <button
                                   target="_blank"
                                    class="btn space-x-2 px-0 font-medium text-white" style="background-color: #e84c37;"
                                >
                                    <span>Join Event</span>
                                </button>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="mt-6 grid w-full grid-cols-1 gap-2">
                            <a href="<?php echo e($events->link); ?>"
                               target="_blank"
                               class="btn space-x-2 px-0 font-medium text-white bg-success"
                            >
                                <span>Join Event</span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <h6 class="text-center w-100 py-3 m-2" style="font-size: 1.75rem; border-radius: 10px; background-color: #e1e1e1"> No events available.</h6>
        <?php endif; ?>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/web/platinum-club-app/Platinum-Club-App/resources/views/customer/events/index.blade.php ENDPATH**/ ?>