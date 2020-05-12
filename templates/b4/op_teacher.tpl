
<h2><{$smarty.const._MD_KWCLUB_INDEX_TEACHER}></h2>


<div class="vtable">
    <ul class="vhead">
        <!-- <li class="w1"><{$smarty.const._MD_KWCLUB_TEACHER_ID}></li> -->
        <li class="w1"><{$smarty.const._MD_KWCLUB_TEACHER_NAME}></li>
        <li class="w4"><{$smarty.const._MD_KWCLUB_TEACHER_CLASS}></li>
        <li class="w4"><{$smarty.const._MD_KWCLUB_CATE_DESC}></li>
    </ul>


    <{foreach from=$teachers key=uid item=tea}>
        <ul>
            <li class="vcell"><{$smarty.const._MD_KWCLUB_TEACHER_ID}></li>
            <!-- <li class="vm w1 text-center">
                <a name="<{$tea.teacher_title}>">
                    <img src="<{$tea.pic}>" alt="<{$tea.teacher_title}>" class="img-fluid">
                </a>
            </li> -->
            <li class="vm w1 text-center">
                <{$tea.teacher_title}>
            </li>
            <li class="vm w4">
                <{foreach from=$tea_class.$uid key=class_id item=class}>
                    <div style="font-size: 0.9em; list-style-position: inside;"><{$class.club_year}> <a href="index.php?class_id=<{$class_id}>"><{$class.class_title}></a></div>
                <{/foreach}>
            </li>

            <li class="vm w4">
                <pre style="white-space: pre-wrap; background: transparent; border: none; padding: 2px;" id="bio_<{$uid}>" title="<{$smarty.const._MD_KWCLUB_CLICK_TO_EDIT}>"><{$tea.teacher_desc}><{$uid.bio}></pre>
            </li>

        </ul>
<{/foreach}>
</div>

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