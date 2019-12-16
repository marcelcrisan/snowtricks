	/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
          x.className += " responsive";
        } else {
          x.className = "topnav";
        }
      }

    function deleteTrick(e)
    {
    
    confirm("Vous êtes sur(e) ?");
    
    }

    var $collectionHolderImage;

        var $addImageButton = $("<button type=\"button\" class=\"add_image_link btn-create-trick btn btn-primary mr-2 copyable\">Ajouter une image</button>");
        var $newLinkLiImage = $("<div></div>").append($addImageButton);

        function addImageFormDeleteLink($imageFormLi) {
            var $removeImageFormButton = $("<button type=\"button\" class=\"btn btn-delete-trick btn-outline-secondary mr-2 copyable\">Delete this Image</button>");
            $imageFormLi.append($removeImageFormButton);

            $removeImageFormButton.on("click", function(e) {
                $imageFormLi.remove();
            });
        }

        function addImageButton($collectionHolderImage, $newLinkLiImage) {
            var prototypeImage = $collectionHolderImage.data("prototype");

            var indexImage = $collectionHolderImage.data("index");

            var newFormImage = prototypeImage;

            newFormImage = newFormImage.replace(/__name__/g, indexImage);

            $collectionHolderImage.data("index", indexImage +1);

            var $newFormLiImage = $("<div></div>").append(newFormImage);
            $newLinkLiImage.before($newFormLiImage);
            addImageFormDeleteLink($newFormLiImage);
        }

        jQuery(document).ready(function() {
            $collectionHolderImage = $("div.images-trick");
               // delete link image
            
            $collectionHolderImage.find("div").each(function() {
                addImageFormDeleteLink($(this));
            });

            $collectionHolderImage.append($newLinkLiImage);

            $collectionHolderImage.data("index", $collectionHolderImage.find(":input").length);

            $addImageButton.on("click", function(e) {
                addImageButton($collectionHolderImage, $newLinkLiImage);
            });
        });
        
        function addImageForm() {
            
        }

        var $collectionHolderVideo;

        var $addVideoButton = $("<button type=\"button\" class=\"add_video_link btn-create-trick btn btn-primary mr-2 copyable\">Ajouter une Video</button>");
        var $newLinkLiVideo = $("<div></div>").append($addVideoButton);

        function addVideoFormDeleteLink($VideoFormLi) {
            var $removeVideoFormButton = $("<button type=\"button\" class=\"btn btn-delete-trick btn-outline-secondary mr-2 copyable\">Delete this Video</button>");
            $VideoFormLi.append($removeVideoFormButton);

            $removeVideoFormButton.on("click", function(e) {
                $VideoFormLi.remove();
            });
        }

        function addVideoButton($collectionHolderVideo, $newLinkLiVideo) {
            var prototypeVideo = $collectionHolderVideo.data("prototype");

            var indexVideo = $collectionHolderVideo.data("index");

            var newFormVideo = prototypeVideo;

            newFormVideo = newFormVideo.replace(/__name__/g, indexVideo);

            $collectionHolderVideo.data("index", indexVideo +1);

            var $newFormLiVideo = $("<div></div>").append(newFormVideo);
            $newLinkLiVideo.before($newFormLiVideo);
            addVideoFormDeleteLink($newFormLiVideo);
        }

        jQuery(document).ready(function() {
            $collectionHolderVideo = $("div.videos-trick");
               // delete link Video
            
            $collectionHolderVideo.find("div").each(function() {
                addVideoFormDeleteLink($(this));
            });

            $collectionHolderVideo.append($newLinkLiVideo);

            $collectionHolderVideo.data("index", $collectionHolderVideo.find(":input").length);

            $addVideoButton.on("click", function(e) {
                addVideoButton($collectionHolderVideo, $newLinkLiVideo);
            });
        });

        function addVideoForm() {
            
        }


    