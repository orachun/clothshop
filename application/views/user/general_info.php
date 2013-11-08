<style>
    .general-info .label
    {
        display: inline-block;
        width: 200px;
    }
    .general-info .form-item-addr textarea
    {
        width: 300px;
        height: 100px;
    }
    .general-info .form-item
    {
        margin: 5px 0px;
    }
    .general-info .form-item div
    {
        display: inline-block;
    }
</style>

<div class="general-info">
    <form class="user-info-form">
        <div class="form-item form-item-email">
            <label class="label">อีเมล์</label><?php echo $email;?>
        </div>
        <div class="form-item form-item-name">
            <label class="label">ชื่อ-สกุล</label>
            <div>
                <input class="ui-corner-all" name="fullname" type="text" value="<?php echo $fullname;?>"/>
            </div>
        </div>
        <div class="form-item form-item-addr">
            <label class="label">ที่อยู่-รหัสไปรษณีย์<br/>สำหรับจัดส่งสินค้า</label>
            <div><textarea class="ui-corner-all" name="addr"><?php echo $addr;?></textarea></div>
        </div>
        <div class="form-item form-item-tel">
            <label class="label">หมายเลขโทรศัพท์<br/>ที่ติดต่อสะดวก</label>
            <div><input class="ui-corner-all" name="tel" type="text" value="<?php echo $tel;?>"/></div>
        </div>
        <span class="button submit-btn ui-corner-all">บันทึกข้อมูล</span>
    </form>

    <form class="change-password-form">
        <div class="form-item form-item-old-pass">
            <label class="label">รหัสผ่านเดิม</label><input class="ui-corner-all" name="old_pass" type="password" />
        </div>
        <div class="form-item form-item-old-pass">
            <label class="label">รหัสผ่านใหม่</label><input class="ui-corner-all" name="new_pass" type="password" />
        </div>
        <div class="form-item form-item-old-pass">
            <label class="label">ยืนยันรหัสผ่านใหม่</label><input class="ui-corner-all" name="new_pass_confirm" type="password" />
        </div>
        <span class="button submit-btn ui-corner-all">แก้ไขรหัสผ่าน</span>
    </form>
</div>
<script type="text/javascript">
$(function(){
    
    $('.general-info .user-info-form .submit-btn').click(function(){
        if(form_valid('.general-info .user-info-form', {
            fullname: { required: true},
            addr: { required: true},
            tel: {required: true, digits: true, minlength: 9}
        }))
        {
            $('.general-info').waiting({fixed:true});
            $.post(base_url+'index.php/user/edit_info', 
                $('.general-info .user-info-form').serialize(), 
                function(data){
                if(data == 'ok')
                {
                    $('.general-info').parent().load(base_url+'index.php/user/general_info', function(){
                        $('.general-info').waiting('done');
                        notify('success', 'แก้ไขข้อมูล', 'แก้ไขข้อมูลเรียบร้อยค่ะ');
                    });
                }
                else
                {
                    $('.general-info').waiting('done');
                    notify('error', 'แก้ไขข้อมูล', data);
                }
            });
        }
    });
    
    $('.general-info .change-password-form .submit-btn').click(function(){
        if(form_valid('.general-info .change-password-form', {
            old_pass: { required: true},
            new_pass: { required: true, minlength: 4},
            new_pass_confirm: {required: true, equalTo: '.general-info .change-password-form input[name="new_pass"]'}
        }))
        {
            $('.general-info').waiting({fixed:true});
            $.post(base_url+'index.php/user/change_pass', 
                $('.general-info .change-password-form').serialize(), 
                function(data){
                if(data == 'ok')
                {
                    $('.general-info').waiting('done');
                    notify('success', 'แก้ไขรหัสผ่าน', 'แก้ไขรหัสผ่านเรียบร้อยค่ะ');
                }
                else
                {
                    $('.general-info').waiting('done');
                    notify('error', 'แก้ไขรหัสผ่าน', data);
                }
            });
        }
    });
    
    
    themeButton('.general-info');
});
</script>