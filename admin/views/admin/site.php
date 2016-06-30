<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>柏荟会VIP</title>
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
			window.UEDITOR_CONFIG.initialFrameWidth = 800;
			window.UEDITOR_CONFIG.initialFrameHeight = 300;
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
		  <li><a href="javascript:;" class='action'>网站设置</a></li> 
		</ul> 
	   </div>
	   <form action="<?php echo site_url('welcome/site'); ?>" method="post" enctype="multipart/form-data">
	   <?php foreach ($site as $v): ?>
			   	<table class="table1 hd-form">
		   	  <tr>
		   	    <th class='w100'>网站名称</th>
		   		<td>
		   		   <input type="text" name="site_name" value="<?php echo $v['site_name'] ?>" style="width:286px;"/>
		   		</td>
		   	 </tr>
		   	   <tr>
		   	     <th class='w100'>网站网址</th>
		   	 	<td>
		   	 	  <input type="text" name="site_domain" value="<?php echo $v['site_domain'] ?>" style="width:286px;"/>
		   	 	</td>
		   	  </tr> 

 		   	   <tr>
 		   	    <th class='w60'>网站logo</th>
 		   	    <td>
                     <!-- 上传图片插件 -->
 		   	 	    <div class = 'ad_upload_input'>
 		   	 	      	<input id="catimage" type="text" name="image" readonly onmouseover='view_image(this)' src='<?php echo base_url()."../uploads/common/".$v['site_logo'] ?>' value="<?php echo $v['site_logo'] ?>" style="width:286px;opacity:0.5" nctype="file_21">
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
 		   	     	    <th class='w100'>站点关键字</th>
 		   	     		<td>
 		   	     			<input type="text" name="seo_keyword" style='width:286px;' value="<?php echo $v['seo_keyword'] ?>" />
 		   	     		</td>
 		   	     	</tr> 
 		   	   <tr>
 		   	      <th class='w100'>站点描述</th>
 		   	  	<td>
 		   	  		<textarea name="seo_description" id= ""cols="45" rows="8"><?php echo $v['seo_description'] ?></textarea>
 		   	  	</td>
 		   	   </tr>  

		  	<tr>
		   	    <th class='w100'>站点状态</th>
		   		<td>
		   	    <?php if ($v['status']): ?>
			   		<input type="radio" id="radio-1" name="status" checked='true' value="1">
		   			<label for="radio-1">正常</label>
		   			<input type="radio" id="radio-2" name="status" value="0">
		   			<label for="radio-2">关闭</label>	   	    	
		   	    <?php else: ?>
    		   		<input type="radio" id="radio-1" name="status" value="1">
    	   			<label for="radio-1">正常</label>
    	   			<input type="radio" id="radio-2" name="status" checked='true' value="0">
    	   			<label for="radio-2">关闭</label>	
		   	    <?php endif ?>
		   		</td>
	   	    </tr> 
       	    <tr>
    		  <th>关闭原因</th>
    		  <td>
    			<textarea name="close_reason" id="content" style="width:900px;height:400px;"><?php echo $v['close_reason'] ?></textarea>
    		  </td>
    	    </tr> 

		   	 <tr>
		   	    <th class='w100' style="text-indent:-9999px;">操作</th>
		   		<td>
		   		    <input type="hidden" name="id" value="<?php echo $v['id'] ?>" style="width:286px;"/>
		   		    <input type="submit" class="btn1" value=" 确定提交 "/>
		   		</td>
		   	 </tr>
           </table>   	
	   <?php endforeach ?>

	   </form>  
	</div>
	<script src="<?php echo base_url();?>../org/ajaxfileupload/ajaxfileupload.js" ></script>
	<script>
	var target_url = "<?php echo site_url('welcome/site_img_upload'); ?>";
	var delete_url = "<?php echo site_url('welcome/site_img_del'); ?>";
		$(function(){
		  $("form").validate({
		    site_name: {
		      rule: {
		        required: true
		    },
		    error: {
		       required: " 网站名称不能为空! "
		    },
		    message: " 请填写网站名称",
		    success: "正确"
		   },
		   site_domain:{
		   	message:"输入网站网址,如：http://www.kskdl.com"
		   },
		    image: {
		      rule: {
		        required: true
		    },
		    error: {
		       required: " 网站logo不能为空! "
		    },
		    message: " 上传网站logo图片",
		    success: "正确"
		   },
		   seo_keyword: {
		    message: " 用于SEO,网站关键字"
		   },
		   seo_description: {
		    message: "用于SEO，网站描述"
		   }
		 })   
		});
	</script>
</body>
</html>