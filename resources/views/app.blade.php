<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/general/bootstrap/dist/css/bootstrap.min.css') }}" >
    <link href="{{ asset('admin_assets/vendors/custom/vendors/fontawesome5/css/all.min.css') }}" rel="stylesheet"
        type="text/css" />

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       
        @routes
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    @inertiaHead
  </head>
  <body>
    @inertia
    <div id="modal"></div>
  </body>
 

<script src="{{ asset('admin_assets/vendors/general/jquery/dist/jquery.slim.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/general/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/general/bootstrap/dist/js/bootstrap.min.js') }}"></script>

 
        
</html>