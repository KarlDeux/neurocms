{strip}
</div>
<div id="footer">
    <p><span class="copyright"><span>CMS created by Carlos Lizaga.</span><span class="newline"></span><span> All rights reserved 2014-2015 ©.</span></span></p>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/gnmenu.js"></script>
<script>
    new gnMenu(document.getElementById('gn-menu'));
</script>
{foreach from=$js_array item=js}
<script src="{$js}"></script>
{/foreach}
</script>
</body>
</html>
{/strip}