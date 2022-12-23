
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style type="text/css">
  .bg-primary {
    background-color: #4f46e5!important;
  }
  .bg-error {
    background-color: #ff5724!important;
  }
</style>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  @if($errors->any())
    @foreach($errors->all() as $error)
      toastr.error("{{ $error }}");
    @endforeach
  @endif
  @if(session()->has('success'))
  		toastr.success("{{ session()->get('success') }}");
  @endif


  @if(session()->has('info'))
  		toastr.info("{{ session()->get('info') }}");
  @endif


  @if(session()->has('warning'))
  		toastr.warning("{{ session()->get('warning') }}");
  @endif


  @if(session()->has('error'))
  		toastr.error("{{ session()->get('error') }}");
  @endif
</script>
@endpush