$(document).ready(function(){
    var origin = window.location.origin;
    var path = window.location.pathname.split( '/' );
    var URL = origin+'/'+path[1]+'/';

    $('#loginUser').submit(function(e){
        e.preventDefault();
        var username = $('.username').val();
        var password = $('.password').val();
        if(username == '' || password == ''){
            $('#userLogin_form .modal-body').append('<div class="alert alert-danger">Please Fill All The Fields.</div>');
        }else{
            $.ajax({
                url: 'php_files/user.php',
                method: 'POST',
                data: {login:'1',username:username,password:password},
                success: function(response){
                    var res = JSON.parse(response);
                    if(res.success){
                        $('#userLogin_form .modal-body').append('<div class="alert alert-success">LoggedIn Successfully.</div>');
                        setTimeout(function(){ location.reload(); }, 1000);
                    }else if(res.error){
                        $('#userLogin_form .modal-body').append('<div class="alert alert-danger">'+res.error+'</div>');
                    }

                }
            });
        }
    });

    $('.user_logout').click(function(e){
        e.preventDefault();
        var user_logout = 1;
        $.ajax({
            url: 'php_files/user.php',
            method: 'POST',
            data: {user_logout:user_logout},
            success: function(response){
                if(response == 'true'){
                    location.reload();
                }
            }
        });
    });
    
    $('#register_sign_up').submit(function(e){
        e.preventDefault();
        $(".form-msg").html('');
        $(".signUp").attr('disabled',true);
        var name = $(".name").val();
        var username = $(".user_name").val();
        var password = $(".pass_word").val();
        var mobile = $(".mobile").val();
        var address = $(".address").val();
        var city = $(".city").val();

        if (name == ''  || username == '' || password == '' || mobile == '' || address == '' || city == ''){
            $('#register_sign_up').append('<div class="alert alert-danger">Please Fill All The Fields</div>');
        }else{
            var formdata = new FormData(this);
            formdata.append('create','1');
            $.ajax({
            url:"./php_files/user.php",
            type:"POST",
            contentType: false,
            processData: false,
            data: formdata,
            success:function(response){
                $(".form-msg").html('Please Wait..!');
                $(".signUp").attr('disabled',false);
                var res = JSON.parse(response);
                if(res.success){
                    $('#register_sign_up').append('<div class="alert alert-success">'+res.success+'</div>');
                    setTimeout(function(){ window.location=URL}, 1500);
                }else if(res.error){
                    $('#register_sign_up').append('<div class="alert alert-danger">'+res.error+'</div>');
                }
            }
        });
        }
    });

    $('#modify-user').submit(function(e){
        e.preventDefault();
        var f_name = $(".f_name").val();
        var mobile = $(".mobile").val();
        var address = $(".address").val();
        var city = $(".city").val();

        if (f_name == '' ||  mobile == '' || address == '' || city == ''){
            $('#modify-user').append('<div class="alert alert-danger">Please Fill All The Fields</div>');
        }else{
            var formdata = new FormData(this);
            formdata.append('update','1');
            $.ajax({
                url:"php_files/user.php",
                type:"POST",
                data: formdata,
                contentType: false,
                processData: false,
                dataType: 'json',
                success:function(response){
                    $('.alert').hide();
                    var res = response;
                    if(res.hasOwnProperty('success')){
                        $('#modify-user').append('<div class="alert alert-success">Modified Successfully.</div>');
                        setTimeout(function(){ window.location=URL+'/user-profile.php'; }, 1500);
                    }else if(res.hasOwnProperty('error')){
                        $('#modify-user').append('<div class="alert alert-danger">'+res.error+'</div>');
                    }
                    
                }
            });
        }
    });


    $('#modify-password').submit(function(e){
        e.preventDefault();
        $('.alert').hide();
        var old_pass = $(".old_pass").val();
        var new_pass = $(".new_pass").val();

        if (old_pass == '' || new_pass == ''){
            $('#modify-password').append('<div class="alert alert-danger">Please Fill All The Fields</div>');
        }else{
            var formdata = new FormData(this);
            formdata.append('modifyPass','1');
            $.ajax({
                url:"php_files/user.php",
                type:"POST",
                data: formdata,
                contentType: false,
                processData: false,
                dataType: 'json',
                success:function(response){
                    $('.alert').hide();
                    var res = response;
                    if(res.hasOwnProperty('success')){
                        $('#modify-password').append('<div class="alert alert-success">Password Modified Successfully.</div>');
                        setTimeout(function(){ window.location = URL+'/user_profile.php'; }, 1500);
                    }else if(res.hasOwnProperty('error')){
                        $('#modify-password').append('<div class="alert alert-danger">'+res.error+'</div>');
                    }
                    
                }
            });
        }
    });

   
    $("#checkMail").submit(function(e){
        e.preventDefault();
        $(".email-msg").html('Please Wait..!');
        $(".sendEmail").attr('disabled',true)
        var email = $(".email").val();
        $.ajax({
            url: './php_files/user.php',
            type: 'post',
            data: {mail:1,email:email},
            success:function(response){
                var res = JSON.parse(response);
                $(".email-msg").html('');
                $(".sendEmail").attr('disabled',false)
                if(res.success){
                    $("#checkMail").append("<div class='alert alert-danger'>"+res.success+"</div>");
                }
                else if(res.error){
                    $("#checkMail").append("<div class='alert alert-danger'>"+res.error+"</div>");
                }
            }

        })
    });

    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#confpassword")
    togglePassword.addEventListener('click',function(){

        const type = password.getAttribute("type") === "password" ? "text":"password";
        password.setAttribute('type',type);

    });

    $("#verifyPassword").submit(function(e){
        e.preventDefault();
        var newpass = $("#password").val();
        var confpass = $("#confpassword").val();
        
        if(newpass=="" || confpass ==""){
            $("#verifyPassword").append('<div class="alert alert-danger">All Field is empty!</div>');
        }
        else{
            if(newpass == confpass){
                if(newpass.length>=8){
                    $.ajax({
                        url: 'php_files/user.php',
                        type: 'post',
                        data: {verifypass:1,password:confpass},
                        success:function(response){
                            var res = JSON.parse(response);
                            if(res.success){
                                $("#verifyPassword").append('<div class="alert alert-success">'+res.success+'</div>');
                                setTimeout(function(){
                                    window.location = URL;
                                })
                            }
                            else if(res.error){
                                $("#verifyPassword").append('<div class="alert alert-danger">'+res.error+'</div>');
                            }
                        }
                    })
                }
                else{
                    $("#verifyPassword").append('<div class="alert alert-danger">Password atleast 8 digit!</div>');    
                }
            }
            else{
                $("#verifyPassword").append('<div class="alert alert-danger">Password not match!</div>');
            }
        }
       
    });

});