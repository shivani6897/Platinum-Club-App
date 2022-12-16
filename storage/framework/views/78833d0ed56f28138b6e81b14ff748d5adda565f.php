

<?php $__env->startSection('heading', 'Habits'); ?>

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
  </li>
  <li>Habits</li>
</ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="grid grid-cols-1 sm:grid-cols-1">
  <?php $__currentLoopData = $habits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $habit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="card items-center justify-between lg:flex-row my-2">
    <div
      class="flex flex-col items-center p-4 text-center sm:p-5 lg:flex-row lg:space-x-4 lg:text-left"
    >
      <div class="mt-2 lg:mt-0">
        <div class="flex items-center justify-center space-x-1">
          <h4
            class="text-base font-medium text-slate-700 line-clamp-1 dark:text-navy-100"
          >
            <?php echo e(ucfirst($habit->name)); ?>

          </h4>
        </div>
      </div>
    </div>
    <div
      class="absolute top-0 right-0 m-2 lg:static"
    >
    <form method="post" action="<?php echo e(route('habits.complete',$habit->id)); ?>">
      <?php echo csrf_field(); ?>
      <button
        type="submit"
        class="btn h-8 w-8 bg-blue-500 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
      >
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M470.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L192 338.7 425.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
      </button>
    </form>
    </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="card grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
  <div class="col-span-12">
    <div class=" p-4 sm:p-5">
      <p
        class="text-base font-medium text-slate-700 dark:text-navy-100"
      >
        Habit Calendar
      </p>
      <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
    <div class="container mx-auto px-4 py-2 md:py-24">
        
      <!-- <div class="font-bold text-gray-800 text-xl mb-4">
        Schedule Tasks
      </div> -->

      <div class="bg-white rounded-lg shadow overflow-hidden">

        <div class="flex items-center justify-between py-2 px-6">
          <div>
            <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
            <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
          </div>
          <div class="border rounded-lg px-1" style="padding-top: 2px;">
            <button 
              type="button"
              class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center" 
              :class="{'cursor-not-allowed opacity-25': month == 0 }"
              
              onclick="changeMonth(<?php echo e(request('month',date('n'))); ?>,<?php echo e(request('year',date('Y'))); ?>,'sub')"
              >
              
              <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
              </svg>  
            </button>
            <div class="border-r inline-flex h-6"></div>    
            <button 
              type="button"
              class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1" 
              :class="{'cursor-not-allowed opacity-25': month == 11 }"
              
              onclick="changeMonth(<?php echo e(request('month',date('n'))); ?>,<?php echo e(request('year',date('Y'))); ?>,'add')">
              
              <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>                    
            </button>
          </div>
        </div>  

        <div class="-mx-1 -mb-1">
          <div class="flex flex-wrap" style="margin-bottom: -40px;">
            <template x-for="(day, index) in DAYS" :key="index">  
              <div style="width: 14.26%" class="px-2 py-2">
                <div
                  x-text="day" 
                  class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center"></div>
              </div>
            </template>
          </div>

          <div class="flex flex-wrap border-t border-l">
            <template x-for="blankday in blankdays">
              <div 
                style="width: 14.28%; height: 120px"
                class="text-center border-r border-b px-4 pt-2" 
              ></div>
            </template> 
            <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex"> 
              <div style="width: 14.28%; height: 120px;" class="px-4 pt-2 border-r border-b relative">
                <div
                  
                  x-text="date"
                  class="inline-flex w-6 h-6 items-center justify-center cursor-pointer text-center leading-none rounded-full transition ease-in-out duration-100"
                  :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }"  
                ></div>
                <div style="height: 80px;" class="overflow-y-auto mt-1">
                  <!-- <div 
                    class="absolute top-0 right-0 mt-2 mr-2 inline-flex items-center justify-center rounded-full text-sm w-6 h-6 bg-gray-700 text-white leading-none"
                    x-show="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"
                    x-text="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"></div> -->

                  <template x-for="event in events.filter(e => new Date(e.event_date).toDateString() ===  new Date(year, month, date).toDateString() )"> 
                  <form method="post" x-bind:action="`<?php echo e(url('/habits/destroy')); ?>/${event.event_id}`"> 
                    <?php echo method_field('delete'); ?>
                    <?php echo csrf_field(); ?>
                    <div
                       style="cursor: pointer;"
                       onclick="removeHabit(this)"
                      class="px-2 py-1 rounded-lg mt-1 overflow-hidden border"
                      :class="{
                        'border-blue-200 text-blue-800 bg-blue-100': event.event_theme === 'blue',
                        'border-red-200 text-red-800 bg-red-100': event.event_theme === 'red',
                        'border-yellow-200 text-yellow-800 bg-yellow-100': event.event_theme === 'yellow',
                        'border-green-200 text-green-800 bg-green-100': event.event_theme === 'green',
                        'border-purple-200 text-purple-800 bg-purple-100': event.event_theme === 'purple'
                      }"
                    >
                      <input type="hidden" class="event_id" x-model="event.event_id"/>
                      <p x-text="event.event_title" class="text-sm truncate leading-tight"></p>
                    </div>
                  </form>
                  </template>
                </div>
              </div>
            </template>
          </div>
        </div>
      </div>
    </div>

  </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
<style>
    [x-cloak] {
      display: none;
    }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

    function changeMonth(month,year,operation)
    {
      $('<form></form>')
        .append('<input type="hidden" name="month" value="'+month+'">')
        .append('<input type="hidden" name="year" value="'+year+'">')
        .append('<input type="hidden" name="operation" value="'+operation+'">')
        .appendTo('body')
        .submit()
        .remove();
    }

    function removeHabit(obj)
    {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5e3ace',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Warning!',
            'Deleting Task',
            'warning'
          );
          $(obj).closest('form').submit();
        }
      })
    }

    function app() {
      return {
        month: '',
        year: '',
        no_of_days: [],
        blankdays: [],
        days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

        events: [
          <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          {
            event_id: '<?php echo e($value['event_id']); ?>',
            event_date: new Date(<?php echo e(explode('-',$value['event_date'])[0]); ?>, <?php echo e(explode('-',$value['event_date'])[1]-1); ?>, <?php echo e(explode('-',$value['event_date'])[2]); ?>),
            event_title: "<?php echo e($value['event_title']); ?>",
            event_theme: '<?php echo e($value['event_theme']); ?>'
          }<?php if(!$loop->last): ?>,
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          // {
          //   event_date: new Date(2022, 3, 1),
          //   event_title: "April Fool's Day",
          //   event_theme: 'blue'
          // },

          // {
          //   event_date: new Date(2022, 3, 10),
          //   event_title: "Birthday",
          //   event_theme: 'red'
          // },

          // {
          //   event_date: new Date(2022, 3, 16),
          //   event_title: "Upcoming Event",
          //   event_theme: 'green'
          // }
        ],
        event_title: '',
        event_date: '',
        event_theme: 'blue',

        themes: [
          {
            value: "blue",
            label: "Blue Theme"
          },
          {
            value: "red",
            label: "Red Theme"
          },
          {
            value: "yellow",
            label: "Yellow Theme"
          },
          {
            value: "green",
            label: "Green Theme"
          },
          {
            value: "purple",
            label: "Purple Theme"
          }
        ],

        openEventModal: false,

        initDate() {
          let today = new Date();
          this.month = <?php echo e(request('month',date('n'))-1); ?>;//today.getMonth();
          this.year = <?php echo e(request('year',date('Y'))); ?>;//today.getFullYear();
          this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
        },

        isToday(date) {
          const today = new Date();
          const d = new Date(this.year, this.month, date);

          return today.toDateString() === d.toDateString() ? true : false;
        },

        showEventModal(date) {
          // open the modal
          // this.openEventModal = true;
          // this.event_date = new Date(this.year, this.month, date).toDateString();
        },

        addEvent() {
          if (this.event_title == '') {
            return;
          }

          this.events.push({
            event_date: this.event_date,
            event_title: this.event_title,
            event_theme: this.event_theme
          });

          console.log(this.events);

          // clear the form data
          this.event_title = '';
          this.event_date = '';
          this.event_theme = 'blue';

          //close the modal
          this.openEventModal = false;
        },

        getNoOfDays() {
          let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

          // find where to start calendar day of week
          let dayOfWeek = new Date(this.year, this.month).getDay();
          let blankdaysArray = [];
          for ( var i=1; i <= dayOfWeek; i++) {
            blankdaysArray.push(i);
          }

          let daysArray = [];
          for ( var i=1; i <= daysInMonth; i++) {
            daysArray.push(i);
          }
          
          this.blankdays = blankdaysArray;
          this.no_of_days = daysArray;
        },

      }
    }
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/web/platinum-club-app/Platinum-Club-App/resources/views/customer/habits/index.blade.php ENDPATH**/ ?>