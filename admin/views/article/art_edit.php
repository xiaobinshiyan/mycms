<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>编辑</title>
</head>
	<base href="<?php echo base_url().'views/style/'; ?>" />
	<link href="./css/media.css" rel="stylesheet">
	<link href="./css/seller_center.css" rel="stylesheet">
	<script src="./js/jquery-1.8.2.min.js"></script>
	<script src="./js/media.js"></script>
	<script src="./js/copy.js"></script>
	<script src="./js/validate.js"></script>

    <script type="text/javascript" src="<?php echo base_url().'../' ?>org/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'../' ?>org/ueditor/ueditor.all.min.js"></script>
	<script type="text/javascript">
		window.UEDITOR_HOME_URL = "<?php echo base_url() ?>org/ueditor/";
		window.onload = function(){
			window.UEDITOR_CONFIG.initialFrameWidth = 900;
			window.UEDITOR_CONFIG.initialFrameHeight = 400;
			UE.getEditor('content', {autoHeightEnabled: false});
        }
	</script>
    <style>
     table.table1 tr th{
     	text-align: center;
     	vertical-align: top;
     }
    </style>
<body>
	<div class="wrap">
	   <div class="menu_list">
	    <ul>
		  <li><a href="<?php echo site_url('article/art_show/'.$art['cid']).'/?ace='.rand(100000,999999); ?>"> 内容列表 </a></li>
		  <li><a href="javascript:;" class='action'>新增</a></li> 
		</ul> 
	   </div>
	   <form action="<?php echo site_url('article/art_edit/'.$art['aid']); ?>" method="post" enctype="multipart/form-data">
		   	<table class="table1 hd-form">
<!-- 所属栏目 -->
		   	 <tr>
		   	    <th class='w100'>所属栏目</th>
		   		<td>
		   		<select name="cid" class="w300">
		   		    <option value="0">其他</option>
		   		    <?php foreach ($category as $k => $v): ?>
		   		    	<option value="<?php echo $v['cid'] ?>" <?php if($art['cid'] == $v['cid']): ?>selected='selected' <?php endif; ?>>
		   		    	   <?php echo $v['html'].'|--'.$v['catname'] ?>
		   		    	</option>
		   		    <?php endforeach ?>
		   		</select>
		   		</td>
		   	 </tr>
		   	  <tr>
		   	    <th class='w100'>标题</th>
		   		<td>
		   		   <input type="text" name="title" value="<?php echo $art['title'] ?>" style="width:286px;"/>
		   		</td>
		   	 </tr>
		   	   <tr>
		   	     <th class='w100'>SEO-描述</th>
		   	 	<td>
		   	 	   <input type="text" name="seo_title" value="<?php echo $art['seo_title'] ?>" style="width:286px;"/>
		   	 	</td>
		   	  </tr>
		   	 <tr>
		   	    <th class='w100'>概要</th>
		   		<td>
		   			<textarea name="desc" id= ""cols="45" rows="8"><?php echo $art['desc'] ?></textarea>
		   		</td>
		   	 </tr>  

	 		   	 <tr>
	 		   	    <th class='w60'>图片</th>
	 		   	    <td>
	                     <!-- 上传图片插件 -->
	 		   	 	    <div class = 'ad_upload_input'>
	 		   	 	      	<input id="catimage" type="text" name="image" readonly onmouseover='view_image(this)' src='<?php echo base_url()."../uploads/article/".$art['image'] ?>' value="<?php echo $art['image'] ?>" style="width:286px;opacity:0.5" nctype="file_21">
	 		   	 	    </div>
	 	 	            <div class="ncsc-upload-btn dx_upload_btn">		   	 	           
	 	 	              <a href="javascript:void(0);">
	 	 	                <span>
	 	 	                   <input type="file" hidefocus="true" size="1" class="input-file" name="file_21" id="file_21">
	 	 	                </span>
	 	 	                <p><i class="icon-upload-alt"></i>上传</p>
	 	 	              </a>   
	 	 	            </div>   
	 	 	            <input type="button" nctype="del" class="ad_upload_del btn2" value="移除"/>  

	 		   	    </td>
	 		   	  </tr>

	   	    <tr>
			  <th>内容</th>
			  <td>
				<textarea name="content" id="content" style="width:900px;height:400px;"><?php echo $art['content'] ?></textarea>
			  </td>
		    </tr>  

		  	<tr>
		   	    <th class='w100'>新窗口打开</th>
		   		<td>
		   		<?php if(intval($art['new_window']) == 0): ?>
		   			<input type="radio" id="radio-1" name="new_window" checked='true' value="0">
		   			<label for="radio-1">否</label>
		   			<input type="radio" id="radio-2" name="new_window" value="1">
		   			<label for="radio-2">是</label>
		   		<?php else: ?>
		   			<input type="radio" id="radio-1" name="new_window" value="0">
		   			<label for="radio-1">否</label>
		   			<input type="radio" id="radio-2" name="new_window" checked='true'  value="1">
		   			<label for="radio-2">是</label>
		   		<?php endif; ?>
		   		</td>
	   	    </tr> 
			<tr>
		   	    <th class='w100'>排序</th>
		   		<td>
		   			<input type="text" name="sort" style='width:150px;' value="<?php echo $art['sort'] ?>" />
		   		</td>
		   	</tr> 
			<tr>
				<th>时间</th>
				<td>
	                <script src='./js/cal/lhgcalendar.min.js'></script>
	                <input type="text" readonly="readonly" id="updatetime" name="addtime"
	                  value="<?php echo date('Y/m/d h:i:s',$art['addtime']); ?>"
	                  class="w150"/>
	                <script>
	                  $('#updatetime').calendar({format: 'yyyy/MM/dd HH:mm:ss'});
	                </script>
				</td>
			</tr> 

		   	 <tr>
		   	    <th class='w100' style="text-indent:-9999px;">操作</th>
		   		<td>
		   		    <input type="submit" class="btn1" value=" 确定提交 "/>
		   		</td>
		   	 </tr>
           </table>
	   </form>  
	</div>
	<script src="<?php echo base_url();?>../org/ajaxfileupload/ajaxfileupload.js" ></script>
	<script>
	var target_url = "<?php echo site_url('article/art_img_upload'); ?>";
	var delete_url = "<?php echo site_url('article/art_img_del'); ?>";
		$(function(){
		  $("form").validate({
		    title: {
		      rule: {
		        required: true
		    },
		    error: {
		       required: " 标题不能为空! "
		    },
		    message: " 请填写标题",
		    success: "正确"
		   },
		   seo_title:{
		   	message:"用于搜索引擎优化，可为空"
		   },
		    desc: {
		      rule: {
		        required: true
		    },
		    error: {
		       required: " 概要不能为空! "
		    },
		    message: " 请填写概要内容",
		    success: "正确"
		   },
		   sort: {
		      rule: {
		        required: true
		    },
		    error: {
		       required: " 排序不能为空! "
		    },
		    message: " 请输入排序!,默认255,数字越小,优先级越高",
		    success: "正确"
		   }
		 })   
		});
	</script>
</body>
</html>