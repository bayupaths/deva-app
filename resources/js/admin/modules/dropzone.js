import Dropzone from "dropzone";

let myDropzone = new Dropzone("#my-dropzone", {
    paramName: "file",
    maxFilesize: 2,
    addRemoveLinks: true,
    acceptedFiles: "image/*",
    previewTemplate: document.getElementById("preview-template").innerHTML,
    init: function () {
        this.on("complete", function (file) {
            this.removeFile(file);
        });
    },
});
