

<?php $__env->startPush('styles'); ?>
<style type="text/css">
  .required:after{ 
    content:'*'; 
    color:red; 
    padding-left:5px;
  }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('heading', 'My Business'); ?>

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
    <a
      class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
      href="<?php echo e(url('business')); ?>"
      >Business</a
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
  <li><?php if(isset($businessStat)): ?> Edit <?php else: ?> Add <?php endif; ?> Stats</li>
</ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
  <div class="col-span-12">
    <div class=" p-4 sm:p-5">
      <p
        class="text-base font-medium text-slate-700 dark:text-navy-100"
      >
        <?php if(isset($businessStat)): ?> Edit <?php else: ?> Add <?php endif; ?> Stats
      </p>

      <?php if(isset($businessStat)): ?>
        <?php echo Form::model($businessStat, ['route' => ['business.update', $businessStat->id], 'method' => 'patch', 'autocomplete' => 'off']); ?>

      <?php else: ?>
        <?php echo Form::open(['route' => ['business.store'], 'method' => 'POST', 'autocomplete' => 'off']); ?>

      <?php endif; ?>
        <?php echo csrf_field(); ?>
        <div class="mt-4 space-y-4">
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <label class="block">
              <span class="required">Month</span>
              <span class="relative mt-1.5 flex">
                <input
                    x-init="$el._x_flatpickr = flatpickr($el,{altInput: true,altFormat: 'F Y',dateFormat: 'F Y',viewMode: 'years'})"
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 mt-1.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                    float_value"
                    placeholder="Month"
                    name="month"
                    type="text"
                    value="<?php echo e((isset($businessStat) ? $businessStat->month : '')); ?>"
                    required
                  />
              </span>
            </label>
          </div>
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <label class="block">
              <span class="required">Total Revenue Earned (<i class="fa-sharp fa-solid fa-indian-rupee-sign"></i>)</span>
              <span class="relative mt-1.5 flex">
                <input
                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent 
                  float_value"
                  placeholder="Total Revenue Earned"
                  name="revenue_earned"
                  type="text"
                  value="<?php echo e((isset($businessStat) ? $businessStat->revenue_earned : '')); ?>"
                  required
                />
              </span>
            </label>
          </div>
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <label class="block">
              <span class="required">Total Ad Spends (<i class="fa-sharp fa-solid fa-indian-rupee-sign"></i>)</span>
              <span class="relative mt-1.5 flex">
                <input
                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent 
                  float_value"
                  placeholder="Total Ad Spends"
                  name="ad_spends"
                  type="text"
                  value="<?php echo e((isset($businessStat) ? $businessStat->ad_spends : '')); ?>"
                  required
                />
              </span>
            </label>
          </div>
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <label class="block">
              <span class="required">Average Cost Per Lead (<i class="fa-sharp fa-solid fa-indian-rupee-sign"></i>)</span>
              <span class="relative mt-1.5 flex">
                <input
                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent 
                  float_value"
                  placeholder="Average Cost Per Lead"
                  name="avg_cost_per_lead"
                  type="text"
                  value="<?php echo e((isset($businessStat) ? $businessStat->avg_cost_per_lead : '')); ?>"
                  required
                />
              </span>
            </label>
          </div>
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <label class="block">
              <span class="required">Total Leads Generated</span>
              <span class="relative mt-1.5 flex">
                <input
                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent 
                  float_value"
                  placeholder="Total Leads Generated"
                  name="leads_generated"
                  value="<?php echo e((isset($businessStat) ? $businessStat->leads_generated : '')); ?>"
                  type="text"
                  required
                />
              </span>
            </label>
          </div>
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <label class="block">
              <span class="required">Total Paid Customers (L1)</span>
              <span class="relative mt-1.5 flex">
                <input
                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent 
                  float_value"
                  placeholder="Total Paid Customers (L1)"
                  name="paid_customer"
                  value="<?php echo e((isset($businessStat) ? $businessStat->paid_customer : '')); ?>"
                  type="text"
                  required
                />
              </span>
            </label>
          </div>
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <label class="block">
              <span class="required">Total Group Size</span>
              <span class="relative mt-1.5 flex">
                <input
                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent 
                  float_value"
                  placeholder="Total Group Size"
                  name="group_size"
                  value="<?php echo e((isset($businessStat) ? $businessStat->group_size : '')); ?>"
                  type="text"
                  required
                />
              </span>
            </label>
          </div>
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <label class="block">
              <span class="required">Ovderhead</span>
              <span class="relative mt-1.5 flex">
                <input
                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent 
                  float_value"
                  placeholder="Return On Ad Spends"
                  name="overheads"
                  type="text"
                  value="<?php echo e((isset($businessStat) ? $businessStat->overheads : '')); ?>"
                  required
                />
              </span>
            </label>
          </div>

          <div class="flex justify-end space-x-2">
            <a
              class="btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-700 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-100 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
              href="<?php echo e(url('business')); ?>"
            >
              Cancel
            </a>
            <button
              class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
              type="submit"
            >
              <span>Submit</span>
            </button>
          </div>
        </div>
      <?php echo e(Form::close()); ?>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
  $('.float_value').keyup(function () {
    var val = $(this).val();
    if (isNaN(val)) {
      val = val.replace(/[^0-9\.]/g, '');
      if (val.split('.').length > 2)
        val = val.replace(/\.+$/, "");
    }
    $(this).val(val);
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/web/platinum-club-app/Platinum-Club-App/resources/views/customer/business/create.blade.php ENDPATH**/ ?>