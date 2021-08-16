monitorSection(current_curriculum);
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
                return `<button type="button" class="btn btn-sm btn-danger stemDelete btnDelete_${data.id}  pt-0 pb-0 pl-2 pr-2" id="${data.id}">
                    Delete
                    </button>&nbsp;
                    <button type="button" class="btn btn-sm btn-info stemEdit btnEdit_${data.id} pt-0 pb-0 pl-3 pr-3 " id="${data.id}">
                        Section
                    </button>
                    `;
            },
        },
    ],
});

$(document).on("click", ".stemDelete", function () {
    let id = $(this).attr("id");
    if (confirm("Are you sure you want delete this student pernamently?")) {
        $.ajax({
            url: "delete/" + id,
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
                $(".btnDelete_" + id).html("Delete");
                tableCurriculum.ajax.reload();
                getToast("success", "Success", "deleted one record");
                monitorSection(current_curriculum);
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
                getToast("error", "Eror", errorThrown);
            });
    } else {
        return false;
    }
});

$(document).on("click", ".stemEdit", function () {
    let id = $(this).attr("id");
    filterSection(current_curriculum);
    $.ajax({
        url: "edit/" + id,
        type: "DELETE",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".btnEdit_" + id).html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
        },
    })
        .done(function (response) {
            $("#setSectionModal").modal("show");
            $(".nameOfStudent").val(
                response.student_lastname +
                    " " +
                    response.student_firstname +
                    " " +
                    response.student_middlename
            );
            $('select[name="section"]').val(response.section_id);
            $("input[name='enroll_id']").val(response.id);
            $(".btnEdit_" + id).html("Section");
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});
