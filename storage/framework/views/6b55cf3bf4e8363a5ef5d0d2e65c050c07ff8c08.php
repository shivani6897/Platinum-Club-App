

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
      <form id="createInvoiceForm" method="post" action="<?php echo e(route('invoices.store')); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" value="" name="paymentIntent">
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
                <option value="<?php echo e($customer->id); ?>" <?php if(old('customer_id',0)==$customer->id): echo 'selected'; endif; ?>><?php echo e($customer->name); ?></option>
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
            <?php $__empty_1 = true; $__currentLoopData = old('product_name',[]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php if($loop->first): ?>
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
                    value="<?php echo e(old('product_name')[0]); ?>"
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
                    value="<?php echo e(old('product_qty')[0]); ?>"
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
                    value="<?php echo e(old('product_price')[0]); ?>"
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
            <?php else: ?>
            <div class="product_div grid mt-2 grid-cols-1 gap-4 sm:grid-cols-12">
              <label class="block sm:col-span-6">
                <span>Product Name</span>
                <span class="relative mt-1.5 flex">
                  <input
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                    placeholder="Product Name"
                    name="product_name[]"
                    type="text"
                    value="<?php echo e(old('product_name')[$loop->index]); ?>"
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
                    value="<?php echo e(old('product_qty')[$loop->index]); ?>"
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
                    value="<?php echo e(old('product_price')[$loop->index]); ?>"
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
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
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
                    value=""
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
                    value=""
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
                    value=""
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
            <?php endif; ?>
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
            <div id="stripeForm"></div>
            <div class="grid mt-2 grid-cols-1 gap-4 sm:grid-cols-4">
              
            </div>
          </div>

          <div class="flex justify-end mt-2 space-x-2">
            <button
              class="pay-btn btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
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
<script src="https://js.stripe.com/v3/"></script>
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
    $('input[name="payment_method"]').change(function(e){
      if($('input[name="payment_method"]:checked').val()==0)
        $('#payment_fields').slideUp('slow');
      else
        $('#payment_fields').slideDown('slow');
    }).trigger('change');
  });

  const stripe = Stripe("<?php echo e(config('payment.STRIPE_PUBLIC')); ?>");
  var backURL = '<?php echo e(url('/customer/invoices/stripe/success')); ?>';
  var paymentIntent = '';

  $('#createInvoiceForm').submit(function(e){
    e.preventDefault();
    var event = e;

    if(parseInt($('input[name="payment_method"]:checked').val())>0)
    {
      var total = 0;
      $('input[name="product_price[]"]').each(function(i,v){
        total += (parseInt($('input[name="product_price[]"]').get(i).value)*parseInt($('input[name="product_qty[]"]').get(i).value));
      });
      console.log(paymentIntent);
      backURL = backURL + "?" + $(this).serialize();
      $.ajax({
        url: "<?php echo e(url('/customer/invoices/test')); ?>/"+total,
        method: "post",
        data: {
          _token: '<?php echo e(csrf_token()); ?>',
          paymentIntent: paymentIntent,
        },
        success: function(result) {
          // const { clientSecret } = JSON.parse(result);

          // elements = stripe.elements({ clientSecret });
          // const paymentElementOptions = {
          //   layout: "tabs",
          // };

          // const paymentElement = elements.create("payment", paymentElementOptions);
          // paymentElement.mount("#stripeForm");
          handleSubmit(event);
        },
        error: function(e) {
          console.error(e);
        }
      });
    }
    else
    {
      this.submit();
    }
  })


// Fetches a payment intent and captures the client secret
async function initialize() {
  const { clientSecret } = await fetch("<?php echo e(url('/customer/invoices/test')); ?>/1", {
    method: "post",
    headers: { "Content-Type": "application/json" },
    body: {
      _token: '<?php echo e(csrf_token()); ?>'
    },
  }).then((r) => r.json());
  const appearence = {
    theme: 'flat'
  };

  paymentIntent = clientSecret;
  $('input[name="paymentIntent"]').val(clientSecret);
  elements = stripe.elements({ clientSecret,appearence });

  const paymentElementOptions = {
    layout: "tabs",
  };

  const paymentElement = elements.create("payment", paymentElementOptions);
  paymentElement.mount("#stripeForm");
}

async function handleSubmit(e) {
  e.preventDefault();
  setLoading(true);

  const { error } = await stripe.confirmPayment({
    elements,
    confirmParams: {
      // Make sure to change this to your payment completion page
      return_url: backURL,
    },
  });

  // This point will only be reached if there is an immediate error when
  // confirming the payment. Otherwise, your customer will be redirected to
  // your `return_url`. For some payment methods like iDEAL, your customer will
  // be redirected to an intermediate site first to authorize the payment, then
  // redirected to the `return_url`.
  if (error.type === "card_error" || error.type === "validation_error") {
    showMessage(error.message);
  } else {
    showMessage("An unexpected error occurred.");
  }

  setLoading(false);
}

function setLoading(isLoading) {
  if (isLoading) {
    // Disable the button and show a spinner
    document.querySelector(".pay-btn").disabled = true;
    document.querySelector(".pay-btn").innerHTML = "Loading...";
  } else {
    document.querySelector(".pay-btn").disabled = false;
    document.querySelector(".pay-btn").innerHTML = "Submit";
  }
}

initialize();
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/web/platinum-club-app/Platinum-Club-App/resources/views/customer/invoice/create.blade.php ENDPATH**/ ?>