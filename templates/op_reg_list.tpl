今天：<{$today}> <{$title}>

<div align="center">
    <select name="select_year" onChange="location.href=this.options[this.selectedIndex].value;">
    <{if $arr_year}>
     <{foreach from=$arr_year item=arr_year}>
     <{if $arr_year==$year}>
      <option value="<{$action}>?year=<{$arr_year}>&review=<{$review}>" selected><{$arr_year}></option>
      <{else}>
      <option value="<{$action}>?year=<{$arr_year}>&review=<{$review}>"><{$arr_year}></option>
      <{/if}>
     <{/foreach}>
     <{else}>
         <option value="">目前沒有任何社團期別</option>
     <{/if}>
    </select>
  

      <select name="review" onChange="location.href=this.options[this.selectedIndex].value;">
        <{if $review=='reg_sn'}>
        <option value="<{$action}>?year=<{$year}>&review=reg_sn"  selected>依報名排序</option>
        <option value="<{$action}>?year=<{$year}>&review=class_id" >依社團排序</option>        
        <option value="<{$action}>?year=<{$year}>&review=grade" >依年級排序</option>
        <option value="<{$action}>?year=<{$year}>&review=reg_uid" >依報名者排序</option>
        <{elseif $review=='class_id'}>
        <option value="<{$action}>?year=<{$year}>&review=reg_sn"  >依報名排序</option>
        <option value="<{$action}>?year=<{$year}>&review=class_id"  selected>依社團排序</option>
        <option value="<{$action}>?year=<{$year}>&review=grade" >依年級排序</option>
        <option value="<{$action}>?year=<{$year}>&review=reg_uid" >依報名者排序</option>
        <{elseif $review=='grade'}>
        <option value="<{$action}>?year=<{$year}>&review=reg_sn"  >依報名排序</option>
        <option value="<{$action}>?year=<{$year}>&review=class_id" >依社團排序</option>
        <option value="<{$action}>?year=<{$year}>&review=grade" selected>依年級排序</option>
        <option value="<{$action}>?year=<{$year}>&review=reg_uid" >依報名者排序</option>
        <{elseif $review=='reg_uid'}>
        <option value="<{$action}>?year=<{$year}>&review=reg_sn"  >依報名排序</option>
        <option value="<{$action}>?year=<{$year}>&review=class_id" >依社團排序</option>
        <option value="<{$action}>?year=<{$year}>&review=grade" >依年級排序</option>
        <option value="<{$action}>?year=<{$year}>&review=reg_uid" selected>依報名者排序</option>
        <{else}>
        <option value="<{$action}>?year=<{$year}>&review=reg_sn"  >依報名排序</option>
        <option value="<{$action}>?year=<{$year}>&review=class_id" >依社團排序</option>        
        <option value="<{$action}>?year=<{$year}>&review=grade" >依年級排序</option>
        <option value="<{$action}>?year=<{$year}>&review=reg_uid" >依報名者排序</option>
        <{/if}>
      </select>
    </div>
   
<div align="right">
    <a href="register.php?op=reg_uid&year=<{$year}>" class="btn btn-info">繳費統計模式</a>
        <a href="excel.php?year=<{$year}>&review=<{$review}>" class="btn btn-info">所有報名列表匯出excel</a>
       
</div>  

  

<h2><{if $arr_year}><{$arr_year}>期<{/if}>社團報名列表<small>（共 <{$total}> 筆報名資料）</small></h2>

<div id="kw_club_class_save_msg"></div>

<table class="table table-bordered table-hover table-striped">
  <thead>
    <tr class="">
        <{if $isAdmin}>
        <th>
          <!--社團年度-->
          <{$smarty.const._MD_KWCLUB_REG_SN}>
        </th>
        <{/if}>
        <th>
          <!--社團年度-->
          <{$smarty.const._MD_KWCLUB_REG_YEAR}>
        </th>
        <th>
          <!--社團名稱-->
          <{$smarty.const._MD_KWCLUB_CLASS_TITLE}>
        </th>
        <th>
            <!--社團名稱-->
            <{$smarty.const._MD_KWCLUB_CLASS_MONEY}>
          </th>
        <th>
          <!--報名者ID-->
            <{$smarty.const._MD_KWCLUB_REG_UID}>
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
            <!--是否後補-->
            <{$smarty.const._MD_KWCLUB_REG_ISREG}>
          </th>
        <th>
            <!--是否繳費-->
            <{$smarty.const._MD_KWCLUB_REG_ISFEE}>
          </th>
          <th>
              <!--報名時間-->
              <{$smarty.const._MD_KWCLUB_REG_DATETIME}>
            </th>
        <th>
          <!--IP-->
          <{$smarty.const._MD_KWCLUB_REG_IP}>
        </th>
        <th><{$smarty.const._TAD_FUNCTION}></th>
    </tr>
  </thead>


  <tbody id="kw_club_class_sort">
    <{foreach from=$all_content item=data}>
    <{if $data.reg_sn == $reg_sn}>
    <tr id="tr_<{$data.class_id}>" bgcolor="#00FFCC">
        <td>
          <{$data.reg_sn}>
        </td>
       
        <form class="form-horizontal" name="regform" id="regform" action="<{$action}>" method="post" onsubmit="return xoopsFormValidate_regform();" enctype = "multipart/form-data">
        <td>
            <input type='text' name='reg_year' value="<{$data.reg_year}>" >
        </td>
        <td>
            <select class="form-control" size="1" class = 'form-control col-sm-6' name="class_title" id="class_title" title="社團名稱">
                <{if $data.class_id==""}>
                <option value="" selected>請選擇</option>
                <{else}>
                <option value="<{$data.class_title}>" selected><{$data.class_title}></option>
                <{/if}>
             <{foreach  from=$arr_class key="id" item=arr_c}><!--類型-->
               <option value="<{$arr_c.class_title}>"><{$arr_c.class_title}></option>
             <{/foreach}>    
        </select>
        </td>
        <td>
            <input type='text' name='reg_uid' id="reg_uid" value="<{$data.reg_uid}>" >
          </td>
        <td>
            <input type='text' name='reg_name' id="reg_name" value="<{$data.reg_name}>" >
        </td>
        <td>
            <input type='text' name='reg_grade' id="reg_grade" value="<{$data.reg_grade}>" >
          </td>
        <td>
            <input type='text' name='reg_class' id="reg_class" value="<{$data.reg_class}>" >
        </td>
        <td>
              <{if $data.reg_isreg=='0'}>
                <label class="radio-inline"><input type='radio' name='reg_isreg'  title='正取' value='0' checked />正取&nbsp;</label>
                <label class="radio-inline"><input type='radio' name='reg_isreg'  title='後補' value='1'  />後補&nbsp;</label>
                <{else}>
                <label class="radio-inline"><input type='radio' name='reg_isreg'  title='正取' value='0'   />正取&nbsp;</label>
                <label class="radio-inline"><input type='radio' name='reg_isreg'  title='後補' value='1'  checked/>後補&nbsp;</label>
                <{/if}>
        </td>
        <td> 
              <{if $data.reg_isfee=='0'}>
                <label class="radio-inline"><input type='radio' name='reg_isfee'  title='未繳' value='0' checked  />未繳&nbsp;</label>
                <label class="radio-inline"><input type='radio' name='reg_isfee'  title='已繳' value='1'  />已繳&nbsp;</label>
                <{else}>
                <label class="radio-inline"><input type='radio' name='reg_isfee'  title='未繳' value='0'   />未繳&nbsp;</label>
                <label class="radio-inline"><input type='radio' name='reg_isfee'  title='已繳' value='1'  checked/>已繳&nbsp;</label>
                <{/if}>
            
       </td>
       <td><{$data.reg_datetime}> </td>
       <td><{$data.reg_ip}></td>
       <td>
          <input type='hidden' name='op' value="update_reg">
          <input type='hidden' name='class_id' value="<{$data.class_id}>">
          <input type='hidden' name='reg_sn' value="<{$data.reg_sn}>">
         <input type='submit' name='send' value ="確定修改" class="btn btn-xs btn-primary" >
        </td>
        </form>
    </tr>

  <{else}>
      <tr id="tr_<{$data.class_id}>">
          <td>
            <{$data.reg_sn}>
          </td>
       
          <td>
             <!--社團年度-->
            <{$data.reg_year}>
          </td>
          <td>
            <!--社團名稱-->
            (<{$data.class_id}>)<a href="index.php?class_id=<{$data.class_id}>"><{$data.class_title}></a>
          </td>
          <td>
              <{$data.class_money}>(<{$data.class_fee}>)
            </td>
          <td>
              <a href="index.php?op=myclass&uid=<{$data.reg_uid}>"><{$data.reg_uid}></a>
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
            <{$data.reg_isreg}>
          </td>
          <td>
            <{$data.reg_isfee}>
          </td>
          <td>
              <{$data.reg_datetime}>
          </td>
          <td>
            
            <{$data.reg_ip}>
          </td>
          <td>
            <a href="<{$action}>?reg_sn=<{$data.reg_sn}>" class="btn btn-xs btn-warning"><{$smarty.const._TAD_EDIT}></a>
            <a href="javascript:delete_reg_func(<{$data.reg_sn}>);" class="btn btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
            <!-- <img src="<{$xoops_url}>/modules/tadtools/treeTable/images/updown_s.png" style="cursor: s-resize;margin:0px 4px;" alt="<{$smarty.const._TAD_SORTABLE}>" title="<{$smarty.const._TAD_SORTABLE}>"> -->
          </td>
      </tr>
      <{/if}>
      <{foreachelse}>
      <tr>
          <td colspan=18>此期沒有人報名!!</td>
        </tr>
    <{/foreach}>
  </tbody>
</table>
<{$bar}>


<script type='text/javascript'>

  //
  function xoopsFormValidate_regform() { 
  var myform = window.document.regform; 
  var hasSelected = false; 
  var selectBox = myform.class_title;
  for (i = 0; i < selectBox.options.length; i++) { 
    if (selectBox.options[i].selected == true && selectBox.options[i].value != '') 
    { 
      hasSelected = true; 
      break; 
    } 
  }
  if (!hasSelected) { 
    window.alert("請輸入社團名稱"); 
    selectBox.focus(); 
    return false; 
    }

  if (myform.reg_uid.value == "") { window.alert("請輸入報名者身分證字號"); myform.reg_uid.focus(); return false; }
  if (myform.reg_name.value == "") { window.alert("請輸入報名者名稱"); myform.reg_name.focus(); return false; }
  if (myform.reg_grade.value == "") { window.alert("請輸入報名者年級"); myform.reg_grade.focus(); return false; }
  if (myform.reg_class.value == "") { window.alert("請輸入報名者班級"); myform.reg_class.focus(); return false; }
  if (myform.reg_isreg.value == "") { window.alert("請輸入是否後補"); myform.class_isreg.focus(); return false; }
  if (myform.reg_isfee.value == "") { window.alert("請輸入是否繳費"); myform.class_isfee.focus(); return false; }
  
  return true;
  }
  </script>



