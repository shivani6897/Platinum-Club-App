<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags  -->
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>

    <title><?php echo e(config('app.name')); ?></title>


    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css"/>

    <link rel="icon" type="image/png" href="<?php echo e(asset('images/favicon.png')); ?>"/>

    <script src="https://cdn.tailwindcss.com/"></script>
    <!-- CSS Assets -->
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>"/>

    <!-- Javascript Assets -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous"/>
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php echo $__env->make('layouts.alertMsg', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        .one-time {
            display: none;
        }

        /*.rb-one-time:checked ~ .one-time {*/
        /*    display: inline;*/
        /*}*/

    </style>
</head>

<body x-data class="is-header-blur" x-bind="$store.global.documentBody">

<!-- Main Content Wrapper -->
<div style="padding-bottom: 50px">
    <main class="w-8/12 mx-auto">
        <div>
            <div class="mt-7 pt-5">
                <div class="rounded-lg p-5 bg-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <p>
                                Due Amount
                            </p>
                            <p class="text-3xl text-black font-bold">
                                ₹ 13,000
                            </p>
                        </div>
                        <button class="btn bg-green-400 font-medium text-white py-2 px-5 rounded-lg text-md">
                            Pay Now
                        </button>
                    </div>
                </div>
                <div class="mt-4 rounded-lg  bg-white" style="padding-bottom: 150px">
                    <center><p class="text-2xl  text-black font-bold pt-5">Invoice</p></center>
                    <div class="border-b-2 border-b-slate-500" style="padding-bottom: 50px;padding-top: 50px">
                        <div class="px-5">
                            <div class="justify-between flex">
                                <p class="text-md font-bold text-black">
                                    Member
                                </p>
                                <p class="text-md font-bold text-black">
                                    Invoice No: PAY-1001
                                </p>
                            </div>
                            <div class="justify-between flex">
                                <span class="flex items-center text-md">
                                    <p class="text-md font-bold text-black mr-2">Phone :</p>+1234567890
                                </span>
                                <span class="flex items-center text-md">
                                    <p class="text-md font-bold text-black mr-2">Due Date :</p>20-2-2022</span>
                            </div>
                            <div class="justify-between flex">
                                <span class="flex items-center text-md">
                                    <p class="text-md font-bold text-black mr-2">Email :</p>hello@owlsy.dev
                                </span>
                                <span class="flex items-center text-md">
                                    <span class="text-md font-bold text-black mr-2">Gateway :</span>Offline
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="border-b-2 border-b-slate-500" style="padding-bottom: 50px;padding-top: 50px">
                        <div class="px-5">
                            <div>
                                <p class="text-md font-bold text-black">
                                    Bill To
                                </p>
                            </div>
                            <div class="justify-between flex">
                                 <span class="flex items-center text-md">
                                    <p class="text-md font-bold text-black mr-2">Name :</p>
                                    Sandy Kumar
                               </span>
                                <span class="flex items-center text-md">
                                    <p class="text-md font-bold text-black mr-2">Invoice Date :</p>
                                    20-02-2022
                               </span>
                            </div>
                            <div class="justify-between flex">
                                <p class="text-md font-bold text-black mr-2">India</p>
                                <span class="flex items-center text-md">
                                    Due Amount
                               </span>
                            </div>
                            <div class="justify-between flex">
                                <span class="flex items-center text-md">
                                    <p class="text-md font-bold text-black mr-2">Phone :</p>+1234567890
                                </span>
                                <span class="flex items-center text-md">
                                    <p class="text-xl font-bold text-black mr-2">₹ 14,750.00</p>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="is-scrollbar-hidden min-w-full overflow-x-auto" style="padding-top: 40px">
                        <table class="w-full text-left">
                            <thead>
                            <tr>
                                <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                    DESCRIPTION
                                </th>
                                <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                    QUANTITY
                                </th>
                                <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                    UNIT COST
                                </th>
                                <th class="text-right whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                    TOTAL
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">Product 1 (1st EMI)</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">1</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">12500.00</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-right">12500.00</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right pr-5">
                       <span class="flex items-center flex justify-end text-md">
                           <p class="text-md text-black mr-4">Subtotal :</p>12,500.00
                       </span>
                        <span class="flex items-center text-md flex justify-end">
                           <p class="text-md text-black mr-4">GST 18% :</p>2,500.00
                       </span>
                        <span class="flex items-center text-md font-bold text-black justify-end">
                           <p class="text-md text-black mr-4 font-bold">Total :</p>14,500.00
                       </span>
                        <button disabled class="btn px-6 py-4 text-xl mt-2 text-black font-bold"
                                style="background-color: #FFD2D2">
                            <span class="pr-4">Due</span>
                            <span>₹ 14,750.00</span>
                        </button>
                    </div>
                </div>
                <div class="mt-4 rounded-lg p-4 bg-white">
                    <div>
                        <center><p class="text-2xl  text-black font-bold pt-5">Product Description</p></center>
                        <div class="grid grid-cols-2 gap-4 mt-4 p-4">
                            <div class=" flex justify-center">
                                <img src="<?php echo e(asset('images/payment/marketing-online.png')); ?>" alt="">
                            </div>
                            <div class="mt-3">
                                <p class="text-black">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusantium consequuntur
                                    cupiditate fugiat harum illo, laborum magnam maiores neque odio quaerat quibusdam
                                    quidem, recusandae reiciendis sed veritatis vero vitae voluptate.
                                </p>
                                <ul style="list-style: disc" class="text-black mt-3 ml-3">
                                    <li> Lorem ipsum dolor sit amet, </li>
                                    <li>  ipsum dolor sit amet, </li>
                                    <li> dolor sit amet, </li>
                                </ul>
                                <p class="text-black mt-2">
                                    when an unknown printer took a galley of type and scrambled it.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>

</script>
</body>

</html>
<?php /**PATH /home/vagrant/web/platinum-club-app/Platinum-Club-App/resources/views/invoice/invoice.blade.php ENDPATH**/ ?>