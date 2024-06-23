<script>
  $(document).ready(function(){
    $('select[name="state"]').on('change',function(){
      var state = $(this).val();
      if(state){
        $.ajax({
          url:"{{url('/get/city/')}}/"+s_id,
          type:'GET',
          dataType:"json",
          success:function(data){
            $('#city').empty();
            $.each(data,function(key,value){
              $('#city').append('<option value="'+value.id+'">'+value.c_name+'</option>')
            })
          },
        });
      }else{
        alert('danger');
      }
    });
  });
</script>
