<div id="setupTab">
    <ul class="resp-tabs-list vert">
        <li><{$smarty.const._MD_KWCLUB_INFO_SETUP}></li>
        <li><{$smarty.const._MD_KWCLUB_SETUP_TEACHER}></li>
        <li><{$smarty.const._MD_KWCLUB_CATE_SETUP}></li>
        <li><{$smarty.const._MD_KWCLUB_PLACE_SETUP}></li>
    </ul>

    <div class="resp-tabs-container vert">
        <div><{includeq file="$xoops_rootpath/modules/kw_club/templates/sub_kw_club_info_list.tpl"}></div>
        <div><{includeq file="$xoops_rootpath/modules/kw_club/templates/sub_kw_club_teacher.tpl"}></div>
        <div><{includeq file="$xoops_rootpath/modules/kw_club/templates/sub_kw_club_cate.tpl"}></div>
        <div><{includeq file="$xoops_rootpath/modules/kw_club/templates/sub_kw_club_place.tpl"}></div>
    </div>
</div>
