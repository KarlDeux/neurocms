{strip}
</body>
{foreach from=$js_array item=js}
<script src="{$js}"></script>
{/foreach}
{foreach from=$js_raw item=jsraw}
<script>{$jsraw}</script>
{/foreach}
</html>
<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css"/>
{/strip}