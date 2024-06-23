<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Site Metas -->
    <title>Freshshop - Ecommerce Bootstrap 4 HTML Template</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{asset('assets/images/apple-touch-icon.png')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head> 

<body>
    
   @yield('content')

   <script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{asset('assets/js/jquery.superslides.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('assets/js/inewsticker.js')}}"></script>
    <script src="{{asset('assets/js/bootsnav.js.')}}"></script>
    <script src="{{asset('assets/js/images-loded.min.js')}}"></script>
    <script src="{{asset('assets/js/isotope.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/baguetteBox.min.js')}}"></script>
    <script src="{{asset('assets/js/form-validator.min.js')}}"></script>
    <script src="{{asset('assets/js/contact-form-script.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script>
  $(document).ready(function(){
    $('select[name="state"]').on('change',function(){
      var state = $(this).val();
      if(state){
        $.ajax({
          url:"{{url('/get/city/')}}/"+state,
          type:'GET',
          dataType:"json",
          success:function(data){
            $('#city').empty();
            $.each(data,function(key,value){
              $('#city').append('<option value="'+value.id+'">'+value.city_name+'</option>')
            })
          },
        });
      }else{
        alert('danger');
      }
    });
  });
</script>

</body>

</html>