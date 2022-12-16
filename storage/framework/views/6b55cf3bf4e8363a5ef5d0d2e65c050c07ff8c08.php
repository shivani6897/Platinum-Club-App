

<?php $__env->startSection('heading', 'Invoice Create'); ?>

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
      >Invoice</a
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
        Customer Details
      </p>
      <form method="post" action="<?php echo e(route('invoices.store')); ?>">
        <?php echo csrf_field(); ?>
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <label class="block">
              <span>Customer</span>
              <select
                class="select2 form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                <?php $__errorArgs = ['customer_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                border-error
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                name="customer_id"
                required
              >
              <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($customer->id); ?>" <?php if(old('customer_id',0)==$customer->id): echo 'selected'; endif; ?>><?php echo e($customer->customer_name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <?php $__errorArgs = ['customer_id'];
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

          <div class="grid mt-2 grid-cols-1 mt-5 gap-4 sm:grid-cols-12">
            <div class="sm:col-span-8">
              <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                Product Details
              </p>
            </div>
            <div class="sm:col-span-4 justify-end flex">
              <button
                class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90 text-end"
                type="button"
                onclick="addProduct()"
              >
                <span>Add</span>
              </button>
            </div>
          </div>

          <div id="products_div">
            <div class="grid mt-2 grid-cols-1 gap-4 sm:grid-cols-12">
              <label class="block sm:col-span-6">
                <span>Product Name</span>
                <span class="relative mt-1.5 flex">
                  <input
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent 
                    <?php $__errorArgs = ['product_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    border-error
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Product Name"
                    name="product_name[]"
                    type="text"
                    value="<?php echo e(old('product_name')); ?>"
                    required
                  />
                </span>
                <?php $__errorArgs = ['product_name'];
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
              <label class="block sm:col-span-2">
                <span>Product Qty</span>
                <span class="relative mt-1.5 flex">
                  <input
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent 
                    <?php $__errorArgs = ['product_qty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    border-error
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Product Qty"
                    name="product_qty[]"
                    type="number"
                    step="1"
                    min="1"
                    value="<?php echo e(old('product_qty')); ?>"
                    required
                  />
                </span>
                <?php $__errorArgs = ['product_qty'];
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
              <label class="block sm:col-span-4">
                <span>Product Price</span>
                <span class="relative mt-1.5 flex">
                  <input
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent 
                    <?php $__errorArgs = ['product_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    border-error
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Product Price"
                    name="product_price[]"
                    type="number"
                    step="0.01"
                    min="1"
                    value="<?php echo e(old('product_price')); ?>"
                    required
                  />
                </span>
                <?php $__errorArgs = ['product_price'];
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

          <p class="text-base font-medium text-slate-700 dark:text-navy-100">
            Payment Details
          </p>


          <label class="block mt-2 sm:col-span-4">
            <span>Invoice Description</span>
            <span class="relative mt-1.5 flex">
              <textarea
                rows="4"
                class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent 
                <?php $__errorArgs = ['product_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                border-error
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                placeholder="Invoice Description"
                name="description"
                required
              ><?php echo e(old('description')); ?></textarea>
            </span>
            <?php $__errorArgs = ['product_name'];
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

          <label class="block mt-2">
            <span>Payment Method</span><br>
            <label class="inline-flex items-center space-x-2 pt-2">
              <input
                checked
                class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                name="payment_method"
                value="0"
                <?php if(old('payment_method',0)==0): echo 'checked'; endif; ?>
                type="radio"
              />
              <span>Offline</span>
            </label>
            <label class="inline-flex items-center space-x-2 pt-2">
              <input
                class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                name="payment_method"
                value="1"
                <?php if(old('payment_method',0)==1): echo 'checked'; endif; ?>
                type="radio"
              />
              <span>Credit Card</span>
            </label>
            <label class="inline-flex items-center space-x-2 pt-2">
              <input
                class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                name="payment_method"
                value="2"
                <?php if(old('payment_method',0)==2): echo 'checked'; endif; ?>
                type="radio"
              />
              <span>Debit Card</span>
            </label>
            <?php $__errorArgs = ['payment_method'];
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

          <div id="payment_fields" style="display: none;">
            <div class="grid mt-2 grid-cols-1 gap-4 sm:grid-cols-4">
              <label class="block mt-2 sm:col-span-2">
                <span>Name on card</span>
                <span class="relative mt-1.5 flex">
                  <input
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent 
                    <?php $__errorArgs = ['name_on_card'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    border-error
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Name on card"
                    name="name_on_card"
                    type="text"
                    value="<?php echo e(old('name_on_card')); ?>"
                    required
                  />
                </span>
                <?php $__errorArgs = ['name_on_card'];
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
              <label class="block mt-2 sm:col-span-2">
                <span>Card Number</span>
                <span class="relative mt-1.5 flex">
                  <input
                    x-input-mask="{
                        numeric:true,
                        blocks: [4, 4, 4, 4],
                    }"
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent 
                    <?php $__errorArgs = ['card_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    border-error
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Card Number"
                    name="card_number"
                    type="text"
                    value="<?php echo e(old('card_number')); ?>"
                    required
                  />
                </span>
                <?php $__errorArgs = ['card_number'];
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
              <label class="block mt-2 sm:col-span-2">
                <span>Expiry Date</span>
                <span class="relative mt-1.5 flex">
                  <input
                    x-input-mask="{
                      numericOnly: true, 
                      blocks: [2, 2], 
                      delimiters: ['/']
                    }"
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent 
                    <?php $__errorArgs = ['expiry_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    border-error
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Expiry Date"
                    name="expiry_date"
                    type="text"
                    value="<?php echo e(old('expiry_date')); ?>"
                    required
                  />
                </span>
                <?php $__errorArgs = ['expiry_date'];
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
              <label class="block mt-2 sm:col-span-2">
                <span>Security Code</span>
                <span class="relative mt-1.5 flex">
                  <input
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent 
                    <?php $__errorArgs = ['security_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    border-error
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Card Number"
                    name="security_code"
                    type="number"
                    min="0"
                    max="9999"
                    value="<?php echo e(old('security_code')); ?>"
                    required
                  />
                </span>
                <?php $__errorArgs = ['security_code'];
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

          <div class="flex justify-end mt-2 space-x-2">
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
  function addProduct()
  {
    $('#products_div').append(`<div class="product_div grid mt-2 grid-cols-1 gap-4 sm:grid-cols-12">
              <label class="block sm:col-span-6">
                <span>Product Name</span>
                <span class="relative mt-1.5 flex">
                  <input
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                    placeholder="Product Name"
                    name="product_name[]"
                    type="text"
                    required
                  />
                </span>
              </label>
              <label class="block sm:col-span-2">
                <span>Product Qty</span>
                <span class="relative mt-1.5 flex">
                  <input
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                    placeholder="Product Qty"
                    name="product_qty[]"
                    type="number"
                    step="1"
                    min="1"
                    required
                  />
                </span>
              </label>
              <label class="block sm:col-span-2">
                <span>Product Price</span>
                <span class="relative mt-1.5 flex">
                  <input
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                    placeholder="Product Price"
                    name="product_price[]"
                    type="number"
                    step="0.01"
                    min="1"
                    required
                  />
                </span>
              </label>
              <div class="sm:col-span-2 flex justify-end items-end">
                <button
                  class="btn space-x-2 bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90 text-end"
                  type="button"
                  onclick="deleteProduct(this)"
                >
                  <span>Delete</span>
                </button>
            </div>`);
  }
  function deleteProduct(obj)
  {
    $(obj).closest('.product_div').remove();
  }
  $(document).ready(function(){
    $('input[name="payment_method"]').click(function(e){
      if($(this).val()==0)
        $('#payment_fields').slideUp('slow');
      else
        $('#payment_fields').slideDown('slow');
    });
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/web/platinum-club-app/Platinum-Club-App/resources/views/customer/invoice/create.blade.php ENDPATH**/ ?>