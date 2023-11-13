<!doctype html>
<html lang="en">
<style>
    @import url("https://fonts.googleapis.com/css?family=Nunito:400,600,700");

    * {
        box-sizing: border-box;
    }

    body {
        font-family: "Nunito", sans-serif;
        color: rgba(#000, 0.7);
    }

    .container {
        height: 200vh;
        background-image: url(https://images.unsplash.com/photo-1538137524007-21e48fa42f3f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=ac9fa0975bd2ebad7afd906c5a3a15ab&auto=format&fit=crop&w=1834&q=80);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .modal {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 60px;
        background: rgba(#333, 0.5);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: 0.4s;

    &-container {
         display: flex;
         max-width: 720px;
         width: 100%;
         border-radius: 10px;
         overflow: hidden;
         position: absolute;
         opacity: 0;
         pointer-events: none;
         transition-duration: 0.3s;
         background: #fff;
         transform: translateY(100px) scale(0.4);
     }

    &-title {
         font-size: 26px;
         margin: 0;
         font-weight: 400;
         color: #55311c;
     }

    &-desc {
         margin: 6px 0 30px 0;
     }

    &-left {
         padding: 60px 30px 20px;
         background: #fff;
         flex: 1.5;
         transition-duration: 0.5s;
         transform: translateY(80px);
         opacity: 0;
     }

    &-button {
         color: darken(#8c7569, 5%);
         font-family: "Nunito", sans-serif;
         font-size: 18px;
         cursor: pointer;
         border: 0;
         outline: 0;
         padding: 10px 40px;
         border-radius: 30px;
         background: rgb(255, 255, 255);
         box-shadow: 0 10px 40px rgba(0, 0, 0, 0.16);
         transition: 0.3s;

    &:hover {
         border-color: rgba(255, 255, 255, 0.2);
         background: rgba(#fff, 0.8);
     }
    }

    &-right {
         flex: 2;
         font-size: 0;
         transition: 0.3s;
         overflow: hidden;

    img {
        width: 100%;
        height: 100%;
        transform: scale(2);
        object-fit: cover;
        transition-duration: 1.2s;
    }
    }

    &.is-open {
         height: 100%;
         background: rgba(#333, 0.85);

    .modal-button {
        opacity: 0;
    }

    .modal-container {
        opacity: 1;
        transition-duration: 0.6s;
        pointer-events: auto;
        transform: translateY(0) scale(1);
    }

    .modal-right img {
        transform: scale(1);
    }

    .modal-left {
        transform: translateY(0);
        opacity: 1;
        transition-delay: 0.1s;
    }
    }

    &-buttons {
         display: flex;
         justify-content: space-between;
         align-items: center;

    a {
        color: rgba(#333, 0.6);
        font-size: 14px;
    }
    }
    }

    .sign-up {
        margin: 60px 0 0;
        font-size: 14px;
        text-align: center;

    a {
        color: #8c7569;
    }
    }

    .input-button {
        padding: 8px 12px;
        outline: none;
        border: 0;
        color: #fff;
        border-radius: 4px;
        background: #8c7569;
        font-family: "Nunito", sans-serif;
        transition: 0.3s;
        cursor: pointer;

    &:hover {
         background: #55311c;
     }
    }

    .input-label {
        font-size: 11px;
        text-transform: uppercase;
        font-family: "Nunito", sans-serif;
        font-weight: 600;
        letter-spacing: 0.7px;
        color: #8c7569;
        transition: 0.3s;
    }

    .input-block {
        display: flex;
        flex-direction: column;
        padding: 10px 10px 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 20px;
        transition: 0.3s;

    input {
        outline: 0;
        border: 0;
        padding: 4px 0 0;
        font-size: 14px;
        font-family: "Nunito", sans-serif;

    &::placeholder {
         color: #ccc;
         opacity: 1;
     }
    }

    &:focus-within {
         border-color: #8c7569;

    .input-label {
        color: rgba(#8c7569, 0.8);
    }
    }
    }

    .icon-button {
        outline: 0;
        position: absolute;
        right: 10px;
        top: 12px;
        width: 32px;
        height: 32px;
        border: 0;
        background: 0;
        padding: 0;
        cursor: pointer;
    }

    .scroll-down {
        position: fixed;
        top: 50%;
        left: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        color: darken(#8c7569, 5%);
        font-size: 32px;
        font-weight: 800;
        transform: translate(-50%, -50%);
    svg {
        margin-top: 16px;
        width: 52px;
        fill: currentColor;
    }
    }


    @media(max-width: 750px) {
        .modal-container {
            width: 90%;
        }
        .modal-right {
            display: none;
        }
    }
</style>
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

<div class="scroll-down">SCROLL DOWN
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
        <path d="M16 3C8.832031 3 3 8.832031 3 16s5.832031 13 13 13 13-5.832031 13-13S23.167969 3 16 3zm0 2c6.085938 0 11 4.914063 11 11 0 6.085938-4.914062 11-11 11-6.085937 0-11-4.914062-11-11C5 9.914063 9.914063 5 16 5zm-1 4v10.28125l-4-4-1.40625 1.4375L16 23.125l6.40625-6.40625L21 15.28125l-4 4V9z"/>
    </svg></div>
<div class="container"></div>
<div class="modal">
    <div class="modal-container">
        <form action="<?php echo base_url(); ?>login/cek" method='post' class="ogin100-form validate-form  ">

        <div class="modal-left">
            <h1 class="modal-title">Welcome!</h1>

            <p class="modal-desc">Fanny pack hexagon food truck, street art waistcoat kitsch.</p>
            <div class="input-block">
                <label for="email" class="input-label">Email</label>
                <input type="text"required name="username" id="email" placeholder="Username">
            </div>
            <div class="input-block">
                <label for="password" class="input-label">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <div class="modal-buttons">
                <a href="" class="">Forgot your password?</a>
                <button class="input-button">Login</button>
            </div>
            <p class="sign-up">Don't have an account? <a href="#">Sign up now</a></p>
        </div>
        </form>
        <div class="modal-right">
            <img src="https://images.unsplash.com/photo-1512486130939-2c4f79935e4f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=dfd2ec5a01006fd8c4d7592a381d3776&auto=format&fit=crop&w=1000&q=80" alt="">
        </div>
        <button class="icon-button close-button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                <path d="M 25 3 C 12.86158 3 3 12.86158 3 25 C 3 37.13842 12.86158 47 25 47 C 37.13842 47 47 37.13842 47 25 C 47 12.86158 37.13842 3 25 3 z M 25 5 C 36.05754 5 45 13.94246 45 25 C 45 36.05754 36.05754 45 25 45 C 13.94246 45 5 36.05754 5 25 C 5 13.94246 13.94246 5 25 5 z M 16.990234 15.990234 A 1.0001 1.0001 0 0 0 16.292969 17.707031 L 23.585938 25 L 16.292969 32.292969 A 1.0001 1.0001 0 1 0 17.707031 33.707031 L 25 26.414062 L 32.292969 33.707031 A 1.0001 1.0001 0 1 0 33.707031 32.292969 L 26.414062 25 L 33.707031 17.707031 A 1.0001 1.0001 0 0 0 32.980469 15.990234 A 1.0001 1.0001 0 0 0 32.292969 16.292969 L 25 23.585938 L 17.707031 16.292969 A 1.0001 1.0001 0 0 0 16.990234 15.990234 z"></path>
            </svg>
        </button>
    </div>
    <button class="modal-button">Click here to login</button>
</div>




<!--<div class="container-fluid bg-login">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-lg-9 col-md-12 login-card">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-5 detail-part">-->
<!--                    </div>-->
<!---->
<!--                    <div class="col-md-7 logn-part">-->
<!---->
<!--                        <div class="row">-->
<!--                            <div class="col-lg-10 col-md-12 mx-auto">-->
<!--                                <div class="logo-cover">-->
<!--                                    <center><img src="--><?php //echo base_url(); ?><!--assets/logo_proschool.jpg" alt=""></center>-->
<!--                                    <!--                                    <img src="-->--><?php ////echo 'http://'.$_SERVER['SERVER_NAME'].'/asis/asispanel/upload/'.$sekolah->logo; ?><!--<!--" height='100px' class="apps ">-->-->
<!--                                </div>-->
<!---->
<!--                                <form action="--><?php //echo base_url(); ?><!--login/cek" method='post' class="ogin100-form validate-form  ">-->
<!--                                    <div class="md-form-group 1"><b>Username</b>-->
<!--                                        <input placeholder="username" type="text" required name="username"  value="" class="md-input form-control">-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="md-form-group 1"><b>Password</b>-->
<!--                                        <input placeholder="password" type="password" name="password" required class="md-input form-control">-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="m-b-md">-->
<!--                                        <label class="md-check">-->
<!--                                            <input type="checkbox" id="show_password" value="1"><i class="primary"></i> Show Password</label>-->
<!--                                    </div>-->
<!---->
<!--                                    <button type="submit" name="submit" class="btn blue p-l-md p-r-md btn-block p-x-md btn-primary">LOGIN</button>-->
<!--                                    <input type="hidden" name="submit">-->
<!--                                </form>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!---->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

</body>
<script src="<?php echo base_url(); ?>assets/js_login/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js_login/popper.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js_login/bootstrap.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/dist/login/packages.js" type="text/javascript"></script>

<script>
    const body = document.querySelector("body");
    const modal = document.querySelector(".modal");
    const modalButton = document.querySelector(".modal-button");
    const closeButton = document.querySelector(".close-button");
    const scrollDown = document.querySelector(".scroll-down");
    let isOpened = false;

    const openModal = () => {
        modal.classList.add("is-open");
        body.style.overflow = "hidden";
    };

    const closeModal = () => {
        modal.classList.remove("is-open");
        body.style.overflow = "initial";
    };

    window.addEventListener("scroll", () => {
        if (window.scrollY > window.innerHeight / 3 && !isOpened) {
            isOpened = true;
            scrollDown.style.display = "none";
            openModal();
        }
    });

    modalButton.addEventListener("click", openModal);
    closeButton.addEventListener("click", closeModal);

    document.onkeydown = evt => {
        evt = evt || window.event;
        evt.keyCode === 27 ? closeModal() : false;
    };

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
