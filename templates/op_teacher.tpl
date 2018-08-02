
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
        <{foreach from=$teachers item=tea}>
            <tr>
                <td class="text-center"><img src="<{$tea.pic}>" alt="<{$tea.name}>" style="width: 72px;"></td>
                <td class="text-center"><{$tea.name}></td>
                <td class="text-center"><{$tea.email}></td>
                <td><{$tea.user_occ}><{$tea.bio}></td>
            </tr>
        <{/foreach}>
    </tbody>
</table>