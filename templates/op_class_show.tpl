<h2 class="text-center"><{$class_title}></h2>

<p align='right'>目前是第<font color='blue'><{$year}></font>期社團，報名期間：<font color='red'><{$reg_start}>~<{$reg_end}></font></p>
 
 <!--社團編號-->
 <div class="row">
    <label class="col-sm-3 text-right">
      <{$smarty.const._MD_KWCLUB_CLASS_YEAR}>
    </label>
    <div class="col-sm-9">
      <{if $class_year!=$year}>
        <font color='red'><{$class_year}></font>
        <{else}><font color='blue'><{$class_year}></font>
        <{/if}>
    </div>
  </div>
<!--社團編號-->
 <div class="row">
   <label class="col-sm-3 text-right">
     <{$smarty.const._MD_KWCLUB_CLASS_NUM}>
   </label>
   <div class="col-sm-9">
     <{$class_num}>
   </div>
 </div>

 <!--社團類型-->
 <div class="row">
   <label class="col-sm-3 text-right">
     <{$smarty.const._MD_KWCLUB_CATE_ID}>
   </label>
   <div class="col-sm-9">
     <{$cate_id_title}>
   </div>
 </div>

 <!--開課教師-->
 <div class="row">
   <label class="col-sm-3 text-right">
     <{$smarty.const._MD_KWCLUB_TEACHER_ID}>
   </label>
   <div class="col-sm-9">
     <{$teacher_id_title}>
   </div>
 </div>

 <!--上課地點-->
 <div class="row">
    <label class="col-sm-3 text-right">
      <{$smarty.const._MD_KWCLUB_PLACE_ID}>
    </label>
    <div class="col-sm-9">
      <{$place_id_title}>
    </div>
  </div>
 <!--上課星期-->
 <div class="row">
   <label class="col-sm-3 text-right">
     <{$smarty.const._MD_KWCLUB_CLASS_WEEK}>
   </label>
   <div class="col-sm-9">
     <{$class_week}>
   </div>
 </div>

  <!--招收對象-->
  <div class="row">
      <label class="col-sm-3 text-right">
        <{$smarty.const._MD_KWCLUB_CLASS_GRADE}>
      </label>
      <div class="col-sm-9">
        <{$class_grade}>
      </div>
    </div>

 <!--上課日-->
 <div class="row">
   <label class="col-sm-3 text-right">
     <{$smarty.const._MD_KWCLUB_CLASS_DATE}>
   </label>
   <div class="col-sm-9">
     <{$class_date_open}>~<{$class_date_close}>
   </div>
 </div>

 <!-- 上課終止日 -->
 <!-- <div class="row">
   <label class="col-sm-3 text-right">
     <{$smarty.const._MD_KWCLUB_CLASS_DATE_CLOSE}>
   </label>
   <div class="col-sm-9">

   </div>
 </div> -->

 <!--上課時間-->
 <div class="row">
   <label class="col-sm-3 text-right">
     <{$smarty.const._MD_KWCLUB_CLASS_TIME}>
   </label>
   <div class="col-sm-9">
     <{$class_time_start}>~ <{$class_time_end}>
   </div>
 </div>

 <!--終止時間-->
 <!-- <div class="row">
   <label class="col-sm-3 text-right">
     <{$smarty.const._MD_KWCLUB_CLASS_TIME_END}>
   </label>
   <div class="col-sm-9">
    
   </div>
 </div> -->



 <!--招收人數-->
 <div class="row">
   <label class="col-sm-3 text-right">
     <{$smarty.const._MD_KWCLUB_CLASS_MENBER}>
   </label>
   <div class="col-sm-9">
     <{$class_menber}>
   </div>
 </div>

 <!--社團學費-->
 <div class="row">
   <label class="col-sm-3 text-right">
     <{$smarty.const._MD_KWCLUB_CLASS_MONEY}>
   </label>
   <div class="col-sm-9">
     <{$class_money}>
   </div>
 </div>

 <!--額外費用-->
 <div class="row">
   <label class="col-sm-3 text-right">
     <{$smarty.const._MD_KWCLUB_CLASS_FEE}>
   </label>
   <div class="col-sm-9">
     <{$class_fee}>
   </div>
 </div>

 <!--報名人數-->
 <div class="row">
   <label class="col-sm-3 text-right">
     <{$smarty.const._MD_KWCLUB_CLASS_REGNUM}>
   </label>
   <div class="col-sm-9">
     <{$class_regnum}>
   </div>
 </div>

 <!--社團備註-->
 <div class="row">
   <label class="col-sm-3 text-right">
     <{$smarty.const._MD_KWCLUB_CLASS_NOTE}>
   </label>
   <div class="col-sm-9">
     <{$class_note}>
   </div>
 </div>


 <!--社團簡介-->
 <div class="row">
   <label class="col-sm-3 text-right">
     <{$smarty.const._MD_KWCLUB_CLASS_DESC}>
   </label>
   <div class="col-sm-9">
     
     <div class="well">
       <{$class_desc}>
     </div>
   </div>
 </div>

 <{if $isAdmin}>
 <!--社團年度-->
 <div class="row">
    <label class="col-sm-3 text-right">
      <{$smarty.const._MD_KWCLUB_CLASS_YEAR}>
    </label>
    <div class="col-sm-9">
      <{$class_year}>
    </div>
  </div>
  
 <!--流水號-->
 <div class="row">
   <label class="col-sm-3 text-right">
     <{$smarty.const._MD_KWCLUB_CLASS_ID}>
   </label>
   <div class="col-sm-9">
     <{$class_id}>
   </div>
 </div> 
   <!--是否開班-->
 <div class="row">
    <label class="col-sm-3 text-right">
      <{$smarty.const._MD_KWCLUB_CLASS_ISCHECKED}>
    </label>
    <div class="col-sm-9">
      <{if $class_ischecked=='1'}>
      開班
      <{elseif $class_ischecked=='0'}>
      不開班
      <{else}>
      尚未報名完成
      <{/if}>
    </div>
  </div>
  <{/if}> 

 <div class="text-center">
   <{if  $is_full == 'yes' }>
    <a href="" class="btn btn-danger">報名額滿</a>
   <{elseif  $is_timeout=='yes' }>
    <a href="" class="btn btn-danger">非報名時間</a>
    <{elseif $class_regnum >= $class_menber}> 
    <a href="<{$xoops_url}>/modules/kw_club/index.php?op=reg_form&class_id=<{$class_id}>&class_grade=<{$class_grade}>&is_full=1" class="btn btn-warning">我要報名後補</a>
   <{else}>
    <a href="<{$xoops_url}>/modules/kw_club/index.php?op=reg_form&class_id=<{$class_id}>&class_grade=<{$class_grade}>" class="btn btn-primary">我要報名</a>
    <{/if}>


   <{if $isAdmin || $uid == $class_uid }>

    <{if $class_regnum == 0}>
     <a href="javascript:delete_class_func(<{$class_id}>);" class="btn btn-danger"><{$smarty.const._TAD_DEL}></a>
     <{/if}>
     <a href="<{$xoops_url}>/modules/kw_club/main.php?op=class_form&class_id=<{$class_id}>" class="btn btn-warning"><{$smarty.const._TAD_EDIT}></a>
     <a href="<{$xoops_url}>/modules/kw_club/main.php?op=class_form" class="btn btn-primary"><{$smarty.const._TAD_ADD}></a>
   <{/if}>
   <a href="<{$action}>" class="btn btn-success"><{$smarty.const._TAD_HOME}></a>
 </div>
<{$bar}>
<br>

<{if $isAdmin || $uid == $class_uid }>
<h2><font color=green><{$class_title}></font>社團報名列表<small>（共 <{$class_regnum}> 筆報名資料）</small></h2>

<div id="kw_club_class_save_msg"></div>

<table class="table table-bordered table-hover table-striped">
  <thead>
    <tr class="">

        <th>
          <!--社團年度-->
          <{$smarty.const._MD_KWCLUB_REG_SN}>
        </th>

        <th>
        <!--報名者姓名-->
          <{$smarty.const._MD_KWCLUB_REG_NAME}>
        </th>
        <th>
           <!--報名者年級-->
            <{$smarty.const._MD_KWCLUB_REG_GRADE}>
          </th>
        <th>
         <!--報名者班級-->
          <{$smarty.const._MD_KWCLUB_REG_CLASS}>
        </th>
        <th>
            <!--報名時間-->
            <{$smarty.const._MD_KWCLUB_REG_DATETIME}>
          </th>
          <{if $isAdmin}>
        <th>
            <!--是否後補-->
            <{$smarty.const._MD_KWCLUB_REG_ISREG}>
          </th>
        <th>
            <!--是否繳費-->
            <{$smarty.const._MD_KWCLUB_REG_ISFEE}>
          </th>
      
           
          <th>
                <!--報名者ID-->
                  <{$smarty.const._MD_KWCLUB_REG_UID}>
          </th>
        <th><{$smarty.const._TAD_FUNCTION}></th>
        <{/if}>
    </tr>
  </thead>
  <{foreach from=$all_reg item=data}>

  <tr id="tr_<{$data.class_id}>">
      <td>
        <{$data.reg_sn}>
      </td>
      <td>
        <{$data.reg_name}>
      </td>
      <td>
          <{$data.reg_grade}>
        </td>
      <td>
        <{$data.reg_class}>
      </td>
      <td>
          <{$data.reg_datetime}>
      </td>
      <{if $isAdmin}>
      <td>
        <{$data.reg_isreg}>
      </td>
      <td>
        <{$data.reg_isfee}>
      </td>
      <td>
          <a href="index.php?op=myclass&uid=<{$data.reg_uid}>"><{$data.reg_uid}></a>
        </td>
      <td>
        <a href="<{$action}>?reg_sn=<{$data.reg_sn}>" class="btn btn-xs btn-warning"><{$smarty.const._TAD_EDIT}></a>
        <a href="javascript:delete_reg_func(<{$data.reg_sn}>);" class="btn btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
        <!-- <img src="<{$xoops_url}>/modules/tadtools/treeTable/images/updown_s.png" style="cursor: s-resize;margin:0px 4px;" alt="<{$smarty.const._TAD_SORTABLE}>" title="<{$smarty.const._TAD_SORTABLE}>"> -->
      </td>
      <{/if}>
  </tr>
  <{/foreach}>
</tbody>
</table>


<{/if}>



