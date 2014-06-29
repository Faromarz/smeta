var FormDropzone = function () {
    return {
        //main function to initiate the module
        init: function () {  

            Dropzone.options.myDropzone = {
                createImageThumbnails: false,
                previewsContainer: ".dropzone-previews",
                maxFiles: 1,
                init: function() {
                    this.on("addedfile", function(file) {
                        // Create the remove button
//                        var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-block'>Удалить файл</button>");
                        
                        // Capture the Dropzone instance as closure.
                        var _this = this;
                        $(_this.element).find('img:first').remove();
                        $(_this.element).prepend(file.name);
                        // Listen to the click event
//                        removeButton.addEventListener("click", function(e) {
//                          // Make sure the button click doesn't submit the form:
//                          e.preventDefault();
//                          e.stopPropagation();
//
//                          // Remove the file preview.
//                          _this.removeFile(file);
//                          // If you want to the delete the file on the server as well,
//                          // you can do the AJAX request here.
//                        });
//
//                        // Add the button to the file preview element.
//                        file.previewElement.appendChild(removeButton);
                    });
                },
                complete: function(){
                    $('.admin-img-hover').hover(
                        function() {
                          $('body').append( $('<div style="text-align:canter;position: fixed;top: 50%;left: 50%;margin-top: -100px;width: 200px;height: 200px;margin-left: -100px;"><img wigth="100%" src="'+$(this).attr('src')+'"></div>'));
                        }, function() {
                          $('body').find( "div:last" ).remove();
                        }
                    );
                }
            };
        }
    };
}();
