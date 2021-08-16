const studentTable = $("#studentTable").DataTable({
    // lengthChange: false,
    pageLenth: 6,
    processing: true,
    language: {
        processing: `
            <div class="spinner-border spinner-border-sm" role="status">
            <span class="sr-only">Loading...</span>
          </div>`,
    },

    ajax: `student/list`,
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
        { data: "gender" },
        { data: "username" },
        { data: "username" },
        { data: "orig_password" },
        {
            data: null,
            render: function (data) {
                return `<button type="button" class="btn btn-sm btn-danger tdelete btnDelete_${data.id}  pt-0 pb-0 pl-2 pr-2" id="${data.id}">
                Delete
                </button>&nbsp;
                <button type="button" class="btn btn-sm btn-info tedit btnEdit_${data.id} pt-0 pb-0 pl-3 pr-3 " id="${data.id}">
                    Edit
                </button>
                `;
            },
        },
    ],
});
$("#btnStudentModal").on("click", function () {
    $(".modal-title").text("New Student");
    $("#studentForm")[0].reset();
    $("#staticBackdrop").modal("show");
});

$("#studentForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "student/store",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $("#btnSaveStudent").html(`Saving 
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
        },
    })
        .done(function (response) {
            $("#btnSaveStudent").html("Save");
            getToast("success", "Success", "Successfully added new student");
            $("#studentForm")[0].reset();
            studentTable.ajax.reload();
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});
