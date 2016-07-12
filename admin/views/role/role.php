<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>大朋后台管理系统</title>
</head>
	<base href="<?php echo base_url().'views/style/'; ?>" />
	<link href="./css/media.css" rel="stylesheet">
	<link href="./hdjs/hdjs.css" rel="stylesheet">
	<script src="./js/jquery-1.8.2.min.js"></script>
	<script src="./js/validate.js"></script>
	<script type="text/javascript" src="./hdjs/hdjs.min.js"></script>
<body>
	<div class="wrap">
	  <div class="menu_list">
	      <ul>
	          <li><a class="action" href="<?php echo site_url('role/index') ?>">角色列表 </a></li>
	          <li><a href="<?php echo site_url('role/add') ?>">添加角色</a></li>
	      </ul>
	  </div>

	  <table class="hd-table hd-table-list hd-form">
	      <thead>
	      <tr>
	          <td class="hd-w100">RID</td>
	          <td class="hd-w100">角色名称</td>
	          <td>Comment</td>
	          <td class="hd-w150">操作</td>
	      </tr>
	      </thead>
	      <tbody>
		  <?php if(! empty($roles) && is_array($roles)): ?>
		  	<?php foreach ($roles as $k => $v): ?>
	          <tr>
	              <td>
	                  <?php echo $v['rid'] ?>
	              </td>
	              <td><?php echo $v['rname'] ?></td>
	              <td><?php echo $v['title'] ?></td>
	              <td style="text-align: left">
	                  <?php if($v['rname'] !== '超级管理员'): ?>
	                      <a href="<?php echo site_url('role/edit/'.$v['rid']); ?>">修改</a> |
	                      <a href="javascript:del(<?php echo $v['rid'] ?>)">删除</a> |
	                      <a href="<?php echo site_url('access/index/'.$v['rid']) ?>">权限设置</a>
	                   <?php else: ?>
	                      <span class="disabled">修改 | </span>
	                      <span class="disabled">删除 | </span>
	                      <span class="disabled">权限设置</span>
	                  <?php endif; ?>
	              </td>
	          </tr>
			<?php endforeach; ?>
		<?php endif; ?>
	      </tbody>
	  </table>
	</div>
	<script>
		function del(uid) {
		    hd_modal({
		        width: 400,//宽度
		        height: 200,//高度
		        title: '提示',//标题
		        content: '确定删除吗',//提示信息
		        button: true,//显示按钮
		        button_success: "确定",//确定按钮文字
		        button_cancel: "关闭",//关闭按钮文字
		        timeout: 0,//自动关闭时间 0：不自动关闭
		        shade: true,//背景遮罩
		        shadeOpacity: 0.1,//背景透明度
		        success: function () {//点击确定后的事件
		            hd_ajax("<?php echo site_url('role/del') ?>", {rid: uid}, "<?php echo site_url('role/index') ?>");
		        }
		    });
		}
	</script>
</body>
</html>