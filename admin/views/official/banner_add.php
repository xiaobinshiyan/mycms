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
	    	<li><a href="<?php echo site_url('banner/index') ?>">banner管理</a></li> 
	    	<li><a class="action" href="javascript:;">添加Banner</a></li>
		</ul> 
	   </div>
	   <form onsubmit="return hd_submit(this,'<?php echo site_url('banner/add') ?>','<?php echo site_url('banner/index') ?>')">
			<table class="table1 hd-form">
		   	  <tr>
		   	    <th class='w100'>Title</th>
		   		<td>
		   		   <input type="text" name="btitle" value="" style="width:286px;"/>
		   		</td>
		   	 </tr>
		   	   <tr>
		   	     <th class='w100'>链接地址</th>
		   	 	<td>
		   	 	  <input type="text" name="burl" value="<?php echo $v['site_domain'] ?>" style="width:286px;"/>
		   	 	</td>
		   	  </tr> 
				<tr>
 		   	   	<th class='w100'>banner图片</th>
 		   	   	<td>
 		   	   	    <img src="./img/upload_pic.png" class="hd-h110" id="thumbImg">
 		   	   	    <input type="hidden" name="bimg" value="" class="w300" readonly=""> 
 		   	   	    <button class="hd-btn hd-btn-sm" onclick="UploadThumb(1,&quot;bimg&quot;)" type="button">上传图片</button>&nbsp;&nbsp;
 		   	   	    <button class="hd-btn hd-btn-sm" onclick="removeThumb(&quot;bimg&quot;)" type="button">移除图片</button>
 		   	   	    <span id="hd_image" class="validate-message" style="display: inline-block;"> </span>                    
 		   	   	</td>
 		   	   </tr>
			  	<tr>
			   	    <th class='w100'>状态</th>
			   		<td>
				   		<input type="radio" id="radio-1" name="status" checked='true' value="1">
			   			<label for="radio-1">正常</label>
			   			<input type="radio" id="radio-2" name="status" value="0">
			   			<label for="radio-2">关闭</label>	   	    	
			   		</td>
		   	    </tr>
		   	    <tr>
		   	    	<th>排序</th>
   	    	   		<td>
   	    	   			<input type="text" name="sort" value="255" style="width:286px;"/>  	    	
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

	<script>
		$(function(){
		  $("form").validate({
		    btitle: {
		   		 message: " banner_title"
		   	},
		   	burl:{
		   		message:"输入网站网址,如：http://www.kskdl.com，如果为空 填写:#"
		   	},
		    image: {
		    	message: " 请上传图片"
		   }
		 })   
		});
	</script>
</body>
</html>