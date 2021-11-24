let CheckandVerify = () => {
    $.ajax({
        url: "check/subject/balance/" + $("input[name='student_id']").val(),
        type: "GET",
    })
        .done(function (data) {
            console.log(data);
            if (parseInt(data) != 0) {
                $(".noteTxt").text("Your grade is not yet complete");
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
    let first_grade_level = $("select[name='first_term_grade_level']").val();
    let second_grade_level = $("select[name='second_term_grade_level']").val();
    let second_section_id = $("select[name='second_term_section_id']").val();
    if (first_grade_level=='' || second_grade_level=='') {
        // $("#staticBackdrop").modal("hide");
        $(".showmessage").text('Please select grade level to enroll')
    } else {
        let grade_level = first_grade_level ?? second_grade_level;
         $.ajax({
            url: "self/enroll",
            type: "POST",
             data: {
                second_section_id,
                grade_level,
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
                console.log(data);
                window.location.reload();
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
                getToast("error", "Eror", errorThrown);
            });
    }
   
});
