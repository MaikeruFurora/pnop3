let filterSection = (strand) => {
    let htmlHold = "<option value=''>Choose Section...</option>";
    $.ajax({
        url: `enrollee/filter/section/senior/${strand}`,
        type: "GET",
    })
        .done(function (data) {
            data.forEach((element) => {
                htmlHold += `<option value="${element.id}">${element.section_name}</option>`;
            });
            $("#massSectioning").html(htmlHold);
            $("#sectionFilter").html(htmlHold);
            $('select[name="section_id"]').html(htmlHold);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSaveSection").html("Submit").attr("disabled", false);
        });
};
filterSection($('select[name="strand_id"]').prop("selectedIndex", 0).val());
$("select[name='strand_id']").on("change", function () {
    filterSection($(this).val());
});

let gradeElevenTable = $("#gradeElevenTable").DataTable({
    processing: true,
    language: {
        processing: `
                <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
              </div>`,
    },

    ajax:
        "student/enrolle/" +
        $("select[name='strand']").val() +
        "/" +
        $("select[name='term']").val(),
    columns: [
        { data: "tracking_no" },
        { data: "roll_no" },
        {
            data: null,
            render: function (data) {
                return (
                    data.student_lastname +
                    ", " +
                    data.student_firstname +
                    " " +
                    data.student_middlename
                );
            },
        },

        {
            data: null,
            render: function (data) {
                return data.section_id == null
                    ? `---No Section--`
                    : `<b>${data.section_name}</b>`;
            },
        },
        {
            data: null,
            render: function (data) {
                switch (data.enroll_status) {
                    case "Pending":
                        return `<span class="badge badge-warning">${data.enroll_status}</span>`;
                        break;
                    case "Enrolled":
                        return `<span class="badge badge-success">${data.enroll_status}</span>`;
                        break;
                    case "Dropped":
                        return `<span class="badge badge-danger">${data.enroll_status}</span>`;
                        break;
                    default:
                        return false;
                        break;
                }
            },
        },
        {
            data: null,
            render: function (data) {
                if (data.isbalik_aral == "Yes") {
                    return `${data.isbalik_aral} - ${data.last_schoolyear_attended}`;
                } else {
                    return `${data.isbalik_aral}`;
                }
            },
        },
        {
            data: null,
            render: function (data) {
                if (data.action_taken == null || data.action_taken == "") {
                    return `--- Nothing ---`;
                } else {
                    return data.action_taken;
                }
            },
        },
        { data: "state" },
        {
            data: null,
            render: function (data) {
                if (data.req_grade != null || data.req_goodmoral != null || data.req_psa != null) {
                    
                    return `
                        <button type="button" class="btn btn-warning btn-sm pt-0 pb-0 pl-3 pr-3 btnRequirement" value="${data.fullname + "^" + data.req_grade + '^' + data.req_goodmoral + '^' + data.req_psa}"><i class="fas fa-file-import"></i> view</button>
                      `;
                    } else {
                    return '--- None ---';
                }
            }
        },
        {
            data: null,
            render: function (data) {
                if (data.enroll_status == "Dropped") {
                    return `<button type="button" class="btn btn-sm btn-danger cDelete btnDelete_${data.id}  pt-0 pb-0 pl-2 pr-2" id="${data.id}">
                    Delete
                    </button>
                    `;
                } else {
                    return `
                   ${
                       data.enroll_status == "Enrolled"
                           ? `<button type="button" class="btn btn-sm btn-primary  cEdit btnEdit_${data.id} pt-0 pb-0 pl-3 pr-3 " id="${data.id}">
                           <i class="fas fa-edit"></i>
                            </button>&nbsp;
                            <button type="button" class="btn btn-sm btn-info btnMain btnMain_${data.id} pt-0 pb-0 pl-3 pr-3 " value="${data.id}">
                                Subjects
                            </button>`
                        :
                        `<button type="button" class="btn btn-sm btn-danger cDelete btnDelete_${data.id}  pt-0 pb-0 pl-4 pr-4" id="${data.id}">
                           <i class="fas fa-times"></i>
                        </button>&nbsp;
                        <button type="button" class="btn btn-sm btn-info cEdit btnEdit_${data.id} pt-0 pb-0 pl-3 pr-3 " id="${data.id}">
                            Enroll
                        </button>`
                   }
                    `;
                }
            },
        },
    ],
});

$("select[name='strand']").on("change", function () {
    gradeElevenTable.ajax
        .url(
            "student/enrolle/" +
                $(this).val() +
                "/" +
                $("select[name='term']").val()
        )
        .load();
    monitorSection($(this).val(), $("select[name='term']").val());
});

$("select[name='term']").on("change", function () {
    gradeElevenTable.ajax
        .url(
            "student/enrolle/" +
                $("select[name='strand']").val() +
                "/" +
                $(this).val()
        )
        .load();
    monitorSection($("select[name='strand']").val(), $(this).val());
});


$(document).on('click', ".btnRequirement", function () {
    let dirNow = $('input[name="dirNow"]').val();
    let req_grade = document.getElementById("req_grade");
    req_grade.setAttribute('src', dirNow + $(this).val().split("^")[1]);
    let req_psa = document.getElementById("req_psa");
    req_psa.setAttribute('src', dirNow + $(this).val().split("^")[3]);
    let req_goodmoral = document.getElementById("req_goodmoral");
    req_goodmoral.setAttribute('src', dirNow + $(this).val().split("^")[2]);
    $("#viewRequirementTitle").text($(this).val().split("^")[0])
    $("#viewRequirementModal").modal("show")
});

$("#req_grade").on('click', function () {
    urlNow = $(this).attr("src");
    window.open(urlNow,'_target')
})

$("#req_goodmoral").on('click', function () {
    urlNow = $(this).attr("src");
    window.open(urlNow,'_target')
})

$("#req_psa").on('click', function () {
    urlNow = $(this).attr("src");
    window.open(urlNow,'_target')
})


$(document).on("click", ".cDelete", function () {
    let id = $(this).attr("id");
    if (confirm("Are you sure you want delete this student pernamently?")) {
        $.ajax({
            url: "enrollee/delete/" + id,
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
                //  $(".btnDelete_" + id).html("Delete");
                gradeElevenTable.ajax.reload();
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

$(document).on("click", ".cEdit", function () {
    let id = $(this).attr("id");
    $.ajax({
        url: "enrollee/edit/" + id,
        type: "GET",
        beforeSend: function () {
            $(".btnEdit_" + id).html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
        },
    })
        .done(function (response) {
            $(".alert-warning").hide();
            filterSection(response.strand_id);
           setTimeout(() => {
            $(".nameOfStudent").val(response.fullname);
            $('#sectionFilter').val(response.section_id);
            $("input[name='enroll_id']").val(response.id);
            $(".btnEdit_" + id).html(
                response.section_id != ""
                    ? `<i class="fas fa-edit"></i>`
                    : "Section"
            );
            $("#setSectionModal").modal("show");
           }, 3000);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});

$(".btnCancelSectionNow").on("click", function () {
    document.getElementById("setSectionForm").reset();
    $("input[name='enroll_id']").val("");
    $(".nameOfStudent").val("Please Select Student");
    $("#setSectionModal").modal("hide");
    $(".alert-warning").hide();
    $(".btnSaveSectionNow").html("Save").attr("disabled", false);
    $("input[name='status_now']").val("");
});

$("#setSectionForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "enrollee/section/set",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $(".btnSaveSectionNow")
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
            $("input[name='status_now']").val("");
            $(".btnSaveSectionNow").html("Save").attr("disabled", false);
            $("input[name='roll_no']").removeClass("is-valid");
            getToast("success", "Ok", "Successfully assign section");
            document.getElementById("setSectionForm").reset();
            gradeElevenTable.ajax.reload();
            monitorSection(
                $("select[name='strand']").val(),
                $("select[name='term']").val()
            );
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSaveSectionNow").html("Save").attr("disabled", false);
        });
});

let monitorSection = (strand, term) => {
    let monitorHMTL = "";
    $.ajax({
        url: `enrollee/monitor/section/${strand}/${term}`,
        type: "GET",
        dataType: "json",
    })
        .done(function (data) {
            data.forEach((val) => {
                monitorHMTL += `
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-info btn-icon icon-left listenrolledBtn ml-3 p-2" value='${val.section_name}'>
                        <i class="far fa-user"></i> ${val.section_name}
                        <span class="btnSection_${val.section_name}">
                        <span class="badge badge-transparent ">${val.total}</span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-info border-left p-2 pl-3 pr-3 printBtn" value='${val.section_id}_${term}'><i class="fa fa-print" style="font-size:15px"></i></button>
                </div>
               `;
            });
            $(".sectionListAvailable").html(monitorHMTL);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSaveSectionNow").html("Save").attr("disabled", false);
        });
};

monitorSection(
    $("select[name='strand']").val(),
    $("select[name='term']").val()
);

$(document).on("click", ".printBtn", function () {
    let dataPrint = $(this).val();
    popupCenter({
        url:
            "enrollee/print/report/" +
            dataPrint.split("_")[0] +
            "/" +
            dataPrint.split("_")[1],
        title: "report",
        w: 1200,
        h: 800,
    });
});
