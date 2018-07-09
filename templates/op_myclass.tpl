<{if $uid}>
<center>
<select name="select_year" onChange="location.href=this.options[this.selectedIndex].value;">
        <{if $arr_year}>
         <{foreach from=$arr_year item=arr_year}>
         <{if $arr_year==$year}>
          <option value="<{$action}>?op=myclass&uid=<{$uid}>&year=<{$arr_year}>" selected><{$arr_year}></option>
          <{else}>
          <option value="<{$action}>?op=myclass&uid=<{$uid}>&year=<{$arr_year}>"><{$arr_year}></option>
          <{/if}>
         <{/foreach}>
         <{else}>
             <option value="">目前沒有任何社團期別</option>
         <{/if}>
        </select>
</center>
<h2><{$reg_name}>的社團列表<small>（共 <{$reg_num}> 筆）</small></h2>

<div id="kw_club_class_save_msg"></div>

<table class="table table-bordered table-hover table-striped">
  <thead>
    <tr class="">
    <th>社團年度</th>
    <th>社團名稱</th>
    <th>上課時間</th>
    <th>社團學費</th>
    <th>報名日期</th>
    <th>是否後補</th>
    <th>是否繳費</th>


    <{if $isAdmin}>
    <th>社團編號</th>
    <th>報名IP</th>
    <{/if}>
    <th>取消報名</th>
    </tr>
    </thead>
    <tbody id="kw_club_class_sort">
    <{foreach from=$arr_reg key=sn item=data}>
    <tr id="tr_<{$data.class_id}>">         
    <td>
    <!--社團年度-->
            <{$data.reg_year}>
    </td>
    <td><a href="index.php?class_id=<{$data.class_id}>">(<{$data.0}>)<{$data.class_title}></a></td>
    <td><{$data.1}>~~<{$data.2}>，每周<{$data.5}><br>
        <{$data.3}>~~<{$data.4}>
    </td><!--上課時間-->
    <td><{$data.6}>(額外費用<{$data.7}>)</td><!--學費-->
    <td><{$data.reg_datetime}></td><!--報名時間-->
    <td>
        <{ if $data.reg_isreg==0}>
            正取
        <{else}>
            備取
        <{/if}>
    </td>
    <td>
        <{ if $data.reg_isfee==1}>
            <font color='green'>已繳費</font>    
        <{else}>
            <font color='red'>未繳費</font>
        <{/if}>    
    </td>
    <{if $isAdmin}>
        <td><{$data.class_id}></td>
        <td><{$data.reg_ip}></td>
    <{/if}>
    <td>
        <{$no_del }>
        <{if !($today > $end_day) }>
        <a href="javascript:delete_reg_func(<{$data.reg_sn}>);" class="btn btn-danger" >取消報名</a>
       <{/if}>
    </td>
    </tr>
    <{foreachelse}>
        <tr>
            <td colspan=4>你目前沒有報名的社團!!</td>
        </tr>
    <{/foreach}>
    <tr>
        <td colspan="2" align='center'>總繳費金額</td>
        <td  colspan="6" align='right'>總共<{$money}>元，已繳<font color='green'><{$in_money}></font>元，未繳<font color='red'><{$un_money}></font>元</td></tr>
    </tbody>
</table>
<{else}>
    <h2>我的社團列表<small></small></h2>
    <form action="<{$action}>" method="post">
        請輸入你的身分證字號<input type='text' name='uid' class="">
        <input type='hidden' name='op' value='<{$op}>'>
        <input type='submit' name='send' class="" value="查詢">
    </form>
<{/if}>


<{if isAdmin}>

<{/if}>