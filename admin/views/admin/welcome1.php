<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>网站概要</title>
</head>
<base href="<?php echo base_url().'views/style/'; ?>" />
<link rel="stylesheet" href="./css/media.css" />
<body>
 <div class="wrap">
        <div class="title-header">
            系统信息
        </div>
        <table class="table2">
            <tbody>
                <tr>
                    <td class="w100">系统:</td>
                    <td><?php echo $this->agent->platform(); ?></td>
                </tr>
                <tr>
                    <td class="w100">运行环境:</td>
                    <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
                </tr>
                <tr>
                    <td class="w100">数据库:</td>
                    <td><?php echo $this->db->version(); ?></td>
                </tr>
                <tr>
                    <td class="w100">允许上传大小:</td>
                    <td><?php echo ini_get("upload_max_filesize"); ?></td>
                </tr>
                <tr>
                    <td class="w100">核心框架:</td>
                    <td>CodeIgniter</td>
                </tr>
                <tr>
                    <td class="w100">当前时间:</td>
                    <td><?php echo date('Y-m-d h:i:s',time()); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>