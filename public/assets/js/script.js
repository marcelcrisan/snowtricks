    /* simple scripts file for Themes.guide Bootstrap 4 theme templates */

    // init Bootstrap tooltips & popovers
    $("[data-toggle=popover]").popover();
    $("[data-toggle=tooltip]").tooltip();
    
    
    /* copy demo sources to clipboard */
    function copyTextToClipboard(text) {
      var textArea = document.createElement("textarea");
      textArea.style.position = 'fixed';
      textArea.style.top = 0;
      textArea.style.left = 0;
      textArea.style.width = '2em';
      textArea.style.height = '2em';
      textArea.style.padding = 0;
      textArea.style.border = 'none';
      textArea.style.outline = 'none';
      textArea.style.boxShadow = 'none';
      textArea.style.background = 'transparent';
      textArea.value = text;
      document.body.appendChild(textArea);
      textArea.select();
    
      try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Copying text command was ' + msg);
      } catch (err) {
        console.log('Oops, unable to copy');
      }
    
      document.body.removeChild(textArea);
      return false;
    }
    
    var modalCode       = $('<div id="modalCode" class="modal fade" />');
    var modalDialog     = $('<div class="modal-dialog modal-dialog-centered modal-lg" />');
    var modalContent    = $('<div class="modal-content" />');
    var modalHeader     = $('<div class="modal-header align-items-center"><h3 class="mb-0">Source Code</h3><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>');
    var modalBody       = $('<div class="modal-body d-block py-3"><span class="badge badge-dark font-weight-light mb-2">The following markup was copied to the clipboard...</span><textarea id="code" class="form-control" rows="10" wrap="off"></textarea></div>');
    modalHeader.appendTo(modalContent);
    modalBody.appendTo(modalContent);
    modalContent.appendTo(modalDialog);
    modalDialog.appendTo(modalCode);
    modalCode.appendTo('body');
    
    var css = ".copyable{position:relative}.copyable .copyable-trigger{color:#333;background-color:rgba(255,255,255,.8);border:1px #888 solid;border-radius:4px;position:absolute;padding:3px 6px;top:0;right:0;z-index:102;text-decoration:none;font-family:monospace;font-size:11px;cursor:pointer;display:none}.copyable:hover .copyable-trigger{display:inline-block}";
    
    $("head").append($(document.createElement("style"))
        .html(css)
    );
    
    $('main').find('.card, .btn-group, .btn, .navbar, .modal, .form-group, .list-group, .alert, .progress, .table-responsive, .jumbotron, .badge, .nav').each(function(){
        var $this = $(this);
        var content = $this.get(0).outerHTML;
        var arrayOfLines = content.match(/[^\r\n]+/g);
        var secondLine = 0;
        for (var l in arrayOfLines) {
            var tabCount;
            if (l>0) {
                tabCount = ((arrayOfLines[l]||'').match(/[\s{4}|\t{1}]\S/g)||[]).length;                
                if (l==1) { secondLine = tabCount }
                arrayOfLines[l] = arrayOfLines[l].replace(/\t{1}/g,'~');
                arrayOfLines[l] = arrayOfLines[l].replace(/\s{4}/g,'~');
                for (var i=0;i<secondLine+1;i++) {
                    arrayOfLines[l] = arrayOfLines[l].replace(/~/,'');
                }
                arrayOfLines[l] = arrayOfLines[l].replace(/~/g,'\t');
            }
        }
        content = arrayOfLines.join('\n');
        var title = "Click to view/copy source";

        $this.addClass("copyable");
        var trigger = $("<a href class='copyable-trigger'>&lt;&gt;</a>");
        $this.append(trigger);
        
        trigger.tooltip({
            title: title,
            placement: 'bottom',
            trigger: 'hover'
        });
        
        trigger.on('click',function(e){
            copyTextToClipboard(content);
            $("#code").text(content);
            $("#modalCode").modal('show');
            return false;
        });
    });

    function delete_trick(e)
    {
    
    confirm('Vous êtes sur(e) ?');
    
    }

    var $collectionHolderImage;

        var $addImageButton = $('<button type="button" class="add_image_link btn-create-trick btn btn-primary mr-2 copyable">Ajouter une image</button>');
        var $newLinkLiImage = $('<div></div>').append($addImageButton);

        jQuery(document).ready(function() {
            $collectionHolderImage = $('div.images-trick');
               // delete link image
            
            $collectionHolderImage.find('div').each(function() {
                addImageFormDeleteLink($(this));
            });

            $collectionHolderImage.append($newLinkLiImage);

            $collectionHolderImage.data('index', $collectionHolderImage.find(':input').length);

            $addImageButton.on('click', function(e) {
                addImageButton($collectionHolderImage, $newLinkLiImage);
            });
            
         
          

        });

        function addImageButton($collectionHolderImage, $newLinkLiImage) {
            var prototypeImage = $collectionHolderImage.data('prototype');

            var indexImage = $collectionHolderImage.data('index');

            var newFormImage = prototypeImage;

            newFormImage = newFormImage.replace(/__name__label__/g, indexImage);

            $collectionHolderImage.data('index', indexImage +1);

            var $newFormLiImage = $('<div></div>').append(newFormImage);
            $newLinkLiImage.before($newFormLiImage);
            addImageFormDeleteLink($newFormLiImage);
        }

        function addImageForm() {
            
        }

        function addImageFormDeleteLink($imageFormLi) {
            var $removeImageFormButton = $('<button type="button" class="btn btn-delete-trick btn-outline-secondary mr-2 copyable">Delete this Image</button>');
            $imageFormLi.append($removeImageFormButton);

            $removeImageFormButton.on('click', function(e) {
                $imageFormLi.remove();
            });
        }

        var $collectionHolderVideo;

        var $addVideoButton = $('<button type="button" class="add_video_link btn-create-trick btn btn-primary mr-2 copyable">Ajouter une Video</button>');
        var $newLinkLiVideo = $('<div></div>').append($addVideoButton);

        jQuery(document).ready(function() {
            $collectionHolderVideo = $('div.videos-trick');
               // delete link Video
            
            $collectionHolderVideo.find('div').each(function() {
                addVideoFormDeleteLink($(this));
            });

            $collectionHolderVideo.append($newLinkLiVideo);

            $collectionHolderVideo.data('index', $collectionHolderVideo.find(':input').length);

            $addVideoButton.on('click', function(e) {
                addVideoButton($collectionHolderVideo, $newLinkLiVideo);
            });
            
         
          

        });

        function addVideoButton($collectionHolderVideo, $newLinkLiVideo) {
            var prototypeVideo = $collectionHolderVideo.data('prototype');

            var indexVideo = $collectionHolderVideo.data('index');

            var newFormVideo = prototypeVideo;

            newFormVideo = newFormVideo.replace(/__name__label__/g, indexVideo);

            $collectionHolderVideo.data('index', indexVideo +1);

            var $newFormLiVideo = $('<div></div>').append(newFormVideo);
            $newLinkLiVideo.before($newFormLiVideo);
            addVideoFormDeleteLink($newFormLiVideo);
        }

        function addVideoForm() {
            
        }

        function addVideoFormDeleteLink($VideoFormLi) {
            var $removeVideoFormButton = $('<button type="button" class="btn btn-delete-trick btn-outline-secondary mr-2 copyable">Delete this Video</button>');
            $VideoFormLi.append($removeVideoFormButton);

            $removeVideoFormButton.on('click', function(e) {
                $VideoFormLi.remove();
            });
        }

    