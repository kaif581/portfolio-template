$(document).ready(function(){

    var origin = window.location.origin;
    var path = window.location.pathname.split( '/' );
    var URL = origin+'/'+path[1]+'/';
    
    // check user login
    // =======================
    $('#adminLogin').submit(function(e){
        e.preventDefault();
        var username = $('.username').val();
        var password = $('.password').val();
        if(username == '' || password == ''){
            $('#adminLogin').append('<div class="alert alert-danger">Please Fill All The Fields.</div>');
        }else{
            $.ajax({
                url    : "./php_files/check_login.php",
                type   : "POST",
                data   : {login:'1',username:username,pass:password},
                success: function(response){
                    console.log(response);
                    $('.alert').hide();
                    var res = JSON.parse(response);
                    if(res.hasOwnProperty('success')){
                        $('#adminLogin').append('<div class="alert alert-success">Logged In Successfully.</div>');
                        setTimeout(function(){ window.location = URL+'admin/dashboard.php'; }, 1000);
                    }else if(res.hasOwnProperty('error')){
                        $('#adminLogin').append('<div class="alert alert-danger">Username and Password not Matched.</div>');
                    }
                }
            });
        }
    });

    $("#createAbout").submit(function(e){
        e.preventDefault();
        var userId = $(".userId").val();
        var sortDesc = $(".sort_desc").val();
        var longDesc = $(".desc").val();

        if(userId == ""){
            $("#createAbout").prepend('<div class="alert alert-danger">User Name Field is empty! </div>')
        }
        else if(sortDesc == ""){
            $("#createAbout").prepend('<div class="alert alert-danger">Sort Description Field is empty! </div>')
        }
        else if(longDesc == ""){
            $("#createAbout").prepend('<div class="alert alert-danger">Long Description Field is empty! </div>')
        }
        else{
            var formdata = new FormData(this);
            formdata.append('createAbout','1');
            $.ajax({
                url: 'php_files/about.php',
                type: 'post',
                processData: false,
                contentType: false,
                data: formdata,
                success: function(response){
                    var res = JSON.parse(response);
                    if(res.success){
                        $("#createAbout").append("<div class='alert alert-success'>"+res.success+"</div>");
                        setTimeout(function(){ window.location = URL+'admin/about.php'; },1000);
                    }
                    else{
                        $("#createAbout").append("<div class='alert alert-danger'>"+res.error+"</div>");
                    }
                }
            })
        }
    });

    $(".status").click(function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var statusData = $(this).attr('data-status');
       
        $.ajax({
            url: 'php_files/about.php',
            type: 'post',
            data: {status:1,id:id,statusData:statusData},
            success:function(response){
                location.reload();
            }
        })
    });

    $(".aboutDelete").click(function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        $.ajax({
            url: 'php_files/about.php',
            type: 'post',
            data: {aboutDelete:1,id:id},
            success:function(){
                location.reload();
            }
        });
    });

    $("#updateAbout").submit(function(e){
        e.preventDefault();
        var formdata = new FormData(this);
        formdata.append('updateAbout','1');
        $.ajax({
            url: 'php_files/about.php',
            type: 'post',
            processData: false,
            contentType: false,
            data: formdata,
            success:function(response){
                var res = JSON.parse(response);
                if(res.success){
                    $("#updateAbout").append("<div class='alert alert-success'>"+res.success+"</div>");
                    setTimeout(function(){ window.location = URL+'admin/about.php'; },1000);
                }
                else{
                    $("#updateAbout").append("<div class='alert alert-danger'>"+res.error+"</div>");
                }
            }
        });
    });

    $(".user-status").click(function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var statusData = $(this).attr('data-status');
       
        $.ajax({
            url: 'php_files/users.php',
            type: 'post',
            data: {status:1,id:id,statusData:statusData},
            success:function(response){
                location.reload();
            }
        })
    });

    $(".userDelete").click(function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        $.ajax({
            url: 'php_files/users.php',
            type: 'post',
            data: {delete:1,id:id},
            success:function(response){
                location.reload();
            }
        })
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
                url:"php_files/users.php",
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
                        setTimeout(function(){ window.location=URL+'admin/users.php'; }, 1500);
                    }else if(res.hasOwnProperty('error')){
                        $('#modify-user').append('<div class="alert alert-danger">'+res.error+'</div>');
                    }
                    
                }
            });
        }
    });

    $("#createMenu").submit(function(e){
        e.preventDefault();
         var menu_title = $(".menu_title").val();
         var menu_name = $(".menu_name").val();
        if(menu_name==""){
            $("#createMenu").append("<div class='alert alert-danger'>Menu Name field is empty</div>");
        }
        if(menu_title == ""){
            $("#createMenu").append("<div class='alert alert-danger'>Menu Title field is empty</div>");
        }
        else{
            $.ajax({
                url: 'php_files/menu.php',
                type: 'post',
                data: {createMenu:1,menu_title:menu_title,menu_name:menu_name},
                success:function(response){
                    var res = JSON.parse(response);
                    if(res.success){
                        $("#createMenu").append("<div class='alert alert-success'>"+res.success+"</div>");
                        setTimeout(function(){window.location=URL+"admin/menu.php"},1000);
                    }
                    else{
                        $("#createMenu").append("<div class='alert alert-danger'>"+res.error+"</div>");
                    }
                }
            })
        }
    });

    $(".menu_status").click(function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var dataStatus = $(this).attr('data-status');
        
        $.ajax({
            url: 'php_files/menu.php',
            type: 'post',
            data: {status:1,id:id,dataStatus:dataStatus},
            success:function(response){
                location.reload();
            }
        })
    });

    $(".menuDelete").click(function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        $.ajax({
            url: 'php_files/menu.php',
            type: 'post',
            data: {deleteMenu:1,id:id},
            success:function(response){
                location.reload();
            }
        })
    });

    $("#updateMenu").submit(function(e){
        e.preventDefault();
        var id = $(".id").val();
        var menutitle = $(".menu_title").val();
        var menuname = $(".menu_name").val();
        
        $.ajax({
            url: 'php_files/menu.php',
            type: 'post',
            data: {update:1,id:id,menutitle:menutitle,menuname:menuname},
            success:function(response){
                console.log(response);
                var res = JSON.parse(response);
                if(res.success){
                    $("#updateMenu").append("<div class='alert alert-success'>"+res.success+"</div>");
                    setTimeout(function(){window.location = URL+"admin/menu.php"},1000);
                }
                else{
                    $("#updateMenu").append("<div class='alert alert-success'>"+res.error+"</div>");
                }
            }
        })
    });

    // update site options
    $('#updateOptions').submit(function(e){
        e.preventDefault();
        $('.alert').hide();
        var site_name = $('.site_name').val();
        var site_title = $('.site_title').val();
        var old_logo = $('.old_logo').val();
        var new_logo = $('.new_logo').val();
        var footer_text = $('.footer_text').val();
        var desc = $('.site_desc').val();
        var phone = $('.phone').val();
        var email = $('.email').val();
        var address = $('.address').val();
        
        if(site_name == ''){
            $('#updateOptions').prepend('<div class="alert alert-danger">Site Name Field is Empty.</div>');
        }if(site_title == ''){
            $('#updateOptions').prepend('<div class="alert alert-danger">Site Title Field is Empty.</div>');
        }else if(footer_text == ''){
            $('#updateOptions').prepend('<div class="alert alert-danger">Footer Text Field is Empty.</div>');
        }else if(desc == ''){
            $('#updateOptions').prepend('<div class="alert alert-danger">Site Description is empty Field is Empty.</div>');
        }else if(phone == ''){
            $('#updateOptions').prepend('<div class="alert alert-danger">Phone Field is Empty.</div>');
        }else if(email == ''){
            $('#updateOptions').prepend('<div class="alert alert-danger">Email Field is Empty.</div>');
        }else if(address == ''){
            $('#updateOptions').prepend('<div class="alert alert-danger">Address Field is Empty.</div>');
        }else{
            var formdata = new FormData(this);
            formdata.append('update',1);
            $.ajax({
                url    : "./php_files/options.php",
                type   : "POST",
                data   : formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response){
                    $('.alert').hide();
                    console.log(response);
                    var res = response;
                    if(res.hasOwnProperty('success')){
                        $('#updateOptions').prepend('<div class="alert alert-success">Options Updates Successfully.</div>');
                        setTimeout(function(){ window.location(); }, 1000);
                        
                    }else if(res.hasOwnProperty('error')){
                        $('#updateOptions').prepend('<div class="alert alert-danger">'+res.error+'</div>');
                    }
                }
            });
        }

    });

    // load image with jquery
    $('.new_logo').change(function(){
        readURL(this);
    })
});

