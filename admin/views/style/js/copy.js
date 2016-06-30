$(function (){
    $('.dx_upload_btn').find('input[type="file"]').live('change', function(){
        var id = $(this).attr('id');
        ajaxFileUpload(id);
    });

    //图片删除
    $('input[nctype="del"]').click(function(){
        var obj = $(this);
        img_name = obj.siblings('div.ad_upload_input').find('input').val();
        if(img_name =='')
        {
            return false;
        }
        $.ajax({
            type : "POST",
            url : delete_url,
            cache : false,
            data : {name : img_name},
            timeout : 10000,
            success : function(data) {
            if(data == 1)
            {
               obj.siblings('div.ad_upload_input').find('input').val('');
               obj.siblings('div.ad_upload_input').find('input').attr('src','');   
            }
          }
        })

    });
})

    //上传图片方法
    function ajaxFileUpload(id, o) 
    {
        $.ajaxFileUpload({
            url : target_url,
            secureuri : false,
            fileElementId : id,
            dataType : 'json',
            data : {name : id},
            success : function (data, status) 
            {
                if (typeof(data.error) != 'undefined') 
                {
                    $('input[nctype="' + id + '"]').attr('src','./img/loading.gif');
                } 
                else 
                {
                    $('input[nctype="' + id + '"]').val(data.name);
                    $('input[nctype="' + id + '"]').attr('src',data.src_name);
                }
            }
        });
        return false;

    }
    //预览单张图片
    function view_image(obj) 
    {
        var src = $(obj).attr('src');
        if (!src)return;
        var id = $(obj).attr('id');
        var viewImg = $('#view_' + id);
        //删除预览图
        if (viewImg.length >= 1) 
        {
            viewImg.remove();
        }
        //鼠标移除时删除预览图
        $(obj).mouseout(function () {
            $('#view_' + id).remove();
        })
        if (src) 
        {
            var offset = $(obj).offset();
            var _left = 205 + offset.left + "px";
            var _top = offset.top - 74 + "px";
            var html = '<img src="' + src + '" style="border:solid 3px #dcdcdc;position:absolute;z-index:1000;height:100px;left:' + _left + ';top:' + _top + ';" id="view_' + id + '"/>';
            $('body').append(html);
        }
    }