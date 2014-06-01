{strip}
    <content>
        <h1>Edit / delete articles</h1>	
        <table style="margin:auto">
            <tr>
                <th>IMAGE</th>
                <th>TITLE</th>
                <th>EDIT</th>
                <th>DELETE</th>
            </tr>
            {foreach $data as $d}
                {if $d['article_type'] == 'image'}
                <form method="post" action="">
                    <tr>
                        <td>
                            <img src="uploader/server/php/files/{$d['id']}/thumbnail/{$d['file_name']}" alt="{$d['article_name']}" width="100"/>
                        </td>
                        <td>
                            {$d['article_name']}
                        </td>
                        <td>
                            <a id="update_{$d['id']}" class="button_type">
                                update
                            </a>
                        </td>
                        <td>
                            <a id="delete_{$d['id']}" class="button_type">
                                delete
                            </a>
                        </td>
                    </tr>
                </form>
                {elseif $d['article_type'] == 'vimeo' || $d['article_type'] == 'youtube'}
                <form method="post" action="">
                    <tr>
                        <td>
                            <img src="../video/{$d['id']}/{$d['id']}.jpg" alt="{$d['article_name']}" width="100"/>
                        </td>
                        <td>
                            {$d['article_name']}
                        </td>
                        <td>
                            <a id="update_{$d['id']}" class="button_type">
                                update
                            </a>
                        </td>
                        <td>
                            <a id="delete_{$d['id']}" class="button_type">
                                delete
                            </a>
                        </td>
                    </tr>
                </form>
                {/if}
            {/foreach}
        </table>
    </content> 
{/strip}