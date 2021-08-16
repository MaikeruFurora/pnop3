let cancelSchedule = $(".cancelSchedule").hide();
let sched_toHTML = "";
const myTime = [
    "7:00 am",
    "7:30 am",
    "8:00 am",
    "8:30 am",
    "9:00 am",
    "9:30 am",
    "10:00 am",
    "10:30 am",
    "11:00 am",
    "11:30 am",
    "12:00 pm",
    "12:30 pm",
    "1:00 pm",
    "1:30 pm",
    "2:00 pm",
    "2:30 pm",
    "3:00 pm",
    "3:30 pm",
    "4:00 pm",
    "4:30 pm",
    "5:00 pm",
];
let myOptionList = (stype) => {
    let htmlHold = "";
    $.ajax({
        url: `search/type/${stype}`,
        type: "GET",
    })
        .done(function (data) {
            htmlHold += ` <option></option>`;
            switch (stype) {
                case "section":
                    data.forEach((element) => {
                        htmlHold += `<option value="${element.id}">${element.section_name}</option>`;
                    });
                    break;
                case "teacher":
                    data.forEach((element) => {
                        htmlHold += `<option value="${element.id}">${element.teacher_lastname},${element.teacher_firstname} ${element.teacher_middlename} </option>`;
                    });
                    break;
                default:
                    break;
            }
            $("#mySelect2").html(htmlHold);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};

$('select[name="search_type"]').on("change", function () {
    if ($(this).val() != "") {
        myOptionList($(this).val());
    }
});

let searchBySection = (grade_level) => {
    let sectionHTML = "";
    $.ajax({
        url: `search/section/${grade_level}`,
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
            }
            $("select[name='section_id']").html(sectionHTML);
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
let searhBySubject = (section) => {
    let subjectHTML = "";
    $.ajax({
        url: `search/subject/${section}`,
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
        searhBySubject($(this).val());
    }
});

$("#scheduleForm").submit(function (e) {
    e.preventDefault();
    let countCheckBoxAreChecked = $(
        "#scheduleForm input[type=checkbox]:checked"
    ).is(":checked");
    if (countCheckBoxAreChecked) {
        $.ajax({
            url: "schedule/save",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $(".btnSaveSchedule")
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
                $(".btnSaveSchedule").html("Submit").attr("disabled", false);
                if (!(data.errSubject || data.errTime)) {
                    cancelSchedule.hide();
                    document.getElementById("scheduleForm").reset();
                    $("#selectedGL").val($('select[name="grade_level"]').val());
                    $("input[name='id']").val("");
                    $("select[name='section_id']").val(null).trigger("change");
                    $("select[name='subject_id']").val(null).trigger("change");
                    $("select[name='teacher_id']").val(null).trigger("change");
                    $("select[name='sched_from']")
                        .find(":selected")
                        .val("7:00 am");
                    $("select[name='sched_to']")
                        .find(":selected")
                        .val("8:00 am");
                    $("input[type='checkbox']").attr("checked", false);
                    nextTime(myTime, "7:00 am");
                    if ($("select[name='search_type']").val() != "") {
                        loadTableSchedule(
                            $("select[name='search_type']")
                                .find(":selected")
                                .val(),
                            $("select[name='exactValue']").val()
                        );
                    }
                }

                if (data.errSubject) {
                    getToast("warning", "Warning", data.errSubject);
                }

                if (data.errTime) {
                    getToast("warning", "Warning", data.errTime);
                }
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $(".btnSaveSchedule").html("Submit").attr("disabled", false);
            });
    } else {
        getToast("warning", "Warning", "Please select day(s) at least one! ");
    }
});

let sched_fromHTML = "";

myTime.forEach((element) => {
    sched_fromHTML += `<option value="${element}">${element}</option>`;
});
$("select[name='sched_from']").html(sched_fromHTML);

//
let nextTime = (arrTime = [], value) => {
    let cloneArr = arrTime.slice(0);
    const index = cloneArr.findIndex((val) => {
        return val == value;
    });
    cloneArr.splice(index + 1).forEach((element, i) => {
        sched_toHTML += `<option  value="${element}" ${
            i == 1 ? `selected` : ``
        }>${element}</option>`;
    });

    $("select[name='sched_to']").html(sched_toHTML);
};
nextTime(myTime, "7:00 am");
$("select[name='sched_from']").on("change", function () {
    nextTime(myTime, $(this).val());
});

let loadTableSchedule = (stype, value) => {
    let loadTableHTML = "";
    let i = 1;
    $.ajax({
        url: `schedule/list/${stype}/${value}`,
        type: "GET",
        beforeSend: function () {
            $("#scheduleTable").html(
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
                        ${val.section_name}
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
                            ${
                                val.monday
                                    ? `<span class="badge badge-info pt-1 pb-1 pl-2 mt-1 pr-2">Mon</span>`
                                    : ""
                            }
                            ${
                                val.tuesday
                                    ? `<span class="badge badge-info pt-1 pb-1 pl-2 mt-1 pr-2">Tue</span>`
                                    : ""
                            }
                            ${
                                val.wednesday
                                    ? `<span class="badge badge-info pt-1 pb-1 pl-2 mt-1 pr-2">Wed</span>`
                                    : ""
                            }
                            ${
                                val.thursday
                                    ? `<span class="badge badge-info pt-1 pb-1 pl-2 mt-1 pr-2">Thu</span>`
                                    : ""
                            }
                            ${
                                val.friday
                                    ? `<span class="badge badge-info pt-1 pb-1 pl-2 mt-1 pr-2">Fri</span>`
                                    : ""
                            }
                        </td>
                        <td>
                            ${val.sched_from} - 
                            ${val.sched_to}
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" style="font-size:9px" class="btn btn-sm btn-info pl-3 pr-3 editSchedule editSched_${
                                    val.id
                                }" id="${val.id}">Edit</button>
                                <button type="button" style="font-size:9px" class="btn btn-sm btn-danger pl-2 pr-2 deleteSchedule deleteSched_${
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

            $("#scheduleTable").html(loadTableHTML);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};

$("select[name='exactValue']").on("change", function () {
    loadTableSchedule(
        $("select[name='search_type']").find(":selected").val(),
        $(this).val()
    );
});

$(document).on("click", ".deleteSchedule", function () {
    let id = $(this).attr("id");
    $.ajax({
        url: `schedule/delete/${id}`,
        type: "DELETE",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".deleteSched_" + id)
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
            $(".deleteSched_" + id)
                .html("Delete")
                .attr("disabled", false);
            getToast("success", "Success", "deleted one record");
            loadTableSchedule(
                $("select[name='search_type']").find(":selected").val(),
                $("select[name='exactValue']").val()
            );
            myOptionList($("select[name='exactValue']").val());
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            $(".deleteSched_" + id)
                .html("Delete")
                .attr("disabled", false);
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});

$(document).on("click", ".editSchedule", function () {
    let id = $(this).attr("id");
    $.ajax({
        url: "schedule/edit/" + id,
        type: "GET",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".editSched_" + id)
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
            cancelSchedule.show();
            $(".editSched_" + id)
                .html("Edit")
                .attr("disabled", false);
            $(".btnSaveSchedule").html("Update");
            $("input[name='id']").val(data.id);
            $("select[name='grade_level']").val(data.grade_level);
            $("select[name='section_id']").val(data.section_id);
            $("select[name='section_id']").trigger("change"); // Notify any JS components that the value changed

            setTimeout(() => {
                $("select[name='subject_id']").val(data.subject_id);
                $("select[name='subject_id']").trigger("change"); // Notify any JS components that the value changed
            }, 500);

            $("select[name='class_type']").val(data.class_type);
            $("select[name='teacher_id']").val(data.teacher_id); // Select the option with a value of '1'
            $("select[name='teacher_id']").trigger("change"); // Notify any JS components that the value changed

            // checkbox
            $("input[name=monday]").attr("checked", data.monday ? true : false);
            $("input[name=tuesday]").attr(
                "checked",
                data.tuesday ? true : false
            );
            $("input[name=wednesday]").attr(
                "checked",
                data.wednesday ? true : false
            );
            $("input[name=thursday]").attr(
                "checked",
                data.thursday ? true : false
            );
            $("input[name=friday]").attr("checked", data.friday ? true : false);
            // time from -to
            $("select[name='sched_from']").val(data.sched_from);
            $("select[name='sched_to']").val(data.sched_to);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            $(".editSched_" + id)
                .html("Edit")
                .attr("disabled", false);
            getToast("error", "Eror", errorThrown);
        });
});

$(".cancelSchedule").on("click", function (e) {
    e.preventDefault();
    $(this).hide();
    document.getElementById("scheduleForm").reset();
    $(".btnSaveSchedule").html("Submit");
    $("input[name='id']").val("");
    $("input[type=checkbox]").attr("checked", false);
    $("select[name='section_id']").val(null).trigger("change");
    $("select[name='subject_id']").val(null).trigger("change");
    $("select[name='teacher_id']").val(null).trigger("change");
});
