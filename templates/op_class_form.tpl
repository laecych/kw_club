<{if $class_id==""}>
    <h2><{$smarty.const._MD_KWCLUB_ADD_CLUB}><small> <span class="club_year_text"><{$club_year_text}></span> (<span style="color:rgb(190, 63, 4);"><{$smarty.session.club_start_date|date_format:"%Y/%m/%d %H:%M"}> ~ <{$smarty.session.club_end_date|date_format:"%Y/%m/%d %H:%M"}></span>)</small></h2>
<{else}>
    <h2><{$smarty.const._TAD_EDIT}><{$class_title}><{$smarty.const._MD_KWCLUB_CLUB}> <{$class_id}><small> <span class="club_year_text"><{$club_year_text}></span></small></h2>
<{/if}>

<form class="form-horizontal" name="classform" id="classform" action="club.php" method="post" enctype = "multipart/form-data">

    <!-- 社團編號 -->
    <div class="form-group">
        <label for="class_num" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_PICK_CLUB}><span class="caption-required">*</span></label>
        <div class="col-sm-10">
            <select class="form-control" size="1" name="class_num" id="class_num" title="<{$smarty.const._MD_KWCLUB_CLASS_NUM}>" onChange="location.href='club.php?class_num='+this.value">
                <{if $class_id==""}>
                    <option value="<{$num}>"><{$smarty.const._MD_KWCLUB_ADD_CLASS}></option>
                    <{foreach from=$js_class key=id item=arr_n }>
                        <{if $class_num==$id}>
                            <option value="<{$id}>" selected><{$id}>_<{$arr_n}></option>
                        <{else}>
                            <option value="<{$id}>" ><{$id}>_<{$arr_n}></option>
                        <{/if}>
                    <{/foreach}>
                <{else}>
                    <option value="<{$class_num}>" ><{$smarty.const._MD_KWCLUB_MODIFY_CLUB}></option>
                <{/if}>
            </select>

        </div>
    </div>

    <!-- 社團名稱 -->
    <div class="form-group">
        <label for="class_title" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_CLASS_TITLE}><span class="caption-required">*</span></label>
        <div class="col-sm-10">
            <input class='form-control validate[required]' type='text' name='class_title' title='<{$smarty.const._MD_KWCLUB_CLASS_TITLE}>' id='class_title' value='<{$class_title}>'>
        </div>
    </div>

    <!-- 開課教師 -->
    <div class="form-group">
        <label for="teacher_id" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_TEACHER_NAME}><span class="caption-required">*</span></label>
        <div class="col-sm-5">
            <select class="form-control validate[required]" size="1" name="teacher_id" id="teacher_id" title="<{$smarty.const._MD_KWCLUB_TEACHER_NAME}>">
                <{foreach from=$arr_teacher key="teacher_id" item="teacher" }>
                    <option value="<{$teacher_id}>" <{if $teacher_id==$uid}>selected<{/if}>><{$teacher.name}> (<{$teacher.email}>)</option>
                <{/foreach}>
            </select>
        </div>
        <div class="col-sm-5">
            <div class="help-block">
                <{$smarty.const._MD_KWCLUB_EDIT_TAECHER_NOTE}>
            </div>
        </div>
    </div>

    <!-- 社團類型 -->
    <div class="form-group">
        <label for="cate_id" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_CATE_ID}><span class="caption-required">*</span></label>
        <div class="col-sm-5">
            <select class="form-control validate[required]" size="1" name="cate_id" id="cate_id" title="<{$smarty.const._MD_KWCLUB_CATE_ID}>">
                <{foreach from=$arr_cate key=id item=arr_c}>
                    <option value="<{$id}>" <{if $cate_id==$id}>selected<{/if}>><{$arr_c}></option>
                <{/foreach}>
            </select>
        </div>
        <div class="col-sm-5">
            <div class="help-block">
                <{$smarty.const._MD_KWCLUB_EDIT_CATE_NOTE}>
            </div>
        </div>
    </div>

    <!-- 上課地點 -->
    <div class="form-group">
        <label for="place_id" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_PLACE_TITLE}><span class="caption-required">*</span></label>
        <div class="col-sm-5">
            <select class="form-control validate[required]" size="1" name="place_id" id="place_id" title="">
                <{foreach from=$arr_place key="id"  item="arr_p" }><!--老師-->
                    <option value="<{$id}>" <{if $place_id==$id}>selected<{/if}>><{$arr_p}></option>
                <{/foreach}>
            </select>
        </div>

        <div class="col-sm-5">
            <div class="help-block">
                <{$smarty.const._MD_KWCLUB_EDIT_PLACE_NOTE}>
            </div>
        </div>
    </div>

    <!-- 上課星期 -->
    <div class="form-group">
        <label for="class_week" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_CLASS_WEEK}><span class="caption-required">*</span></label>
        <div class="col-sm-10">
            <{foreach from = $c_week key=v item=wname}>
                <label class="checkbox-inline">
                    <input type='checkbox' name='class_week[]' id="class_week<{$v}>" title='<{$v}>' value='<{$wname}>' <{if in_array($wname,$class_week)}>checked="checked"<{/if}>><{$smarty.const._MD_KWCLUB_WEEK}><{$wname}>
                </label>
            <{/foreach}>
        </div>
    </div>

    <!-- 招收對象 -->
    <div class="form-group">
        <label for="class_grade" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_CLASS_GRADE}><span class="caption-required">*</span></label>
        <div class="col-sm-10">
            <{foreach from = $c_grade key=v item=gname}>
                <label class="checkbox-inline">
                    <{if $gname==$smarty.const._MD_KWCLUB_KG}>
                        <input type='checkbox' name='class_grade[]' id="class_grade<{$v}>" title='<{$smarty.const._MD_KWCLUB_KINDERGARTEN}>' value='<{$gname}>' <{if in_array($gname,$class_grade)}>checked="checked"<{/if}>><{$smarty.const._MD_KWCLUB_KINDERGARTEN}>
                    <{else}>
                        <input type='checkbox' name='class_grade[]' id="class_grade<{$v}>" title='<{$gname}><{$smarty.const._MD_KWCLUB_GRADE}>' value='<{$gname}>' <{if in_array($gname,$class_grade)}>checked="checked"<{/if}>><{$gname}><{$smarty.const._MD_KWCLUB_GRADE}>
                    <{/if}>
                </label>
            <{/foreach}>
        </div>
    </div>

    <!-- 招收人數 -->
    <div class="form-group">
        <label for="class_member" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_CLASS_MENBER}><span class="caption-required">*</span></label>
        <div class="col-sm-10"><input class='form-control validate[required]' type='text' name='class_member' title='<{$smarty.const._MD_KWCLUB_CLASS_MENBER}>' id='class_member' size='30' maxlength='255' value='<{$class_member}>'>
        </div>
    </div>

    <!-- 社團學費 -->
    <div class="form-group">
        <label for="class_money" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_CLASS_MONEY}><span class="caption-required">*</span></label>
        <div class="col-sm-10">
            <input class='form-control validate[required]' type='text' name='class_money' title='<{$smarty.const._MD_KWCLUB_CLASS_MONEY}>' id='class_money' size='30' maxlength='255' value='<{$class_money}>'>
        </div>
    </div>

    <!-- 額外費用 -->
    <div class="form-group">
        <label for="class_fee" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_CLASS_FEE}><span class="caption-required"></span></label>
        <div class="col-sm-10"><input class='form-control' type='text' name='class_fee' title='<{$smarty.const._MD_KWCLUB_CLASS_FEE}>' id='class_fee' size='30' maxlength='255' value='<{$class_fee}>'>
        </div>
    </div>

    <!-- 開課日期 -->
    <div class="form-group">
        <label for="class_date_open" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_CLASS_DATE_OPEN}><span class="caption-required">*</span></label>
        <div class="col-sm-2">
            <input class = "form-control validate[required]" type="text" name="class_date_open" id="class_date_open" size="30" maxlength="25" value="<{$class_date_open}>"
            onclick="WdatePicker({minDate:'<{$smarty.session.club_end_date}>' })"  >
        </div>
        <label for="class_date_close" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_CLASS_DATE_CLOSE}><span class="caption-required">*</span></label>
        <div class="col-sm-2">
            <input class = "form-control validate[required]" type="text" name="class_date_close" id="class_date_close" size="30" maxlength="25" value="<{$class_date_close}>"  onclick="WdatePicker({minDate:'#F{$dp.$D(\'class_date_open\',{d:1});}'})" >
        </div>
    </div>

    <!-- 起始時間 -->
    <div class="form-group">
        <label for="class_date_open" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_CLASS_TIME_START}><span class="caption-required">*</span></label>
        <div class="col-sm-2">
            <input class = "form-control validate[required]" type="text" name="class_time_start" id="class_time_start" size="30" maxlength="25" value="<{$class_time_start}>"
            onclick="WdatePicker({dateFmt:'HH:mm', minTime:'07:00:00', maxTime:'17:30:00' })" >
        </div>
        <label for="class_date_close" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_CLASS_TIME_END}><span class="caption-required">*</span></label>
        <div class="col-sm-2">
            <input class = "form-control validate[required]" type="text" name="class_time_end" id="class_time_end" size="30" maxlength="25" value="<{$class_time_end}>"   onclick="WdatePicker({dateFmt:'HH:mm', minTime:'#F{$dp.$D(\'class_time_start\')}',maxTime:'21:30:00'})"  >
        </div>
    </div>

    <!-- 社團備註 -->
    <div class="form-group">
        <label for="class_note" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_CLASS_NOTE}></label>
        <div class="col-sm-10">
            <input class='form-control ' type='text' name='class_note' title='<{$smarty.const._MD_KWCLUB_CLASS_NOTE}>' id='class_note' size='30' maxlength='255' value='<{$class_note}>'>
        </div>
    </div>

    <!-- 是否啟用 -->
    <div class="form-group">
        <label for="class_isopen" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_CLASS_ISOPEN}><span class="caption-required">*</span></label>
        <div class="col-sm-10">
            <label class="radio-inline">
                <input type='radio' name='class_isopen' id='class_isopen1' title='<{$smarty.const._YES}>' value='1' <{if $class_isopen=='1'}>checked<{/if}>><{$smarty.const._YES}>
            </label>
            <label class="radio-inline">
                <input type='radio' name='class_isopen' id='class_isopen2' title='<{$smarty.const._NO}>' value='0' <{if $class_isopen!='1'}>checked<{/if}>><{$smarty.const._NO}>
            </label>
        </div>
    </div>

    <!-- 社團簡介 -->
    <div class="form-group">
        <label for="class_desc" class="col-sm-2 control-label"><{$smarty.const._MD_KWCLUB_CLASS_DESC}><span class="caption-required">*</span></label>
        <div class="col-sm-10">
            <{$class_desc_editor}>
        </div>
    </div>

    <{if $class_id }>
        <input type="hidden" name="class_id" id="class_id" value="<{$class_id}>">
        <input type="hidden" name="op" value="update_class">
    <{else}>
        <input type="hidden" name="op" value="insert_class">
    <{/if}>
    <input type="hidden" name="club_year"  value="<{$club_year}>">
    <{$token}>
    <div class="form-group">
        <label class="col-sm-2 control-label"> </label>
        <div class="col-sm-10">
            <button type='submit' class='btn btn-primary'><{$smarty.const._TAD_SAVE}></button>
        </div>
    </div>
</form>
