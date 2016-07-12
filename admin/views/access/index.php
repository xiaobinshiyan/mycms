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
	          <li><a href="<?php echo site_url('role/index') ?>">角色列表 </a></li>
	          <li><a class="action" href="javascript:;">设置权限</a></li>
	      </ul>
	  </div>
		<form class="hd-form" onsubmit="return hd_submit(this,'<?php echo site_url('access/edit') ?>','<?php echo site_url('role/index') ?>')">
		    <input type="hidden" name="rid" value="<?php echo $rid; ?>"/>
		    <div class="access">
		        <ul>
		            <?php foreach ($access as $k => $v): ?>
		            	<li class="li1">
		            	    <h3> <?php echo $v['checkbox'] ?></h3>
		            	    <?php if ($v['_data']): ?>
		            	        <ul class="level2">

		            	        <?php foreach ($v['_data'] as $b): ?>
		 		            	        <li class="li2">
		            	                    <h4> <?php echo $b['checkbox'] ?></h4>
		            	                    <?php if ($b['_data']): ?>
		            	                        <ul class="level3">
		            	                            <?php foreach ($b['_data'] as $c): ?>
			            	                            <li>
			            	                                <?php echo $c['checkbox'] ?>
			            	                            </li>	
		            	                            <?php endforeach ?>
		            	                        </ul>
		            	                    <?php endif; ?>
		            	                </li>           	        	
		            	        <?php endforeach ?>
		            	        </ul>
		            	    <?php endif; ?>
		            	</li>
		            <?php endforeach ?>
		        </ul>
		    </div>
		    <input type="submit" class="hd-btn" value="确定"/>
		</form>
	</div>
	<style type="text/css">
	    h3, h4, li, label {
	        font-size: 12px;
	        vertical-align: middle;
	    }

	    h3 {
	        margin-bottom: 0px;
	        margin-top: 10px;
	        background: #E6E6E6;
	        padding: 8px;
	    }

	    ul .level2 {
	        height: auto;
	        overflow: hidden;
	    }

	    ul .level2 li.li2 {
	        padding: 5px 10px 5px 5px;
	        height: auto;
	        overflow: hidden;
	        clear: both;
	        border-bottom: solid 1px #dcdcdc;
	        margin: 5px;
	    }

	    ul .level3 {
	        clear: both;
	        height: auto;
	        overflow: hidden;
	    }

	    ul .level3 li {
	        float: left !important;
	        display: inline-block;
	        padding: 10px 10px 5px 0px;
	        margin-right: 10px;
	        border: 0;
	    }

	    ul .level3 li:first-child {
	        border: none;
	    }
	</style>
	<script>
	    //复选框选后，将子集checked选中
	    $("input").click(function () {
	        var _obj = $(this);
	        //将所有子节点选中
	        $(this).parents("li").eq(0).find("input").not($(this)).each(function (i) {
	            $(this).attr("checked", _obj.attr("checked") == "checked");
	        });
	        //将父级NID选中
	        if ($(this).attr("checked")) {
	            $(this).parents("li").each(function (i) {
	                $(this).children("label,h3,h4").find("input").attr("checked", "checked");
	            })
	        }
	    })
	</script>
</body>
</html>