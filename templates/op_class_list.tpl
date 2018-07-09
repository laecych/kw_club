<div align="center">請選擇社團期別
    <select name="select_year" onChange="location.href=this.options[this.selectedIndex].value;">
    <{if $arr_year}>
     <{foreach from=$arr_year item=arr_year}>
     <{if $arr_year==$year}>
      <option value="<{$action}>?year=<{$arr_year}>" selected><{$arr_year}></option>
      <{else}>
      <option value="<{$action}>?year=<{$arr_year}>"><{$arr_year}></option>
      <{/if}>
     <{/foreach}>
     <{else}>
       <option value="">目前沒有期別</option>
     <{/if}>
    </select>
  </div>



<{if $year}>
<h2><font color='blue'><{$year}></font>
期社團列表<small>（共 <{$total}> 筆活動）</small> </h2>
報名期間：<font color='red'><{$reg_start}>~<{$reg_end}></font>

<{if $all_content}>
<table class="table table-bordered table-hover table-striped">
  <thead>
    <tr class="">
        <th>
          <!--社團編號-->
          <{$smarty.const._MD_KWCLUB_CLASS_NUM}>
        </th>
        <th>
          <!--社團名稱-->
          <{$smarty.const._MD_KWCLUB_CLASS_TITLE}>
        </th>
        <th>
            <!--社團類型-->
            <{$smarty.const._MD_KWCLUB_CATE_ID}>
          </th>
        <th>
          <!--開課教師-->
          <{$smarty.const._MD_KWCLUB_TEACHER_ID}>
        </th>
        <th>
            <!--上課地點-->
            <{$smarty.const._MD_KWCLUB_PLACE_ID}>
          </th>
        <th>
          <!--上課星期-->
          <{$smarty.const._MD_KWCLUB_CLASS_WEEK}>
        </th>
        <th>
            <!--招收對象-->
            <{$smarty.const._MD_KWCLUB_CLASS_GRADE}>
          </th>
        <th>
          <!--上課日期-->
          <{$smarty.const._MD_KWCLUB_CLASS_DATE}>
        </th>
        <th>
            <!--上課時間-->
            <{$smarty.const._MD_KWCLUB_CLASS_TIME}>
          </th>
       
        <th>
          <!--社團學費-->
          <{$smarty.const._MD_KWCLUB_CLASS_MONEY}>
        </th>
        <th>
          <!--額外費用-->
          <{$smarty.const._MD_KWCLUB_CLASS_FEE}>
        </th>
        <th>
            <!--招收人數-->
            <{$smarty.const._MD_KWCLUB_CLASS_MENBER}>
          </th>
        <th>
            <!--已報名人數-->
            <{$smarty.const._MD_KWCLUB_CLASS_REGNUM}>
          </th>
          <th>
              <!--社團備註-->
              <{$smarty.const._MD_KWCLUB_CLASS_NOTE}>
            </th>
          <th><!--社團期別-->
          <{$smarty.const._MD_KWCLUB_CLASS_YEAR}>
          </th>
           
          <{if $isAdmin || $isUser }>
           <th colspan =3>
            管理
          </th>
        <{/if}>
     
    </tr>
  </thead>



<tbody id="kw_club_class_sort">
    <{foreach from=$all_content item=data}>
      <tr id="tr_<{$data.class_id}>">
          
          <td>
            <!--社團編號-->
            <{$data.class_num}>
          </td>
          <td>
            <!--社團名稱-->
            <a href="<{$action}>?class_id=<{$data.class_id}>"><{$data.class_title}></a>
          </td>
          <td>
              <!--社團類型-->
              <{$data.cate_id}>
            </td>
          <td>
            <!--開課教師-->
            <{$data.teacher_id}>
          </td>
          <td>
              <!--上課地點-->
              <{$data.place_id}>
            </td>
          <td>
            <!--上課星期-->
            <{$data.class_week}>
          </td>
          <td>
              <!--招收對象-->
              <{$data.class_grade}>
            </td>
          <td>
            <!--上課起始日-->
            <{$data.class_date_open}>~<br>
            <!--上課終止日-->
            <{$data.class_date_close}>
          </td>
          <td>
            <!--起始時間-->
            <{$data.class_time_start}>~<br>
            <!--終止時間-->
            <{$data.class_time_end}>
          </td>
         

          <td>
            <!--社團學費-->
            <{$data.class_money}>
          </td>

          <td>
            <!--額外費用-->
            <{$data.class_fee}>
          </td>

          <td>
              <!--招收人數-->
              <{$data.class_menber}>
            </td>
          <td>
              <!--已報名人數-->
              <{$data.class_regnum}>
              <{if $data.class_regnum >= $data.class_menber}>
                <font color='red'>滿</font> 
              <{/if}>
          </td>
          <td>
              <{if $data.class_regnum >= $data.class_menber}>
              <font color='red'>後補報名中..</font> 
              <{/if}>
              <!--社團備註-->
              <{$data.class_note}>
            </td>
  <td>
            <!--社團期別--><!--ID-->
            <{$data.class_year}>
            (<{$data.class_id}>)
          </td>
          <{if $isAdmin || $uid == $data.class_uid}>
         
          <td>
            <!--是否啟用-->
            <{$data.class_isopen}>
          </td>
          <td>
              <!--UID-->
              <{$data.class_uid}>
              <{$data.class_uidname}>
              
            </td>
          <td>
              
            <a href="<{$xoops_url}>/modules/kw_club/main.php?op=class_form&class_id=<{$data.class_id}>" class="btn btn-xs btn-warning"><{$smarty.const._TAD_EDIT}></a>
            <{if $data.class_regnum == 0}>
            <a href="javascript:delete_class_func(<{$data.class_id}>);" class="btn btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
            <{/if}>
          </td>
        <{/if}>
      </tr>
    <{/foreach}>
  </tbody>
</table>
<{$bar}>
<{else}>
    <p>此期尚未新增社團!!</p>
<{/if}>

    <{if $isAdmin}>
   
    <div class="jumbotron text-center">
      <a href="<{$xoops_url}>/modules/kw_club/main.php?op=class_form&class_id=<{$class_id}>" class="btn btn-info"><{$smarty.const._TAD_ADD}></a>
    </div>


    <{/if}>
<{else}>
<p>尚未設定社團期別， 請先到管理介面進行每期社團資訊設定後，再新增課程!</p>
<{/if}>







