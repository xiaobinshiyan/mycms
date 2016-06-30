<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>目录-添加</title>
</head>
    <base href="<?php echo base_url().'views/style/'; ?>" />
    <link href="./css/media.css" rel="stylesheet">
    <script src="./js/jquery-1.8.2.min.js"></script>
    <script src="./js/media.js"></script>
    <script src="./js/copy.js"></script>
    <script src="./js/validate.js"></script>
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
		  <li><a href="<?php echo site_url('welcome/category'); ?>"> 栏目列表 </a></li>
		  <li><a href="javascript:;" class='action'>新增</a></li> 
		</ul> 
	   </div>
	   <form action="<?php echo site_url('welcome/category_add'); ?>" method="post">
		   	<table class="table1 hd-form">
		   	  

		   	 <tr>
		   	    <th class='w100'>上级栏目</th>
		   		<td>
		   		<select name="pid" class="w200">
		   		    <option value="0">一级栏目</option>
		   		    <?php foreach ($category as $k => $v): ?>
		   		    	<option value="<?php echo $v['cid'] ?>" <?php if($pid == $v['cid']): ?>selected='selected' <?php endif; ?>>
		   		    	   <?php echo $v['html'].'|--'.$v['catname'] ?>
		   		    	</option>
		   		    <?php endforeach ?>
		   		</select>
		   		</td>
		   	 </tr>

		   	 <tr>
		   	 	<th class="w100">内容模型</th>
		   	 	<td>
		   	 		<input type="radio" name="cattype" value="1" id="article" /><label for="article">普通文章</label>
		   	 		<input type="radio" name="cattype" checked value="2" id="others" /><label for="others">其他</label>
		   	 	</td>
		   	 </tr>

		   	  <tr>
		   	    <th class='w100'>栏目名称</th>
		   		<td>
		   		   <input type="text" name="catname" value="" style="width:185px;"/>
		   		</td>
		   	 </tr>
 
		   	 <tr>
		   	    <th class='w60'>图片</th>
		   	    <td>
                    <!-- 上传图片插件 -->
		   	 	    <div class = 'ad_upload_input'>
		   	 	      	<input id="catimage" type="text" name="image" readonly onmouseover='view_image(this)' src='' value="" style="width:185px;opacity:0.5" nctype="file_21">
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
	   	   	    <th class='w100'>seo-标题</th>
	   	   		<td>
	   	   		   <input type="text" name="seo_title" value="" style="width:318px;"/>
	   	   		</td>
	   	   	 </tr> 	

	         <tr>
		   	    <th class='w100'>seo-描述</th>
	   		    <td>
	   			   <textarea name="seo_description" id= ""cols="50" rows="6"></textarea>
	   		    </td>
		     </tr>

			<tr>
		   	    <th class='w100'>排序</th>
		   		<td>
		   			<input type="text" name="sort" style='width:185px;' value="255" />
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
	var target_url = "<?php echo site_url('welcome/cate_img_upload'); ?>";
	var delete_url = "<?php echo site_url('welcome/cate_img_del'); ?>";
	       $(function(){
	       $("form").validate({
			    catname: {
			      rule: {
			        required: true
			    },
			    error: {
			       required: " 名称不能为空! "
			    },
			    message: " 请填写名称",
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