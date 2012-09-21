        var emailEntered;

        $(document).ready(function() {
            $("#btnSignupEmail").click(function() {
                    $(".error").hide();
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    var emailaddressVal = $("#txtSignupEmail").val();

                    if(emailaddressVal == '') {
                        $("#signup-response").html('<span class="error">Enter your email address!</span>');
                        return false; 
                    }
                    else if(!emailReg.test(emailaddressVal)) {
                        $("#signup-response").html("<span class='error'>Invalid email address!</span>");
                        return false; 
                    } 
                    else {
                        emailEntered = escape($('#txtSignupEmail').val());
                    }

                    

            });
            $('#signup').submit(function() {
                $("#signup-response").html("<span class='status'>Adding your email address...</span>");
                $.ajax({
                    url: 'includes/mailchimp/inc/store-address.php', // proper url to your "store-address.php" file
                    data: 'ajax=true&email=' + emailEntered,
                    success: function(msg) {
                        $('#signup-response').html("<span class='status'>" + msg + "</span>");
                    }
                });
                return false;
            });
        });
 