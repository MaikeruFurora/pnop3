let cancelSubject = $(".cancelSubject").hide();
const subjectTable = (level) => {
    let htmlHold = "";
    let i = 1;
    $.ajax({
        url: `subject/list/${level}`,
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            $("#subjectTable").html(
                `<tr>
                        <td colspan="5" class="text-center">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </td>
                    </tr>
                    `
            );
        },
    })
        .done(function (data) {
            if (data.length > 0) {
                data.forEach((val) => {
                    htmlHold += `
                        <tr>
                            <td>
                                ${i++}
                            </td>
                            <td>
                                ${val.subject_code}
                            </td>
                            <td>
                                ${val.descriptive_title}
                            </td>
                            <td>
                                ${val.subject_for}
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                
                                   
                                    <button type="button" style="font-size:9px" class="btn btn-sm btn-info pb-2 pt-2 pl-3 pr-3 editSubject editSub_${
                                        val.id
                                                    }" id="${
                                        val.id
                                    }"><i class="fas fa-edit"></i></button>
                                    <button type="button" style="font-size:9px" class="btn btn-sm btn-danger pb-2 pt-2 pl-3 pr-3 deleteSubject deleteSub_${
                                                    val.id
                                                }" id="${
                                    val.id
                                    }"><i class="fas fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            } else {
                htmlHold = `
                            <tr>
                                <td colspan="5" class="text-center">No available data</td>
                            </tr>`;
            }
            $("#subjectTable").html(htmlHold);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
        });
};
subjectTable(7);
$("#subjectForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "subject/save",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $(".btnSaveSubject")
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
            $("#selectedGL").val($('select[name="grade_level"]').val());
            subjectTable($('select[name="grade_level"]').val());
            document.getElementById("subjectForm").reset();
            $("input[name='id']").val("");
            $(".btnSaveSubject").html("Submit").attr("disabled", false);
            cancelSubject.hide();
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSaveSubject").html("Submit").attr("disabled", false);
        });
});

$(".cancelSubject").on("click", function (e) {
    e.preventDefault();
    $(this).hide();
    document.getElementById("subjectForm").reset();
    $(".btnSaveSubject").html("Submit");
    $("input[name='id']").val("");
});

$("#selectedGL").on("change", function () {
    subjectTable($(this).val());
});

$('input[name="subject_code"]').on("blur", function () {
    if ($(this).val() != "") {
        $.ajax({
            url: `subject/check/${$(this).val()}/${$(
                'select[name="grade_level"]'
            ).val()}`,
            type: "GET",
        })
            .done(function (data) {
                if (data) {
                    getToast(
                        "warning",
                        "Warning",
                        "This subject is already added"
                    );
                    $('input[name="subject_code"]').addClass("is-invalid");
                } else {
                    $('input[name="subject_code"]').removeClass("is-invalid");
                }
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $(".btnSaveSubject").html("Submit").attr("disabled", false);
            });
    }
});

$(document).on("click", ".editSubject", function () {
    let id = $(this).attr("id");
    $.ajax({
        url: "subject/edit/" + id,
        type: "GET",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".editSec_" + id).html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
        },
    })
        .done(function (data) {
            cancelSubject.show();
            // console.log(data.id);
            $(".editSub_" + id).html(`<i class="fas fa-edit"></i>`);
            $(".btnSaveSubject").html("Update");
            $("input[name='id']").val(data.id);
            $("select[name='grade_level']").val(data.grade_level);
            $("input[name='subject_code']").val(data.subject_code);
            $("input[name='descriptive_title']").val(data.descriptive_title);
            $("select[name='subject_for']").val(data.subject_for);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});

$(document).on("click", ".deleteSubject", function () {
    let id = $(this).attr("id");
    $('.deleteYes').val(id)
    $("#teacherDeleteModal").modal("show");
   
});

$(".deleteYes").on('click', function () {
    $.ajax({
        url: "subject/delete/" + $(this).val(),
        type: "DELETE",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".deleteYes").html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
        },
    })
        .done(function (response) {
            $(".deleteYes").html("Yes");
            getToast("success", "Success", "deleted one record");
            subjectTable($("#selectedGL").val());
            $(this).val('')
            $("#teacherDeleteModal").modal("hide");
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
            $(".deleteYes").html("Yes");
        });
})

