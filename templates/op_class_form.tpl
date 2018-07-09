<{if $class_id==""}>
<h2>新增社團</h2>	
<{else}>
<h2>編輯<{$class_title}>社團 <{$class_id}></h2>	
<{/if}>
<center>
<h2>目前是第<{$club_year}>期社團</h2>

<h3>開放報名期間：<font color='red'><{$reg_start}>~<{$reg_end}></font></h3>
</center>


<div><form class="form-horizontal" name="classform" id="classform" action="<{$_server[PHP_SELF]}>" method="post" onsubmit="return xoopsFormValidate_classform();" enctype = "multipart/form-data">

    <div class="form-group">
        <label for="class_num" class="col-md-2 control-label">挑選社團<span class="caption-required">*</span></label>
        <div class="col-md-10">
            <!-- <input class='form-control validate[required, custom[integer]]' type='text' name='class_num' title='社團編號' id='class_num' value='<{$class_num}>' /> -->

            <select class="form-control" size="1" name="class_num" id="class_num" title="社團編號" onChange="location.href='main.php?op=class_form&class_num='+this.value">
                <{if $class_id==""}>
                    
                    <option value="<{$num}>">新增課程</option> 
                    <{foreach from=$js_class key="id" item="arr_n" }>
                    <{if $class_num==$id}>
                        <option value="<{$id}>" selected><{$id}>_<{$arr_n}></option>
                    <{else}>
                        <option value="<{$id}>" ><{$id}>_<{$arr_n}></option>
                    <{/if}>
                    <{/foreach}>	
                <{else}>
                <option value="<{$class_num}>" >修改社團</option>
                <{/if}>
                
        </select>

        </div>
    </div>
    <div class="form-group">
            <label for="class_title" class="col-md-2 control-label">社團名稱<span class="caption-required">*</span></label>
            <div class="col-md-10">
                <input class='form-control validate[required]' type='text' name='class_title' title='社團名稱' id='class_title' value='<{$class_title}>' /> 
            </div>
        </div>
    <div class="form-group">
        <label for="cate_id" class="col-md-2 control-label">社團類型<span class="caption-required">*</span></label>
        <div class="col-md-10">
            <select class="form-control validate[required]" size="1" name="cate_id" id="cate_id" title="社團類型">
                    <{if $cate_id==""}>
                    <option value="" selected>請選擇</option>
                    <{else}>
                    <option value="<{$cate_id}>" selected><{$arr_cate[$cate_id]}></option>
                    <{/if}>
                 <{foreach  from=$arr_cate key="id" item="arr_c"}><!--類型-->
                 <option value="<{$id}>"><{$arr_c}></option>
                 <{/foreach}>    
            </select>
        </div>
    </div>
   
    <div class="form-group">
        <label for="teacher_id" class="col-md-2 control-label">開課教師<span class="caption-required">*</span></label>
        <div class="col-md-10">
            <select class="form-control validate[required]" size="1" name="teacher_id" id="teacher_id" title="開課教師">
                    <{if $teacher_id==""}>
                    <option value="" selected>請選擇</option>
                    <{else}>
                    <option value="<{$teacher_id}>" selected><{$arr_teacher[$teacher_id]}></option>
                    <{/if}>
                    <{foreach from=$arr_teacher key="id" item="arr_t" }><!--老師-->
                    <option value="<{$id}>"><{$arr_t}></option>
                    <{/foreach}>	
            </select>
        </div>
    </div>
    <div class="form-group">
            <label for="place_id" class="col-md-2 control-label">上課地點<span class="caption-required">*</span></label>
            <div class="col-md-10">
                <select class="form-control validate[required]" size="1" name="place_id" id="place_id" title="">
                        <{if $place_id==""}>
                        <option value="" selected>請選擇</option>
                        <{else}>
                        <option value="<{$place_id}>" selected><{$arr_place[$place_id]}></option>
                        <{/if}>
                        <{foreach from=$arr_place key="id"  item="arr_p" }><!--老師-->
                        <option value="<{$id}>"><{$arr_p}></option>
                        <{/foreach}>	
                </select>
            </div>
        </div>
    <div class="form-group">
        <label for="class_week" class="col-md-2 control-label">上課星期<span class="caption-required">*</span></label>
        <div class="col-md-10">
            <{foreach from = $c_week key=v item=wname}>
                <{if in_array($wname,$class_week)}>  
                 <input type='checkbox' name='class_week[]' id="class_week<{$v}>" title='<{$v}>' value='<{$wname}>' checked="checked" >星期<{$wname}>
                 <{else}>
                  <input type='checkbox' name='class_week[]' id="class_week<{$v}>" title='<{$v}>' value='<{$wname}>' >星期<{$wname}>
                 <{/if}>
            <{/foreach}>
        </div>
    </div>
    <div class="form-group">
        <label for="class_grade" class="col-md-2 control-label">招收對象<span class="caption-required">*</span></label>
        <div class="col-md-10">
         <{foreach from = $c_grade key=v item=gname}>
            <{if $v==0}>
                <{if in_array($gname,$class_grade)}>  
                    <input type='checkbox' name='class_grade[]' id="class_grade<{$v}>" title='<{$v}>' value='<{$gname}>' checked="checked" ><{$gname}>兒園
                 <{else}>
                    <input type='checkbox' name='class_grade[]' id="class_grade<{$v}>" title='<{$v}>' value='<{$gname}>' ><{$gname}>兒園
                 <{/if}>
            <{else}>
                 <{if in_array($gname,$class_grade)}>  
                    <input type='checkbox' name='class_grade[]' id="class_grade<{$v}>" title='<{$v}>' value='<{$gname}>' checked="checked" ><{$gname}>年級
                 <{else}>
                    <input type='checkbox' name='class_grade[]' id="class_grade<{$v}>" title='<{$v}>' value='<{$gname}>' ><{$gname}>年級
                 <{/if}>
            <{/if}>
            <{/foreach}>
               
         </div>
    </div>
    <div class="form-group">
        <label for="class_menber" class="col-md-2 control-label">招收人數<span class="caption-required">*</span></label>
        <div class="col-md-10"><input class='form-control validate[required]' type='text' name='class_menber' title='招收人數' id='class_menber' size='30' maxlength='255' value='<{$class_menber}>' />
        </div>
    </div>
    <div class="form-group">
        <label for="class_money" class="col-md-2 control-label">社團學費<span class="caption-required">*</span></label>
        <div class="col-md-10">
            <input class='form-control validate[required]' type='text' name='class_money' title='社團學費' id='class_money' size='30' maxlength='255' value='<{$class_money}>' />
        </div>
    </div>
    <div class="form-group">
        <label for="class_fee" class="col-md-2 control-label">額外費用<span class="caption-required"></span></label>
        <div class="col-md-10"><input class='form-control' type='text' name='class_fee' title='額外費用' id='class_fee' size='30' maxlength='255' value='<{$class_fee}>' />
        </div>
    </div>
    <div class="form-group">
        <label for="class_date_open" class="col-md-2 control-label">開課日期<span class="caption-required">*</span></label>
        <div class="input-group col-md-2">
            <input class = "form-control col-sm-6 validate[required]" type="text" name="class_date_open" id="class_date_open" size="30" maxlength="25" value="<{$class_date_open}>" 
            onclick="WdatePicker({minDate:'<{$reg_end}>' })"  >
        </div>
        <label for="class_date_close" class="col-md-2 control-label">終止日期<span class="caption-required">*</span></label>
        <div class="input-group col-md-2">
            <input class = "form-control col-sm-6 validate[required]" type="text" name="class_date_close" id="class_date_close" size="30" maxlength="25" value="<{$class_date_close}>"  onclick="WdatePicker({minDate:'#F{$dp.$D(\'class_date_open\',{d:1});}'})" >
        </div>
    </div>
    <div class="form-group">
            <label for="class_date_open" class="col-md-2 control-label">起始時間<span class="caption-required">*</span></label>
            <div class="input-group col-md-2">
                <input class = "form-control col-sm-6 validate[required]" type="text" name="class_time_start" id="class_time_start" size="30" maxlength="25" value="<{$class_time_start}>"   
                onclick="WdatePicker({dateFmt:'HH:mm', minTime:'07:00:00', maxTime:'17:30:00' })" >
            </div>
            <label for="class_date_close" class="col-md-2 control-label">終止時間<span class="caption-required">*</span></label>
            <div class="input-group col-md-2">
                <input class = "form-control col-sm-6 validate[required]" type="text" name="class_time_end" id="class_time_end" size="30" maxlength="25" value="<{$class_time_end}>"   onclick="WdatePicker({dateFmt:'HH:mm', minTime:'#F{$dp.$D(\'class_time_start\')}',maxTime:'21:30:00'})"  >
            </div>
        </div>

    <div class="form-group">
            <label for="class_note" class="col-md-2 control-label">社團備註</label>
            <div class="col-md-10"><input class='form-control ' type='text' name='class_note' title='社團備註' id='class_note' size='30' maxlength='255' value='<{$class_note}>' />
            </div>
        </div>
    <div class="form-group">
        <label for="class_isopen" class="col-md-2 control-label">是否啟用<span class="caption-required">*</span></label>
        <div class="col-md-10">
            <label class="radio-inline"><input type='radio' name='class_isopen' id='class_isopen1' title='啟用' value='1' checked  />啟用&nbsp;</label>
            <label class="radio-inline"><input type='radio' name='class_isopen' id='class_isopen2' title='停用' value='0'  />停用&nbsp;</label>
        </div>
    </div>
    <div class="form-group">
        <label for="class_desc" class="col-md-2 control-label">社團簡介<span class="caption-required">*</span></label>
        <div class="col-md-10">        
                  
        <textarea class='form-control validate[required]' name='class_desc' id='class_desc'  title='社團簡介' rows='18' cols='60' class='ckeditor_css'><{$class_desc}></textarea>
        <script>
                CKEDITOR.replace('class_desc');
        </script>
    </div>
    </div>
   
    
    <{if !empty($class_id) }>
        <input type="hidden" name="class_id" id="class_id" value="<{$class_id}>" />
        <input type="hidden" name="op" id="op" value="update_class" />
    <{else}>
        <input type="hidden" name="op" id="op" value="insert_class" />
    <{/if}>
    <{$token}>
    <div class="form-group">
            <div class="col-md-2"> </div>
            <div class="col-md-10"><span class="form-inline">
                <input type='submit' class='btn btn-default' name=''  id='' value='送出' title='送出'  /></span>
            </div>
    </div>
</form>
</div>



