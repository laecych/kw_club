<{if $isAdmin}>
<{$delete_cate_func}>
<{/if}>
<h2 class="text-center"><{$arr[1]}></h2>


<!--類型編號-->
<div class="row">
<label class="col-sm-3 text-right">
  <{$smarty.const._MD_KWCLUB_CATE_ID}>
</label>
<div class="col-sm-9">
  <{$arr[0]}>
</div>
</div>

<!--類型說明-->
<div class="row">
<label class="col-sm-3 text-right">
  <{$smarty.const._MD_KWCLUB_CATE_DESC}>
</label>
<div class="col-sm-9">
  <{$arr[2]}>
</div>
</div>

<!--類型排序-->
<div class="row">
<label class="col-sm-3 text-right">
  <{$smarty.const._MD_KWCLUB_CATE_SORT}>
</label>
<div class="col-sm-9">
  <{$arr[3]}>
</div>
</div>

<!--狀態-->
<div class="row">
<label class="col-sm-3 text-right">
  <{$smarty.const._MD_KWCLUB_CATE_ENABLE}>
</label>
<div class="col-sm-9">
  <{$arr[4]}>
</div>
</div>

<div class="text-right">
<{if $isAdmin}>
  <a href="javascript:delete_cate_func(<{$arr[0]}>);" class="btn btn-danger"><{$smarty.const._TAD_DEL}></a>
  <a href="<{$xoops_url}>/modules/kw_club/admin/cate.php?type=<{$type}>&op=cate_form&cate_id=<{$arr[0]}>" class="btn btn-warning"><{$smarty.const._TAD_EDIT}></a>
  <a href="<{$xoops_url}>/modules/kw_club/admin/cate.php?type=<{$type}>&op=cate_form" class="btn btn-primary"><{$smarty.const._TAD_ADD}></a>
<{/if}>


<a href="<{$action}>" class="btn btn-success"><{$smarty.const._TAD_HOME}></a>
</div>


