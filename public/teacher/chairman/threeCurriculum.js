// setTimeout(() => {
    let tableCurriculum = $("#tableCurriculum").DataTable({
        columnDefs: [
            {
                orderable: false,
                targets: 0,
                data: null,
                defaultContent: "",
                render: function (data, type, row, meta) {
                    data = '<input type="checkbox" class="dt-checkboxes">';
                    if (row.enroll_status === "Enrolled") {
                        data = "";
                    }
                    return data;
                },
                checkboxes: {
                    selectRow: true,
                    selectAll: false,
                },
            },
            {
                targets: [2],
                visible: false,
                searchable: false,
            },
        ],
        select: {
            style: "multi",
            selector: "td:first-child",
        },
        processing: true,
        order: [3, "asc"],
        language: {
            processing: `
                    <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>`,
        },
    
        ajax: "table/list/" + $('input[name="current_curriculum"]').val(),
        columns: [
            { data: "id" },
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
                   if (data.state=="Old") {
                       return `-------`;
                   } else {
                    if (data.req_grade != null || data.req_goodmoral != null || data.req_psa != null) {
                        
                        return `
                            <button type="button" class="btn btn-warning btn-sm pt-0 pb-0 pl-3 pr-3 btnRequirement" value="${data.fullname + "^" + data.req_grade + '^' + data.req_goodmoral + '^' + data.req_psa}"><i class="fas fa-file-import"></i> view</button>
                          `;
                        } else {
                        return '--- None ---';
                    }
                   }
                }
            },
            {
                data: null,
                render: function (data) {
                    if (data.enroll_status == "Dropped") {
                        return `<button type="button" class="btn btn-sm btn-danger cDelete btnDelete_${data.id}  pt-0 pb-0 pl-2 pr-2" id="${data.id}">Delete</button>`;
                    } else {
                        return `<button type="button" class="btn btn-sm btn-danger cDelete btnDelete_${data.id}  pt-0 pb-0 pl-2 pr-2" id="${data.id}">Delete</button>&nbsp;
                       ${
                           data.enroll_status == "Enrolled"
                               ? ` <button type="button" class="btn btn-sm btn-primary cEdit btnEdit_${data.id} pt-0 pb-0 pl-3 pr-3 " id="${data.id}">Change</button>`
                               : ` <button type="button" class="btn btn-sm btn-info cEdit btnEdit_${data.id} pt-0 pb-0 pl-3 pr-3 " id="${data.id}">Section</button>`
                       }
                        `;
                    }
                },
            },
        ],
    });
    
    tableCurriculum.ajax.url("table/list/" + current_curriculum).load();
// }, 5000);
$('select[name="selectBarangay"]').on("change", function () {
    $(this).val() != ""
        ? tableCurriculum.ajax.url("table/list/filtered/"+current_curriculum+"/"+$(this).val()).load()
        : "";
});

// setTimeout(() => {
//     tableCurriculum.ajax.url("table/list/filtered/"+current_curriculum+"/" +$('select[name="selectBarangay"]').prop("selectedIndex", 0).val()).load();
// }, 1000);


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