<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>操作失败</title>
</head>
<style>
	a {
  text-decoration: none;
}
div.wrap {
  overflow: hidden;
  background: #fff;
  border: solid 1px #03565E;
  box-shadow: 0px 3px 26px #333;
  width: 460px;
  height: 150px;
  position: absolute;
  left: 50%;
  top: 50%;
  margin-left: -275px;
  margin-top: -168px;
}
div.wrap div.title {
  height: 35px;
  background: #F6F6F6;
  border-bottom: solid 1px #999;
  color: #666;
  font-weight: bold;
  font-size: 14px;
  line-height: 35px;
  text-indent: 20px;
}
div.wrap div.content {
  height: 422px;
  padding-top: 0px;
}
div.wrap div.content div.icon {
  width: 120px;
  height: 100px;
  float: left;
  background: url("<?php echo base_url().'views/style/'; ?>img/ico.jpg") no-repeat 30px 10px;
}
div.wrap div.content div.message {
  float: left;
  color: #333;
  font-size: 12px;
  padding-top: 15px;
}
div.wrap div.content div.message p {
  padding-bottom: 5px;
}
div.wrap .hd-cancel {
  background-color: #F5F5F5;
  background-image: linear-gradient(to bottom, #FFFFFF, #E6E6E6);
  background-repeat: repeat-x;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) #B3B3B3;
  border-image: none;
  border-radius: 4px;
  border-style: solid;
  border-width: 1px;
  box-shadow: 0 1px 0 rgba(255, 255, 255, 0.2) inset, 0 1px 2px rgba(0, 0, 0, 0.05);
  color: #333333;
  cursor: pointer;
  display: inline-block;
  font-size: 12px;
  line-height: 20px;
  margin-bottom: 0;
  padding: 3px 6px;
  text-align: center;
  text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
  vertical-align: middle;
}
div.wrap .hd-cancel:hover,
div.wrap .hd-cancel:focus {
  background-position: 0 -115px;
}

</style>
	<body>
		<div class="wrap">
			<div class="title">
				操作失败
			</div>
			<div class="content">
				<div class="icon"></div>
				<div class="message">
					<p>
						<?php echo $msg; ?>
					</p>
					<a href="javascript:<?php echo $url ?>" class="hd-cancel">
						返回
					</a>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		var time = "<?php echo $time; ?>";
			window.setTimeout("<?php echo $url;?>",time*1000);
		</script>
	</body>
</html>