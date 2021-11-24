let CheckandVerify = () => {
    $.ajax({
        url: "check/subject/balance/" + $("input[name='student_id']").val(),
        type: "GET",
    })
        .done(function (data) {
            console.log(data);
            if (parseInt(data) != 0) {
                $(".noteTxt").text("Your grade is not yet complete");
                $(".btnCheckandVerify").hide();
                $(".btnCheckandVerify").attr("disabled", true);
            }
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};

CheckandVerify();

$(".promptModal").on('click', function () {
    $("#staticBackdrop").modal("show");
})

$(".btnCheckandVerify").on("click", function () {

    $.ajax({
        url: "self/enroll",
        type: "POST",
        data: {
            id: $("input[name='student_id']").val(),
            _token: $('input[name="_token"]').val(),
        },
        beforeSend: function () {
            $(".btnCheckandVerify")
                .html(
                    `Processing ...
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`
                )
                .attr("disabled", true);
        },
    })
        .done(function (data) {
            // console.log(data);
            window.location.reload();
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});
