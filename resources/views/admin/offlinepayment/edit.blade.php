@extends('admin.layouts.app')

@section('heading', 'Offline Collection Edit')

@section('breadcrums')

    <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
    </div>
    <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
        <li class="flex items-center space-x-2">
            <a
                class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                href="{{ route('admin.dashboard') }}"
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
                href="{{ route('admin.offlinepayments.index') }}"
            >Offline Collection</a
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
<div class="card grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
  <div class="col-span-12">
    <div class=" p-4 sm:p-5">
      <p
        class="text-base font-medium text-slate-700 dark:text-navy-100"
      >
        Customer Details
      </p>
        <form method="POST"
              id="createInvoiceForm"
              action="{{route('admin.offlinepayments.update',$invoices->id)}}"
              accept-charset="UTF-8"
              class="p-lg-5 p-3"
              enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')
        <input type="hidden" value="" name="paymentIntent">
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <label class="block">
              <span>Customer</span>
              <select
                class="select2 form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                @error('customer_id')
                    border-error
                @enderror"
                name="customer_id"
                required
              >
              @foreach($customers as $customer)
                <option value="{{$customer->id}}" @selected(old('customer_id',$invoices->customer_id)==$customer->id)>{{$customer->name}}</option>
              @endforeach
              </select>
              @error('customer_id')
                <span class="text-tiny+ text-error">{{$message}}</span>
              @enderror
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
            @foreach($productLogs as $productLog)
              <div class="grid mt-2 grid-cols-1 gap-4 sm:grid-cols-12">

                <label class="block sm:col-span-6 product-label">
                  <span>Product</span>
                  <span class="relative mt-1.5 flex">
                    <select
                        class="select2 form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                          @error('product_id')
                              border-error
                          @enderror"
                      name="product_id[]"
                      onchange="getProduct(this)"
                      required
                    >
                      <option value="">Select Product</option>
                      @foreach($products as $key => $product)
                            <option value="{{$product->id}}" @selected($productLog->product_id==$product->id)>{{$product->name}}</option>
{{--                                  <option value="{{$key}}">{{$product->name}}</option>--}}
                      @endforeach
                    </select>
                  </span>
                </label>
                <label class="block sm:col-span-2">
                  <span>Product Qty</span>
                  <span class="relative mt-1.5 flex">
                    <input
                      class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                      @error('product_qty')
                      border-error
                      @enderror"
                      placeholder="Product Qty"
                      name="product_qty[]"
                      type="number"
                      step="1"
                      min="1"
                      value="{{$productLog->qty}}"
                      required
                    />
                  </span>
                  @error('product_qty')
                    <span class="text-tiny+ text-error">{{$message}}</span>
                  @enderror
                </label>
                <label class="block sm:col-span-4 product-price-label">
                  <span>Product Price</span>
                  <span class="relative mt-1.5 flex">
                    <input
                      readonly
                      class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                      product_price"
                      placeholder="Product Price"
                      name="product_price[]"
                      type="text"
                      value="{{ $productLog->price }}"
                    />
                  </span>
                  @error('product_price')
                    <span class="text-tiny+ text-error">{{$message}}</span>
                  @enderror
                </label>
              </div>
            @endforeach
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
                @error('product_description')
                border-error
                @enderror"
                placeholder="Invoice Description"
                name="description"

              >{{$invoices->description}}</textarea>
            </span>
            @error('description')
              <span class="text-tiny+ text-error">{{$message}}</span>
            @enderror
          </label>

          <div class="flex justify-end mt-2 space-x-2">
            <button
              class="btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90 pay-btn"
              type="submit"
              >
              <span>Update</span>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        function addProduct()
        {
            $('#products_div').append(`<div class="product_div grid mt-2 grid-cols-1 gap-4 sm:grid-cols-12">
              <label class="block sm:col-span-6 product-label">
                <span>Product Name</span>
                <span class="relative mt-1.5 flex">
                  <select
                    class="form-select w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent product_id"
                    name="product_id[]"
                    onchange="getProduct(this)"
                    required
                  >
                    <option value="">Select Product</option>
                    @foreach($products as $key => $product)
            <option value="{{$key}}">{{$product}}</option>
                    @endforeach
            </select>
          </span>
        </label>
        <label class="block sm:col-span-2 product-qty-label">
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
        <label class="block sm:col-span-2 product-price-label">
          <span>Product Price</span>
          <span class="relative mt-1.5 flex">
            <input
              readonly
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
        // $(document).ready(function(){
        //     $('input[name="payment_method"]').change(function(e){
        //         if($('input[name="payment_method"]:checked').val()==0)
        //             $('#payment_fields').slideUp('slow');
        //         else
        //             $('#payment_fields').slideDown('slow');
        //     }).trigger('change');
        // });

        {{--        @if($gateway->stripe_active)--}}
        {{--        const stripe = Stripe("{{$gateway->stripe_public}}");--}}
        {{--        var backURL = '{{url('/customer/invoices/stripe/success')}}';--}}
        // var paymentIntent = '';
        {{--        @endif--}}

        function getProduct(obj) {
            let data = {product_id:$(obj).val()};
            let product = ajaxCallRequest('{{ route('products.getProductById') }}',
                'GET',data);
            product.then(function(data){
                $(obj).parents('.product-label').siblings('.product-price-label').find('input').val(data.product.price);
            });
        }

    </script>
@endpush
