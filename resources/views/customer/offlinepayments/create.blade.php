@extends('layouts.app')

@section('heading', 'Offline Collection')

@section('breadcrums')
    <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
    </div>
    <div class="row flex justify-between w-full">
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
            </li>
            <li>Offline Collection</li>
        </ul>

        <div class="flex justify-end mt-1 space-x-2">
            <button
                style="background-color: #38bdf8; color: white!important;"
                class="btn p-2 rounded-full border border-slate-300 px-2.5 pr-9 pl-9 text-xs+ hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                type="button"
                disabled
            >
                <span>Total Collection:<br> {{$invoices->sum('total_amount')}}/-</span>
            </button>
        </div>
    </div>
@endsection


@section('content')

    <div>
        <div class="grid md:grid-cols-2 md:gap-6 mt-7">
            <div>
                <div class="col-span-12">
                    <div class="card p-4 sm:p-5">
                        <div x-data="{showModal:false}" >

                            <p
                                class="text-base font-medium text-slate-700 dark:text-navy-100 flex justify-between"
                            >
                                Customer Details
                            
                                <button
                                    @click="showModal = true"
                                    class="btn space-x-2 bg-primary text-white font-medium hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                >
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </p>

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
                                    <div style="width: 50%;"
                                        class="relative rounded-lg bg-white pt-10 pb-4 transition-all duration-300 dark:bg-navy-700"
                                        x-show="showModal"
                                        x-transition:enter="easy-out"
                                        x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]"
                                        x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                                        x-transition:leave="easy-in"
                                        x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]"
                                        x-transition:leave-end="opacity-0 [transform:translate3d(0,1rem,0)]">
                                        <form method="POST"
                                            action="{{ route('offlinepayments.storeCustomer') }}"
                                            accept-charset="UTF-8"
                                            class="p-lg-5"
                                            enctype="multipart/form-data"
                                        >
                                        @csrf
                                            <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
                                                <div class="col-span-12">
                                                    <div class="card p-4 pt-0 sm:p-5">
                                                        <h2 style="font-size: 20px"> Create Customer</h2>

                                                        <div class="mt-4 space-y-4">
                                                            {{-- <div class="grid grid-cols-1 gap-4 sm:grid-cols-2"> --}}
                                                                <label class="block">
                                                                    <span>Customer name</span> <span>*</span>
                                                                    <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Customer Name"
                                                                        type="text"
                                                                        name="name"
                                                                        autocomplete="off"
                                                                        value="{{ old('name') }}"
                                                                        required
                                                                    />
                                                                </span>
                                                                    @error('name')
                                                                    <span class="text-tiny+ text-error">{{$message}}</span>
                                                                    @enderror
                                                                </label>
                                                                <label class="block">
                                                                    <span>Email</span> <span>*</span>
                                                                    <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Customer's Email"
                                                                        type="email"
                                                                        name="email"
                                                                        autocomplete="off"
                                                                        value="{{ old('email') }}"
                                                                        required
                                                                    />
                                                                </span>
                                                                    @error('email')
                                                                    <span class="text-tiny+ text-error">{{$message}}</span>
                                                                    @enderror
                                                                </label>
                                                            {{-- </div>
                                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2"> --}}
                                                                <label class="block">
                                                                    <span>Phone Number</span> <span>*</span>
                                                                    <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        x-input-mask="{
                                                                              numeric:true,
                                                                              blocks: [3, 3, 4],
                                                                          }"
                                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="Customer's Phone Number"
                                                                        type="text"
                                                                        name="phone_no"
                                                                        autocomplete="off"
                                                                        value="{{ old('phone_no') }}"
                                                                        required
                                                                    />
                                                                </span>
                                                                    @error('phone_no')
                                                                    <span class="text-tiny+ text-error">{{$message}}</span>
                                                                    @enderror
                                                                </label>
                                                                <label class="block">
                                                                    <span>State</span> <span>*</span>
                                                                    <span class="relative mt-1.5 flex">
                                                                    <input
                                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                        placeholder="State"
                                                                        type="text"
                                                                        name="state"
                                                                        autocomplete="off"
                                                                        value="{{ old('state') }}"
                                                                        required
                                                                    />
                                                                </span>
                                                                    @error('state')
                                                                    <span class="text-tiny+ text-error">{{$message}}</span>
                                                                    @enderror
                                                                </label>
                                                            {{-- </div>
                                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2"> --}}
                                                                <label class="block">
                                                                    <span>Company name</span>
                                                                    <span class="relative mt-1.5 flex">
                                                                        <input
                                                                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                            placeholder="Company Name"
                                                                            type="text"
                                                                            name="company_name"
                                                                            autocomplete="off"
                                                                            value="{{ old('company_name') }}"
                                                                        />
                                                                    </span>
                                                                    @error('company_name')
                                                                        <span class="text-tiny+ text-error">{{$message}}</span>
                                                                    @enderror
                                                                </label>
                                                                <label class="block">
                                                                    <span>Gst Number</span>
                                                                    <span class="relative mt-1.5 flex">
                                                                        <input
                                                                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                            placeholder="Gst Number"
                                                                            type="text"
                                                                            name="gst_no"
                                                                            autocomplete="off"
                                                                            value="{{ old('gst_no') }}"
                                                                            
                                                                        />
                                                                    </span>
                                                                    @error('gst_no')
                                                                        <span class="text-tiny+ text-error">{{$message}}</span>
                                                                    @enderror
                                                                </label>
                                                            </div>
                                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 mt-4">
                                                                <label class="block">
                                                                    <span>Company's Address</span>
                                                                    <span class="relative mt-1.5 flex">
                                                                        <input
                                                                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                                            placeholder="Company's Address"
                                                                            type="text"
                                                                            name="company_address"
                                                                            autocomplete="off"
                                                                            value="{{ old('company_address') }}"
                                                                            
                                                                        />
                                                                    </span>
                                                                    @error('company_address')
                                                                    <span class="text-tiny+ text-error">{{$message}}</span>
                                                                    @enderror
                                                                </label>
                                                            </div>
                                                            <div class="flex justify-end space-x-2 mt-4">
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
                            </template>
                        </div>
                        <form id="createInvoiceForm" method="post" action="{{route('offlinepayments.store')}}">
                            @csrf
                            <input type="hidden" value="" name="paymentIntent">
                            {{--                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">--}}
                            <label class="block">
                                <span>Customer</span>
                                <select
                                    class="select2 mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                                    @error('customer_id')
                                        border-error
                                    @enderror"
                                    name="customer_id"
                                    id="customer_id"
                                    required
                                >
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}" @selected(old('customer_id',0)==$customer->id)>{{$customer->name}}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>
                            

                            <label class="block mt-2">
                                <span>Customer Email</span>

                                <select
                                    class="select2 mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                                    @error('email')
                                        border-error
                                    @enderror"
                                    name="email"
                                    id="email"
                                    required
                                >
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}" @selected(old('customer_id',0)==$customer->id)>{{$customer->email}}</option>
                                    @endforeach
                                </select>
                                @error('email')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>

                            <label class="block mt-2">
                                <span>Customer Contact</span>
                                    <select
                                        class="select2 mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent
                                        @error('phone_no')
                                            border-error
                                        @enderror"
                                        name="phone_no"
                                        id="phone_no"
                                        required
                                    >
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}" @selected(old('customer_id',0)==$customer->id)>{{$customer->phone_no}}</option>
                                    @endforeach
                                    </select>
                                </span>
                                @error('phone_no')
                                    <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>

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
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>

                            <div id="products_div">
                                @forelse(old('product_name',[]) as $data)
                                    @if($loop->first)
                                        <label class="block mt-2">
                                            <span>Product Name</span>
                                            <span class="relative mt-1.5 flex">
                                                <input
                                                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                                  @error('product_name')
                                                      border-error
                                                  @enderror"
                                                  placeholder="Product Name"
                                                  name="product_name[]"
                                                  type="text"
                                                  value="{{old('product_name')[0]}}"
                                                  required
                                                />
                                            </span>
                                            @error('product_name')
                                                    <span class="text-tiny+ text-error">{{$message}}</span>
                                            @enderror
                                        </label>
                                        <label class="block mt-2">
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
                                                    value="{{old('product_qty')[0]}}"
                                                    required
                                                />
                                            </span>
                                            @error('product_qty')
                                                <span class="text-tiny+ text-error">{{$message}}</span>
                                            @enderror
                                        </label>
                                        <label class="block mt-2">
                                            <span>Product Price</span>
                                            <span class="relative mt-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                                    @error('product_price')
                                                      border-error
                                                    @enderror"
                                                    placeholder="Product Price"
                                                    name="product_price[]"
                                                    type="number"
                                                    step="0.01"
                                                    min="1"
                                                    value="{{old('product_price')[0]}}"
                                                    required
                                                />
                                            </span>
                                            @error('product_price')
                                                <span class="text-tiny+ text-error">{{$message}}</span>
                                            @enderror
                                        </label>
                                    @else
                                        <label class="block mt-2 ">
                                            <span>Product Name</span>
                                            <span class="relative mt-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="Product Name"
                                                    name="product_name[]"
                                                    type="text"
                                                    value="{{old('product_name')[$loop->index]}}"
                                                    required
                                                />
                                            </span>
                                        </label>
                                        <label class="block mt-2">
                                            <span>Product Qty</span>
                                            <span class="relative mt-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="Product Qty"
                                                    name="product_qty[]"
                                                    type="number"
                                                    step="1"
                                                    min="1"
                                                    value="{{old('product_qty')[$loop->index]}}"
                                                    required
                                                />
                                            </span>
                                        </label>
                                        <label class="block mt-2">
                                            <span>Product Price</span>
                                            <span class="relative mt-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="Product Price"
                                                    name="product_price[]"
                                                    type="number"
                                                    step="0.01"
                                                     min="1"
                                                    value="{{old('product_price')[$loop->index]}}"
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
                                    @endif
                                @empty
                                    {{--                                            <div class="grid mt-2 grid-cols-1 gap-4 sm:grid-cols-12">--}}
                                    <label class="block mt-2  product-label">
                                        <span>Product</span>
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
                                    <label class="block mt-2">
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
                                                      value=""
                                                      required
                                                  />
                                                </span>
                                        @error('product_qty')
                                        <span class="text-tiny+ text-error">{{$message}}</span>
                                        @enderror
                                    </label>
                                    <label class="block mt-2 product-price-label">
                                        <span>Product Price</span>
                                        <span class="relative mt-1.5 flex">
                                                  <input
                                                      readonly
                                                      class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                                    product_price"
                                                      placeholder="Product Price"
                                                      name="product_price[]"
                                                      type="text"
                                                      value=""
                                                  />
                                                </span>
                                        @error('product_price')
                                        <span class="text-tiny+ text-error">{{$message}}</span>
                                        @enderror
                                    </label>
                                    {{--                                            </div>--}}
                                @endforelse
                            </div>

                            <p class="text-base font-medium mt-6 mb-4 text-slate-700 dark:text-navy-100">
                                Payment Details
                            </p>

                            <label class="block mt-2 sm:col-span-4">
                                <span>Invoice Description</span>
                                <span class="relative mt-1.5 flex">
                                          <textarea
                                              rows="4"
                                              class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent
                                                @error('product_price')
                                                  border-error
                                                @enderror"
                                              placeholder="Invoice Description"
                                              name="description"
                                          >
                                          {{old('description')}}</textarea>
                                    </span>
                                @error('product_name')
                                <span class="text-tiny+ text-error">{{$message}}</span>
                                @enderror
                            </label>

                            <label class="inline-flex items-center space-x-2 mt-6">
                                <input
                                    class="check form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                                    type="checkbox"
                                    name="declaration"
                                    required
                                />
                                <p  id="agree-label" class="text-black"
                                    {{--                                           onClick="myFunction()"--}}
                                >
                                    I hereby declare that I’m collecting the cash on the behalf of the organisation.                                       </p>
                                <p id="tax-detail"></p>
                                {{-- <p class="text-black">I hereby agree to make the monthly Emi of Rs <span id="emi-amount">13,333.00</span>/-</p> --}}
                            </label>


                            <div class="flex justify-end mt-2 space-x-2">
                                <button
                                    class="collect-cash-btn btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                    type="submit"
                                >
                                    Collect Cash
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div>
                <div class="card col-span-12">
                    <div class=" p-4 sm:p-5">
                        <div>
                            <div class="flex items-center justify-between">
                                <h2
                                    class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
                                >
                                    Offline Collection Table
                                </h2>
                            </div>
                            <form method="get" action="">
                                <div class="flex items-center justify-between">
                                <div class="flex">
                                    <label class="block">
                                        <select
                                            class="search form-select mt-1.5 w-full pr-8 rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                                            name="transactions"
                                            id="transactions"
                                        >
                                            <option value="">All Transaction</option>
                                            <option value="2" @selected(request('transactions',0)==2)> 5</option>
                                            <option value="20" @selected(request('transactions',0)==20)>20</option>
                                            <option value="50" @selected(request('transactions',0)==50)>50</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="flex">
                                    <div class="flex items-center" x-data="{isInputActive:false}">
                                        <label class="block">
                                                <span class="relative mr-1.5 flex">
                                                  <input
                                                      class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                      placeholder="Search here..."
                                                      onchange="tableSearch(this)"
                                                      name="search"
                                                      type="text"
                                                      value="{{request('search','')}}"
                                                  />
                                                </span>
                                        </label>
                                    </div>
                                </div>
                                </div>
                                <div id="reportrange" name="duration"
                                    class="form-input mt-3 peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span id="date-duration"></span>
                                </div>
                                <input type="hidden" name="start_date">
                                <input type="hidden" name="end_date">
                            </form>

                            <div class=" mt-3">
                                <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                                    <table class="is-hoverable w-full text-left">
                                        <thead>
                                            <tr>
                                                <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                    #
                                                </th>
                                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                    @sortablelink('created_at','Created At')
                                                </th>
                                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                    @sortablelink('invoice_number','Invoice Number')
                                                </th>
                                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                    @sortablelink('customer.name','Customer Name')
                                                </th>
                                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                    @sortablelink('total_amount','Total Amount')
                                                </th>
                                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                    @sortablelink('customer.gst_no','GST Number')
                                                </th>
                                            
                                                <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($invoices as $invoice)
                                                <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{((request('page',1)-1)*10+$loop->iteration)}}</td>
                                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5"> {{ $invoice->created_at->format('Y-m-d') }} </td>
                                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5"> {{ $invoice->invoice_number }} </td>
                                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5"> {{ $invoice->customer->name }} </td>
                                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5" > {{ $invoice->total_amount}} </td>
                                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5" > {{ isset($invoice->customer->gst_no) ? $invoice->customer->gst_no : '-' }} </td>

                                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                        <div
                                                            x-data="usePopper({placement:'bottom-end',offset:4})"
                                                            @click.outside="if(isShowPopper) isShowPopper = false"
                                                            class="inline-flex"
                                                        >
                                                            <a href="{{route('invoices.payment',['id'=>auth()->id(),'invoiceId'=>$invoice->id,'rinvoiceId'=>0])}}" target="_blank" title="Share invoice now"><i class="fa-solid fa-share-from-square"></i></a>
                                                            <button
                                                                x-ref="popperRef"
                                                                @click="isShowPopper = !isShowPopper"
                                                                class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                                            >
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-5 w-5"
                                                                    fill="none"
                                                                    viewBox="0 0 24 24"
                                                                    stroke="currentColor"
                                                                    stroke-width="2"
                                                                >
                                                                    <path
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
                                                                    />
                                                                </svg>
                                                            </button>

                                                            <div
                                                                x-ref="popperRoot"
                                                                class="popper-root"
                                                                :class="isShowPopper && 'show'"
                                                            >
                                                                <div class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                                                                    <ul>
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('invoices.pdf', $invoice->id) }}"
                                                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                                                                PDF
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <td colspan="5" class="text-center">No record found</td>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if(empty(request('transactions')))
                                    <div class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
                                        {!! $invoices->appends(\Request::except('page'))->render() !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        function tableSearch(obj)
        {
            $('<form action=""></form>').append('<input type="hidden" name="search" value="'+$(obj).val()+'">').appendTo('body').submit().remove();
        }

        function addProduct()
        {
            $('#products_div').append(`<div class="product_div grid mt-2 grid-cols-1 gap-4 sm:grid-cols-12">
              <label class="block sm:col-span-12 product-label">
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
        <label class="block sm:col-span-12 product-qty-label">
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
        <label class="block sm:col-span-12 product-price-label">
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

        // if ($('input[name="payment_type"]:checked').val() == 1) {
        //     $('.emi-payment').slideDown('slow');
        //     $('#agree-label').html('I hereby agree to make the monthly Emi of Rs <span id="emi-amount">' + $('select[name="emi"]').find(':selected').data('emi') + '</span>');
        // } else {
        //     $('.emi-payment').slideUp('slow');
        //     $('#agree-label').html('I hereby agree to make payment of Rs ' + $('select[name="product_id"]').find(':selected').data('price'));
        // }

    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

    <script type="text/javascript">

        $(document).ready(function(){
        
        $(".select2").select2();
        var triggerManual = false;
        $('.select2').on('change', function (e) {
            if( triggerManual ) {
                return;
            }
            $('.select2').val($(this).val());
            changeSelValues($(this).attr('id'));
        });

       
        function changeSelValues(id) {
            triggerManual = true;
            $('.select2:not(#'+id+')').trigger('change');
            // $('#email').trigger('change');

            
            triggerManual = false;
        } 
        }); 
    </script>
    <script>
        @if(!empty(request('start_date')) && !empty(request('end_date')))
        var start = moment('{{request('start_date')}}','YYYY-MM-DD');
        var end = moment('{{request('end_date')}}','YYYY-MM-DD');
        var flg = 0;
        @else
        var flg = 1;
        @endif


        function cb(start, end) {
            $('#reportrange #date-duration').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
            'MMMM D, YYYY'));

            if(flg==1)
            {
                $('input[name="start_date"]').val(start.format("YYYY-MM-DD"));
                $('input[name="end_date"]').val(end.format("YYYY-MM-DD")).closest('form').submit();
            }
            else
                flg=1;
        }
        $('.collect-cash-btn').hide();
        $('.check').on('click',function(){
            $('.collect-cash-btn').toggle();
        })

        $('.search').change(function() {
            $(this).closest("form").submit();
        });

        $('#reportrange').daterangepicker({
            locale: { cancelLabel: 'Clear' }
        }, cb);

        @if(!empty(request('start_date')) && !empty(request('end_date')))
            cb(start, end);
        @endif

        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
            $('#reportrange #date-duration').html('');
            $('input[name="start_date"]').val('');
            $('input[name="end_date"]').val('').closest("form").submit();
        });

        // document.getElementById("created_at").flatpickr({
        //     maxDate: "today",
        // });
    </script>
@endpush
@push('scripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


@endpush


@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .select2-container .select2-selection--single {
        height: 38.6px !important;
        padding-left: 0.75rem !important;
        padding-right: 0.75rem !important;
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
        border-radius: 0.5rem !important;
        border-color: rgb(203 213 225 / 1) !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 6px !important;
        right: 9px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 21px !important;
    }
    .select2-results__option.select2-results__option--highlighted {
        background-color: #5897FB !important;
        color: white !important;
    }
    .select2-results__option {
        padding: 6px !important;
        padding-left: 1em !important;
    }
</style>
@endpush