<link rel='stylesheet' type='text/css' href='class/Qaptcha_v3.0/jquery/QapTcha.jquery.css' media='screen'>
<script type='text/javascript' src='class/Qaptcha_v3.0/jquery/jquery.ui.touch.js'></script>
<script type='text/javascript' src='class/Qaptcha_v3.0/jquery/QapTcha.jquery.js'></script>

<script type='text/javascript'>
    $(document).ready(function(){
        $('.QapTcha').QapTcha({
            disabledSubmit:true ,
            autoRevert:true ,
            PHPfile:'class/Qaptcha_v3.0/php/Qaptcha.jquery.php',
            txtLock:'<{$smarty.const._MD_KWCLUB_TXTLOCK}>' ,
            txtUnlock:'<{$smarty.const._MD_KWCLUB_TXTUNLOCK}>'
            });
    });
</script>

<h2><{$smarty.const._MD_KWCLUB_APPLY_CLASS|sprintf:$class.class_title}></h2>
<p><{$smarty.const._MD_KWCLUB_APPLY_NOTE}></p>


<!--套用formValidator驗證機制-->
<form action="index.php" method="post" id="regForm" enctype="multipart/form-data" class="myForm form-horizontal" role="form">

    <!--報名者姓名-->
    <div class="form-group">
        <!--身分證字號-->
        <label class="col-sm-2 control-label">
            <{$smarty.const._MD_KWCLUB_REG_UID}><span class="caption-required">*</span>
        </label>
        <div class="col-sm-4">
            <input type="text" name="reg_uid" id="reg_uid" class="form-control validate[required]" value="<{$reg_uid}>" placeholder="<{$smarty.const._MD_KWCLUB_KEYIN}><{$smarty.const._MD_KWCLUB_REG_UID}>">
        </div>

        <label class="col-sm-2 control-label">
            <{$smarty.const._MD_KWCLUB_REG_NAME}><span class="caption-required">*</span>
        </label>
        <div class="col-sm-4">
            <input type="text" name="reg_name" id="reg_name" class="form-control validate[required]" value="<{$reg_name}>" placeholder="<{$smarty.const._MD_KWCLUB_KEYIN}><{$smarty.const._MD_KWCLUB_REG_NAME}>">
        </div>
    </div>


    <!--報名者年級-->
    <div class="form-group">
        <label for="reg_grade" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_REG_GRADE}><span class="caption-required">*</span></label>
        <div class="col-sm-10">
            <{foreach from = $class_grade_arr key=v item=gname}>
                <label class="radio-inline">
                    <{if $gname==$smarty.const._MD_KWCLUB_KG}>
                        <input type='radio' name='reg_grade' id="reg_grade<{$v}>" class="validate[required]" title='<{$smarty.const._MD_KWCLUB_KINDERGARTEN}>' value='<{$gname}>' <{if $gname == $reg_grade}>checked="checked"<{/if}>><{$smarty.const._MD_KWCLUB_KINDERGARTEN}>
                    <{else}>
                        <input type='radio' name='reg_grade' id="reg_grade<{$v}>" title='<{$gname}><{$smarty.const._MD_KWCLUB_GRADE}>' value='<{$gname}>' <{if $gname == $reg_grade}>checked="checked"<{/if}>><{$gname}><{$smarty.const._MD_KWCLUB_GRADE}>
                    <{/if}>
                </label>
            <{/foreach}>
        </div>
    </div>

    <!--報名者班級-->
    <div class="form-group">
        <label class="col-sm-2 control-label">
            <{$smarty.const._MD_KWCLUB_REG_CLASS}><span class="caption-required">*</span>
        </label>
        <div class="col-sm-10">
            <{foreach from = $school_class key=v item=cname}>
                <label class="radio-inline">
                    <input type='radio' name='reg_class' id="reg_class<{$v}>" class="validate[required]" title='<{$cname}>' value='<{$cname}>' <{if $cname == $reg_class}>checked="checked"<{/if}>><{$cname}>
                </label>
            <{/foreach}>
        </div>
    </div>

    <!--家長姓名-->
    <div class="form-group">
        <label class="col-sm-2 control-label">
            <{$smarty.const._MD_KWCLUB_REG_PARENT}><span class="caption-required">*</span>
        </label>
        <div class="col-sm-4">
            <input type="text" name="reg_parent" id="reg_parent" class="form-control validate[required]" value="<{$reg_parent}>" placeholder="<{$smarty.const._MD_KWCLUB_KEYIN}><{$smarty.const._MD_KWCLUB_REG_PARENT}>">
        </div>
        <label class="col-sm-2 control-label">
            <{$smarty.const._MD_KWCLUB_REG_TEL}>
        </label>
        <div class="col-sm-4">
            <input type="text" name="reg_tel" id="reg_tel" class="form-control validate[required]" value="<{$reg_tel}>" placeholder="<{$smarty.const._MD_KWCLUB_KEYIN}><{$smarty.const._MD_KWCLUB_REG_TEL}>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            <{$smarty.const._MD_KWCLUB_CAPTCHA}>
        </label>
        <div class="col-sm-10">
            <div class='QapTcha'></div>
        </div>
    </div>



    <div class="text-center">

        <{$reg_token}>

        <!--類型排序-->
        <input type="hidden" name="class_id"  value="<{$class_id}>" >
        <input type="hidden" name="op" value="insert_reg">
        <button type="submit" class="btn btn-primary"><{$smarty.const._MD_KWCLUB_CHECK_OK}></button>
    </div>
</form>


<script>
    $(document).ready(function(){
        $('#reg_uid').change(function(){
            $.post('ajax.php', { reg_uid: $('#reg_uid').val(), op: "search_reg_uid" },
            function(data) {
                $('#reg_name').val(data);
            });
        });
    });
</script>