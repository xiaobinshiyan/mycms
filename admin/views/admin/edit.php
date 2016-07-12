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
	          <li><a href="<?php echo site_url('admin/index') ?>">管理员</a></li>
	          <li><a class="action" href="javascript:;">编辑</a></li>
	      </ul>
	  </div>
	  <form class="hd-form" onsubmit="return hd_submit(this,'<?php echo site_url('admin/edit/'.$info['uid']) ?>','<?php echo site_url('admin/index') ?>')">
	      <table class="hd-table hd-table-form">
	          <tr>
	              <th class="hd-w100">帐号 <span class="star">*</span></th>
	              <td>
	                  <input type="hidden" name="username" class="hd-w200" value="<?php echo $info['username'] ?>" />
	                  <?php echo $info['username'] ?>
	              </td>
	          </tr>
	          <tr>
	              <th class="hd-w100">所属角色 <span class="star">*</span></th>
	              <td>
	              <select name="role">
	              		<?php foreach ($roles as $v): ?>
	                        <option value="<?php echo $v['rid'] ?>"
	                        <?php if($info['role'] == $v['rid']): ?>selected='selected' <?php endif; ?>>
	                        <?php echo $v['rname'] ?></option>	
	              		<?php endforeach ?>
	              </select>
	              </td>
	          </tr>
	          <tr>
	              <th class="hd-w100">密码 <span class="star">*</span></th>
	              <td>
	                  <input type="password" name="password" class="hd-w200"/>
	              </td>
	          </tr>
	          <tr>
	              <th class="hd-w100">确认密码 <span class="star">*</span></th>
	              <td>
	                  <input type="password" name="c_password" class="hd-w200"/>
	              </td>
	          </tr>
	          <tr>
	              <th>状态</th>
	              <td>
	              	<?php if($info['status'] == 1): ?>
	                  <label><input type="radio" name="status" value="1" checked="checked"> 显示</label>
	                  <label><input type="radio" name="status" value="0"> 隐藏</label>
	              	<?php else: ?>
	              		<label><input type="radio" name="status" value="1"> 显示</label>
	              		<label><input type="radio" name="status" value="0" checked="checked"> 隐藏</label>
	              	<?php endif; ?>
	              </td>
	          </tr>
	      </table>
	      <input type="submit" class="hd-btn" value="确定"/>
	  </form>
	</div>
</body>
</html>