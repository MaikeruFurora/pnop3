$.uploadPreview({
    input_field: "#image-upload", // Default: .image-upload
    preview_box: "#image-preview", // Default: .image-preview
    label_field: "#image-label", // Default: .image-label
    label_default: "Choose File", // Default: Choose File
    label_selected: "Change File", // Default: Change File
    no_label: false, // Default: false
    success_callback: null, // Default: null
});

$("#schooProfileForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "profile/save",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $("#btnSaveSP")
                .html(
                    `Saving ...
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`
                )
                .attr("disabled", true);
        },
    })
        .done(function (response) {
            $("#btnSaveSP").html("Save Changes").attr("disabled", false);
            getToast("success", "Success", "Successfully added new teacher");
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});
