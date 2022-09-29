// Plugin JavaScript

jQuery(function () {
  jQuery("#ads_Image").on("click", function () {
    var images = wp
      .media({
        title: "Upload Image",
        multiple: false,
      })
      .open()
      .on("select", function (e) {
        var uploadedImages = images.state().get("selection").first();
        var selectedImages = uploadedImages.toJSON();

        jQuery("#getImage").attr("src", selectedImages.url);
        jQuery("#adsImage").val(selectedImages.url);
        // console.log(uploadedImages);
        // console.log("hello ");
        // console.log(
        //   selectedImages.title +
        //     "  " +
        //     selectedImages.url +
        //     "   " +
        //     selectedImages.filename
        // );

        /*selectedImages.map(function(image){
           var itemDetails = image.toJSON();
           console.log(itemDetails.url);
           });*/
      });
  });
});

console.log("Welcome to Plugin JS.");
