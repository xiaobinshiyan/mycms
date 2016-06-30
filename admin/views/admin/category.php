<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>栏目列表</title>
	    <base href="<?php echo base_url().'views/style/'; ?>" />
		<link href="./css/media.css" rel="stylesheet">
        <link href="./css/index.css" rel="stylesheet">
        <script src="./js/jquery-1.8.2.min.js"></script>
        <script src="./js/myconfirm.js"></script>
        <script src="./js/menu.js"></script>
        <script src="./js/media.js"></script>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li>
                <a href='javascript:;' class="action">
                    栏目列表
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('welcome/category_add'); ?>">
                    添加顶级栏目
                </a>
            </li>
        </ul>
    </div>
    <table class="table2 hd-form">
        <thead>
        <tr>
            <td class="w30">CID</td>

            <td>栏目名称</td>
            <td class="w180">状态</td>
            <td class="w180">操作</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($category as $v): ?>

            <tr <?php if($v['pid'] == 0){?>class="top"<?php }?>>
            <td><?php echo $v['cid']; ?></td>

            <td>
                <?php if($v['pid'] ==0):?>
                    <img src="<?php echo base_url().'views/style/'; ?>img/contract.gif" action="2" class="explodeCategory"/>
                <?php endif; ?>
               <?php if($v['pid'] == 0):?><strong><?php echo $v['catname'] ?></strong><?php else: ?><?php echo $v['html'].'|--'.$v['catname'] ?> <?php endif; ?>
            </td>
            <td>
                    <?php if($v['status']):?>
                <a title="编辑显示状态" href="javascript:;" onclick = "status_edit(1,<?php echo $v['cid']; ?>,'<?php echo site_url('welcome/category_status') ?>')">正常</a>
                    <?php else: ?>
                <a title="编辑显示状态" href="javascript:;" onclick = "status_edit(0,<?php echo $v['cid']; ?>,'<?php echo site_url('welcome/category_status') ?>')">屏蔽</a>
                     <?php endif;?>
            </td>
            <td>
            <span class="line">|</span>
                <a href="<?php echo site_url('welcome/category_add/'.$v['cid']); ?>">
                    添加子栏目
                </a>
                <span class="line">|</span>
                <a href="<?php echo site_url('welcome/category_edit/'.$v['cid']); ?>">
                    修改
                </a>
            <span class="line">|</span>
               <a href="javascript:;" onclick="obj_del(<?php echo $v['cid']; ?>,'<?php echo site_url('welcome/category_del') ?>')">删除</a>
            </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="h60"></div>
</div>
<script>
$(".explodeCategory").click(function(){
	var action=parseInt($(this).attr("action"));
	var tr= $(this).parents('tr').eq(0);
	switch(action){
		case 1://展示
			$(tr).nextUntil('.top').show();
			$(this).attr('action',2);
			$(this).attr('src',"<?php echo base_url().'views/style/'; ?>img/contract.gif");
			break;
		case 2://收缩
			$(tr).nextUntil('.top').hide();
			$(this).attr('action',1);
			$(this).attr('src',"<?php echo base_url().'views/style/'; ?>img/explode.gif");
		break;
	}
})
</script>
</body>
</html>
