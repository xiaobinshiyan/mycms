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
		  <li><a href="<?php echo site_url('node/index').'/?ace='.rand(100000,999999); ?>"> 菜单管理 </a></li>
		  <li><a href="javascript:;" class='action'>添加菜单</a></li> 
		</ul> 
	   </div>
	  <div class="hd-title-header">菜单信息</div>
	  <form onsubmit="return hd_submit(this,'<?php echo site_url('node/add') ?>','<?php echo site_url('node/index') ?>')">
	      <table class="hd-table hd-table-form hd-form">
	          <tr>
	              <th class="hd-w100">上级</th>
	              <td>
	                  <select name="pid">
	                      <option value="0">一级菜单</option>
	                     	<?php foreach ($nodes as $v): ?>
	                     		<option value="<?php echo $v['nid'] ?>"
	                     		<?php if($nid == $v['nid']): ?>selected='selected' <?php endif; ?>>
	                     		<?php echo $v['_name'] ?>
	                     		</option>
	                     	<?php endforeach ?>
	                  </select>
	              </td>
	          </tr>
	          <tr>
	              <th>名称 <span class="star">*</span></th>
	              <td>
	                  <input type="text" name="title" class="hd-w200"/>
	              </td>
	          </tr>
	          <tr>
	              <th>控制器 <span class="star">*</span></th>
	              <td>
	                  <input type="text" name="control" class="hd-w200"/>
	              </td>
	          </tr>
	          <tr>
	              <th>动作 <span class="star">*</span></th>
	              <td>
	                  <input type="text" name="method" class="hd-w200"/>
	              </td>
	          </tr>
	          <tr>
	              <th>参数</th>
	              <td>
	                  <input type="text" name="param" class="hd-w300"/>
	                  <span class="hd-validate-notice">例:cid=1&mid=2</span>
	              </td>
	          </tr>
	          <tr>
	              <th>备注</th>
	              <td>
	                  <textarea name="comment" class="hd-w350 hd-h100"></textarea>
	              </td>
	          </tr>
	          <tr>
	              <th>状态</th>
	              <td>
	                  <label><input type="radio" name="state" value="1" checked="checked"> 显示</label>
	                  <label><input type="radio" name="state" value="0"> 隐藏</label>
	              </td>
	          </tr>
	          <tr>
	              <th>类型</th>
	              <td>
	                  <select name="type">
	                      <option value="1">菜单+权限控制</option>
	                      <option value="2">普通菜单</option>
	                  </select>
	              </td>
	          </tr>
	          <tr>
	              <th>是否是系统菜单</th>
	              <td>
	                  <label><input type="radio" name="issystem" value="1"> 是</label>
	                  <label><input type="radio" name="issystem" value="0" checked="checked"> 否</label>
	              </td>
	          </tr>
	      </table>
	      <input type="submit" class="hd-btn" value="提交"/>
	  </form>
	  </div>
</body>
</html>