$(".cancelSection").hide();
const sectionTable = () => {
    let htmlHold = "";
    let i = 1;
    $.ajax({
        url: `section/list`,
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            $("#sectionTable").html(
                `<tr>
                        <td colspan="5" class="text-center">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </td>
                    </tr>
                    `
            );
        },
    })
        .done(function (data) {
            if (data.length > 0) {
                data.forEach((val) => {
                    htmlHold += `
                        <tr>
                            <td>
                                ${i++}
                            </td>
                            <td>
                                ${val.section_name}
                            </td>
                            <td>
                                ${val.strand.strand}
                            </td>
                            <td>
                                ${val.teacher.teacher_lastname},
                                ${val.teacher.teacher_firstname}
                                ${val.teacher.teacher_middlename}
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" style="font-size:9px" class="btn btn-sm btn-info pl-3 pr-3 editSection editSec_${
                                        val.id
                                    }" id="${val.id}"> <i class="fas fa-edit"></i></button>
                                    <button type="button" style="font-size:9px" class="btn btn-sm btn-danger pl-3 pr-3 deleteSection deleteSec_${
                                        val.id
                                    }" id="${
                        val.id
                    }"><i class="fas fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            } else {
                htmlHold = `
                            <tr>
                                <td colspan="5" class="text-center">No available data</td>
                            </tr>`;
            }
            $("#sectionTable").html(htmlHold);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
        });
};
sectionTable();

$("#sectionForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "section/save",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $(".btnSaveSection")
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
            console.log(data);
            $(".btnSaveSection").html("Submit").attr("disabled", false);
            if (data.error) {
                getToast("warning", "Warning", data.error);
                $("select[name='teacher_id']").val(data.currentTeacherID); // Select the option with a value of '1'
                $("select[name='teacher_id']").trigger("change"); // Notify any JS components that the value changed
            } else {
                sectionTable();
                $(".cancelSection").hide();
                document.getElementById("sectionForm").reset();
                $("input[name='id']").val("");
                $("select[name='teacher_id']").val(null).trigger("change");
            }
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSaveSection").html("Submit").attr("disabled", false);
        });
});

/**
 *
 * DELETE
 *
 */
$(document).on("click", ".deleteSection", function () {
    if (confirm("Are you sure you want delete this?")) {
        let id = $(this).attr("id");
        $.ajax({
            url: "section/delete/" + id,
            type: "DELETE",
            data: { _token: $('input[name="_token"]').val() },
            beforeSend: function () {
                $(".deleteSec_" + id).html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
            },
        })
            .done(function (response) {
                $(".deleteSec_" + id).text("Delete");
                getToast("success", "Success", "deleted one record");
                sectionTable($("#selectedGL").val());
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
                getToast("error", "Eror", errorThrown);
                $(".deleteSec_" + id).text("Delete");
            });
    } else {
        return false;
    }
});

$(document).on("click", ".editSection", function () {
    let id = $(this).attr("id");
    $.ajax({
        url: "section/edit/" + id,
        type: "GET",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".editSec_" + id).html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
        },
    })
        .done(function (data) {
            $(".cancelSection").show();
            // console.log(data.id);
            $(".editSec_" + id).html("Edit");
            $(".btnSaveSection").html("Update");
            $("input[name='id']").val(data.id);
            $("input[name='section_name']").val(data.section_name);
            $("select[name='strand_id']").val(data.strand_id);
            $("select[name='teacher_id']").val(data.teacher_id); // Select the option with a value of '1'
            $("select[name='teacher_id']").trigger("change"); // Notify any JS components that the value changed
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});
