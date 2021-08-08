let cancelSchedule = $(".cancelSchedule").hide();
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

let searchByGradeLevel = (grade_level) => {
    let subjectHTML = "";
    let sectionHTML = "";
    $.ajax({
        url: `search/byGradeLevel/${grade_level}`,
        type: "GET",
        dataType: "json",
    })
        .done(function (data) {
            subjectHTML += `<option></option>`;
            sectionHTML += `<option></option>`;
            if (data["section"]) {
                data.section.forEach((element) => {
                    sectionHTML += `<option value="${element.id}">${element.section_name}</option>`;
                });
                $("select[name='section_id']").html(sectionHTML);
            }
            if (data["subject"]) {
                data.subject.forEach((element) => {
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
            }
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};

$("select[name='grade_level']").on("change", function () {
    searchByGradeLevel($(this).val());
    $("select[name='teacher_id']").val(null).trigger("change");
});
searchByGradeLevel(7);

$("#scheduleForm").submit(function (e) {
    e.preventDefault();
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
            console.log(data);
            $("#selectedGL").val($('select[name="grade_level"]').val());
            $(".btnSaveSchedule").html("Submit").attr("disabled", false);
            document.getElementById("scheduleForm").reset();
            $("input[name='id']").val("");
            $("select[name='section_id']").val(null).trigger("change");
            $("select[name='subject_id']").val(null).trigger("change");
            $("select[name='teacher_id']").val(null).trigger("change");
            $("select[name='sched_to']").val(null);
            let cloneArr = arrTime.slice(0);
            cloneArr.splice(index + 1).forEach((element, i) => {
                sched_toHTML += `<option  value="${element}" ${
                    i == 1 ? `selected` : ``
                }>${element}</option>`;
            });
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSaveSchedule").html("Submit").attr("disabled", false);
        });
});

let sched_fromHTML = "";

myTime.forEach((element) => {
    sched_fromHTML += `<option value="${element}">${element}</option>`;
});
$("select[name='sched_from']").html(sched_fromHTML);

//
let nextTime = (arrTime = [], value) => {
    let sched_toHTML = "";
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
            $("#sectionTable").html(
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
            console.log(data);
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
                        ${val.monday ? "Monday, " : ""}
                        ${val.tuesday ? "Tuesday, " : ""}
                        ${val.wednesday ? "Wednesday, " : ""}
                        ${val.thursday ? "Thursday, " : ""}
                        ${val.friday ? "Friday " : ""}
                    </td>
                    <td>
                        ${val.sched_from} - 
                        ${val.sched_to}
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" style="font-size:9px" class="btn btn-sm btn-info pl-3 pr-3 editSubject editSub_${
                                val.id
                            }" id="${val.id}">Edit</button>
                            <button type="button" style="font-size:9px" class="btn btn-sm btn-danger deleteSubject deleteSub_${
                                val.id
                            }" id="${val.id}">Delete</button>
                        </div>
                    </td>
                </tr>
                `;
            });
            $("#subjectTable").html(loadTableHTML);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};

$("select[name='exactValue']").on("change", function () {
    console.log($("select[name='search_type']").find(":selected").val());
    loadTableSchedule(
        $("select[name='search_type']").find(":selected").val(),
        $(this).val()
    );
});
