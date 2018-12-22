<{$toolbar}>
<{includeq file="$xoops_rootpath/modules/kw_club/templates/op_`$op`.tpl"}>

<{if $error}>
    <div class="alert alert-danger">
        <{$error}>
    </div>
<{/if}>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
