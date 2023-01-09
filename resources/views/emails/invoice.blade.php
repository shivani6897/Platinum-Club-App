<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags  -->
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>

    <title>{{ config('app.name') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous"/>
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"/>

    @stack('styles')
    @include('layouts.alertMsg')
    <style>
        a,hr{color:inherit}.align-baseline,progress,sub,sup{vertical-align:baseline}.m-0,blockquote,body,dd,dl,fieldset,figure,h1,h2,h3,h4,h5,h6,hr,menu,ol,p,pre,ul{margin:0}.p-0,.sr-only,fieldset,legend,menu,ol,ul{padding:0}.bottom-0,.inset-0{bottom:0}.border-collapse,table{border-collapse:collapse}.overflow-hidden,.sr-only{overflow:hidden}.sr-only,.truncate,.whitespace-nowrap{white-space:nowrap}.from-amber-400,.from-pink-500,.from-purple-500,.from-sky-400{--tw-gradient-stops:var(--tw-gradient-from),var(--tw-gradient-to)}.transition,.transition-all,.transition-colors,.transition-opacity,.transition-transform{transition-timing-function:cubic-bezier(0.4,0,0.2,1);transition-duration:150ms}.hover\:text-gray-800:hover,.hover\:text-gray-900:hover,.text-amber-400,.text-black,.text-blue-800,.text-gray-200,.text-gray-300,.text-gray-400,.text-gray-500,.text-gray-600,.text-gray-700,.text-gray-800,.text-gray-900,.text-green-800,.text-purple-800,.text-red-800,.text-rose-500,.text-sky-100,.text-slate-400,.text-slate-500,.text-slate-600,.text-slate-700,.text-white,.text-yellow-800{--tw-text-opacity:1}.border-b-slate-200,.border-b-slate-500,.border-blue-200,.border-gray-200,.border-gray-300,.border-gray-700,.border-green-200,.border-purple-200,.border-red-200,.border-sky-200,.border-slate-200,.border-slate-300,.border-white,.border-yellow-200,.focus\:border-blue-500:focus,.hover\:border-gray-500:hover,.hover\:border-sky-500:hover{--tw-border-opacity:1}*,::after,::before{box-sizing:border-box;border:0 solid #e5e7eb;--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::after,::before{--tw-content:''}html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;-o-tab-size:4;tab-size:4;font-family:ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";font-feature-settings:normal}body{line-height:inherit}hr{height:0;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}.focus\:shadow-lg:focus,.hover\:shadow-lg:hover,.shadow,.shadow-md,.shadow-sm{box-shadow:var(--tw-ring-offset-shadow,0 0 #0000),var(--tw-ring-shadow,0 0 #0000),var(--tw-shadow)}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}menu,ol,ul{list-style:none}textarea{resize:vertical}input::-moz-placeholder,textarea::-moz-placeholder{opacity:1;color:#9ca3af}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}.cursor-pointer,[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}.hidden,[hidden]{display:none}::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.container,.w-full{width:100%}@media (min-width:640px){.container{max-width:640px}.sm\:col-span-8{grid-column:span 8/span 8}.sm\:col-span-4{grid-column:span 4/span 4}.sm\:col-span-6{grid-column:span 6/span 6}.sm\:col-span-2{grid-column:span 2/span 2}.sm\:col-span-5{grid-column:span 5/span 5}.sm\:col-span-7{grid-column:span 7/span 7}.sm\:col-span-12{grid-column:span 12/span 12}.sm\:m-0{margin:0}.sm\:mx-auto{margin-left:auto;margin-right:auto}.sm\:ml-0{margin-left:0}.sm\:mt-5{margin-top:1.25rem}.sm\:block{display:block}.sm\:flex{display:flex}.sm\:hidden{display:none}.sm\:h-20{height:5rem}.sm\:w-8\/12{width:66.666667%}.sm\:w-80{width:20rem}.sm\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}.sm\:grid-cols-4{grid-template-columns:repeat(4,minmax(0,1fr))}.sm\:grid-cols-12{grid-template-columns:repeat(12,minmax(0,1fr))}.sm\:grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}.sm\:grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}.sm\:flex-row{flex-direction:row}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:gap-5{gap:1.25rem}.sm\:space-y-0>:not([hidden])~:not([hidden]){--tw-space-y-reverse:0;margin-top:calc(0px * calc(1 - var(--tw-space-y-reverse)));margin-bottom:calc(0px * var(--tw-space-y-reverse))}.sm\:rounded-lg{border-radius:.5rem}.sm\:p-5{padding:1.25rem}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:px-5{padding-left:1.25rem;padding-right:1.25rem}.sm\:pt-0{padding-top:0}.sm\:pl-2{padding-left:.5rem}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.container{max-width:768px}.md\:inset-0{top:0;right:0;bottom:0;left:0}.md\:mt-0{margin-top:0}.md\:h-full{height:100%}.md\:h-auto{height:auto}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}.md\:gap-6{gap:1.5rem}.md\:gap-4{gap:1rem}.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:p-10{padding:2.5rem}.md\:py-24{padding-top:6rem;padding-bottom:6rem}}@media (min-width:1024px){.container{max-width:1024px}.lg\:static{position:static}.lg\:col-span-4{grid-column:span 4/span 4}.lg\:col-span-8{grid-column:span 8/span 8}.lg\:col-span-12{grid-column:span 12/span 12}.lg\:mt-6{margin-top:1.5rem}.lg\:mt-0{margin-top:0}.lg\:w-48{width:12rem}.lg\:grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}.lg\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}.lg\:flex-row{flex-direction:row}.lg\:place-items-center{place-items:center}.lg\:gap-6{gap:1.5rem}.lg\:gap-4{gap:1rem}.lg\:space-x-4>:not([hidden])~:not([hidden]){--tw-space-x-reverse:0;margin-right:calc(1rem * var(--tw-space-x-reverse));margin-left:calc(1rem * calc(1 - var(--tw-space-x-reverse)))}.lg\:p-7{padding:1.75rem}.lg\:px-8{padding-left:2rem;padding-right:2rem}.lg\:px-5{padding-left:1.25rem;padding-right:1.25rem}.lg\:py-6{padding-top:1.5rem;padding-bottom:1.5rem}.lg\:text-left{text-align:left}.lg\:text-base{font-size:1rem;line-height:1.5rem}.lg\:text-2xl{font-size:1.5rem;line-height:2rem}}@media (min-width:1280px){.container{max-width:1280px}.xl\:hidden{display:none}.xl\:grid-cols-4{grid-template-columns:repeat(4,minmax(0,1fr))}}@media (min-width:1536px){.container{max-width:1536px}}.sr-only{position:absolute;width:1px;height:1px;margin:-1px;clip:rect(0,0,0,0);border-width:0}.pointer-events-none{pointer-events:none}.collapse{visibility:collapse}.static{position:static}.fixed{position:fixed}.absolute{position:absolute}.relative{position:relative}.inset-0{top:0;right:0;left:0}.inset-y-0{top:0;bottom:0}.top-0{top:0}.right-0{right:0}.-top-px{top:-1px}.-right-px{right:-1px}.left-0{left:0}.z-50{z-index:50}.z-\[100\]{z-index:100}.z-40{z-index:40}.col-span-12{grid-column:span 12/span 12}.col-span-2{grid-column:span 2/span 2}.float-right{float:right}.float-left{float:left}.-m-3{margin:-.75rem}.m-2{margin:.5rem}.m-4{margin:1rem}.my-3{margin-top:.75rem;margin-bottom:.75rem}.mx-auto{margin-left:auto;margin-right:auto}.mx-4{margin-left:1rem;margin-right:1rem}.mx-2{margin-left:.5rem;margin-right:.5rem}.my-1{margin-top:.25rem;margin-bottom:.25rem}.my-4{margin-top:1rem;margin-bottom:1rem}.my-7{margin-top:1.75rem;margin-bottom:1.75rem}.my-5{margin-top:1.25rem;margin-bottom:1.25rem}.mt-2,.my-2{margin-top:.5rem}.my-2{margin-bottom:.5rem}.-mx-1{margin-left:-.25rem;margin-right:-.25rem}.ml-1{margin-left:.25rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.mt-3{margin-top:.75rem}.mt-6{margin-top:1.5rem}.mt-5{margin-top:1.25rem}.mt-1\.5{margin-top:.375rem}.mt-1{margin-top:.25rem}.mb-3{margin-bottom:.75rem}.mb-0{margin-bottom:0}.mt-7{margin-top:1.75rem}.-mt-1{margin-top:-.25rem}.mr-4{margin-right:1rem}.mt-10{margin-top:2.5rem}.ml-3{margin-left:.75rem}.mb-2{margin-bottom:.5rem}.mb-4{margin-bottom:1rem}.ml-0\.5{margin-left:.125rem}.ml-0{margin-left:0}.-mr-1\.5{margin-right:-.375rem}.-mr-1{margin-right:-.25rem}.-ml-1\.5{margin-left:-.375rem}.-ml-1{margin-left:-.25rem}.mr-3{margin-right:.75rem}.mt-0{margin-top:0}.mr-1\.5{margin-right:.375rem}.mr-1{margin-right:.25rem}.mb-6{margin-bottom:1.5rem}.-mb-1{margin-bottom:-.25rem}.ml-auto{margin-left:auto}.mr-10{margin-right:2.5rem}.mt-24{margin-top:6rem}.mb-1{margin-bottom:.25rem}.block{display:block}.inline-block{display:inline-block}.inline{display:inline}.flex{display:flex}.inline-flex{display:inline-flex}.table{display:table}.grid{display:grid}.h-8{height:2rem}.h-16{height:4rem}.h-5{height:1.25rem}.h-full{height:100%}.h-3{height:.75rem}.h-48{height:12rem}.h-7{height:1.75rem}.h-6{height:1.5rem}.h-4{height:1rem}.h-2{height:.5rem}.h-10{height:2.5rem}.h-11{height:2.75rem}.h-12{height:3rem}.h-3\.5{height:.875rem}.h-14{height:3.5rem}.h-9{height:2.25rem}.h-20{height:5rem}.h-px{height:1px}.max-h-\[calc\(100vh-6rem\)\]{max-height:calc(100vh - 6rem)}.min-h-screen{min-height:100vh}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.w-px{width:1px}.w-3{width:.75rem}.w-16{width:4rem}.w-48{width:12rem}.w-10{width:2.5rem}.w-7{width:1.75rem}.w-6{width:1.5rem}.w-80{width:20rem}.w-60{width:15rem}.w-4{width:1rem}.w-2{width:.5rem}.w-\[calc\(100vw-2rem\)\]{width:calc(100vw - 2rem)}.w-36{width:9rem}.w-11{width:2.75rem}.w-12{width:3rem}.w-3\.5{width:.875rem}.w-64{width:16rem}.w-14{width:3.5rem}.w-96{width:24rem}.w-20{width:5rem}.w-32{width:8rem}.w-0{width:0}.min-w-full{min-width:100%}.min-w-\[7rem\]{min-width:7rem}.min-w-\[2rem\]{min-width:2rem}.max-w-6xl{max-width:72rem}.max-w-\[26rem\]{max-width:26rem}.max-w-lg{max-width:32rem}.max-w-md{max-width:28rem}.max-w-2xl{max-width:42rem}.max-w-xl{max-width:36rem}.shrink-0{flex-shrink:0}.grow{flex-grow:1}.origin-top{transform-origin:top}.hover\:rotate-\[360deg\]:hover,.scale-100,.scale-105,.scale-75,.scale-95,.transform{transform:translate(var(--tw-translate-x),var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.scale-75{--tw-scale-x:.75;--tw-scale-y:.75}.scale-100{--tw-scale-x:1;--tw-scale-y:1}.scale-105{--tw-scale-x:1.05;--tw-scale-y:1.05}.scale-95{--tw-scale-x:.95;--tw-scale-y:.95}@keyframes ping{100%,75%{transform:scale(2);opacity:0}}.animate-ping{animation:1s cubic-bezier(0,0,.2,1) infinite ping}.cursor-not-allowed{cursor:not-allowed}.appearance-none{-webkit-appearance:none;-moz-appearance:none;appearance:none}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}.grid-cols-12{grid-template-columns:repeat(12,minmax(0,1fr))}.grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}.grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}.flex-row{flex-direction:row}.flex-col{flex-direction:column}.flex-wrap{flex-wrap:wrap}.place-content-center{place-content:center}.place-items-center{place-items:center}.items-start{align-items:flex-start}.items-end{align-items:flex-end}.items-center{align-items:center}.justify-end{justify-content:flex-end}.justify-center{justify-content:center}.justify-between{justify-content:space-between}.gap-4{gap:1rem}.gap-2{gap:.5rem}.gap-x-4{-moz-column-gap:1rem;column-gap:1rem}.gap-y-8{row-gap:2rem}.space-x-2>:not([hidden])~:not([hidden]){--tw-space-x-reverse:0;margin-right:calc(.5rem * var(--tw-space-x-reverse));margin-left:calc(.5rem * calc(1 - var(--tw-space-x-reverse)))}.space-x-4>:not([hidden])~:not([hidden]){--tw-space-x-reverse:0;margin-right:calc(1rem * var(--tw-space-x-reverse));margin-left:calc(1rem * calc(1 - var(--tw-space-x-reverse)))}.-space-x-px>:not([hidden])~:not([hidden]){--tw-space-x-reverse:0;margin-right:calc(-1px * var(--tw-space-x-reverse));margin-left:calc(-1px * calc(1 - var(--tw-space-x-reverse)))}.space-y-1\.5>:not([hidden])~:not([hidden]){--tw-space-y-reverse:0;margin-top:calc(.375rem * calc(1 - var(--tw-space-y-reverse)));margin-bottom:calc(.375rem * var(--tw-space-y-reverse))}.space-y-1>:not([hidden])~:not([hidden]){--tw-space-y-reverse:0;margin-top:calc(.25rem * calc(1 - var(--tw-space-y-reverse)));margin-bottom:calc(.25rem * var(--tw-space-y-reverse))}.space-y-4>:not([hidden])~:not([hidden]){--tw-space-y-reverse:0;margin-top:calc(1rem * calc(1 - var(--tw-space-y-reverse)));margin-bottom:calc(1rem * var(--tw-space-y-reverse))}.space-x-3>:not([hidden])~:not([hidden]){--tw-space-x-reverse:0;margin-right:calc(.75rem * var(--tw-space-x-reverse));margin-left:calc(.75rem * calc(1 - var(--tw-space-x-reverse)))}.space-y-3>:not([hidden])~:not([hidden]){--tw-space-y-reverse:0;margin-top:calc(.75rem * calc(1 - var(--tw-space-y-reverse)));margin-bottom:calc(.75rem * var(--tw-space-y-reverse))}.space-x-1>:not([hidden])~:not([hidden]){--tw-space-x-reverse:0;margin-right:calc(.25rem * var(--tw-space-x-reverse));margin-left:calc(.25rem * calc(1 - var(--tw-space-x-reverse)))}.space-y-6>:not([hidden])~:not([hidden]){--tw-space-y-reverse:0;margin-top:calc(1.5rem * calc(1 - var(--tw-space-y-reverse)));margin-bottom:calc(1.5rem * var(--tw-space-y-reverse))}.overflow-x-auto{overflow-x:auto}.overflow-y-auto{overflow-y:auto}.overflow-x-hidden{overflow-x:hidden}.truncate{overflow:hidden;text-overflow:ellipsis}.break-all{word-break:break-all}.rounded-lg{border-radius:.5rem}.rounded-full{border-radius:9999px}.rounded{border-radius:.25rem}.rounded-none{border-radius:0}.rounded-md{border-radius:.375rem}.rounded-xl{border-radius:.75rem}.rounded-l-lg,.rounded-t-lg{border-top-left-radius:.5rem}.rounded-r-lg,.rounded-t-lg{border-top-right-radius:.5rem}.rounded-l-lg{border-bottom-left-radius:.5rem}.rounded-r-lg{border-bottom-right-radius:.5rem}.rounded-l-full{border-top-left-radius:9999px;border-bottom-left-radius:9999px}.rounded-r-full{border-top-right-radius:9999px;border-bottom-right-radius:9999px}.rounded-t{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.rounded-b{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.rounded-tl-lg{border-top-left-radius:.5rem}.rounded-tr-lg{border-top-right-radius:.5rem}.border{border-width:1px}.border-2{border-width:2px}.border-0{border-width:0}.border-t,.border-y{border-top-width:1px}.border-y{border-bottom-width:1px}.border-b-2{border-bottom-width:2px}.border-r{border-right-width:1px}.border-b{border-bottom-width:1px}.border-l-2{border-left-width:2px}.border-l{border-left-width:1px}.border-gray-700{border-color:rgb(55 65 81 / var(--tw-border-opacity))}.border-gray-200{border-color:rgb(229 231 235 / var(--tw-border-opacity))}.border-slate-300{border-color:rgb(203 213 225 / var(--tw-border-opacity))}.border-slate-400\/70{border-color:rgb(148 163 184 / .7)}.border-transparent{border-color:transparent}.border-white{border-color:rgb(255 255 255 / var(--tw-border-opacity))}.border-sky-200{border-color:rgb(186 230 253 / var(--tw-border-opacity))}.border-slate-200{border-color:rgb(226 232 240 / var(--tw-border-opacity))}.border-blue-200{border-color:rgb(191 219 254 / var(--tw-border-opacity))}.border-red-200{border-color:rgb(254 202 202 / var(--tw-border-opacity))}.border-yellow-200{border-color:rgb(254 240 138 / var(--tw-border-opacity))}.border-green-200{border-color:rgb(187 247 208 / var(--tw-border-opacity))}.border-purple-200{border-color:rgb(233 213 255 / var(--tw-border-opacity))}.border-gray-300{border-color:rgb(209 213 219 / var(--tw-border-opacity))}.border-b-slate-500{border-bottom-color:rgb(100 116 139 / var(--tw-border-opacity))}.border-b-slate-200{border-bottom-color:rgb(226 232 240 / var(--tw-border-opacity))}.bg-gray-800{--tw-bg-opacity:1;background-color:rgb(31 41 55 / var(--tw-bg-opacity))}.bg-gray-900{--tw-bg-opacity:1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.bg-white,.checked\:before\:bg-white:checked::before,.focus\:bg-white:focus{background-color:rgb(255 255 255 / var(--tw-bg-opacity));--tw-bg-opacity:1}.bg-gray-100,.hover\:bg-gray-100:hover{--tw-bg-opacity:1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.bg-slate-300,.focus\:bg-slate-300:focus,.hover\:bg-slate-300:hover{--tw-bg-opacity:1;background-color:rgb(203 213 225 / var(--tw-bg-opacity))}.bg-white\/20{background-color:rgb(255 255 255 / .2)}.bg-slate-50{--tw-bg-opacity:1;background-color:rgb(248 250 252 / var(--tw-bg-opacity))}.bg-transparent{background-color:transparent}.bg-green-400{--tw-bg-opacity:1;background-color:rgb(74 222 128 / var(--tw-bg-opacity))}.bg-blue-700{--tw-bg-opacity:1;background-color:rgb(29 78 216 / var(--tw-bg-opacity))}.bg-blue-600{--tw-bg-opacity:1;background-color:rgb(37 99 235 / var(--tw-bg-opacity))}.bg-slate-900\/60{background-color:rgb(15 23 42 / .6)}.bg-slate-100,.focus\:bg-slate-100:focus,.hover\:bg-slate-100:hover{--tw-bg-opacity:1;background-color:rgb(241 245 249 / var(--tw-bg-opacity))}.bg-slate-200,.focus\:bg-slate-200:focus,.hover\:bg-slate-200:hover{--tw-bg-opacity:1;background-color:rgb(226 232 240 / var(--tw-bg-opacity))}.bg-blue-500{--tw-bg-opacity:1;background-color:rgb(59 130 246 / var(--tw-bg-opacity))}.bg-blue-200,.hover\:bg-blue-200:hover{--tw-bg-opacity:1;background-color:rgb(191 219 254 / var(--tw-bg-opacity))}.bg-gray-700,.hover\:bg-gray-700:hover{--tw-bg-opacity:1;background-color:rgb(55 65 81 / var(--tw-bg-opacity))}.bg-blue-100{--tw-bg-opacity:1;background-color:rgb(219 234 254 / var(--tw-bg-opacity))}.bg-red-100{--tw-bg-opacity:1;background-color:rgb(254 226 226 / var(--tw-bg-opacity))}.bg-yellow-100{--tw-bg-opacity:1;background-color:rgb(254 249 195 / var(--tw-bg-opacity))}.bg-green-100{--tw-bg-opacity:1;background-color:rgb(220 252 231 / var(--tw-bg-opacity))}.bg-purple-100{--tw-bg-opacity:1;background-color:rgb(243 232 255 / var(--tw-bg-opacity))}.bg-gray-200,.hover\:bg-gray-200:hover{--tw-bg-opacity:1;background-color:rgb(229 231 235 / var(--tw-bg-opacity))}.bg-gradient-to-br{background-image:linear-gradient(to bottom right,var(--tw-gradient-stops))}.bg-gradient-to-r{background-image:linear-gradient(to right,var(--tw-gradient-stops))}.from-amber-400{--tw-gradient-from:#fbbf24;--tw-gradient-to:rgb(251 191 36 / 0)}.from-pink-500{--tw-gradient-from:#ec4899;--tw-gradient-to:rgb(236 72 153 / 0)}.from-purple-500{--tw-gradient-from:#a855f7;--tw-gradient-to:rgb(168 85 247 / 0)}.from-sky-400{--tw-gradient-from:#38bdf8;--tw-gradient-to:rgb(56 189 248 / 0)}.to-orange-600{--tw-gradient-to:#ea580c}.to-rose-500{--tw-gradient-to:#f43f5e}.to-indigo-400{--tw-gradient-to:#818cf8}.to-indigo-600{--tw-gradient-to:#4f46e5}.to-blue-600{--tw-gradient-to:#2563eb}.bg-clip-text{-webkit-background-clip:text;background-clip:text}.fill-slate-500{fill:#64748b}.fill-current{fill:currentColor}.p-6{padding:1.5rem}.p-2{padding:.5rem}.p-3\.5{padding:.875rem}.p-3{padding:.75rem}.p-4{padding:1rem}.p-5{padding:1.25rem}.p-2\.5{padding:.625rem}.p-1{padding:.25rem}.p-1\.5{padding:.375rem}.p-8{padding:2rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-1{padding-top:.25rem;padding-bottom:.25rem}.px-4{padding-left:1rem;padding-right:1rem}.py-2{padding-top:.5rem;padding-bottom:.5rem}.px-2\.5{padding-left:.625rem;padding-right:.625rem}.px-2{padding-left:.5rem;padding-right:.5rem}.px-3{padding-left:.75rem;padding-right:.75rem}.px-3\.5{padding-left:.875rem;padding-right:.875rem}.px-\[var\(--margin-x\)\]{padding-left:var(--margin-x);padding-right:var(--margin-x)}.px-5{padding-left:1.25rem;padding-right:1.25rem}.py-3{padding-top:.75rem;padding-bottom:.75rem}.py-5{padding-top:1.25rem;padding-bottom:1.25rem}.py-2\.5{padding-top:.625rem;padding-bottom:.625rem}.py-6{padding-top:1.5rem;padding-bottom:1.5rem}.py-10{padding-top:2.5rem;padding-bottom:2.5rem}.px-1\.5{padding-left:.375rem;padding-right:.375rem}.px-1{padding-left:.25rem;padding-right:.25rem}.py-1\.5{padding-top:.375rem;padding-bottom:.375rem}.px-0{padding-left:0;padding-right:0}.px-7{padding-left:1.75rem;padding-right:1.75rem}.pt-8{padding-top:2rem}.pb-4{padding-bottom:1rem}.pr-8{padding-right:2rem}.pr-9{padding-right:2.25rem}.pr-3{padding-right:.75rem}.pl-9{padding-left:2.25rem}.pb-8{padding-bottom:2rem}.pt-5{padding-top:1.25rem}.pr-5{padding-right:1.25rem}.pr-4{padding-right:1rem}.pl-\[var\(--main-sidebar-width\)\]{padding-left:var(--main-sidebar-width)}.pl-4{padding-left:1rem}.pr-1{padding-right:.25rem}.pt-2{padding-top:.5rem}.pt-4{padding-top:1rem}.pt-6{padding-top:1.5rem}.pb-5{padding-bottom:1.25rem}.pb-2{padding-bottom:.5rem}.pt-3{padding-top:.75rem}.pr-12{padding-right:3rem}.pb-3{padding-bottom:.75rem}.pb-12{padding-bottom:3rem}.pl-0{padding-left:0}.pr-0{padding-right:0}.text-left{text-align:left}.text-center{text-align:center}.text-right{text-align:right}.text-end{text-align:end}.text-sm{font-size:.875rem;line-height:1.25rem}.text-lg{font-size:1.125rem;line-height:1.75rem}.text-xs{font-size:.75rem;line-height:1rem}.text-2xl{font-size:1.5rem;line-height:2rem}.text-3xl{font-size:1.875rem;line-height:2.25rem}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-base{font-size:1rem;line-height:1.5rem}.text-7xl{font-size:4.5rem;line-height:1}.font-medium{font-weight:500}.font-semibold{font-weight:600}.font-bold{font-weight:700}.font-normal{font-weight:400}.uppercase{text-transform:uppercase}.italic{font-style:italic}.leading-7{line-height:1.75rem}.leading-tight{line-height:1.25}.leading-none{line-height:1}.tracking-wide{letter-spacing:.025em}.text-slate-700{color:rgb(51 65 85 / var(--tw-text-opacity))}.text-white{color:rgb(255 255 255 / var(--tw-text-opacity))}.text-gray-400{color:rgb(156 163 175 / var(--tw-text-opacity))}.text-gray-500{color:rgb(107 114 128 / var(--tw-text-opacity))}.text-gray-200{color:rgb(229 231 235 / var(--tw-text-opacity))}.text-gray-300{color:rgb(209 213 219 / var(--tw-text-opacity))}.text-gray-600{color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-700{color:rgb(55 65 81 / var(--tw-text-opacity))}.hover\:text-gray-900:hover,.text-gray-900{color:rgb(17 24 39 / var(--tw-text-opacity))}.text-sky-100{color:rgb(224 242 254 / var(--tw-text-opacity))}.text-slate-600{color:rgb(71 85 105 / var(--tw-text-opacity))}.text-slate-400{color:rgb(148 163 184 / var(--tw-text-opacity))}.focus\:text-slate-800:focus,.hover\:text-slate-800:hover,.text-slate-800{--tw-text-opacity:1;color:rgb(30 41 59 / var(--tw-text-opacity))}.text-black{color:rgb(0 0 0 / var(--tw-text-opacity))}.text-slate-500{color:rgb(100 116 139 / var(--tw-text-opacity))}.text-amber-400{color:rgb(251 191 36 / var(--tw-text-opacity))}.text-transparent{color:transparent}.text-rose-500{color:rgb(244 63 94 / var(--tw-text-opacity))}.hover\:text-gray-800:hover,.text-gray-800{color:rgb(31 41 55 / var(--tw-text-opacity))}.text-blue-800{color:rgb(30 64 175 / var(--tw-text-opacity))}.text-red-800{color:rgb(153 27 27 / var(--tw-text-opacity))}.text-yellow-800{color:rgb(133 77 14 / var(--tw-text-opacity))}.text-green-800{color:rgb(22 101 52 / var(--tw-text-opacity))}.text-purple-800{color:rgb(107 33 168 / var(--tw-text-opacity))}.underline{text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.placeholder-slate-400::-moz-placeholder{--tw-placeholder-opacity:1;color:rgb(148 163 184 / var(--tw-placeholder-opacity))}.placeholder-slate-400::placeholder{--tw-placeholder-opacity:1;color:rgb(148 163 184 / var(--tw-placeholder-opacity))}.opacity-0{opacity:0}.opacity-100{opacity:1}.opacity-80{opacity:.8}.opacity-25{opacity:.25}.shadow{--tw-shadow:0 1px 3px 0 rgb(0 0 0 / 0.1),0 1px 2px -1px rgb(0 0 0 / 0.1);--tw-shadow-colored:0 1px 3px 0 var(--tw-shadow-color),0 1px 2px -1px var(--tw-shadow-color)}.shadow-sm{--tw-shadow:0 1px 2px 0 rgb(0 0 0 / 0.05);--tw-shadow-colored:0 1px 2px 0 var(--tw-shadow-color)}.shadow-md{--tw-shadow:0 4px 6px -1px rgb(0 0 0 / 0.1),0 2px 4px -2px rgb(0 0 0 / 0.1);--tw-shadow-colored:0 4px 6px -1px var(--tw-shadow-color),0 2px 4px -2px var(--tw-shadow-color)}.focus\:outline-none:focus,.outline-none{outline:transparent solid 2px;outline-offset:2px}.filter{filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.backdrop-blur{--tw-backdrop-blur:blur(8px);-webkit-backdrop-filter:var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);backdrop-filter:var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia)}.transition-colors{transition-property:color,background-color,border-color,text-decoration-color,fill,stroke}.transition-opacity{transition-property:opacity}.transition-transform{transition-property:transform}.transition-all{transition-property:all}.transition{transition-property:color,background-color,border-color,text-decoration-color,fill,stroke,opacity,box-shadow,transform,filter,backdrop-filter,-webkit-backdrop-filter}.duration-200{transition-duration:.2s}.duration-300{transition-duration:.3s}.duration-500{transition-duration:.5s}.duration-\[\.25s\]{transition-duration:.25s}.duration-100{transition-duration:.1s}.ease-out{transition-timing-function:cubic-bezier(0,0,0.2,1)}.ease-in{transition-timing-function:cubic-bezier(0.4,0,1,1)}.ease-in-out{transition-timing-function:cubic-bezier(0.4,0,0.2,1)}.\[transform\:translate3d\(1rem\2c 0\2c 0\)\]{transform:translate3d(1rem,0,0)}.\[transform\:translate3d\(0\2c 0\2c 0\)\]{transform:translate3d(0,0,0)}.\[transform\:translate3d\(0\2c -1rem\2c 0\)\]{transform:translate3d(0,-1rem,0)}.\[--size\:2\.75rem\]{--size:2.75rem}.\[--line\:\.5rem\]{--line:.5rem}.\[--fp-grid\:2\]{--fp-grid:2}.placeholder\:text-slate-400\/70::-moz-placeholder{color:rgb(148 163 184 / .7)}.placeholder\:text-slate-400\/70::placeholder{color:rgb(148 163 184 / .7)}.placeholder\:text-slate-500::-moz-placeholder{--tw-text-opacity:1;color:rgb(100 116 139 / var(--tw-text-opacity))}.placeholder\:text-slate-500::placeholder{--tw-text-opacity:1;color:rgb(100 116 139 / var(--tw-text-opacity))}.before\:rounded-full::before{content:var(--tw-content);border-radius:9999px}.before\:bg-slate-50::before{content:var(--tw-content);--tw-bg-opacity:1;background-color:rgb(248 250 252 / var(--tw-bg-opacity))}.before\:bg-slate-200::before{content:var(--tw-content);--tw-bg-opacity:1;background-color:rgb(226 232 240 / var(--tw-bg-opacity))}.checked\:before\:bg-white:checked::before{content:var(--tw-content)}.focus\:z-10:focus,.hover\:z-10:hover{z-index:10}.hover\:rotate-\[360deg\]:hover{--tw-rotate:360deg}.hover\:border-slate-400:hover{--tw-border-opacity:1;border-color:rgb(148 163 184 / var(--tw-border-opacity))}.hover\:border-sky-500:hover{border-color:rgb(14 165 233 / var(--tw-border-opacity))}.hover\:border-gray-500:hover{border-color:rgb(107 114 128 / var(--tw-border-opacity))}.focus\:bg-slate-300\/20:focus,.hover\:bg-slate-300\/20:hover{background-color:rgb(203 213 225 / .2)}.hover\:bg-blue-800:hover{--tw-bg-opacity:1;background-color:rgb(30 64 175 / var(--tw-bg-opacity))}.hover\:bg-sky-100:hover{--tw-bg-opacity:1;background-color:rgb(224 242 254 / var(--tw-bg-opacity))}.focus\:shadow-lg:focus,.hover\:shadow-lg:hover{--tw-shadow:0 10px 15px -3px rgb(0 0 0 / 0.1),0 4px 6px -4px rgb(0 0 0 / 0.1);--tw-shadow-colored:0 10px 15px -3px var(--tw-shadow-color),0 4px 6px -4px var(--tw-shadow-color)}.focus\:ring-4:focus,.focus\:ring:focus{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);box-shadow:var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow,0 0 #0000)}.focus\:border-blue-500:focus{border-color:rgb(59 130 246 / var(--tw-border-opacity))}.focus\:ring-4:focus{--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(4px + var(--tw-ring-offset-width)) var(--tw-ring-color)}.focus\:ring:focus{--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color)}.focus\:ring-blue-300:focus{--tw-ring-opacity:1;--tw-ring-color:rgb(147 197 253 / var(--tw-ring-opacity))}.active\:bg-slate-200\/80:active{background-color:rgb(226 232 240 / .8)}.active\:bg-slate-300\/25:active{background-color:rgb(203 213 225 / .25)}.active\:bg-slate-300\/80:active{background-color:rgb(203 213 225 / .8)}@media (prefers-color-scheme:dark){.dark\:border-gray-700{--tw-border-opacity:1;border-color:rgb(55 65 81 / var(--tw-border-opacity))}.dark\:border-gray-600{--tw-border-opacity:1;border-color:rgb(75 85 99 / var(--tw-border-opacity))}.dark\:bg-gray-900{--tw-bg-opacity:1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:bg-gray-800{--tw-bg-opacity:1;background-color:rgb(31 41 55 / var(--tw-bg-opacity))}.dark\:bg-blue-600{--tw-bg-opacity:1;background-color:rgb(37 99 235 / var(--tw-bg-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:rgb(107 114 128 / var(--tw-text-opacity))}.dark\:hover\:text-white:hover,.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-gray-400{--tw-text-opacity:1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:checked\:before\:bg-white:checked::before{content:var(--tw-content);--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.dark\:hover\:bg-blue-700:hover{--tw-bg-opacity:1;background-color:rgb(29 78 216 / var(--tw-bg-opacity))}.dark\:hover\:bg-gray-600:hover{--tw-bg-opacity:1;background-color:rgb(75 85 99 / var(--tw-bg-opacity))}.dark\:focus\:ring-blue-800:focus{--tw-ring-opacity:1;--tw-ring-color:rgb(30 64 175 / var(--tw-ring-opacity))}}@media print{.print\:hidden{display:none}}
        .text-success {
            color: green;
        }
    </style>
</head>

<body x-data class="is-header-blur" x-bind="$store.global.documentBody">

<!-- Main Content Wrapper -->
<div style="padding-bottom: 50px">
    <main class="sm:w-8/12 sm:mx-auto">
        <div>
            <div class="mt-7 pt-5">
                <div class="rounded-lg p-5 bg-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <p>
                                Due Amount
                            </p>
                            <p class="text-3xl text-black font-bold">
                                ₹ {{number_format($data['due'],2)}}
                            </p>
                            {{-- <label class="mt-1.5 flex -space-x-px">
                                <div
                                    class="flex items-center justify-center rounded-l-lg border border-slate-300 px-3.5 font-inter dark:border-navy-450"
                                >
                                    <span class="-mt-1">₹</span>
                                </div>
                                <input
                                    class="form-input w-full rounded-r-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Due Amount"
                                    type="text"
                                    value="{{number_format($data['due'],2)}}"
                                    required
                                />
                            </label> --}}
                        </div>
                        @if($data['status']==0 && $data['emi']<$data['total_emis'])
                        <a href="{{route('invoices.payment.page',['id'=>$id,'invoiceId'=>$invoiceId,'rinvoiceId'=>$rinvoiceId,'amount'=>$data['due']])}}" class="btn bg-green-400 font-medium text-white py-2 px-5 rounded-lg text-md">
                            Pay Now
                        </a>
                        @else
                        <span class="text-success">Paid</span>
                        @endif
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
                                    Invoice No: {{$data['invoice_number']}}
                                </p>
                                <input type="hidden" value="{{$data['invoiceId']}}" name="invoiceId">
                                <input type="hidden" value="{{$data['invoice_number']}}" name="invoice_number">
                            </div>

                            <div class="justify-between flex">
                                <p class="text-md font-bold text-black">
{{--                                    @if($data['userdetails']?->business_name)--}}
                                        Name of Company: {{$data['userdetails']?->business_name}}
{{--                                    @endif--}}
                                </p>

                                <p class="text-md font-bold text-black">
{{--                                    @if($data['user']?->email)--}}
                                        Email: {{$data['user']?->email}}
{{--                                    @endif--}}
                                </p>
{{--                                <input type="hidden" value="{{$data['invoiceId']}}" name="invoiceId">--}}
{{--                                <input type="hidden" value="{{$data['invoice_number']}}" name="invoice_number">--}}
                            </div>

                            <div class="sm:justify-between sm:flex">
                                <span class="flex items-center text-md">
{{--                                    @if($data['user']?->phone_no)--}}
                                        <p class="text-md font-bold text-black mr-2">Phone :</p>{{ $data['user']?->phone_no }}
{{--                                    @endif--}}
                                </span>
                                <span class="flex items-center text-md">
{{--                                    @if( $data['business_address'] )--}}
                                        <p class="text-md font-bold text-black mr-2">Address :</p>{{ isset($userdetails->business_address) ? $userdetails?->business_address . ', ' . $userdetails?->business_city . ', ' . $userdetails?->business_state . ', ' . $userdetails?->business_country :'' }}
{{--                                    @endif--}}
                                </span>
                            </div>
                            <div class="sm:justify-between sm:flex">
                                <span class="flex items-center text-md">
{{--                                    @if( $data['userdetails']?->business_gst_no )--}}
                                        <p class="text-md font-bold text-black mr-2">GST Number :</p>{{  $data['userdetails']?->business_gst_no }}
{{--                                    @endif--}}
                                </span>
{{--                                <span class="flex items-center text-md">--}}
{{--                                    <span class="text-md font-bold text-black mr-2">Gateway :</span> {{ $data['paid_by'] }}--}}
{{--                                </span>--}}
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

                            <div class="sm:justify-between sm:flex">
                                 <span class="flex items-center text-md">
                                    <p class="text-md font-bold text-black mr-2">Name :</p>
                                    {{ $data['customer']->name }}
                                 </span>
                                <span class="flex items-center text-md">
                                    <p class="text-md font-bold text-black mr-2">Email :</p>
                                    {{  $data['customer']->email }}
                               </span>
                            </div>
                            <div class="justify-between flex">
                                <span class="flex items-center text-md">
{{--                                    @if($data['customer']->company_address)--}}
                                        <p class="text-md font-bold text-black mr-2">Address :</p>
                                        {{ $data['customer']->company_address }}
{{--                                    @endif--}}
                                 </span>
                                <span class="flex items-center text-md">
                                    <p class="text-md font-bold text-black mr-2">GST Number :</p>
                                    {{ $data['customer']->gst_no }}
                                 </span>
                            </div>
                            <div class="justify-between flex">
                                <span class="flex items-center text-md">
                                    <p class="text-md font-bold text-black mr-2">Phone :</p>{{ $data['customer']->phone_no}}
                                </span>
{{--                                <span class="flex items-center text-md">--}}
{{--                                    <p class="text-xl font-bold text-black ">₹ {{ number_format($data['due'],2) }}</p>--}}
{{--                                </span>--}}
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
                            @if(!empty($data['products']))
                            @foreach($data['products'] as $product)
                            <tr>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$product->name}}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$product->qty}}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$product->price}}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-right">{{$product->price*$product->qty}}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$data['product']->name}} [ EMI {{$data['emi'] == $data['total_emis'] ? $data['emi'] : $data['emi']+1}} ]</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">1</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{number_format($data['subtotal'],2)}}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-right">{{number_format($data['subtotal'],2)}}</td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right pr-5">
                       <span class="flex items-center flex justify-end text-md">
                           <p class="text-md text-black mr-4">Subtotal :</p> {{ number_format($data['subtotal'],2) }}
                       </span>
                        <span class="flex items-center text-md flex justify-end">
                           <p class="text-md text-black mr-4">GST {{ $data['tax']? number_format($data['tax'],2): '0' }}%:</p> {{ number_format($data['due']-$data['subtotal'],2) }}
                       </span>
                        <span class="flex items-center text-md font-bold text-black justify-end">
                           <p class="text-md text-black mr-4 font-bold">Total :</p> {{ number_format($data['due'],2) }}
                       </span>
                        <button disabled class="btn px-6 py-4 text-xl mt-2 text-black font-bold"
                                style="background-color: {{($data['status']==0?'#FFD2D2':'#d2ffea')}}">
                            <span class="pr-4">{{($data['status']==0?'Due':'Paid')}}</span>
                            <span>₹ {{ number_format($data['due'],2) }}</span>
                        </button>
                    </div>
                </div>
                <div class="mt-4 rounded-lg p-4 bg-white">
                    <center><p class="text-2xl  text-black font-bold pt-5">Product Description</p></center>
                    @if(!empty($data['products']))
                    @foreach($data['products'] as $product)
                    <div>
                        <h2 class="text-2xl  text-black font-bold pt-5">{{$product->name}}</h2>
                        <div class="grid md:grid-cols-2 gap-4 mt-4 p-4">
                            <div class=" flex justify-center">
                                @if(!empty($product->product) && !empty($product->product->image))
                                <img src="{{asset('images/products/'.$product->product->image)}}" alt="{{$product->name}} Image">
                                @endif
                            </div>
                            <div class="mt-3">
                                {!! $product->product?->description !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div>
                        <h2 class="text-2xl  text-black font-bold pt-5">{{$data['product']->name}}</h2>
                        <div class="grid md:grid-cols-2 gap-4 mt-4 p-4">
                            <div class=" flex justify-center">
                                @if(!empty($data['product']->image))
                                <img src="{{asset('images/products/'.$data['product']->image)}}" alt="{{$data['product']->name}} Image">
                                @endif
                            </div>
                            <div class="mt-3">
                                {!! $data['product']->description !!}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>

<script>

</script>
</body>

</html>
