<style>
    .contact-us img
    {
        vertical-align: middle;
        width: 16px;
        height: 16px;
    }
</style>
<div class="contact-us">
    <h1>ติดต่อเรา</h1>
    <form class="contact-form">
        <?php if($is_logged_in == FALSE):?>
        <div class="form-item form-item-name"><label class="label">ชื่อ</label><div><input name="name" type="text"/></div></div>
        <div class="form-item form-item-email"><label class="label">อีเมล์</label><div><input name="email" type="text"/></div></div>
        <div class="form-item form-item-tel"><label class="label">โทร.</label><div><input name="tel" type="text"/></div></div>
        <?php endif;?>
        <div class="form-item form-item-msg"><label class="label">ข้อความ</label><div><textarea name="msg"></textarea></div></div>
        <div class="form-item form-item-send-btn"><span class="send-btn ui-corner-all button">ส่งข้อความ</span></div>
    </form>

    <h1>ช่องทางอื่นๆ</h1>
    <div><img src="<?php echo base_url();?>images/icons/mobile.png"/>: 0123456789</div>
    <div><img src="<?php echo base_url();?>images/icons/email.png"/>: a@a.com</div>
    <div><img src="<?php echo base_url();?>images/icons/facebook.png"/>: <a href="http://www.facebook.com/page" target="_blank">http://www.facebook.com/page</a></div>
    <div><img src="<?php echo base_url();?>images/icons/line.png"/>: ___aaa</div>
</div>
<script type="text/javascript">
    $('.contact-us .send-btn').click(function(){
        if(form_valid('.contact-us .contact-form'), {
            'name': { required: true },
            'email': { required: true, email: true },
            'tel': { required: true, digits: true, minlength: 9 },
            'msg' : {required: true}
        })
        {
            $('.contact-us').parent().waiting();
            $.post('<?php echo base_url();?>index.php/others/contact_us_submit', 
                $('.contact-us .contact-form').serialize(), 
                function(data){
                    if(data == 'ok')
                    {
                        notify('succcess','ส่งข้อความ', 'บันทึกข้อความที่ส่งเรียบร้อยค่ะ');
                    }    
                    else
                    {
                        notify('error', 'ส่งข้อความไม่สำเร็จ', data);
                    }
                    $('.contact-us').parent().waiting('done');
                }
                );
        }
    });
    themeButton('.contact-us');
</script>