<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>列表</title>
</head>
    <base href="<?php echo base_url().'views/style/'; ?>" />
    <link href="./css/media.css" rel="stylesheet">
    <script src="./js/jquery-1.8.2.min.js"></script>
    <script src="./js/myconfirm.js"></script>
    <script src="./js/media.js"></script>
    <script src="./js/validate.js"></script>
    <style>
     table.table1 tr th{
     	text-align: center;
     }
    </style>
<body>
	<div class="wrap">
	   <div class="menu_list">
	    <ul>
		  <li><a href="javascript:void(0);" class='action'> 内容列表 </a></li>
		  <li><a href="<?php echo site_url('article/art_add').'/'.$cid."/?ace =".rand(10,10000000);?>" >新增</a></li> 
         <!-- 文章内容搜索 -->
		  <li>
		  	<div class='hd-form' style='margin-left:800px'>
		  		<form action="<?php echo site_url('article/art_search')?>" method="get" accept-charset="utf-8">
		  			文章标题 ：<input type='text' name='pname'>
		  			<input class='btn1' type='hidden' name='acid' value='<?php echo $cid;?>'>	
		  			<input class='btn1' type='submit' value='查找'>	
		  		</form>
		  	</div>
		  </li>

		</ul> 
	   </div>
	   	<table class="table2 hd-form form-inline">
	   	<thead>
	   	  <tr>
	   	    <td class='w50'>ID</td>
	   		<td class=''>名称</td>
	   		<td class="w150">时间</td>
	   		<td class="w100">状态</td>
	   		<td class='w200'>操作</td>
	   	 </tr>	   		
	   	</thead>
        <tbody>
        <?php foreach($arts as $v): ?>
         <tr>
	   		<td><?php echo $v['aid'];?></td>
	   	    <td><?php echo $v['title'];?></td>
	   	    <td><?php echo date('Y-m-d H:i',$v['addtime']) ?></td>
       	    <td>
       	    	<?php if($v['status']):?>
    			<a title="编辑显示状态" href="javascript:;" onclick = "status_edit(1,<?php echo $v['aid']; ?>,'<?php echo site_url('article/art_status') ?>')">正常</a>
       	    	<?php else: ?>
    			<a title="编辑显示状态" href="javascript:;" onclick = "status_edit(0,<?php echo $v['aid']; ?>,'<?php echo site_url('article/art_status') ?>')">屏蔽</a>
       	         <?php endif;?>
       	    </td>
	   		<td>
	   		    <a class='btn1' href="<?php echo site_url('article/art_edit/'.$v['aid'])."/?ace =".rand(10,10000000);?>">编辑</a>
	   			<a class='btn2' href="javascript:;" onclick="obj_del(<?php echo $v['aid']; ?>,'<?php echo site_url('article/art_del') ?>')">删除</a>
	   		</td>         	
         </tr>
         <?php  endforeach;?>
         </tbody>
	   </table>

	   <div class="page">
	   	 <?php echo $links ?>
	   </div>
	</div>
</body>
</html>