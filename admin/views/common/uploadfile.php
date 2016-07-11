<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>大朋后台管理系统</title>
    <base href="<?php echo base_url().'views/style/'; ?>" />
    <script type="text/javascript" src="./js/jquery-1.8.2.min.js"></script>
    <link rel="stylesheet" href="./hdjs/hdjs.css"/>
    <script type="text/javascript" src="./hdjs/hdjs.min.js"></script>
    <script>
        var name = "<?php echo $name; ?>";
        $(function () {
            $(".imagelist ul li").live('click', function () {
                var type = "image";
                switch (type) {
                    case 'image':
                        image(this);
                        break;
                }
            })
        })
        /**
         * 单图上传
         * @param obj
         */
        function image(obj) 
        {
            var url = $(obj).attr('url');
            $(parent.document).find('input[name="'+name+'"]').val(url)
            $(parent.document).find('input[name="'+name+'"]').prev('img').attr('src', url);
            parent.hd_modal_close();
        }
    </script>
    <script type='text/javascript'>
    $(document).ready(function() {
        var Qiniu_UploadUrl = "http://up.qiniu.com";
        $("#file").change(function() {
            //普通上传
            var Qiniu_upload = function(f, token, key) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', Qiniu_UploadUrl, true);
                var formData, startDate;
                formData = new FormData();
                if (key !== null && key !== undefined) formData.append('key', key);
                formData.append('token', token);
                formData.append('file', f);
                var taking;
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var nowDate = new Date().getTime();
                        taking = nowDate - startDate;
                        var x = (evt.loaded) / 1024;
                        var y = taking / 1000;
                        var uploadSpeed = (x / y);
                        var formatSpeed;
                        if (uploadSpeed > 1024) {
                            formatSpeed = (uploadSpeed / 1024).toFixed(2) + "Mb\/s";
                        } else {
                            formatSpeed = uploadSpeed.toFixed(2) + "Kb\/s";
                        }
                    }
                }, false);
     
                xhr.onreadystatechange = function(response) {
                    if (xhr.readyState == 4 && xhr.status == 200 && xhr.responseText != "") 
                    {
                        var blkRet = JSON.parse(xhr.responseText);
                        var imageUrl = "<?php echo $url;?>"+blkRet.key;
                        var li="<li url='"+imageUrl+"'><img src='"+imageUrl+"' class='hd-w80'/></li>";
                        $("#uploadList ul").prepend(li);

                    } 
                    else if (xhr.status != 200 && xhr.responseText) 
                    {
                        console && console.log('error');
                    }
                };
                startDate = new Date().getTime();
                $("#progressbar").show();
                xhr.send(formData);
            };



            var token = $("#token").val();
            if ($("#file")[0].files.length > 0 && token != "") 
            {
                Qiniu_upload($("#file")[0].files[0], token, $("#key").val());
            } 
            else 
            {
                console && console.log("form input error");
            }
        })
    })
    //]]>  
    </script>
    <style>
        .btn1 {
            background: #4BAED4;
            border: none;
            color: #FFFFFF;
            cursor: pointer;
            font-size: 12px;
            height: 25px;
            overflow: hidden;
            box-shadow: none;
            vertical-align: middle;
            padding: 0px 10px 0px;
            display: inline-block;
            text-align: center;
            text-indent: 0px;
            line-height: 2em;
            margin-right: 10px;
            box-shadow: none !important;
        }
        .hd-validate-notice {
            text-indent: 22px;
            display: inline-block;
            color: #666;
            margin-left: 5px;
            /*background: url("ico.png") no-repeat 0px -200px;*/
        }
        .imagelist ul li{
            float:left;
            margin:5px;
            border:solid 2px #dcdcdc;
            width:80px;
            height: 80px;
            overflow: hidden;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="hd-tab">
    <ul class="hd-tab-menu">
        <li lab="uploadFile" class="active">
            <a>上传文件</a>
        </li>
    </ul>
    <div class="hd-tab-content">
        <div lab="uploadFile" class="hd-tab-area">
            <input id="token" name="token" class="ipt" type="hidden" value="<?php echo $uptoken; ?>">
            <input class="hd-btn" id="file" name="file"  type="file">
            <span class="hd-validate-notice">类型: .jpg,.png 大小: 2000KB 数量: 1</span>
            <div id="uploadList" class="imagelist">
                <ul>

                </ul>
            </div>
        </div>
<!--         <div>
        <ul>
            <li>
                <input class="btn1" id="btn_upload" type="button" value="提交">
            </li>
        </ul>    
        </div> -->

        <div lab="webFile" id="webFile" class="imagelist hd-tab-area">

        </div>
        <div lab="noUse" id="noUse" class="imagelist  hd-tab-area">

        </div>
    </div>
</div>

</body>
</html>