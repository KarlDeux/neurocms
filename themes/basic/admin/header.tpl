{*
*  @author      Neurotix
*  @copyright   2013-2014
*  @version     0.1
*  @license     All rights reserved.
*}
{strip}
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Backoffice</title>
        <meta name="viewport" content="width=device-width,user-scalable=no"> 
        <meta name="description" content="A sidebar menu as seen on the Google Nexus 7 website" />
        <meta name="keywords" content="google nexus 7 menu, css transitions, sidebar, side menu, slide out menu" />
        <link rel="shortcut icon" href="../favicon.ico">
        <style>{$css}</style>
        <script src="js/modernizr.custom.63321.js"></script>
    </head>
    <body id="{$page_name|replace:".php":""}">
        <div class="container">
            <ul id="gn-menu" class="gn-menu-main">
                <li class="gn-trigger">
                    <a class="gn-icon gn-icon-menu"><span>Menu</span></a>
                    <nav class="gn-menu-wrapper">
                        <div class="gn-scroller">
                            <ul class="gn-menu">
                                <li>
                                    <a class="gn-icon gn-icon-download" href="new-article.php">New article</a>
                                </li>
                                <li>
                                    <a class="gn-icon gn-icon-archive" href="edit-delete-articles.php">Edit / Remove article</a>
                                </li>
                                <li>
                                    <a class="gn-icon gn-icon-help" href="help.php">Help</a>
                                </li>
                                <li>
                                    <a class="gn-icon gn-icon-cog" href="settings.php">Settings</a>
                                </li>
                                <li>
                                    <a class="gn-icon gn-icon-cog" href="logout.php">Logout</a>
                                </li>
                            </ul>
                        </div><!-- /gn-scroller -->
                    </nav>
                </li>
                <li><a class="codrops-icon codrops-icon-prev" href="{$admin_uri}"><span>Home</span></a></li>
                <li><a class="codrops-icon codrops-icon-drop" href="{$site_uri}"><span>{$site_title}</span></a></li>
            </ul>
{/strip}