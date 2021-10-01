let tableAssign = (section) => {
    let hold = "";
    $.ajax({
        url: "assign/list/" + section,
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            $("#tableAssign").html(
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
            let i = 1;
            data.forEach((val) => {
                hold += `
                <tr>
                <td>${i++}</td>
                <td>${val.descriptive_title}</td>
                    <td>${val.teacher_name}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning sdelete deleteAssign btnDelete_${
                            val.id
                        }  pt-0 pb-0 pl-2 pr-2" id="${val.id}">
                        <i class="fas fa-user-times"></i>
                        </button>
                        &nbsp;&nbsp;
                        <button type="button" class="btn btn-sm btn-info editAssign  editA_${
                            val.id
                        } pt-0 pb-0 pl-2 pr-2" id="${val.id}">
                        <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
            `;
            });
            $("#tableAssign").html(hold);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};

tableAssign($('input[name="section_id"]').val());

$("#assignForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "assign/save",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $(".assignBtn").html(
                `Saving...  <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
                    `
            );
        },
    })
        .done(function (data) {
            $(".assignBtn").html("Save");

            if (data.warning) {
                getToast("warning", "Warning", data.warning);
            } else {
                cancelNow.hide();
                tableAssign($('input[name="section_id"]').val());
                $('input[name="id"]').val("");
                $('select[name="subject_id"]').val("");
                $("select[name='teacher_id']").val(data.currentTeacherID); // Select the option with a value of '1'
                $("select[name='teacher_id']").trigger("change"); // Notify any JS components that the value changed
            }
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            $(".assignBtn").html("Save");
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});

let cancelNow = $(".cancelNow").hide();

$(document).on("click", ".deleteAssign", function () {
    let id = $(this).attr("id");
    if (confirm("Are you sure you want to delete this?")) {
        $.ajax({
            url: "assign/delete/" + id,
            type: "DELETE",
            data: { _token: $('input[name="_token"]').val() },
            beforeSend: function () {
                $(".btnDelete_" + id).html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
            },
        })
            .done(function (response) {
                tableAssign($('input[name="section_id"]').val());
                getToast("success", "Success", "deleted one record");
                subjectTable($("#selectedGL").val());
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
                getToast("error", "Eror", errorThrown);
            });
    } else {
        return false;
    }
});

$(document).on("click", ".editAssign", function () {
    let id = $(this).attr("id");
    $.ajax({
        url: "assign/edit/" + id,
        type: "GET",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".editA_" + id)
                .html(
                    `
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`
                )
                .attr("disabled", true);
        },
    })
        .done(function (data) {
            cancelNow.show();
            $(".editA_" + id)
                .html(` <i class="fas fa-edit"></i>`)
                .attr("disabled", false);
            $(".btnSaveAssign").html("Update");
            $("input[name='id']").val(data.id);
            $("input[name='grade_level']").val(data.grade_level);
            $("select[name='subject_id']").val(data.subject_id);
            $("select[name='teacher_id']").val(data.teacher_id); // Select the option with a value of '1'
            $("select[name='teacher_id']").trigger("change"); // Notify any JS components that the value changed
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            $(".editA_" + id)
                .html(` <i class="fas fa-edit"></i>`)
                .attr("disabled", false);
            getToast("error", "Eror", errorThrown);
        });
});

$(".cancelNow").on("click", function (e) {
    e.preventDefault();
    $(this).hide();
    document.getElementById("assignForm").reset();
    $(".assignBtn").html("Submit");
    $("input[name='id']").val("");
    $("select[name='subject_id']").val("");
    $("select[name='teacher_id']").val(null).trigger("change");
});
