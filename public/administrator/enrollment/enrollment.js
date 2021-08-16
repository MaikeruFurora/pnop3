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
                    return data.enroll_status == "Pending"
                        ? `<span class="badge badge-warning">${data.enroll_status}</span>`
                        : `<span class="badge badge-success">${data.enroll_status}</span>`;
                },
            },
            { data: "date_of_enroll" },
        ],
    });
};
enrollmentTable(7);
$("select[name='selectedGL']").on("change", function () {
    enrollmentTable($(this).val());
});
