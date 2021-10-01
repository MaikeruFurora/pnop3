//-------------- add student walk in -------------
$("#btnModalStudent").on("click", function () {
    $("#staticBackdrop").modal("show");
});

$(".modalClose").on("click", function () {
    $("#staticBackdrop").modal("hide");
    document.getElementById("enrollForm").reset();
    $("input[name='roll_no']").removeClass("is-valid is-invalid");
});

$("#enrollForm").submit(function (e) {
    e.preventDefault();
    if ($("select[name='status']").val() != "nothing") {
        $.ajax({
            url: "enrollee/save",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $(".btnSaveEnroll")
                    .html(
                        `Saving ...
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`
                    )
                    .attr("disabled", true);
            },
        })
            .done(function (data) {
                if (data.warning) {
                    getToast("warning", "Warning", data.warning);
                } else {
                    getToast(
                        "success",
                        "Ok",
                        "Successfully added new enrolled"
                    );
                }
                // $("input[name='roll_no']").removeClass("is-valid");

                $(".btnSaveEnroll").html("Enroll").attr("disabled", false);
                document.getElementById("enrollForm").reset();
                setTimeout(() => {
                    monitorSection(
                        $("select[name='strand']").val(),
                        $("select[name='term']").val()
                    );
                }, 1500);
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $(".btnSaveEnroll").html("Enroll").attr("disabled", false);
            });
    } else {
        getToast(
            "warning",
            "Warning",
            "You must select student Status for verification"
        );
    }
});
