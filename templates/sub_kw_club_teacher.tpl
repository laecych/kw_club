<div class="row">
    <div class="col-sm-6">
        <h2>
            <{$smarty.const._MD_KWCLUB_TEACHER_SETUP}>
        </h2>
        <{includeq file="$xoops_rootpath/modules/kw_club/templates/sub_kw_club_teacher_form.tpl" }>
    </div>
    <div class="col-sm-6">
        <h2>
            <{$smarty.const._MD_KWCLUB_TEACHER_LIST}>
        </h2>
        <{if $all_teacher_content}>
            <script type="text/javascript">
                $(document).ready(function () {
                    $("#kw_club_teacher_sort").sortable({
                        opacity: 0.6, cursor: "move", update: function () {
                            var order = $(this).sortable("serialize");
                            $.post("<{$xoops_url}>/modules/kw_club/save_sort.php", order + "&op=update_kw_club_teacher_sort", function (theResponse) {
                                $("#kw_club_teacher_save_msg").html(theResponse);
                            });
                        }
                    });
                });
            </script>
            <div id="kw_club_teacher_save_msg"></div>
            <ul class="list-group" id="kw_club_teacher_sort">
<<<<<<< HEAD
                <{foreach from=$all_teacher_content item=data}>
=======
                <{foreach from=$all_place_content item=data}>
>>>>>>> 685224cc6d6b0c454c4aa46d27cc7d27966e7bda
                    <li id="teacherli_<{$data.teacher_id}>" class="list-group-item">
                        <{$data.teacher_title}>
                            <{if $smarty.session.isclubAdmin}>
                                <img src="<{$xoops_url}>/modules/tadtools/treeTable/images/updown_s.png" style="cursor: s-resize;margin:0px 4px;" alt="<{$smarty.const._TAD_SORTABLE}>"
                                    title="<{$smarty.const._TAD_SORTABLE}>">
                                <a href="javascript:delete_teacher_func(<{$data.teacher_id}>);" class="btn btn-xs btn-danger">
                                    <{$smarty.const._TAD_DEL}>
                                </a>
                                <a href="<{$xoops_url}>/modules/kw_club/config.php?type=teacher&teacher_id=<{$data.teacher_id}>#setupTab2" class="btn btn-xs btn-warning">
                                    <{$smarty.const._TAD_EDIT}>
                                </a>
                                <{/if}>
                    </li>
                    <{/foreach}>
            </ul>
            <{/if}>
    </div>
</div>