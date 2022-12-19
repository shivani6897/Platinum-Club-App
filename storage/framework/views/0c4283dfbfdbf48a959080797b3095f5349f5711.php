

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
                href="<?php echo e(route('incomes.index')); ?>"
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
        <li>Add Business</li>
    </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    


    <div x-data="{activeTab:'tabHome'}" class="tabs flex flex-col">
        <div
            class="is-scrollbar-hidden overflow-x-auto rounded-lg bg-slate-200 text-slate-600 dark:bg-navy-800 dark:text-navy-200"
        >
            <div class="tabs-list flex px-1.5 py-1">
                <button
                    @click="activeTab = 'tabHome'"
                    onclick="saveSelectedTab('income')"
                    id="incomeTab"
                    :class="activeTab === 'tabHome' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                    class="btn shrink-0 px-3 py-1.5 font-medium"
                >
                    Income
                </button>
                <button
                    @click="activeTab = 'tabProfile'"
                    onclick="saveSelectedTab('expense')"
                    id="expenseTab"
                    :class="activeTab === 'tabProfile' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                    class="btn shrink-0 px-3 py-1.5 font-medium"
                >
                    Expense
                </button>
                <button
                    @click="activeTab = 'tabMessages'"
                    onclick="saveSelectedTab('lead')"
                    id="leadTab"
                    :class="activeTab === 'tabMessages' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                    class="btn shrink-0 px-3 py-1.5 font-medium"
                >
                    Lead
                </button>







            </div>
        </div>
        <div class="tab-content pt-4">
            <div
                x-show="activeTab === 'tabHome'"
                x-transition:enter="transition-all duration-500 easy-in-out"
                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
            >
                <div>
                    <form method="POST"
                          action="<?php echo e(route('incomes.store')); ?>"
                          accept-charset="UTF-8"
                          class="p-lg-5 p-3"
                          enctype="multipart/form-data"
                    >
                        <?php echo csrf_field(); ?>

                        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6 ">
                            <div class="col-span-12">
                                <div class="card p-4 sm:p-5">
                                    <div class="mt-4 space-y-4">
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                            <label class="block">
                                                <span>Income Category</span>
                                                <select
                                                    class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                                                    <?php $__errorArgs = ['income_category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        border-error
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    name="income_category_id"
                                                    required
                                                >
                                                    <?php $__currentLoopData = $incomeCateogries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $incomeCateogry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($incomeCateogry->id); ?>" <?php if(old('income_cateogry_id',0)==$incomeCateogry->id): echo 'selected'; endif; ?>><?php echo e($incomeCateogry->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['club_id'];
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
                                                <span>Income</span>
                                                <span class="relative mt-1.5 flex">
                                                    <input
                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                                             <?php $__errorArgs = ['income'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                  border-error
                                                             <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        placeholder="income"
                                                        name="income"
                                                        type="number"
                                                        value="<?php echo e(old('income')); ?>"
                                                        required
                                                        autocomplete="off"
                                                      />
                                                </span>
                                                <?php $__errorArgs = ['income'];
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
                                                  <span class="required">Date</span>
                                                  <span class="relative flex">
                                                      <input
                                                        x-init="$el._x_flatpickr = flatpickr($el,{altInput: true,altFormat: 'd-m-Y',dateFormat: 'Y-m-d'})"
                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 mt-1.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                                        float_value"
                                                        placeholder="Choose Date.."
                                                        name="date"
                                                        type="text"
                                                        value="<?php echo e(old('date')); ?>"
                                                        required
                                                        autocomplete="off"
                                                      />
                                              </span>
                                            </label>
                                        </div>
                                        <label class="block">
                                            <span>Description</span>
                                            <textarea
                                                rows="4"
                                                placeholder="Description"
                                                autocomplete="off"
                                                name="description"
                                                autocomplete="off"
                                                class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            >
                                                <?php echo e(old('description')); ?>

                                            </textarea>
                                            <?php $__errorArgs = ['description'];
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

                                    <div class="flex justify-end space-x-2">
                                        <button
                                            class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                            type="submit"
                                        >
                                            <span>Submit</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </form>
                </div>
            </div>

            <div
                x-show="activeTab === 'tabProfile'"
                x-transition:enter="transition-all duration-500 easy-in-out"
                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
            >
                <div>
                    <form method="POST"
                          action="<?php echo e(route('expenses.store')); ?>"
                          accept-charset="UTF-8"
                          class="p-lg-5 p-3"
                          enctype="multipart/form-data"
                    >
                        <?php echo csrf_field(); ?>

                        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6 ">
                            <div class="col-span-12">
                                <div class="card p-4 sm:p-5">
                                    <div class="mt-4 space-y-4">
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                            <label class="block">
                                                <span>Expense Category</span>
                                                <select
                                                    class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                                                    <?php $__errorArgs = ['expense_category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        border-error
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    name="expense_category_id"
                                                    required
                                                >
                                                    <?php $__currentLoopData = $expenseCateogries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expenseCateogry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($expenseCateogry->id); ?>" <?php if(old('expense_category_id',0)==$expenseCateogry->id): echo 'selected'; endif; ?>><?php echo e($expenseCateogry->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['club_id'];
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
                                                <span>Expense</span>
                                                <span class="relative mt-1.5 flex">
                                                    <input
                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                                         <?php $__errorArgs = ['expense'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            border-error
                                                         <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                         placeholder="expense"
                                                         name="expense"
                                                         type="number"
                                                         value="<?php echo e(old('expense')); ?>"
                                                         required
                                                         autocomplete="off"
                                                    />
                                                </span>
                                                <?php $__errorArgs = ['expense'];
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
                                                <span class="required">Date</span>
                                                <span class="relative flex">
                                                    <input
                                                        x-init="$el._x_flatpickr = flatpickr($el,{altInput: true,altFormat: 'd-m-Y',dateFormat: 'Y-m-d'})"
                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 mt-1.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                                        float_value"
                                                        placeholder="Choose Date.."
                                                        name="date"
                                                        type="text"
                                                        value="<?php echo e(old('date')); ?>"
                                                        required
                                                        autocomplete="off"
                                                    />
                                                </span>
                                            </label>
                                        </div>
                                        <label class="block">
                                            <span>Description</span>
                                            <textarea
                                                rows="4"
                                                placeholder="Description"
                                                autocomplete="off"
                                                name="description"
                                                autocomplete="off"
                                                class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            >
                                                <?php echo e(old('description')); ?>

                                            </textarea>
                                            <?php $__errorArgs = ['description'];
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

                                        <div class="flex justify-end space-x-2">
                                            <button
                                                class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                                type="submit"
                                            >
                                                <span>Submit</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div
                x-show="activeTab === 'tabMessages'"
                x-transition:enter="transition-all duration-500 easy-in-out"
                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
            >
                <div>
                    <form method="POST"
                          action="<?php echo e(route('leads.store')); ?>"
                          accept-charset="UTF-8"
                          class="p-lg-5 p-3"
                          enctype="multipart/form-data"
                    >
                        <?php echo csrf_field(); ?>

                        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6 ">
                            <div class="col-span-12">
                                <div class="card p-4 sm:p-5">
                                    <div class="mt-4 space-y-4">
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                            <label class="block">
                                                <span>Generated Lead</span> <span>*</span>
                                                <span class="relative mt-1.5 flex">
                                                    <input
                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                        placeholder="Lead Generated"
                                                        type="number"
                                                        name="lead_generated"
                                                        autocomplete="off"
                                                        value="<?php echo e(old('lead_generated')); ?>"
                                                        required
                                                    />
                                                </span>
                                                <?php $__errorArgs = ['lead_generated'];
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
                                                <span>Converted Customer</span> <span>*</span>
                                                <span class="relative mt-1.5 flex">
                                                    <input
                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                        placeholder="Converted Customer"
                                                        type="number"
                                                        name="converted_customer"
                                                        autocomplete="off"
                                                        value="<?php echo e(old('converted_customer')); ?>"
                                                        required
                                                    />
                                                </span>
                                                <?php $__errorArgs = ['converted_customer'];
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
                                                <span class="required">Date</span>
                                                <span class="relative flex">
                                                    <input
                                                        x-init="$el._x_flatpickr = flatpickr($el,{altInput: true,altFormat: 'd-m-Y',dateFormat: 'Y-m-d'})"
                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 mt-1.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                                        float_value"
                                                        placeholder="Choose Date.."
                                                        name="date"
                                                        type="text"
                                                        value="<?php echo e(old('date')); ?>"
                                                        required
                                                        autocomplete="off"
                                                    />
                                                </span>
                                            </label>
                                        </div>
                                        <div class="flex justify-end space-x-2">
                                            <button
                                                class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                            >
                                                <span>Submit</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
        function saveSelectedTab(name)
        {
            setCookie('business_stat',name,7);
        }
        $(document).ready(function(){
            name = getCookie('business_stat');
            if(name!='')
                $('#'+name+'Tab').click();
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/web/platinum-club-app/Platinum-Club-App/resources/views/customer/incomes/create.blade.php ENDPATH**/ ?>