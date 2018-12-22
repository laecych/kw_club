<div class="row">
    <div class="col-sm-6">
        <h2><{$smarty.const._MD_KWCLUB_CATE_SETUP}></h2>
        <{includeq file="$xoops_rootpath/modules/kw_club/templates/sub_kw_club_cate_form.tpl"}>
    </div>
    <div class="col-sm-6">
        <h2><{$smarty.const._MD_KWCLUB_CATE_LIST}></h2>
        <{if $all_cate_content}>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#kw_club_cate_sort").sortable({ opacity: 0.6, cursor: "move", update: function() {
                        var order = $(this).sortable("serialize");
                        $.post("<{$xoops_url}>/modules/kw_club/save_sort.php", order + "&op=update_kw_club_cate_sort", function(theResponse){
                        $("#kw_club_cate_save_msg").html(theResponse);
                        });
                    }
                    });
                });
            </script>
            <div id="kw_club_cate_save_msg"></div>
            <ul class="list-group" id="kw_club_cate_sort">
                <{foreach from=$all_cate_content item=data}>
                    <li id="cateli_<{$data.cate_id}>" class="list-group-item">
                        <{$data.cate_title}>
                        <{if $smarty.session.isclubAdmin}>
                            <img src="<{$xoops_url}>/modules/tadtools/treeTable/images/updown_s.png" style="cursor: s-resize;margin:0px 4px;" alt="<{$smarty.const._TAD_SORTABLE}>" title="<{$smarty.const._TAD_SORTABLE}>">
                            <a href="javascript:delete_cate_func(<{$data.cate_id}>);" class="btn btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
                            <a href="<{$xoops_url}>/modules/kw_club/config.php?type=cate&cate_id=<{$data.cate_id}>#setupTab3" class="btn btn-xs btn-warning"><{$smarty.const._TAD_EDIT}></a>
                        <{/if}>
                    </li>
                <{/foreach}>
            </ul>
        <{/if}>
    </div>
</div>
