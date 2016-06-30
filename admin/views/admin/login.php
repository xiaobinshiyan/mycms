<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>管理系统后台登陆-Login</title>
    <base href="<?php echo base_url().'views/style/'; ?>" />
    <link href="./css/media.css" rel="stylesheet">
    <link href="./css/css.css" rel="stylesheet">
    <script src="./js/jquery-1.8.2.min.js"></script>
</head>
<body>
<div class="header">
    <div class="links">
        <a href="<?php echo base_url().'../'; ?>">首页官网</a>    
    </div>
</div>
<div class="main">
    <div class="pics"></div>
    <div class="login">
        <div class="title">
            后台登录
        </div>
        <div id="tips" class="tips"></div>
        <div class="web_login">
            <div class="login_form">
                <div id="error_tips">
                    <span class="error_logo"></span>
                    <span class="err_m"></span>
                </div>
                <form action="<?php echo site_url('login/login_in') ?>" method="post" class="hd-form">
                   <b style="color:red"><?php echo $this->session->flashdata('error'); ?></b>
                    <div class="input">
                        <div class="inputOuter">
                            <input type="text" name="username" autofocus='true' placeholder="帐号" required=""/>
                        </div>
                    </div>
                    <div class="input">
                        <div class="inputOuter">
                            <input type="password" name="passwd" placeholder="密码" required=""/>
                        </div>
                    </div>
                    <div class="input">
                        <div class="inputOuter">
                            <input type="text" name="captcha" placeholder="验证码" required=""/>
                        </div>
                    </div>

                    <div class="verifyimgArea">
                        <img src="<?php echo site_url('login/code') ?>" class="code" style="cursor: pointer;float:left;"
                             onclick="this.src='<?php echo site_url ('login/code') ?>/'+Math.random()"/>
                        <a href="javascript:void(0);" onclick="$('.code').trigger('click')">看不清，换一张</a>
                    </div>
                    <div class="send">
                        <input type="submit" class="btn2" value="登录"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <iframe name="checkLogin" style="display:none;"></iframe> -->
</body>
</html>