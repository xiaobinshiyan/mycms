<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
		<title> 后台管理中心</title>
		<base href="<?php echo base_url().'views/style/'; ?>" />
		<link href="./css/media.css" rel="stylesheet">
        <link href="./css/index.css" rel="stylesheet">
        <script src="./js/jquery-1.8.2.min.js"></script>
        <script src="./js/menu.js"></script>
	</head>
	<body>
	<style>
   a{
   	cursor: pointer;
   }
	</style>
	<base target="iframe">
		<div class="nav">
			<!--头部左侧导航-->
	      <div class="top_menu" style="padding-left:140px;">
	          <?php foreach ($node as $v): ?>
	            <a nid="<?php echo $v['nid']; ?>" onclick="get_left_menu(<?php echo $v['nid']; ?>);" class="top_menu">
	             <?php echo $v['title']; ?>
	            </a>           
	          <?php endforeach; ?>
	      </div>
			<!--头部左侧导航-->
			<!--头部右侧导航-->
			<div class="r_menu">
				管理员：<?php echo $this->session->userdata('username');?>
				<a href="<?php echo site_url('login/login_out'); ?>" target="_self">
					[退出]
				</a>
				<span>|</span>
				<a href="<?php echo base_url().'../';?>" target="_blank">
					前台首页
				</a>
			</div>
			<!--头部右侧导航-->
		</div>
		<!--左侧导航-->
		<div class="main">
			<!--主体左侧导航-->
			<div class="left_menu"></div>
			<!--主体左侧导航-->
				<!--内容显示区域-->
			      <div class="menu_nav">
			        <div class="direction">
			          <a class="left">
			            向左
			          </a>
			          <a class="right">
			            向右
			          </a>
			        </div>
			        <div class="favorite_menu">
			          <ul style="width:auto;">
<!-- 			            <li class="action" nid="0" style="border-left:solid 1px #D8D8D8;">
			              <a class="menu" nid="0">
			                环境
			              </a>
			            </li> -->
			          </ul>
			        </div>
			      </div>
			      <div class="top_content">
			        <iframe src="<?php echo site_url('welcome/defaultPage');?>" nid="0" scrolling="auto" frameborder="0"
			        style="height: 100%;width: 100%;"></iframe>
			      </div>
		      	<!--内容显示区域-->
			<!--内容显示区域-->
		</div>
		<!--加载后触发第一个顶级菜单-->
		<script>
		var back_url = "<?php echo base_url(); ?>index.php";
			$("a[nid=1]").trigger("click");
		</script>
		
	</body>
</html>