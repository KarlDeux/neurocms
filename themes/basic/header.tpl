{*
*  @author      Neurotix
*  @copyright   2013-2014
*  @version     0.1
*  @license     All rights reserved.
*}
{strip}
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <title>{$meta_title|truncate:50}</title>
        {if isset($meta_description) AND $meta_description}
        <meta name="description" content="{$meta_description|truncate:155}" />
        {/if}
        {if isset($meta_keywords) AND $meta_keywords}
        <meta name="keywords" content="{$meta_keywords|escape:html:'UTF-8'}" />
        {/if}
        <meta charset="UTF-8"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="author" content="neurotix" />
        <meta name="revisit-after" content="2 days" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link rel="icon" type="image/vnd.microsoft.icon" href="{$img_theme_dir}favicon.ico?" />
        <link rel="shortcut icon" type="image/x-icon" href="{$img_theme_dir}favicon.ico" />
        <style>{$css}</style>
    </head>
    <body {if $page_name}id="{$page_name|escape:'htmlall':'UTF-8'}"{/if}>
        <div class="container">
            <a href="{$base_uri}">
                <div class="cbp-af-header">
                    <div class="cbp-af-inner">
                        <h1>Alejandro Albarracín</h1>
                    </div>
                </div>
            </a>