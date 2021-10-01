$("#tableStudent").css("width", "100%");
let tableStudent = $("#tableStudent").DataTable({
    // lengthChange: false,
    responsive: true,
    pageLenth: 6,
    processing: true,
    language: {
        processing: `
                <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
              </div>`,
    },

    ajax: "assign/list/" + $("select[name='term']").val(),
    columns: [
        { data: "roll_no" },
        { data: "fullname" },
        {
            data: null,
            render: function (data) {
                return data.enroll_status == "Dropped"
                    ? `<span class="badge badge-danger">${data.enroll_status}</span>`
                    : `<span class="badge badge-success">${data.enroll_status}</span>`;
            },
        },
        {
            data: null,
            render: function (data) {
                return `<button type="button" class="btn btn-info enrolledSubjectBtn btn_${
                    data.stud_id
                } pt-1 pb-1 pl-2 pr-2" id="${data.stud_id}" value="${
                    data.fullname + `_` + data.roll_no + `_` + data.stud_id
                }">
                    Subject
                    </button>
                    `;
            },
        },
    ],
});

$("select[name='term']").on("change", function () {
    tableStudent.ajax.url("assign/list/" + $(this).val()).load();
    tableAssign($(this).val());
    $("select[name='term_assign']").val($(this).val());
});

// $(document).on("click", ".dropped", function () {
//     let id = $(this).attr("id");
//     $.ajax({
//         url: "monitor/dropped/" + id,
//         type: "POST",
//         data: { _token: $('input[name="_token"]').val() },
//         beforeSend: function () {
//             $(".btnDropped_" + id).html(`
//                 <div class="spinner-border spinner-border-sm" role="status">
//                     <span class="sr-only">Loading...</span>
//                 </div>`);
//         },
//     })
//         .done(function (response) {
//             $(".btnDropped_" + id).html("Delete");

//             getToast("info", "Done", "Change one record");
//             myClassTable.ajax.reload();
//         })
//         .fail(function (jqxHR, textStatus, errorThrown) {
//             console.log(jqxHR, textStatus, errorThrown);
//             getToast("error", "Eror", errorThrown);
//         });
// });

///////////////////////////////////////////////////////////////
let tableAssign = (term) => {
    let hold = "";
    $.ajax({
        url: "assign/list/subject/section/" + term,
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
            if (data.length == 0) {
                hold = `<tr>
                <td colspan="5" class="text-center">
                   No Data Available
                </td>
            </tr>`;
            } else {
                data.forEach((val) => {
                    hold += `
                    <tr>
                    <td>${i++}</td>
                    <td>${val.descriptive_title}</td>
                        <td>${val.teacher_name}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning sdelete deleteAssign btnDelete_${
                                val.id
                            }  pt-2 pb-2 pl-2 pr-2" id="${val.id}">
                            <i class="fas fa-user-times"></i>
                            </button>
                            &nbsp;&nbsp;
                            <button type="button" class="btn btn-sm btn-info editAssign  editA_${
                                val.id
                            } pt-2 pb-2 pl-2 pr-2" id="${val.id}">
                            <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                `;
                });
            }
            $("#tableAssign").html(hold);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};

tableAssign($('select[name="term"]').val());

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
                `<div class="spinner-border spinner-border-sm" role="status">
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
                $('input[name="id"]').val("");
                $("select[name='subject_id']").val(""); // Select the option with a value of '1'
                $("select[name='subject_id']").trigger("change"); // Notify any JS components that the value changed
                $("select[name='teacher_id']").val(""); // Select the option with a value of '1'
                $("select[name='teacher_id']").trigger("change"); // Notify any JS components that the value changed
                tableAssign($('select[name="term"]').val());
            }
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            $(".assignBtn").html("Save");
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
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
            $(".editA_" + id)
                .html(` <i class="fas fa-edit"></i>`)
                .attr("disabled", false);
            $(".btnSaveAssign").html("Update");
            $("input[name='id']").val(data.id);
            $("input[name='grade_level']").val(data.grade_level);
            $("select[name='term_assign']").val(data.term);
            $("select[name='subject_id']").val(data.subject_id);
            $("select[name='subject_id']").trigger("change");
            $("select[name='teacher_id']").val(data.teacher_id);
            $("select[name='teacher_id']").trigger("change");
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            $(".editA_" + id)
                .html(` <i class="fas fa-edit"></i>`)
                .attr("disabled", false);
            getToast("error", "Eror", errorThrown);
        });
});

$(".cancelNow").on("click", function (e) {
    e.preventDefault();
    document.getElementById("assignForm").reset();
    $(".assignBtn").html("Save");
    $("input[name='id']").val("");
    $("select[name='subject_id']").val(null).trigger("change");
    $("select[name='teacher_id']").val(null).trigger("change");
});

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
                tableAssign($('select[name="term"]').val());
                getToast("success", "Success", "deleted one record");
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
                getToast("error", "Eror", errorThrown);
            });
    } else {
        return false;
    }
});
