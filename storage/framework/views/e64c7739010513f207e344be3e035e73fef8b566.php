

<?php $__env->startSection('heading', 'Reminder Create'); ?>

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
      href="<?php echo e(route('tasks.index')); ?>"
      >Reminders</a
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
  <li>Create</li>
</ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
  <div class="col-span-12">
    <div class=" p-4 sm:p-5">
      <p
        class="text-base font-medium text-slate-700 dark:text-navy-100"
      >
        Reminder Create
      </p>
      <form method="post" action="<?php echo e(route('tasks.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="mt-4 space-y-4">
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <label class="block">
              <span>Reminder Category</span>
              <select
                class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                <?php $__errorArgs = ['task_category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                border-error
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                name="task_category_id"
                required
              >
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" <?php if(old('task_category_id',0)==$category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <?php $__errorArgs = ['task_category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-tiny+ text-error"><?php echo e($message); ?></span>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </label>
            <label class="block">
              <span>Name</span>
              <span class="relative mt-1.5 flex">
                <input
                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent 
                  <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  border-error
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                  placeholder="Task Name"
                  name="name"
                  type="text"
                  value="<?php echo e(old('name')); ?>"
                  required
                />
              </span>
              <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-tiny+ text-error"><?php echo e($message); ?></span>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </label>
          </div>

          <div class="grid grid-cols-1 gap-4">
            <label class="block">
              <span>Type</span><br>
              <label class="inline-flex items-center space-x-2 pt-2">
                <input
                  checked
                  class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                  name="type"
                  value="0"
                  <?php if(old('type',0)==0): echo 'checked'; endif; ?>
                  type="radio"
                />
                <span>One-Time</span>
              </label>
              <label class="inline-flex items-center space-x-2 pt-2">
                <input
                  class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                  name="type"
                  value="1"
                  <?php if(old('type',0)==1): echo 'checked'; endif; ?>
                  type="radio"
                />
                <span>Recurring</span>
              </label>
              <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-tiny+ text-error"><?php echo e($message); ?></span>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </label>
            
          </div>

          <div id="oneTimeDiv" class="block">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <label class="block">
                <span>DateTime</span><br>
                <label class="relative flex">
                  <input
                    x-init="$el._x_flatpickr = flatpickr($el,{enableTime: true,altInput: true,altFormat: 'd-m-Y H:i',dateFormat: 'Y-m-d H:i'})"
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                    <?php $__errorArgs = ['task_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    border-error
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Choose datetime..."
                    type="text"
                    name="task_date"
                    value="<?php echo e(old('task_date')); ?>"
                  />
                  <span
                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-5 w-5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="1.5"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                      />
                    </svg>
                  </span>
                </label>
                <?php $__errorArgs = ['task_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <span class="text-tiny+ text-error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </label>
            </div>
          </div>

          <div id="recurringDiv" class="space-y-4 block" style="display: none;">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <label class="block">
                <span>Start DateTime</span><br>
                <label class="relative flex">
                  <input
                    x-init="$el._x_flatpickr = flatpickr($el,{enableTime: true,altInput: true,altFormat: 'd-m-Y H:i',dateFormat: 'Y-m-d H:i'})"
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                    <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    border-error
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Choose start datetime..."
                    type="text"
                    name="start_date"
                    value="<?php echo e(old('start_date')); ?>"
                  />
                  <span
                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-5 w-5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="1.5"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                      />
                    </svg>
                  </span>
                </label>
                <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <span class="text-tiny+ text-error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </label>
              <label class="block">
                <span>End DateTime</span><br>
                <label class="relative flex">
                  <input
                    x-init="$el._x_flatpickr = flatpickr($el,{enableTime: true,altInput: true,altFormat: 'd-m-Y H:i',dateFormat: 'Y-m-d H:i'})"
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                    <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    border-error
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Choose end datetime..."
                    type="text"
                    name="end_date"
                    value="<?php echo e(old('end_date')); ?>"
                  />
                  <span
                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-5 w-5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="1.5"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                      />
                    </svg>
                  </span>
                </label>
                <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <span class="text-tiny+ text-error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </label>
            </div>

            <div class="grid grid-cols-1 gap-4">
              <label class="block">
                <span>Frequency Type</span><br>
                <label class="inline-flex items-center space-x-2 pt-2">
                  <input
                    checked
                    class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                    name="frequency"
                    value="0"
                    <?php if(old('frequency',1)==1): echo 'checked'; endif; ?>
                    type="radio"
                  />
                  <span>Daily</span>
                </label>
                <label class="inline-flex items-center space-x-2 pt-2">
                  <input
                    class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                    name="frequency"
                    value="1"
                    <?php if(old('frequency',1)==2): echo 'checked'; endif; ?>
                    type="radio"
                  />
                  <span>Bi-Weekly</span>
                </label>
                <label class="inline-flex items-center space-x-2 pt-2">
                  <input
                    class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                    name="frequency"
                    value="2"
                    <?php if(old('frequency',1)==3): echo 'checked'; endif; ?>
                    type="radio"
                  />
                  <span>Weekly</span>
                </label>
                <label class="inline-flex items-center space-x-2 pt-2">
                  <input
                    class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                    name="frequency"
                    value="3"
                    <?php if(old('frequency',1)==4): echo 'checked'; endif; ?>
                    type="radio"
                  />
                  <span>Monthly</span>
                </label>
                <?php $__errorArgs = ['frequency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <span class="text-tiny+ text-error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </label>
            </div>

            <div id="bi_weekly_div" class="grid grid-cols-1 gap-4 sm:grid-cols-2" style="display: none;">
              <label class="block">
                <span>First Day of the Week</span>
                <select
                  class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                  <?php $__errorArgs = ['day_of_week_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  border-error
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                  name="day_of_week_1"
                  required
                >
                  <option value="Monday" <?php if(old('day_of_week_1','Monday')=='Monday'): echo 'selected'; endif; ?>>Monday</option>
                  <option value="Tuesday" <?php if(old('day_of_week_1','Monday')=='Tuesday'): echo 'selected'; endif; ?>>Tuesday</option>
                  <option value="Wednesday" <?php if(old('day_of_week_1','Monday')=='Wednesday'): echo 'selected'; endif; ?>>Wednesday</option>
                  <option value="Thursday" <?php if(old('day_of_week_1','Monday')=='Thursday'): echo 'selected'; endif; ?>>Thursday</option>
                  <option value="Friday" <?php if(old('day_of_week_1','Monday')=='Friday'): echo 'selected'; endif; ?>>Friday</option>
                  <option value="Saturday" <?php if(old('day_of_week_1','Monday')=='Saturday'): echo 'selected'; endif; ?>>Saturday</option>
                  <option value="Sunday" <?php if(old('day_of_week_1','Monday')=='Sunday'): echo 'selected'; endif; ?>>Sunday</option>
                </select>
                <?php $__errorArgs = ['day_of_week_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <span class="text-tiny+ text-error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </label>
              <label class="block">
                <span>Second Day of the Week</span>
                <select
                  class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                  <?php $__errorArgs = ['day_of_week_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  border-error
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                  name="day_of_week_2"
                  required
                >
                  <option value="Monday" <?php if(old('day_of_week_1','Monday')=='Monday'): echo 'selected'; endif; ?>>Monday</option>
                  <option value="Tuesday" <?php if(old('day_of_week_1','Monday')=='Tuesday'): echo 'selected'; endif; ?>>Tuesday</option>
                  <option value="Wednesday" <?php if(old('day_of_week_1','Monday')=='Wednesday'): echo 'selected'; endif; ?>>Wednesday</option>
                  <option value="Thursday" <?php if(old('day_of_week_1','Monday')=='Thursday'): echo 'selected'; endif; ?>>Thursday</option>
                  <option value="Friday" <?php if(old('day_of_week_1','Monday')=='Friday'): echo 'selected'; endif; ?>>Friday</option>
                  <option value="Saturday" <?php if(old('day_of_week_1','Monday')=='Saturday'): echo 'selected'; endif; ?>>Saturday</option>
                  <option value="Sunday" <?php if(old('day_of_week_1','Monday')=='Sunday'): echo 'selected'; endif; ?>>Sunday</option>
                </select>
                <?php $__errorArgs = ['day_of_week_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <span class="text-tiny+ text-error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </label>
            </div>

            <div id="weekly_div" class="grid grid-cols-1 gap-4" style="display: none;">
              <label class="block">
                <span>Day of the Week</span>
                <select
                  class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                  <?php $__errorArgs = ['day_of_week'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  border-error
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                  name="day_of_week"
                  required
                >
                  <option value="Monday" <?php if(old('day_of_week_2','Monday')=='Monday'): echo 'selected'; endif; ?>>Monday</option>
                  <option value="Tuesday" <?php if(old('day_of_week_2','Monday')=='Tuesday'): echo 'selected'; endif; ?>>Tuesday</option>
                  <option value="Wednesday" <?php if(old('day_of_week_2','Monday')=='Wednesday'): echo 'selected'; endif; ?>>Wednesday</option>
                  <option value="Thursday" <?php if(old('day_of_week_2','Monday')=='Thursday'): echo 'selected'; endif; ?>>Thursday</option>
                  <option value="Friday" <?php if(old('day_of_week_2','Monday')=='Friday'): echo 'selected'; endif; ?>>Friday</option>
                  <option value="Saturday" <?php if(old('day_of_week_2','Monday')=='Saturday'): echo 'selected'; endif; ?>>Saturday</option>
                  <option value="Sunday" <?php if(old('day_of_week_2','Monday')=='Sunday'): echo 'selected'; endif; ?>>Sunday</option>
                </select>
                <?php $__errorArgs = ['day_of_week'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <span class="text-tiny+ text-error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </label>
            </div>

            <div id="monthly_div" class="grid grid-cols-1 gap-4" style="display: none;">
              <label class="block">
                <span>Day of the Month</span>
                <select
                  class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                  <?php $__errorArgs = ['day_of_month'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  border-error
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                  name="day_of_month"
                  required
                >
                <?php for($i=1;$i<32;$i++): ?>
                  <option value="<?php echo e($i); ?>" <?php if(old('day_of_week',1)==$i): echo 'selected'; endif; ?>><?php echo e($i); ?></option>
                <?php endfor; ?>
                </select>
                <?php $__errorArgs = ['day_of_month'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <span class="text-tiny+ text-error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </label>
            </div>

          </div>

          <div class="flex justify-end space-x-2">
            <button
              class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
              type="submit"
            >
              <span>Submit</span>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  $(document).ready(function(){
    $('input[name="type"]').change(function(e){
      if($(this).val()==0)
      {
        $('#oneTimeDiv').slideDown('slow');
        $('#recurringDiv').slideUp('slow');
      }
      else
      {
        $('#oneTimeDiv').slideUp('slow');
        $('#recurringDiv').slideDown('slow');
      }
    });
    $('input[name="frequency"]').change(function(e) {
      console.log(($(this).val()));
      switch($(this).val())
      {
        case '0': 
          $('#bi_weekly_div').slideUp('slow');
          $('#weekly_div').slideUp('slow');
          $('#monthly_div').slideUp('slow');
          break; 

        case '1': 
          $('#bi_weekly_div').slideDown('slow');
          $('#weekly_div').slideUp('slow');
          $('#monthly_div').slideUp('slow');
          break; 

        case '2': 
          $('#bi_weekly_div').slideUp('slow');
          $('#weekly_div').slideDown('slow');
          $('#monthly_div').slideUp('slow');
          break; 

        case '3': 
          $('#bi_weekly_div').slideUp('slow');
          $('#weekly_div').slideUp('slow');
          $('#monthly_div').slideDown('slow');
          break;
      }
    });

    $('input[name="type"][value="<?php echo e(old('type',0)); ?>"]').prop('checked',true).trigger('change');
    $('input[name="frequency"][value="<?php echo e(old('frequency',0)); ?>"]').prop('checked',true).trigger('change');
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/web/platinum-club-app/Platinum-Club-App/resources/views/customer/tasks/create.blade.php ENDPATH**/ ?>