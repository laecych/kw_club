<!-- <{$pickdate}> -->

<H2>社團資訊設定</H2>

<div>
    <form class="form-horizontal" name="classform" id="classform" action="<{$_server[PHP_SELF]}>" method="post" onsubmit="return xoopsFormValidate_classform();" enctype = "multipart/form-data">
        <div class="form-group">
            <label for="class_year" class="col-md-2 control-label">社團期別<span class="caption-required">*</span></label>
        <{if $semester}>
            <div class="col-md-6"><h3>目前設定的期數是：<{$semester}></h3>   </div>
            
            <input type="hidden" name="op" id="op" value="update_config" />
        <{else}>
           
            <div class="col-md-6">
                <input type="hidden" name="op" id="op"  value="set_config" />
                <select class="form-control  validate[required]" size="1" class = 'form-control col-sm-6' name="kw_club_year" id="kw_club_year" title="社團年度">
                <{foreach from=$arr_semester item=arr_s }><!--期別-->
                        <option value="<{$arr_s}>" ><{$arr_s}></option>
                <{/foreach}>	
                </select>(除非截止日期或重設，否則設定後就無法變更。00暑假、01第一學期、11寒假、02第二學期)
            </div>
        <{/if}>
        </div>
        <div class="form-group">
                <label for="class_date_open" class="col-md-2 control-label">報名起始時間<span class="caption-required">*</span></label>
                <div class="input-group col-md-6">
                    <input class = "form-control col-sm-6 validate[required]" type="text" name="start_reg" id="class_time_start" size="30" maxlength="25" value="<{$start_reg}>" required onclick="WdatePicker({maxDate:'#F{$dp.$D(\'class_time_end\');}'})"   >
                    
                </div>
                <label for="class_date_close" class="col-md-2 control-label">報名終止時間<span class="caption-required">*</span></label>
                <div class="input-group col-md-6">
                    <input class = "form-control col-sm-6 validate[required]" type="text" name="end_reg" id="class_time_end" size="30" maxlength="25" value="<{$end_reg}>"  required onclick="WdatePicker({minDate:'#F{$dp.$D(\'class_time_start\',{d:1});}'})">
                    (日期可修改)
                </div>
        </div>
        <div class="form-group">
                <label for="class_isopen" class="col-md-2 control-label">報名方式<span class="caption-required">*</span></label>
                <div class="col-md-6">
                    <label class="radio-inline">
                        <input type='radio' class="validate[required]" name='isfree_reg' id='class_isopen1' title='自由報名' value='0' checked  />自由報名(不登入可報名)&nbsp;</label>
                    <!-- <label class="radio-inline"><input type='radio' name='isfree_reg' id='class_isopen2' title='登入報名' value='1'  />登入報名(須安裝單位名冊模組，上傳報名者相關資料)&nbsp;</label> -->
                </div>
            </div>
            <div class="form-group">
                    <label for="backup_num" class="col-md-2 control-label">候補人數<span class="caption-required">*</span></label>
                    <div class="col-md-6">
                        <{if $backup_num}>
                            <{$backup_num}>人
                        <{else}>
                        <select class="form-control validate[required]" size="1" class = 'form-control col-sm-6' name="backup_num" id="backup_num" title="候補人數">
                                <{foreach from=$arr_num item=num}>
                                <option value="<{$num}>"><{$num}></option>
                                <{/foreach}>
                        </select>
                        <{/if}>	
                    </div>
                </div>
        <div class="form-group">
                <div class="col-md-10">
                  <center><input type='submit' class='btn btn-default' name='儲存修改日期'  value='儲存修改日期'  title='儲存修改日期'  >
                    <!-- <input type='button' class='btn btn-default' name='重設'  value='重設社團期別'  title='重設'  onclick="javascript:delete_class_func()"> -->
                    <!-- <a href="javascript:delete_cate_func(<{$arr[0]}>);" class="btn btn-danger"><{$smarty.const._TAD_DEL}></a> -->
                    <{if $semester}> <a href="javascript:delete_club_func(0);" class="btn btn-danger">重設社團期別</a><{/if}>
                </center>
                </div>
        </div>
    </form>
</div>



<script type='text/javascript'>
    function xoopsFormValidate_classform() { var myform = window.document.classform; 
    var hasSelected = false; var selectBox = myform.class_year;for (i = 0; i < selectBox.options.length; i++) { if (selectBox.options[i].selected == true && selectBox.options[i].value != '') { hasSelected = true; break; } }if (!hasSelected) { window.alert("請輸入社團期別"); selectBox.focus(); return false; }
     
    if (myform.start_reg.value == "") { window.alert("請輸入社團報名起始時間"); myform.class_date_open.focus(); return false; }
    if (myform.end_reg.value == "") { window.alert("請輸入社團報名終止時間"); myform.class_date_close.focus(); return false; }
    if (myform.start_reg.value >= myform.end_reg.value ) { window.alert("時間錯誤!報名起始時間大於終止時間"); myform.class_date_close.focus(); return false; }
    if (myform.isfree_reg.value == "") { window.alert("請輸入報名方法"); myform.class_date_close.focus(); return false; }
    }
</script>
    <!-- End Form Validation JavaScript //-->