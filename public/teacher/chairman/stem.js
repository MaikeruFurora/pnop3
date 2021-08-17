let tableCurriculum = $("#tableCurriculum").DataTable({
    processing: true,
    order: [2, "asc"],
    language: {
        processing: `
                <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
              </div>`,
    },

    ajax: "table/list/" + current_curriculum,
    columns: [
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
                return data.enroll_status == "Pending"
                    ? `<span class="badge badge-warning">${data.enroll_status}</span>`
                    : `<span class="badge badge-success">${data.enroll_status}</span>`;
            },
        },
        {
            data: null,
            render: function (data) {
                return `<button type="button" class="btn btn-sm btn-danger cDelete btnDelete_${data.id}  pt-0 pb-0 pl-2 pr-2" id="${data.id}">
                    Delete
                    </button>&nbsp;
                    <button type="button" class="btn btn-sm btn-info cEdit btnEdit_${data.id} pt-0 pb-0 pl-3 pr-3 " id="${data.id}">
                        Section
                    </button>
                    `;
            },
        },
    ],
});
