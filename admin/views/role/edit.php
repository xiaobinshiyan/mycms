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
              <li><a href="<?php echo site_url('role/index') ?>">角色列表</a></li>
              <li><a class="action" href="javascript:;">编辑</a></li>
          </ul>
      </div>
    <form onsubmit="return hd_submit(this,'<?php echo site_url('role/edit/'.$info['rid']) ?>','<?php echo site_url('role/index') ?>')">
        <table class="hd-table hd-table-form hd-form">
            <tr>
                <th class="hd-w100">角色名称</th>
                <td>
                    <input type="text" name="rname" class="hd-w200" value="<?php echo $info['rname'] ?>"/>
                </td>
            </tr>
            <tr>
                <th class="hd-w100">角色描述</th>
                <td>
                    <textarea name="title" class="hd-w300 hd-h100">
                        <?php echo $info['title'] ?>
                    </textarea>
                </td>
            </tr>
        </table>
            <input type="submit" class="hd-btn" value="确定"/>
    </form>
    </div>
</body>
</html>