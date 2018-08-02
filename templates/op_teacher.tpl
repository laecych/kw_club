
<h2><{$smarty.const._MD_KWCLUB_INDEX_TEACHER}></h2>

<table class="table table-bordered table-hover table-condensed">
    <thead>
        <tr class="success">
            <th nowrap><{$smarty.const._MD_KWCLUB_TEACHER_ID}></th>
            <th nowrap><{$smarty.const._MD_KWCLUB_TEACHER_NAME}></th>
            <th nowrap><{$smarty.const._MD_KWCLUB_TEACHER_EMAIL}></th>
            <th nowrap><{$smarty.const._MD_KWCLUB_CATE_DESC}></th>
        </tr>
    </thead>
    <tbody>
        <{foreach from=$teachers key=uid item=tea}>
            <tr>
                <td class="text-center"><img src="<{$tea.pic}>" alt="<{$tea.name}>" style="width: 72px;"></td>
                <td class="text-center"><{$tea.name}></td>
                <td class="text-center"><{$tea.email}></td>
                <td><div id="bio_<{$uid}>"><{$tea.bio}></div></td>
            </tr>
        <{/foreach}>
    </tbody>
</table>
<{if $smarty.session.isclubAdmin}>
    <div class="text-right" style="font-size:0.9em;margin: 2px auto 30px;color:rgb(97, 29, 63);">
        <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
        <{$smarty.const._MD_KWCLUB_CLICK_BIO_TO_EDIT_DESC}>
    </div>
<{/if}>