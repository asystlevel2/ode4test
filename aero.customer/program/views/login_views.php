<html>
<head>
<?=$this->config->item('metahtml')?>	
<title><?=$this->config->item('login_title')?></title>
<link rel="shortcut icon" type="image/png" href="<?=base_url()?>assets/img/favicon.png">
<link href="<?php echo site_url('assets/css/all.min.css');?>" rel="stylesheet">
<style rel="stylesheet" type="text/css">
body {
  color: #e7e7e7;
  font-family: Arial, Helvetica, Tahoma, sans-serif;
}
h2 {
  color: #e7e7e7;
  font-size: 24px;
  font-weight: 640;
  text-align: center;
  margin-bottom: 10px;
}

a {
  color: #e7e7e7;
  text-decoration: none;
}

.login {
  width: 400px;
  position: absolute;
  top: 40%;
  left: 45%;
  z-index: 99;
  margin: -184px 0px 0px -155px;
  background: rgb(178,254,250);
background: linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(14,210,247,1) 100%);
  padding: 20px 30px;
  border-radius: 5px;
  box-shadow: 0px 15px 25px rgba(0,0,0,0.4),inset 0px 1px 0px rgba(255,255,255,0.07)
}

input[type="text"], input[type="password"] {
  width: 250px;
  padding: 10px;
  margin-bottom: 7px;
  background: #fff;
  border: 1px solid #aaa;
  outline: none;
  color: #333;
  border-radius: 5px;
}

input[type=checkbox] {
  display: none;
}

label {color:#888;
  margin-top: 2px;
  width: 4px;
  height: 4px;
  border-radius: 50%;
  background: #46485c;
  content: "";
  display: block;
  position: absolute;
  transition: all 0.5s linear;
  cursor: pointer;
  border: 3px solid #252730;
  box-shadow: 0px 0px 0px 2px #46485c;
}

#remember:checked ~ label[for=remember] {
  background: #b5cd60;
  border: 3px solid #252730;
  box-shadow: 0px 0px 0px 2px #b5cd60;
}


input[type="submit"] {
  background: #176ddc;
  border: 0;
    font-size: 16px;
    font-weight: bold;
  width: 250px;
  height: 40px;
  border-radius: 10px;
  color: white;
  cursor: pointer;
  transition: background 0.4s linear;
}
input[type="submit"]:hover {

  background: #16bb59;
}

.forgot {
  margin-top: 30px;
  display: block;
  font-size: 11px;
  text-align: center;
  font-weight: bold;
}
.forgot:hover {
  margin-top: 30px;
  display: block;
  font-size: 11px;
  text-align: center;
  font-weight: bold;
  color: #6d7781;
}

.remember {
  padding: 30px 0px;
  font-size: 12px;
  text-indent: 25px;
  line-height: 15px;
}

::-webkit-input-placeholder {
  color: #ccc;
}

[placeholder]:focus::-webkit-input-placeholder {
  transition: all 0.3s linear;
  transform: translate(12px, 0);
  opacity: 0;
}
@keyframes move_wave {
    0% {
        transform: translateX(0) translateZ(0) scaleY(1)
    }
    50% {
        transform: translateX(-25%) translateZ(0) scaleY(0.55)
    }
    100% {
        transform: translateX(-50%) translateZ(0) scaleY(1)
    }
}
.waveWrapper {
    overflow: hidden;
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    margin: auto;
}
.waveWrapperInner {
    position: absolute;
    width: 100%;
    overflow: hidden;
    height: 100%;
    bottom: -1px;
    background-image: linear-gradient(to top, #3b3b7d 20%, #86377b 80%);
}
.bgTop {
    z-index: 15;
    opacity: 0.5;
}
.bgMiddle {
    z-index: 10;
    opacity: 0.75;
}
.bgBottom {
    z-index: 5;
}
.wave {
    position: absolute;
    left: 0;
    width: 200%;
    height: 100%;
    background-repeat: repeat no-repeat;
    background-position: 0 bottom;
    transform-origin: center bottom;
    z-index: 1;
}
.waveTop {
    background-size: 50% 100px;
}
.waveAnimation .waveTop {
  animation: move_wave 4s linear infinite;
   -webkit-animation: move_wave 4s linear infinite;
   -webkit-animation-delay: 1s;
   animation-delay: 1s;
}
.waveMiddle {
    background-size: 50% 120px;
}
.waveAnimation .waveMiddle {
    animation: move_wave 10s linear infinite;
}
.waveBottom {
    background-size: 50% 100px;
}
.waveAnimation .waveBottom {
    animation: move_wave 15s linear infinite;
}
    .error-message {text-align:center;color:#DD2C00;background:#FFE082;padding:10px;margin:10px;font-size:12px;border-radius:5px;border:1px solid #fff;}
</style>
</head>
<body>
<div class='login' style='text-align:center;'>
  <? /*<h2>=$this->config->item('login_header')</h2> */?>
<<<<<<< HEAD
 <img src="<?=base_url()?>assets/img/logo_aero.png">
=======
 <img src="<?=base_url()?>assets/img/new-logo_aero.png" width="220" height="80" style="padding-bottom: 20px">
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
 <form action="<?=base_url()?>login" method="post">
  <input name='username' placeholder='Username' type='text' style="font-size: 16px;">
  <input name='password' placeholder='Password' type='password'  style="font-size: 16px;">
  <input type="submit" class="btn btn-primary btn-block btn-flat" name="submit" value="Sign In">	
</form>
<!-- ini untuk error -->
		<?if($alert):?>
		
		<div class="error-message" name="error-message">
			<button type="button" class="close" style="float:right;background:transparent;border:none" onclick="DismissAlert()" data-dismiss="alert" aria-hidden="true"><i class="fas fa-times-circle"></i></button>
		    <?if($alert==2):?>
			<i class="fas fa-exclamation-triangle"></i> <strong>Warning!</strong> Access Denied Your Module
			<?else:?>
			<i class="fas fa-exclamation-triangle"></i> <strong>Sorry!</strong> Please enter the right username/password
			<?endif;?>
			<span style="clear:both"></span>
		</div>
		<?endif;?>	

</div>

<div class="waveWrapper waveAnimation">
  <div class="waveWrapperInner bgTop">
    <div class="wave waveTop" style="background-image: url('<?=base_url()?>assets/img/wave-top.png')"></div>
  </div>
  <div class="waveWrapperInner bgMiddle">
    <div class="wave waveMiddle" style="background-image: url('<?=base_url()?>assets/img/wave-mid.png')"></div>
  </div>
  <div class="waveWrapperInner bgBottom">
    <div class="wave waveBottom" style="background-image: url('<?=base_url()?>assets/img/wave-bot.png')"></div>
  </div>
</div>
 <script type="text/javascript" src="<?php echo site_url('assets/js/jquery-1.11.3.min.js');?>"></script>
<script type="text/javascript">
function DismissAlert() { 
  document.getElementsByName("error-message")[0].outerHTML = ""; 
} 
</script>
</body>
</html>