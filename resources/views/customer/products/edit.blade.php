@extends('layouts.app')

@section('heading', 'Edit Product')

@section('breadcrums')
    <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
    </div>
    <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
        <li class="flex items-center space-x-2">
            <a
                class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                href="{{ route('home') }}"
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
                href="{{ route('products.index') }}"
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
@endsection
@section('content')
    <form method="POST"
          action="{{ route('products.update',$product->id) }}"
          accept-charset="UTF-8"
          class="p-lg-5 p-3"
          enctype="multipart/form-data"
          id="productForm"
          >
        @csrf
        @method('put')

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
                                    value="{{ $product->name }}"
                                    required
                                />
                            </span>
                            @error('name')
                            <span class="text-tiny+ text-error">{{$message}}</span>
                            @enderror
                        </label>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
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
                                    value="{{ $product->price }}"
                                    required
                                />
                            </span>
                            @error('price')
                            <span class="text-tiny+ text-error">{{$message}}</span>
                            @enderror
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
                                    value="{{ $product->downpayment }}"
                                />
                            </span>
                            @error('downpayment')
                            <span class="text-tiny+ text-error">{{$message}}</span>
                            @enderror
                        </label>
                        </div>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <label class="block">
                                <span>Tax</span>
                                <span class="relative mt-1.5 flex">
                                    <input
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Product Tax"
                                        type="number"
                                        name="tax"
                                        min="0"
                                        max="50"
                                        {{--                                    step="0.01"--}}
                                        value="{{ $product->tax }}"
                                    />
                                </span>
                                @error('tax')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>
                            <label class="inline-flex items-center space-x-2 ml-4" style="margin-top: 27px">
                            <label class="inline-flex items-center space-x-2" x-data="{emi: [1]}">
                                <input
                                    type="checkbox"
                                    class="form-checkbox is-outline h-5 w-5 rounded-full border-slate-400/70 before:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:before:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                                    name="emi"
                                   id="emi" {{($product->emi?'checked':'')}}>
                                <p class="" for="emi">Emi</p>
                            </label>
                                @error('emi')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>
                        </div>

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
                            @error('image')
                            <span class="text-tiny+ text-error">{{$message}}</span>
                            @enderror
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
                          >{!!$product->description!!}</div>
                          @error('description')
                            <span class="text-tiny+ text-error">{{$message}}</span>
                          @enderror
                        {{-- <label class="block">
                            <span>Product Description</span>
                            <span class="relative mt-1.5 flex">
                                <textarea
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Product Description"
                                    rows="4"
                                    name="description"
                                >{{$product->description}}</textarea>
                            </span>
                            @error('description')
                            <span class="text-tiny+ text-error">{{$message}}</span>
                            @enderror
                        </label> --}}
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
@endsection

@push('styles')
<style type="text/css">
    .ql-toolbar.ql-snow+.ql-container.ql-snow {
        margin-top: 0px;
    }
</style>
@endpush


@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
  $("#productForm").on("submit", function (e) {
    var hvalue = $('.ql-editor').html();
    $(this).append("<textarea name='description' style='display:none'>"+hvalue+"</textarea>");
   });
});
</script>
@endpush
