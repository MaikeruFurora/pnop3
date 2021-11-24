let cancelchairman = $(".cancelchairman").hide();
const chairmanTable = () => {
    let htmlHold = "";
    let i = 1;
    $.ajax({
        url: `chairman/list`,
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            $("#chairmanTable").html(
                `<tr>
                        <td colspan="4" class="text-center">
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
            if (data.error) {
                getToast("warning", "Warning", data.error);
            } else {
                if (data.length > 0) {
                    data.sort(function (a, b) {
                        return a.grade_level - b.grade_level;
                    });
                    console.log(data);
                    data.forEach((val) => {
                        htmlHold += `
                            <tr>
                                <td>
                                    ${i++}
                                </td>
                                <td>
                                    ${val.grade_level}
                                </td>
                                <td>
                                    ${val.teacher_lastname},
                                    ${val.teacher_firstname}
                                    ${val.teacher_middlename}
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" style="font-size:9px" class="btn btn-sm btn-info pl-3 pr-3 editchairman editCha_${
                                            val.id
                                            }" id="${val.id}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" style="font-size:9px" class="btn btn-sm btn-danger pl-3 pr-3 deletechairman deleteCha_${
                                            val.id
                                            }" id="${val.id}">
                                            <i class="fas fa-user-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    htmlHold = `
                                <tr>
                                    <td colspan="4" class="text-center">No available data</td>
                                </tr>`;
                }
            }

            $("#chairmanTable").html(htmlHold);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
        });
};
chairmanTable(7);
$("#chairmanForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "chairman/save",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $(".btnSavechairman")
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
            $(".btnSavechairman").html("Submit").attr("disabled", false);
            if (data.error) {
                getToast("warning", "Warning", data.error);
                $("select[name='teacher_id']").val(data.currentTeacherID); // Select the option with a value of '1'
                $("select[name='teacher_id']").trigger("change"); // Notify any JS components that the value changed
            } else {
                cancelchairman.hide();
                document.getElementById("chairmanForm").reset();
                $("input[name='id']").val("");
                $("select[name='teacher_id']").val(null).trigger("change");
                chairmanTable();
            }
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSavechairman").html("Submit").attr("disabled", false);
        });
});

$(document).on("click", ".editchairman", function () {
    let id = $(this).attr("id");
    $.ajax({
        url: "chairman/edit/" + id,
        type: "GET",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".editCha_" + id).html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
        },
    })
        .done(function (data) {
            cancelchairman.show();
            // console.log(data.id);
            $(".editCha_" + id).html("Edit");
            $(".btnSavechairman").html("Update");
            $("input[name='id']").val(data.id);
            $("select[name='grade_level']").val(data.grade_level);
            $("input[name='chairman_name']").val(data.chairman_name);
            $("select[name='teacher_id']").val(data.teacher_id); // Select the option with a value of '1'
            $("select[name='teacher_id']").trigger("change"); // Notify any JS components that the value changed
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});

$(".cancelchairman").on("click", function (e) {
    e.preventDefault();
    $(this).hide();
    document.getElementById("chairmanForm").reset();
    $(".btnSavechairman").html("Submit");
    $("input[name='id']").val("");
    $("select[name='teacher_id']").val(null).trigger("change");
});

$(document).on("click", ".deletechairman", function () {
    let id = $(this).attr("id");
    $('.deleteYes').val(id)
    $("#teacherDeleteModal").modal("show");
});


$(".deleteYes").on('click', function () {
    $.ajax({
        url: "chairman/delete/" + $(this).val(),
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
            chairmanTable();
            $(this).val('')
            $("#teacherDeleteModal").modal("hide");
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
            $(".deleteYes").html("Yes");

        });
})
