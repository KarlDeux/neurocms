{strip}
    <content>
        <h1>New article</h1>
        <div id="container_buttons" {if $article}style="display:none"{/if}>
            <p>
                <a id="click_video" class="button_type">
                    Submit a video
                </a>
                <a id="click_image" class="button_type">
                    Submit images
                </a>
            </p>
        </div>
        <div id="video_choose" {if $article[0]['type'] == "vimeo" || $article[0]['type'] == "youtube"}style="display:block"{/if}>
            <h2 {if $article[0]['type'] == "vimeo" || $article[0]['type'] == "youtube"}style="display:none"{/if}>Choose your video provider:</h2>
            <div id="button_vimeo" {if $article[0]['type'] == "vimeo" || $article[0]['type'] == "youtube"}style="display:none"{/if}>
                <img src="img/vimeo-logo.png"/>
            </div>
            <div id="button_youtube" {if $article[0]['type'] == "vimeo" || $article[0]['type'] == "youtube"}style="display:none"{/if}>
                <img src="img/youtube-logo.png"/>
            </div>
            <div id="vimeo" {if $article[0]['type'] == "vimeo"}style="display:block"{/if}>
                <h2>Copy the share URL here:</h2>
                <input id="vimeo_uri" type="text" {if $article[0]['video']}value="http://vimeo.com/{$article[0]['video']}"{/if}/>
                <img src="img/help-vimeo.png"/>
                <h2>Write a tittle for the article:</h2>
                <input id="vimeo_title" type="text" {if $article[0]['title']}value="{$article[0]['title']}"{/if}/>
                <h2>Write a description for the article:</h2>
                <textarea id="vimeo_description">
                    {if $article[0]['description']}{$article[0]['description']|replace:"<br />":"\n"}{/if}
                </textarea>
                <a {if $article[0]['type'] == "vimeo"}id="update_vimeo"{else}id="submit_vimeo"{/if} class="button_type">
                    Save the article
                </a>
            </div>
            <div id="youtube" {if $article[0]['type'] == "youtube"}style="display:block"{/if}>
                <h2>Copy the share URL here:</h2>
                <input id="youtube_uri" type="text" {if $article[0]['video']}value="http://youtu.be/{$article[0]['video']}"{/if}/>
                <img src="img/help-youtube.png"/>
                <h2>Write a tittle for the article:</h2>
                <input id="youtube_title" type="text" {if $article[0]['title']}value="{$article[0]['title']}"{/if}/>
                <h2>Write a description for the article:</h2>
                <textarea id="youtube_description">
                    {if $article[0]['description']}{$article[0]['description']|replace:"<br />":"\n"}{/if}
                </textarea>
                <a {if $article[0]['type'] == "youtube"}id="update_youtube"{else}id="submit_youtube"{/if} class="button_type">
                    Save the article
                </a>
            </div>
        </div>
        <div id="image_choose" {if $article[0]['type'] == "image"}style="display:block"{/if}>
            <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
                <!-- Redirect browsers with JavaScript disabled to the origin page -->
                <noscript><input type="hidden" name="redirect" value="http://blueimp.github.io/jQuery-File-Upload/"></noscript>
                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                <div class="row fileupload-buttonbar">
                    <div class="col-lg-7">
                        <!-- The fileinput-button span is used to style the file input field as button -->
                        <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Add files...</span>
                            <input type="file" name="files[]" multiple accept="image/*">
                        </span>
                        <button type="submit" class="btn btn-primary start">
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>Start upload</span>
                        </button>
                        <button type="reset" class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancel upload</span>
                        </button>
                        <button type="button" class="btn btn-danger delete">
                            <i class="glyphicon glyphicon-trash"></i>
                            <span>Delete</span>
                        </button>
                        <input type="checkbox" class="toggle">
                        <!-- The global file processing state -->
                        <span class="fileupload-process"></span>
                    </div>
                    <!-- The global progress state -->
                    <div class="col-lg-5 fileupload-progress fade">
                        <!-- The global progress bar -->
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                        </div>
                        <!-- The extended global progress state -->
                        <div class="progress-extended">&nbsp;</div>
                    </div>
                </div>
                <input type="hidden" id="folder" name="folder" value="{$article_id}">
                <!-- The table listing the files available for upload/download -->
                <table role="presentation" class="table"><tbody class="files"></tbody></table>
            </form>
            <!-- The blueimp Gallery widget -->
            <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                <div class="slides"></div>
                <h3 class="title"></h3>
                <a class="prev">‹</a>
                <a class="next">›</a>
                <a class="close">×</a>
                <a class="play-pause"></a>
                <ol class="indicator"></ol>
            </div>
            <!-- The template to display files available for upload -->
            <script id="template-upload" type="text/x-tmpl">
                {ldelim}% for (var i=0, file; file=o.files[i]; i++) {ldelim} %{rdelim}
                <tr class="template-upload fade">
                <td>
                <span class="preview"></span>
                </td>
                <td>
                <p class="name">{ldelim}%=file.name%{rdelim}</p>
                <strong class="error text-danger"></strong>
                </td>
                <td>
                <p class="size">Processing...</p>
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                </td>
                <td>
                {ldelim}% if (!i && !o.options.autoUpload) {ldelim} %{rdelim}
                <button class="btn btn-primary start" disabled>
                <i class="glyphicon glyphicon-upload"></i>
                <span>Start</span>
                </button>
                {ldelim}% } %{rdelim}
                {ldelim}% if (!i) {ldelim} %{rdelim}
                <button class="btn btn-warning cancel">
                <i class="glyphicon glyphicon-ban-circle"></i>
                <span>Cancel</span>
                </button>
                {ldelim}% } %{rdelim}
                </td>
                </tr>
                {ldelim}% } %{rdelim}
            </script>
            <!-- The template to display files available for download -->
            <script id="template-download" type="text/x-tmpl">
                {ldelim}% for (var i=0, file; file=o.files[i]; i++) {ldelim} %{rdelim}
                <tr class="template-download fade">
                <td>
                <span class="preview">
                {ldelim}% if (file.thumbnailUrl) {ldelim} %{rdelim}
                <a href="{ldelim}%=file.url%{rdelim}" title="{ldelim}%=file.name%{rdelim}" download="{ldelim}%=file.name%{rdelim}" data-gallery><img width="100" src="{ldelim}%=file.thumbnailUrl%{rdelim}"></a>
                {ldelim}% } %{rdelim}
                </span>
                </td>
                <td>
                <p class="name">
                {ldelim}% if (file.url) {ldelim} %{rdelim}
                <a href="{ldelim}%=file.url%{rdelim}" title="{ldelim}%=file.name%{rdelim}" download="{ldelim}%=file.name%{rdelim}" {ldelim}%=file.thumbnailUrl?'data-gallery':''%{rdelim}>{ldelim}%=file.name%{rdelim}</a>
                {ldelim}% } else {ldelim} %{rdelim}
                <span>{ldelim}%=file.name%{rdelim}</span>
                {ldelim}% } %{rdelim}
                </p>
                <p class="default">
                    {ldelim}% if (file.url) {ldelim} %{rdelim}
                    <input id="{ldelim}%=file.name%{rdelim}" type="radio" value="{ldelim}%=file.name%{rdelim}" name="radio-input">
                    <label for="{ldelim}%=file.name%{rdelim}">Set as default</label>
                    {ldelim}% } else {ldelim} %{rdelim}
                    {ldelim}% } %{rdelim}
                </p>
                {ldelim}% if (file.error) {ldelim} %{rdelim}
                <div><span class="label label-danger">Error</span> {ldelim}%=file.error%{rdelim}</div>
                {ldelim}% } %{rdelim}
                </td>
                <td class="col_size">
                <span class="size">{ldelim}%=o.formatFileSize(file.size)%{rdelim}</span>
                </td>
                <td>
                {ldelim}% if (file.deleteUrl) {ldelim} %{rdelim}
                <button class="btn btn-danger delete" data-type="{ldelim}%=file.deleteType%{rdelim}" data-url="{ldelim}%=file.deleteUrl%{rdelim}"{ldelim}% if (file.deleteWithCredentials) {ldelim} %{rdelim} data-xhr-fields='{ldelim}"withCredentials":true}'{ldelim}% } %{rdelim}>
                <i class="glyphicon glyphicon-trash"></i>
                <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
                {ldelim}% } else {ldelim} %{rdelim}
                <button class="btn btn-warning cancel">
                <i class="glyphicon glyphicon-ban-circle"></i>
                <span>Cancel</span>
                </button>
                {ldelim}% } %{rdelim}
                </td>
                </tr>
                {ldelim}% } %{rdelim}
            </script>
            <div id="image">
                <h2>Write a tittle for the article:</h2>
                <input id="image_title" type="text" {if $article[0]['title']}value="{$article[0]['title']}"{/if}/>
                <h2>Write a description for the article:</h2>
                <textarea id="image_description">
                    {if $article[0]['description']}{$article[0]['description']|replace:"<br />":"\n"}{/if}
                </textarea>
                <a {if $article[0]['type'] == "image"}id="update_image"{else}id="submit_image"{/if} class="button_type">
                    Save the article
                </a>
            </div>
        </div>
    </content> 
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" type="text/css"/>
{/strip}