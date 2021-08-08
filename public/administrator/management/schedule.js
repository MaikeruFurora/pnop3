let cancelSchedule = $(".cancelSchedule").hide();

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
    myOptionList($(this).val());
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
                        element.subject_code + " - " + element.descriptive_title
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
            $("#selectedGL").val($('select[name="grade_level"]').val());
            $(".btnSaveSchedule").html("Submit").attr("disabled", false);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSaveSchedule").html("Submit").attr("disabled", false);
        });
});

let schedTime = () => {
    myTime = [
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
};

$("select[name='sched_from']").on("change", function () {});

$("select[name='sched_to']").on("change", function () {});
schedTime();
