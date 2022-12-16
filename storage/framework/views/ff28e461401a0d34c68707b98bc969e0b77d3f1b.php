

<?php $__env->startSection('heading', 'Tasks'); ?>

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
  <li>20 Top Performers</li>
</ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
  <!-- Users Table -->
  <div>
    <div class="flex items-center justify-between">
      <h2
        class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
      >
        Tasks Table
      </h2>
      <div class="flex">
        <div class="flex items-center" x-data="{isInputActive:false}">
          <form>
          <label class="block">
            <select
              onchange="tableSearch(this)"
              class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 pr-8 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
              name="search"
            >
              <option value="0" <?php if(request('search',0)==0): echo 'selected'; endif; ?>>All time</option>
              <option value="1" <?php if(request('search',0)==1): echo 'selected'; endif; ?>>Monthly</option>
              <option value="2" <?php if(request('search',0)==2): echo 'selected'; endif; ?>>Yearly</option>
            </select>
          </label>
          </form>
          
        </div>
        <div
          class="inline-flex"
        >
        
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div
        class="is-scrollbar-hidden min-w-full overflow-x-auto"
        x-data="pages.tables.initExample1"
      >
        <table class="is-hoverable w-full text-left">
          <thead>
            <tr>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Rank
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Name
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Club
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Revenue
              </th>
            </tr>
          </thead>
            <?php $__empty_1 = true; $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr
                class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"
              >
                <td
                  class="whitespace-nowrap px-4 py-3 sm:px-5"
                ><?php echo e($loop->iteration); ?></td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                  <?php echo e($stat->user?->first_name); ?> <?php echo e($stat->user?->last_name); ?>

                </td>
                <td
                  class="whitespace-nowrap px-3 py-3 sm:px-5"
                ><?php echo e($stat->user?->club?->name); ?></td>
                <td
                  class="whitespace-nowrap px-3 py-3 sm:px-5"
                ><?php echo e($stat->profit); ?></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr>
                <td class="text-center p-5" colspan="9">No Data...</td>
              </tr>
              <?php endif; ?>
          </tbody>
        </table>
      </div>

      <div
        class="paginate-div flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5"
      >
        

        
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  function tableSearch(obj)
  {
    $('<form action=""></form>').append('<input type="hidden" name="search" value="'+$(obj).val()+'">').appendTo('body').submit().remove();
  }
  function taskDelete(obj)
  {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#5e3ace',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Warning!',
          'Deleting Task',
          'warning'
        );
        $(obj).closest('form').submit();
      }
    })
  }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/web/platinum-club-app/Platinum-Club-App/resources/views/customer/top_performers/index.blade.php ENDPATH**/ ?>