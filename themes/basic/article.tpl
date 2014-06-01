{strip}{$test}
    <header class="clearfix"></header>	
    <div class="main_article">
        {foreach $data as $d}
            <h2>{$d['title']}</h2>
            {if $d['type'] == 'image'}
                {foreach $d['images'] as $image}
                    <img src="admin/uploader/server/php/files/{$image}" alt="{$d['title']}"/>
                {/foreach}
            {elseif $d['type'] == 'vimeo'}
                <iframe src="//player.vimeo.com/video/{$d['video']}?title=0&amp;byline=0&amp;portrait=0&amp;badge=0" width="800" height="450" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            {elseif $d['type'] == 'youtube'}
                <iframe width="800" height="450" src="//www.youtube.com/embed/{$d['video']}" frameborder="0" allowfullscreen></iframe>
            {/if}
            <p>{$d['description']}</p>
        {/foreach}
        <div id="nav_bar">
            <div>
            {if $previous_article}
                <a href="article.php?article_id={$previous_article}" id="previous">◄ <span>Previous article</span></a>
            {/if}
            </div>
            <div>
            {if $next_article}
                <a href="article.php?article_id={$next_article}" id="next"><span>Next article</span> ►</a>
            {/if}
            </div>
        </div>
    </div>
</div>
{/strip}