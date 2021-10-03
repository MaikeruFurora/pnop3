let certificateTable = $("#certificateTable").DataTable({
    processing: true,
    language: {
        processing: `
                <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
              </div>`,
    },

    ajax: "certificate/load/student" ,
    columns: [
        { data: "roll_no" },
        { data: "fullname" },
        { data: "section_name" },
        {
         data: null,
        render: function (data) {
            return `<button type="button" class="btn btn-sm btn-info coe btnDelete_${data.id}  pt-0 pb-0 pl-2 pr-2" value="${data.id}">Certificate Enrollment</button>`;
            },
        },
    ],
});

$(document).on('click','.coe', function () {
    popupCenter({
        url: "certificate/load/certificate/" + $(this).val(),
        title: "report",
        w: 1400,
        h: 800,
    });
})