<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> ProSchool </title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/fav.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css_login/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css_login/style.css" type="text/css">
</head>

<body>

<div class="container-fluid bg-login">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 login-card">
                <div class="row">
                    <div class="col-md-5 detail-part">
                    </div>

                    <div class="col-md-7 logn-part">

                        <div class="row">
                            <div class="col-lg-10 col-md-12 mx-auto">
                                <div class="logo-cover">
                                    <center><img src="<?php echo base_url(); ?>assets/logo_proschool.jpg" alt=""></center>
                                    <!--                                    <img src="--><?php //echo 'http://'.$_SERVER['SERVER_NAME'].'/asis/asispanel/upload/'.$sekolah->logo; ?><!--" height='100px' class="apps ">-->
                                </div>

                                <form action="<?php echo base_url(); ?>login/cek" method='post' class="ogin100-form validate-form  ">
                                    <div class="md-form-group 1"><b>Username</b>
                                        <input placeholder="username" type="text" required name="username"  value="" class="md-input form-control">
                                    </div>

                                    <div class="md-form-group 1"><b>Password</b>
                                        <input placeholder="password" type="password" name="password" required class="md-input form-control">
                                    </div>

                                    <div class="m-b-md">
                                        <label class="md-check">
                                            <input type="checkbox" id="show_password" value="1"><i class="primary"></i> Show Password</label>
                                    </div>

                                    <button type="submit" name="submit" class="btn blue p-l-md p-r-md btn-block p-x-md btn-primary">LOGIN</button>
                                    <input type="hidden" name="submit">
                                </form>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
<script src="<?php echo base_url(); ?>assets/js_login/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js_login/popper.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js_login/bootstrap.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/dist/login/packages.js" type="text/javascript"></script>

<script>
    function showTime() {
        var a_p = "";
        var today = new Date();
        var curr_hour = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();
        if (curr_hour < 12) {
            a_p = "AM";
        } else {
            a_p = "PM";
        }
        if (curr_hour == 0) {
            curr_hour = 12;
        }
        if (curr_hour > 12) {
            curr_hour = curr_hour - 12;
        }
        curr_hour = checkTime(curr_hour);
        curr_minute = checkTime(curr_minute);
        curr_second = checkTime(curr_second);
        document.getElementById('clock').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
    }
    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    setInterval(showTime, 500);
    $(document).ready(function(){
        if($('input[name=username]').val().trim()=='') $('input[name=username]').focus();
        else $('input[name=password]').focus();

        $("#show_password").change(function(event) {
            if($(this).is(':checked')){
                $("input[name=password]").prop('type', "text");
            }else{
                $("input[name=password]").prop('type', "password");
            }
        });
    });
</script>
<script src="<?php echo base_url(); ?>assets/dist/login/app.js" type="text/javascript"></script>

</html>
