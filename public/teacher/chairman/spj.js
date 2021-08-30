let tableCurriculumSpj = (barangay) => {
    // $("#example").dataTable().destroy();
    $("#tableCurriculum").dataTable({
        processing: true,
        destroy: true,
        order: [3, "asc"],
        language: {
            processing: `
            <div class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
          </div>`,
        },

        ajax: "table/list/filtered/" + current_curriculum + "/" + barangay,
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
                    if (data.enroll_status == "Dropped") {
                        return `<button type="button" class="btn btn-sm btn-danger cDelete btnDelete_${data.id}  pt-0 pb-0 pl-2 pr-2" id="${data.id}">
                        Delete
                        </button>
                        `;
                    } else {
                        return `<button type="button" class="btn btn-sm btn-danger cDelete btnDelete_${data.id}  pt-0 pb-0 pl-2 pr-2" id="${data.id}">
                        Delete
                        </button>&nbsp;
                        <button type="button" class="btn btn-sm btn-info cEdit btnEdit_${data.id} pt-0 pb-0 pl-3 pr-3 " id="${data.id}">
                            Section
                        </button>
                        `;
                    }
                },
            },
        ],
    });
};

$('select[name="selectBarangay"]').on("change", function () {
    $(this).val() != "" ? tableCurriculumSpj($(this).val()) : "";
});

setTimeout(() => {
    tableCurriculumSpj(
        $('select[name="selectBarangay"]').prop("selectedIndex", 0).val()
    );
}, 2000);
