<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>修改密码</title>
</head>
    <link href="<?php echo base_url().'views/style/'; ?>css/media.css" rel="stylesheet">
    <script src="<?php echo base_url().'views/style/'; ?>js/jquery-1.8.2.min.js"></script>
    <script src="<?php echo base_url().'views/style/'; ?>js/media.js"></script>
    <script src="<?php echo base_url().'views/style/'; ?>js/validate.js"></script>
<body>
	<div class="wrap">
	<div class="title-header"> 密码修改 </div>
    <form method="post" action="<?php echo site_url('welcome/change_pass'); ?>" >
		<table class="table1 hd-form"> 
			<tbody>
				<tr>
					<td class="w50">
						管理员
					</td>
					<td>
						<?php echo $_SESSION['username'] ?>
					</td>
				</tr>
				<tr>
					<td class="w50">
						原密码
					</td>
					<td>
						<input type="password" name="oldPwd" />
					</td>
				</tr>
				<tr>
					<td class="w50">
						新密码
					</td>
					<td>
						<input type="password" name="newPwd" />
					</td>
				</tr>
				<tr>
					<td class="w50">
						重复密码
					</td>
					<td>
						<input type="password" name="re_newPwd" />
					</td>
				</tr>
				<tr>
					<td class="w50">
					</td>
					<td>
						<input type="submit" value=" 确定 " class="btn1"/> 
					</td>
				</tr>				
			</tbody>
		</table>
	</form>
	</div>
<script>
	$(function () {
		$("form").validate({  
		// 验证规则  
		oldPwd: {  
			rule: {  
			  required: true,  
		      ajax: "<?php echo site_url('welcome/check_password'); ?>"  
	        },
           error: {
              required: " 原密码不能为空 ",
              ajax: " 原密码输入错误 "
              },
            message: " 输入原密码 ",
            success: '输入正确'
          },
          newPwd: {
            rule: {
              required: true
            },
            error:{
            	required: '新密码不能为空'
            },
            message: '输入新密码',
            success: '输入正确'
          },
          re_newPwd: {
              rule: {
                confirm: "newPwd"
            },
            error: {
                confirm: " 确认密码输入错误 "
             },
             message: '重复输入新密码',
             success: '输入正确'
           }
        })
	})
</script>
</body>
</html>