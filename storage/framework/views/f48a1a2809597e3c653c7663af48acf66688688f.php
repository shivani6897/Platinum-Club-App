

<?php $__env->startSection('heading', 'Edit Product'); ?>

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
                href="<?php echo e(route('products.index')); ?>"
            >Products</a
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
        <li>Edit</li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <form method="POST"
          action="<?php echo e(route('products.update',$product->id)); ?>"
          accept-charset="UTF-8"
          class="p-lg-5 p-3"
          enctype="multipart/form-data"
          id="productForm"
          >
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>

        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="col-span-12">
                <div class="card p-4 sm:p-5">
                    <div class="mt-4 space-y-4">
                        <label class="block">
                            <span>Name</span> <span>*</span>
                            <span class="relative mt-1.5 flex">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Product Name"
                                    type="text"
                                    name="name"
                                    autocomplete="off"
                                    value="<?php echo e($product->name); ?>"
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
                        <label class="block">
                            <span>Price</span> <span>*</span>
                            <span class="relative mt-1.5 flex">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Product Price"
                                    type="number"
                                    name="price"
                                    min="1"
                                    step="0.01"
                                    value="<?php echo e($product->price); ?>"
                                    required
                                />
                            </span>
                            <?php $__errorArgs = ['price'];
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
                            <span>Downpayment</span>
                            <span class="relative mt-1.5 flex">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Product Downpayment"
                                    type="number"
                                    name="downpayment"
                                    min="0"
                                    step="0.01"
                                    value="<?php echo e($product->downpayment); ?>"
                                />
                            </span>
                            <?php $__errorArgs = ['downpayment'];
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
                            <span>Image</span>
                            <span class="relative mt-1.5 flex">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Product Image"
                                    type="file"
                                    name="image"
                                />
                            </span>
                            <?php $__errorArgs = ['image'];
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
                        <div
                            class="h-48 "
                            x-init="$el._x_quill = new Quill($el,{
                            modules : {
                              toolbar: [
                                ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                                ['blockquote', 'code-block'],
                                [{ header: 1 }, { header: 2 }], // custom button values
                                [{ list: 'ordered' }, { list: 'bullet' }],
                                [{ script: 'sub' }, { script: 'super' }], // superscript/subscript
                                [{ indent: '-1' }, { indent: '+1' }], // outdent/indent
                                [{ direction: 'rtl' }], // text direction
                                [{ size: ['small', false, 'large', 'huge'] }], // custom dropdown
                                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                                [{ color: [] }, { background: [] }], // dropdown with defaults from theme
                                [{ font: [] }],
                                [{ align: [] }],
                                ['clean'], // remove formatting button
                              ],
                            },
                            placeholder: 'Enter your content...',
                            theme: 'snow',
                          })"
                          ><?php echo $product->description; ?></div>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style type="text/css">
    .ql-toolbar.ql-snow+.ql-container.ql-snow {
        margin-top: 0px;
    }
</style>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
$(document).ready(function(){
  $("#productForm").on("submit", function (e) {
    var hvalue = $('.ql-editor').html();
    $(this).append("<textarea name='description' style='display:none'>"+hvalue+"</textarea>");
   });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/web/platinum-club-app/Platinum-Club-App/resources/views/customer/products/edit.blade.php ENDPATH**/ ?>