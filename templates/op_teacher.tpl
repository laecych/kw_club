
<h2><{$smarty.const._MD_KWCLUB_INDEX_TEACHER}></h2>

<table class="table table-bordered table-hover table-condensed">
    <thead>
        <tr class="success">
            <th nowrap><{$smarty.const._MD_KWCLUB_TEACHER_ID}></th>
            <th nowrap><{$smarty.const._MD_KWCLUB_TEACHER_NAME}></th>
            <th nowrap><{$smarty.const._MD_KWCLUB_TEACHER_CLASS}></th>
            <th nowrap><{$smarty.const._MD_KWCLUB_CATE_DESC}></th>
        </tr>
    </thead>
    <tbody>
        <{foreach from=$teachers key=uid item=tea}>
            <tr>
                <td class="text-center">
                    <a name="<{$uid}>">
                        <img src="<{$tea.pic}>" alt="<{$tea.name}>" style="width: 72px;">
                    </a>
                </td>
                <td class="text-center">
                    <{$tea.name}>
                </td>
                <td nowrap>
                    <ul>
                        <{foreach from=$tea_class.$uid key=class_id item=class}>
                            <li style="font-size: 0.9em; list-style-position: inside;"><{$class.club_year}> <a href="index.php?class_id=<{$class_id}>"><{$class.class_title}></a></li>
                        <{/foreach}>
                    </ul>
                </td>
                <td>
                    <pre style="white-space: pre-wrap; background: transparent; border: none; padding: 2px;" id="bio_<{$uid}>"><{$tea.bio}></pre>
                </td>
            </tr>
        <{/foreach}>
    </tbody>
</table>

<{if $smarty.session.isclubAdmin || $smarty.session.isclubUser}>
    <div class="text-right" style="font-size:0.9em;margin: 2px auto 30px;color:rgb(97, 29, 63);">
        <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
        <{if $smarty.session.isclubUser}>
            <{$smarty.const._MD_KWCLUB_TEACHER_DESC}>
        <{/if}>
        <{if $smarty.session.isclubAdmin}>
            <{$smarty.const._MD_KWCLUB_CLICK_BIO_TO_EDIT_DESC}>
        <{/if}>
    </div>
<{/if}>