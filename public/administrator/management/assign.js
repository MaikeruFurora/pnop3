let cancelAssign = $(".cancelAssign").hide();

let searchBySection = (grade_level) => {
    let sectionHTML = "";
    $.ajax({
        url: `assign/search/section/${grade_level}`,
        type: "GET",
        dataType: "json",
    })
        .done(function (data) {
            sectionHTML += `<option></option>`;
            if (data.warning) {
                getToast("warning", "Warning", data.warning);
            } else {
                data.forEach((element) => {
                    sectionHTML += `<option value="${element.id}">${element.section_name}</option>`;
                });
                $("select[name='section_id']").html(sectionHTML);
            }
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};
$("select[name='grade_level']").on("change", function () {
    searchBySection($(this).val());
    $("select[name='teacher_id']").val(null).trigger("change");
});
searchBySection(7);
let searhBySubject = (section, action) => {
    let subjectHTML = "";
    $.ajax({
        url: `assign/search/subject/${section}/${action}`,
        type: "GET",
        dataType: "json",
    })
        .done(function (data) {
            subjectHTML += `<option></option>`;
            data.forEach((element) => {
                subjectHTML += `<option value="${element.id}">${
                    "[ " +
                    element.subject_for +
                    " ] " +
                    element.subject_code +
                    " - " +
                    element.descriptive_title
                }</option>`;
            });
            $("select[name='subject_id']").html(subjectHTML);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};
$("select[name='section_id']").on("change", function () {
    if ($(this).val() != "") {
        searhBySubject($(this).val(), "adding");
    }
});

let showSectionList = (grade_level) => {
    let htmlHold = "";
    $.ajax({
        url: `search/${grade_level}`,
        type: "GET",
    })
        .done(function (data) {
            htmlHold += ` <option></option>`;
            if (data.warning) {
                getToast("warning", "Warning", data.warning);
            } else {
                data.forEach((element) => {
                    htmlHold += `<option value="${element.id}">${element.section_name}</option>`;
                });
            }
            $('select[name="showSection"]').html(htmlHold);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};
$('select[name="grade_level_top"]').on("change", function () {
    if ($(this).val() != "") {
        showSectionList($(this).val());
    }
});

$(".cancelAssign").on("click", function (e) {
    e.preventDefault();
    $(this).hide();
    document.getElementById("AssignForm").reset();
    $(".btnSaveAssign").html("Submit");
    $("input[name='id']").val("");
    $("input[type=checkbox]").attr("checked", false);
    $("select[name='section_id']").val(null).trigger("change");
    $("select[name='subject_id']").val(null).trigger("change");
    $("select[name='teacher_id']").val(null).trigger("change");
});

$("#AssignForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "assign/save",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $(".btnSaveAssign")
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
            $(".btnSaveAssign").html("Submit").attr("disabled", false);
            if ($("input[name='id']").val() != "") {
                loadTableSchedule($('select[name="showSection"]').val());
            }

            if ($('select[name="showSection"]').val() != "") {
                loadTableSchedule($('select[name="showSection"]').val());
            }
            if (!data.errSubject) {
                cancelAssign.hide();

                document.getElementById("AssignForm").reset();
                $('select[name="grade_level"]').val(
                    $('select[name="grade_level_top"]').val() != ""
                        ? $('select[name="grade_level_top"]').val()
                        : "7"
                );
                $("input[name='id']").val("");
                $("select[name='section_id']").val(null).trigger("change");
                $("select[name='subject_id']").val(null).trigger("change");
                $("select[name='teacher_id']").val(null).trigger("change");
                getToast("info", "New", "Successfully saved");
            }

            if (data.errSubject) {
                getToast("warning", "Warning", data.errSubject);
            }
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSaveAssign").html("Submit").attr("disabled", false);
        });
});

let loadTableSchedule = (section) => {
    let loadTableHTML = "";
    let i = 1;
    $.ajax({
        url: `assign/list/${section}`,
        type: "GET",
        beforeSend: function () {
            $("#assignTable").html(
                `<tr>
                        <td colspan="7" class="text-center">
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
                    loadTableHTML += `
                    <tr>
                        <td>
                        ${i++}
                        <td>
                        ${val.subject_code}
                        </td>
                        <td>
                        ${val.descriptive_title}
                        </td>
                        </td>
                        <td>
                        ${val.teacher_lastname},
                        ${val.teacher_firstname} 
                        ${val.teacher_middlename}
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" style="font-size:9px" class="btn btn-sm btn-info pl-3 pr-3 editAssign editA${
                                    val.id
                                }" id="${val.id}">Edit</button>
                                <button type="button" style="font-size:9px" class="btn btn-sm btn-danger pl-2 pr-2 deleteAssign deleteA${
                                    val.id
                                }" id="${val.id}">Delete</button>
                            </div>
                        </td>
                    </tr>
                    `;
                });
            } else {
                loadTableHTML = `
                                <tr>
                                    <td colspan="7" class="text-center">No available data</td>
                                </tr>
                                `;
            }

            $("#assignTable").html(loadTableHTML);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};

$('select[name="showSection"]').on("change", function () {
    loadTableSchedule($(this).val());
});

$(document).on("click", ".editAssign", function () {
    let id = $(this).attr("id");
    $.ajax({
        url: "assign/edit/" + id,
        type: "GET",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".editA" + id)
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
            cancelAssign.show();
            $(".editA" + id)
                .html("Edit")
                .attr("disabled", false);
            $(".btnSaveAssign").html("Update");
            $("input[name='id']").val(data.id);
            $("select[name='grade_level']").val(data.grade_level);
            $("select[name='section_id']").val(data.section_id);
            $("select[name='section_id']").trigger("change"); // Notify any JS components that the value changed

            searhBySubject(data.section_id, "editing");
            setTimeout(() => {
                $("select[name='subject_id']").val(data.subject_id);
                $("select[name='subject_id']").trigger("change"); // Notify any JS components that the value changed
            }, 400);

            $("select[name='class_type']").val(data.class_type);
            $("select[name='teacher_id']").val(data.teacher_id); // Select the option with a value of '1'
            $("select[name='teacher_id']").trigger("change"); // Notify any JS components that the value changed
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            $(".editA" + id)
                .html("Edit")
                .attr("disabled", false);
            getToast("error", "Eror", errorThrown);
        });
});

$(document).on("click", ".deleteAssign", function () {
    let id = $(this).attr("id");
    $.ajax({
        url: `assign/delete/${id}`,
        type: "DELETE",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".deleteA" + id)
                .html(
                    `
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`
                )
                .attr("disabled", true);
        },
    })
        .done(function (response) {
            $(".deleteA" + id)
                .html("Delete")
                .attr("disabled", false);
            getToast("success", "Success", "deleted one record");
            loadTableSchedule($('select[name="showSection"]').val());
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            $(".deleteA" + id)
                .html("Delete")
                .attr("disabled", false);
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});
