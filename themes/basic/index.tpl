{strip}
    <header class="clearfix"></header>	
    <div class="main">
        <div id="grid-gallery" class="grid-gallery">
            <section class="grid-wrap">
                <ul class="grid">
                    <li class="grid-sizer"></li>
                    {foreach $data as $d}
                        {if $d['article_type'] == 'image'}
                            <li class="li-loader" id="{$d['id']}">
                                <a href="article.php?article_id={$d['id']}">
                                    <figure>
                                        <img src="admin/uploader/server/php/files/{$d['id']}/thumbnail/{$d['file_name']}" alt="{$d['article_name']}"/>
                                        <figcaption><h3>{$d['article_name']}</h3></figcaption>
                                    </figure>
                                </a>
                            </li>
                        {elseif $d['article_type'] == 'vimeo' || $d['article_type'] == 'youtube'}
                            <li class="li-loader" id="{$d['id']}">
                                <a href="article.php?article_id={$d['id']}">
                                    <figure>
                                        <img src="video/{$d['id']}/{$d['id']}.jpg" alt="{$d['article_name']}"/>
                                        <figcaption><h3>{$d['article_name']}</h3></figcaption>
                                    </figure>
                                </a>
                            </li>
                        {/if}
                    {/foreach}
                    {*
                        <figure>
                            <iframe type="text/html" width="100%" src="http://www.youtube.com/embed/Ha_QKhBPu_8" frameborder="0"></iframe>
                        </figure>
                    </li>*}
                </ul>
            </section>
        </div>
    </div>
    <div id="show_more"><div style="display:none" id="ajax-load"></div></div>
</div>
{/strip}