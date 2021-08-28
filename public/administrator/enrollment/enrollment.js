let enrollmentTable = (level) => {
    $("#enrollmentTable").dataTable().fnDestroy();
    $("#enrollmentTable").dataTable({
        processing: true,
        order: [3, "asc"],
        language: {
            processing: `
                    <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>`,
        },

        ajax: "enrollment/list/" + level,
        columns: [
            { data: "roll_no" },
            { data: "fullname" },
            { data: "curriculum" },
            { data: "section_name" },
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
            { data: "date_of_enroll" },
        ],
    });
};
enrollmentTable("all");
$("select[name='selectedGL']").on("change", function () {
    enrollmentTable($(this).val());
});
