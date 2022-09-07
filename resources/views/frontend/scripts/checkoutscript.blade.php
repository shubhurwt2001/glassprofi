<script type="text/javascript">
  /*
        $(document).ready(function(){
        
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        
   });

   $("#billing_address").submit(function(e){
        e.preventDefault();
        $("#place_order").val('Please Wait.......');
        $("#place_order").attr("disabled", true);
        removeValidationClassess('#billing_address');
        $.ajax({
          url:'{{ route('place.order') }}',
          method:'post',
          data:$(this).serialize(),
          dataType: 'json',
          success: function(placeres){
            //console.log(placeres);
            if(placeres.status == 400){
              showError('f_name', placeres.messages.f_name);
              showError('l_name', placeres.messages.l_name);
              showError('country', placeres.messages.country);
              showError('address', placeres.messages.address);
              showError('apartment', placeres.messages.apartment);
              showError('city', placeres.messages.city);
              showError('state', placeres.messages.state);
              showError('postcode', placeres.messages.postcode);
              showError('mail', placeres.messages.mail);
              showError('phone', placeres.messages.phone);
              $("#place_order").val('Place order');
              $("#place_order").attr("disabled", false);
            }if(placeres.status == 200){
              $("#billing_address")[0].reset();
              removeValidationClassess('#billing_address');
              $("#place_order").val('Place order');
             // $("#place_order").attr("disabled", true);
            }if(placeres.status == 401){
              $("#billing_address")[0].reset();
              removeValidationClassess('#billing_address');
              $("#place_order").val('Place order');
              //$("#place_order").attr("disabled", true);
            }
          }
        });

   });

   function showMessage(type, message){
                return `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    <strong>${message}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
    }

    function showError(field, message){
            if(!message){
                $("#"+field)
                .addClass("is-valid")
                .removeClass("is-invalid")
                .siblings(".invalid-feedback")
                .text("");
            }else{
                $("#"+field)
                .addClass("is-invalid")
                .removeClass("is-valid")
                .siblings(".invalid-feedback")
                .text(message);
            }
    }

    function removeValidationClassess(form){
        $(form).each(function(){
            $(form).find(":input").removeClass("is-valid is-invalid");
        });
    }
*/
   </script>