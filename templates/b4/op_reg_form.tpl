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

    function studIdNumberIdentify(nationality, idNumber) {

            studIdNumber = idNumber.toUpperCase();
            //本國人
            if (nationality == 0) {
                //驗證填入身分證字號長度及格式
                if (studIdNumber.length != 10) {
                    alert("長度不足");
                    return false;
                }
                //格式，用正則表示式比對第一個字母是否為英文字母
                if (isNaN(studIdNumber.substr(1, 9)) ||
                    (!/^[A-Z]$/.test(studIdNumber.substr(0, 1)))) {
                    alert("格式錯誤");
                    return false;
                }
                var idHeader = "ABCDEFGHJKLMNPQRSTUVXYWZIO"; //按照轉換後權數的大小進行排序
                //這邊把身分證字號轉換成準備要對應的
                studIdNumber = (idHeader.indexOf(studIdNumber.substring(0, 1)) + 10) + '' + studIdNumber.substr(1, 9);
                //開始進行身分證數字的相乘與累加，依照順序乘上1987654321
                s = parseInt(studIdNumber.substr(0, 1)) +
                    parseInt(studIdNumber.substr(1, 1)) * 9 +
                    parseInt(studIdNumber.substr(2, 1)) * 8 +
                    parseInt(studIdNumber.substr(3, 1)) * 7 +
                    parseInt(studIdNumber.substr(4, 1)) * 6 +
                    parseInt(studIdNumber.substr(5, 1)) * 5 +
                    parseInt(studIdNumber.substr(6, 1)) * 4 +
                    parseInt(studIdNumber.substr(7, 1)) * 3 +
                    parseInt(studIdNumber.substr(8, 1)) * 2 +
                    parseInt(studIdNumber.substr(9, 1));
                checkNum = parseInt(studIdNumber.substr(10, 1));
                //模數 - 總和/模數(10)之餘數若等於第九碼的檢查碼，則驗證成功
                //若餘數為0，檢查碼就是0
                if ((s % 10) == 0 || (10 - s % 10) == checkNum) {
                    return true;
                }
                else {
                    return false;
                }
            }
            //外籍生，居留證號規則跟身分證號差不多，只是第二碼也是英文字母代表性別，跟第一碼轉換二位數字規則相同，但只取餘數
            else {
                //驗證填入身分證字號長度及格式
                if (studIdNumber.length != 10) {
                    alert("長度不足");
                    return false;
                }
                //格式，用正則表示式比對第一個字母是否為英文字母
                if (isNaN(studIdNumber.substr(2, 8)) ||
                    (!/^[A-Z]$/.test(studIdNumber.substr(0, 1))) ||
                    (!/^[A-Z]$/.test(studIdNumber.substr(1, 1)))) {
                    alert("格式錯誤");
                    return false;
                }
                var idHeader = "ABCDEFGHJKLMNPQRSTUVXYWZIO"; //按照轉換後權數的大小進行排序
                //這邊把身分證字號轉換成準備要對應的
                studIdNumber = (idHeader.indexOf(studIdNumber.substring(0, 1)) + 10) +
                    '' + ((idHeader.indexOf(studIdNumber.substr(1, 1)) + 10) % 10) + '' + studIdNumber.substr(2, 8);
                //開始進行身分證數字的相乘與累加，依照順序乘上1987654321

                s = parseInt(studIdNumber.substr(0, 1)) +
                    parseInt(studIdNumber.substr(1, 1)) * 9 +
                    parseInt(studIdNumber.substr(2, 1)) * 8 +
                    parseInt(studIdNumber.substr(3, 1)) * 7 +
                    parseInt(studIdNumber.substr(4, 1)) * 6 +
                    parseInt(studIdNumber.substr(5, 1)) * 5 +
                    parseInt(studIdNumber.substr(6, 1)) * 4 +
                    parseInt(studIdNumber.substr(7, 1)) * 3 +
                    parseInt(studIdNumber.substr(8, 1)) * 2 +
                    parseInt(studIdNumber.substr(9, 1));

                //檢查號碼 = 10 - 相乘後個位數相加總和之尾數。
                checkNum = parseInt(studIdNumber.substr(10, 1));
                //模數 - 總和/模數(10)之餘數若等於第九碼的檢查碼，則驗證成功
                ///若餘數為0，檢查碼就是0
                if ((s % 10) == 0 || (10 - s % 10) == checkNum) {
                    return true;
                }
                else {
                    return false;
                }
            }
        }
</script>

<div class="row">
        <div class="col-sm-10">
                <h2><{$smarty.const._MD_KWCLUB_APPLY_CLASS|sprintf:$class.class_title}></h2>
        </div>
        <div class="col-sm-1" style="padding-top: 40px;">
           <{if $language=="english"}>
            <a href="index.php?op=reg_form&class_id=<{$class_id}>&language=tchinese_utf8" class="btn btn-primary btn-block" ><i class="fa fa-plus" aria-hidden="true"></i>
            <{else}>
            <a href="index.php?op=reg_form&class_id=<{$class_id}>&language=english" class="btn btn-primary btn-block" ><i class="fa fa-plus" aria-hidden="true"></i>
            <{/if}>    
               <{$smarty.const._MD_KWCLUB_LANGUAGE}></a>
        </div>   
    </div>


<p><{$smarty.const._MD_KWCLUB_APPLY_NOTE}></p>



<!--套用formValidator驗證機制-->
<form action="index.php" method="post" id="regForm" enctype="multipart/form-data" class="myForm " role="form">

    <!--報名者姓名-->
    <div class="form-group row">
        <!--身分證字號-->
        <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_KWCLUB_REG_UID}><span class="caption-required">*</span>
        </label>
        <div class="col-sm-4">
            <input type="text" name="reg_uid" id="reg_uid" class="form-control validate[required]" value="<{$reg_uid}>" placeholder="<{$smarty.const._MD_KWCLUB_KEYIN}><{$smarty.const._MD_KWCLUB_REG_UID}>">
        </div>

        <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_KWCLUB_REG_NAME}><span class="caption-required">*</span>
        </label>
        <div class="col-sm-4">
            <input type="text" name="reg_name" id="reg_name" class="form-control validate[required]" value="<{$reg_name}>" placeholder="<{$smarty.const._MD_KWCLUB_KEYIN}><{$smarty.const._MD_KWCLUB_REG_NAME}>">
        </div>
    </div>


    <!--報名者年級-->
    <div class="form-group row">
        <label for="reg_grade" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWCLUB_REG_GRADE}><span class="caption-required">*</span></label>
        <div class="col-sm-10">
            <{foreach from = $class_grade_arr key=v item=gname}>
            <div class="form-check form-check-inline">   
          
                    <{if $gname==$smarty.const._MD_KWCLUB_KG}>
                        <input type='radio' name='reg_grade' id="reg_grade<{$v}>" class="validate[required]" title='<{$smarty.const._MD_KWCLUB_KINDERGARTEN}>' value='<{$gname}>' <{if $gname == $reg_grade}>checked="checked"<{/if}>>
                        <label class="form-check-label" for="reg_grade<{$v}>"><{$smarty.const._MD_KWCLUB_KINDERGARTEN}></label>
                    <{else}>
                        <input type='radio' name='reg_grade' id="reg_grade<{$v}>" class="validate[required]" title='<{$gname}><{$smarty.const._MD_KWCLUB_GRADE}>' value='<{$gname}>' <{if $gname == $reg_grade}>checked="checked"<{/if}>>
                        <label class="form-check-label" for="reg_grade<{$v}>"><{$gname}><{$smarty.const._MD_KWCLUB_GRADE}></label>
                    <{/if}>
                    
            </div> 
            <{/foreach}>
        </div>
    </div>

    <!--報名者班級-->
    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_KWCLUB_REG_CLASS}><span class="caption-required">*</span>
        </label>
        <div class="col-sm-10">
            <{foreach from = $school_class key=v item=cname}>
            <div class="form-check form-check-inline">
                <input type='radio' name='reg_class' id="reg_class<{$v}>" class="validate[required]" title='<{$cname}>' value='<{$cname}>' <{if $cname == $reg_class}>checked="checked"<{/if}>>
                <label class="form-check-label" for="reg_class<{$v}>"> <{$cname}> </label>
            </div>
            <{/foreach}>
        </div>
    </div>

  
    <div class="form-group row">
        <!--家長姓名-->
        <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_KWCLUB_REG_PARENT}><span class="caption-required">*</span>
        </label>
        <div class="col-sm-4">
            <input type="text" name="reg_parent" id="reg_parent" class="form-control validate[required]" value="<{$reg_parent}>" placeholder="<{$smarty.const._MD_KWCLUB_KEYIN}><{$smarty.const._MD_KWCLUB_REG_PARENT}>">
        </div>
        <!--連絡電話-->
        <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_KWCLUB_REG_TEL}><span class="caption-required">*</span>
        </label>
        <div class="col-sm-4">
            <input type="text" name="reg_tel" id="reg_tel" class="form-control validate[required]" value="<{$reg_tel}>" placeholder="<{$smarty.const._MD_KWCLUB_KEYIN}><{$smarty.const._MD_KWCLUB_REG_TEL}>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
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