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
	          <li><a class="action" href="javascript:;">Banner管理</a></li>
	          <li><a href="<?php echo site_url('banner/add') ?>">添加Banner</a></li>
	      </ul>
	  </div>
	  <table class="hd-table hd-table-list hd-form">
	      <thead>
	      <tr>
	          <td class="hd-w50">排序</td>
	          <td class="hd-w50">ID</td>
	          <td>Title</td>
	          <td>状态</td>
	          <td class="hd-w150">操作</td>
	      </tr>
	      </thead>
	      <tbody>
		  <?php if(! empty($info) && is_array($info)): ?>
		  	<?php foreach ($info as $k => $v): ?>
	          <tr>
	              <td>
	                  <input type="text" class="hd-sort hd-w30" nidinfo="<?php echo $v['bid']; ?>" value="<?php echo $v['sort'] ?>" name="sort"/>
	              </td>
	              <td><?php echo $v['bid'] ?></td>
	              <td><?php echo $v['btitle'] ?></td>
	              <td>
	                 <?php if($v['status'] == 1): ?>
	                      显示
	                 <?php else: ?>
	                      隐藏
	                  <?php endif; ?>
	              </td>
	              <td style="text-align: left">
	                  	<a href="javascript:;">修改</a> |
	                    <a href="javascript:del(<?php echo $v['bid'] ?>)">删除</a>
	              </td>
	          </tr>
			<?php endforeach; ?>
		<?php endif; ?>
	      </tbody>
	  </table>
	</div>
	<script>
	$(function(){
		$(".hd-sort").change(function(){
			var val = parseInt($(this).val().trim());
			var did = parseInt($(this).attr('nidinfo'));
			if(val >= 0 && val <= 255)
			{
				$.ajax({
					url: "<?php echo site_url('banner/chagesort'); ?>",
					data: {"sort":val,"bid":did},
					type: "POST",
					dataType: "json",
					success: function(e) {
						hd_alert({
							message: e.message,
							timeout: 1,
							success: function() {
								e.status && window.location.reload();
							}
						})
					}
				})
			}
			else
			{
				hd_alert({
					message: "数字必须介于0,255之间",
					timeout: 1,
					success: function() {
						window.location.reload();
					}
				})
			}
		})
	})
		function del(nid) {
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
		            hd_ajax("<?php echo site_url('banner/del') ?>", {bid: nid}, "<?php echo site_url('banner/index') ?>");
		        }
		    });
		}
	</script>
</body>
</html>