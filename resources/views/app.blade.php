<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/general/bootstrap/dist/css/bootstrap.min.css') }}" >
    
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
    <link href="{{ asset('admin_assets/vendors/custom/vendors/fontawesome5/css/all.min.css') }}" rel="stylesheet"
        type="text/css" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" /> --}}

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- <link rel="stylesheet" href="{{ asset('admin_assets/vendors/general/select2/dist/css/select2new.min.css') }}" > --}}
        @routes
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    @inertiaHead
  </head>
  <body>
    @inertia
    <div id="modal"></div>
  </body>
  {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}

{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> --}}

<script src="{{ asset('admin_assets/vendors/general/jquery/dist/jquery.slim.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/general/bootstrap/js/dist/bootstrap.bundle.min.js') }}"></script>

 
        
</html>