<?php $__env->startSection('heading', 'Add Subscription'); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-white rounded-md p-4 shadow-md container">
        <div class="border-b border-sky-200 pb-3">
            <h3 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                Add Subscription
            </h3>
            <div class="justify-between items-center flex">
                <p>
                    You can manually add any subscription after assigning the specific product plan. If the customer
                    purchases any plan from the checkout page or via API, the subscription is created automatically.
                </p>
                <div>
                    <div x-data="{showModal:false}">
                        <button
                            @click="showModal = true"
                            class="btn px-2 py-1 space-x-2 border border-primary font-medium text-primary ">
                            <i class="fa-solid fa-video fa-2x"></i>
                        </button>
                        <template x-teleport="#x-teleport-target">
                            <div
                                class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                                x-show="showModal"
                                role="dialog"
                                @keydown.window.escape="showModal = false"
                            >
                                <div
                                    class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"
                                    @click="showModal = false"
                                    x-show="showModal"
                                    x-transition:enter="ease-out"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="ease-in"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                ></div>
                                <div
                                    class="relative max-w-md rounded-lg bg-white p-0 transition-all duration-300 dark:bg-navy-700 "
                                    x-show="showModal"
                                    x-transition:enter="easy-out"
                                    x-transition:enter-start="opacity-0 [transform:translate3d(0,-1rem,0)]"
                                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                                    x-transition:leave="easy-in"
                                    x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]"
                                    x-transition:leave-end="opacity-0 [transform:translate3d(0,-1rem,0)]"
                                >
                                    <div
                                        class="relative  overflow-hidden w-96"
                                        style="padding-bottom: 56.25%"
                                    >
                                        <iframe
                                            src="https://www.youtube.com/embed/UBOj6rqRUME"
                                            frameborder="0"
                                            allowfullscreen
                                            class="absolute top-0 left-0 w-full h-full"
                                        ></iframe>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block">
                    <span>Customer Email <sup class="text-rose-500">*</sup></span>
                    <select
                        class="mt-1.5 w-full"
                        x-init="$el._tom = new Tom($el,{create: true,sortField: {field: 'text',direction: 'asc'}})"
                    >
                        <option></option>
                    </select>
                </label>
            </div>
            <div>
                <div class="pb-3"><label>Email To</label></div>
                <label class="inline-flex items-center space-x-2">
                    <input
                        class="form-checkbox is-basic h-5 w-5 rounded bg-slate-100 border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:bg-navy-900 dark:border-navy-500 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                        type="checkbox"/>
                    <p>example@gmail.com</p>
                </label> <br>
                <small>
                    Check if you want to notify this customer about his subscription via email.
                </small>
            </div>
        </div>
        <div class="card m-4 p-4">
            <h3 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                Assign Product and Plan
            </h3>
            <div class="grid grid-cols-2 gap-4 mt-3">
                <div>
                    <label class="block">
                        <span>Select Product <sup class="text-rose-500">*</sup></span>
                        <select
                            class="form-select mt-1 h-8 w-full m  rounded-lg border border-slate-300 bg-white px-2.5 text-xs+ hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                        >
                            <option>Test</option>
                        </select>
                    </label>
                    <small>
                        Select the product for which you want to create a subscription for your customer.
                    </small>
                </div>
            </div>
            <div class="mt-4">
                <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                        <tr>
                            <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                PLAN NAME
                            </th>
                            <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                QTY
                            </th>
                            <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                UNIT PRICE
                            </th>
                            <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                SETUP FEE
                            </th>
                            <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                AMOUNT
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <label class="block">
                                    <span>Customer Email <sup class="text-rose-500">*</sup></span>
                                    <select
                                        class="mt-1.5 w-4/12"
                                        x-init="$el._tom = new Tom($el,{create: true,sortField: {field: 'text',direction: 'asc'}})"
                                    >
                                        <option></option>
                                    </select>
                                </label>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">Cy Ganderton</td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                Quality Control Specialist
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">Blue</td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">Blue</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>

    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\platinum\resources\views/subscription/add-subscription.blade.php ENDPATH**/ ?>