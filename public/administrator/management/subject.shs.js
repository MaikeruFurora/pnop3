let shsTable = $("#shsTable").DataTable({
    processing: true,
    language: {
        processing: `
            <div class="spinner-border spinner-border-sm" role="status">
            <span class="sr-only">Loading...</span>
          </div>`,
    },

    ajax: `subject/shs/list`,
    columns: [
        { data: "indicate_type" },
        { data: "grade_level" },
        { data: "strand" },
        { data: "subject_code" },
        { data: "descriptive_title" },
        {
            data: null,
            render: function (data) {
                return `<button type="button" class="btn btn-sm btn-warning deleteSHS deleteSHS_${data.id}  pt-0 pb-0 pl-3 pr-3" id="${data.id}">
                    <i class="fas fa-times"></i>
                    </button>&nbsp;
                    <button type="button" class="btn btn-sm btn-info editSHS editSHS_${data.id} pt-0 pb-0  pl-3 pr-3" id="${data.id}">
                         <i class="fas fa-edit"></i>
                    </button>
                    `;
            },
        },
    ],
});

$("#shsForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "subject/shs/save",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $(".btnSHSsave")
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
            cancelSHS.hide();
            shsTable.ajax.reload();
            document.getElementById("shsForm").reset();
            $("input[name='shs_id']").val("");
            $(".btnSHSsave").html("Save").attr("disabled", false);
            cancelSubject.hide();
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSHSsave").html("Submit").attr("disabled", false);
        });
});

$('select[name="shs_grade_level"]').val("").attr("disabled", true);
$('select[name="shs_strand_id"]').val("").attr("disabled", true);
$("select[name='shs_indicate_type']").on("change", function () {
    if ($(this).val() == "" || $(this).val() == "Core") {
        $('select[name="shs_grade_level"]')
            .val("")
            .attr("disabled", true)
            .attr("required", false);
        $('select[name="shs_strand_id"]')
            .val("")
            .attr("disabled", true)
            .attr("required", false);
    } else {
        $('select[name="shs_grade_level"]').attr("disabled", false);
        // .attr("required", true);
        $('select[name="shs_strand_id"]')
            .attr("disabled", false)
            .attr("required", true);
    }
});

$(document).on("click", ".deleteSHS", function () {
    if (confirm("Are you sure, Do you want delete this?")) {
        let id = $(this).attr("id");
        $.ajax({
            url: "subject/shs/delete/" + id,
            type: "DELETE",
            data: { _token: $('input[name="_token"]').val() },
            beforeSend: function () {
                $(".deleteSHS_" + id).html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
            },
        })
            .done(function (response) {
                $(".deleteSHS_" + id).html(`<i class="fas fa-times"></i>`);
                getToast("success", "Success", "deleted one record");
                shsTable.ajax.reload();
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
                getToast("error", "Eror", errorThrown);
            });
    } else {
        return false;
    }
});

cancelSHS = $(".cancelSHS");
cancelSHS.hide();
$(document).on("click", ".editSHS", function () {
    let id = $(this).attr("id");
    $.ajax({
        url: "subject/shs/edit/" + id,
        type: "GET",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".editSHS_" + id).html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
        },
    })
        .done(function (data) {
            cancelSHS.show();
            // console.log(data.id);
            $(".editSHS_" + id).html(`<i class="fas fa-edit"></i>`);
            $(".btnSHSsave").html("Update");
            $("input[name='shs_id']").val(data.id);
            $("select[name='shs_indicate_type']").val(data.indicate_type);
            $("select[name='shs_grade_level']").val(data.grade_level);
            $("select[name='shs_strand_id']").val(data.strand_id);
            $("input[name='shs_subject_code']").val(data.subject_code);
            $("input[name='shs_descriptive_title']").val(
                data.descriptive_title
            );
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});

cancelSHS.on("click", function () {
    cancelSHS.hide();
    $("input[name='shs_id']").val("");
    $("select[name='shs_indicate_type']").val("");
    $("select[name='shs_grade_level']").val("");
    $("select[name='shs_strand_id']").val("");
    $("input[name='shs_subject_code']").val("");
    $("input[name='shs_descriptive_title']").val("");
});