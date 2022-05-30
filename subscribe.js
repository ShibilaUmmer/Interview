$(document).ready(function() {	
    $('#subscribe').on('click', function() {        
        $('.status').html('');        
        var regEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var name = $('#name').val();
        var email = $('#email').val();	        
        if(name.trim() == '' ) {           
			$('#emailError').text('').addClass('hidden');
            $('#name').focus();
            return false;
        } else if(email.trim() == '' ) {          
			$('#emailError').text('Please enter your email.').removeClass('hidden');
			$('#nameError').text('').addClass('hidden');
            $('#email').focus();
            return false;
        } else if(email.trim() != '' && !regEmail.test(email)) {          
			$('#emailError').text('Please enter a valid email.').removeClass('hidden');
			$('#nameError').text('').addClass('hidden');
            $('#email').focus();
            return false;
        } else {            
            $.ajax({
                type:'POST',
                url:'subscription.php',
                dataType: "json",
                data:{subscribe:1, name:name, email:email},
                beforeSend: function () {
                    $('#subscribe').attr("disabled", "disabled");
                    $('.susbcribe-container').css('opacity', '.5');
                },
                success:function(data) {
                    if(data.status == 'ok') {
                        $('#subscribeForm')[0].reset();
                        $('.status').html('<p class="success">'+data.msg+'</p>');
                    } else {
                        $('.status').html('<p class="error">'+data.msg+'</p>');
                    }
                    $('#subscribe').removeAttr("disabled");
                    $('.susbcribe-container').css('opacity', '');
                }
            });
        }
    });
}); 