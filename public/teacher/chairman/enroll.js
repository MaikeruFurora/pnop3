// var my_handlers = {
//     fill_provinces: function () {
//         var region_code = $(this).val();
//         $("#province").ph_locations("fetch_list", [
//             { region_code: region_code },
//         ]);
//     },

//     fill_cities: function () {
//         var province_code = $(this).val();
//         $("#city").ph_locations("fetch_list", [
//             { province_code: province_code },
//         ]);
//     },

//     fill_barangays: function () {
//         var city_code = $(this).val();
//         $("#barangay").ph_locations("fetch_list", [{ city_code: city_code }]);
//     },
// };

// $("#region").on("change", my_handlers.fill_provinces);
// $("#province").on("change", my_handlers.fill_cities);
// $("#city").on("change", my_handlers.fill_barangays);

// $("#region").ph_locations({ location_type: "regions" });
// $("#province").ph_locations({ location_type: "provinces" });
// $("#city").ph_locations({ location_type: "cities" });
// $("#barangay").ph_locations({ location_type: "barangays" });

// $("#region").ph_locations("fetch_list");
/**
 *
 *
 */

// global variable for all curriculum
let current_curriculum = $('input[name="current_curriculum"]').val();

let filterBarangay = () => {
    let barangayHTML;
    $.ajax({
        url: `filter/barangay/${current_curriculum}`,
        type: "GET",
        dataType: "json",
    })
        .done(function (data) {
            data.forEach((val) => {
                barangayHTML += `<option>${val.barangay}</option>`;
            });
            $("select[name='selectBarangay']").html(barangayHTML);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSaveSectionNow").html("Save").attr("disabled", false);
        });
};
filterBarangay();
let monitorSection = (curriculum) => {
    let monitorHMTL = "";
    $.ajax({
        url: `monitor/section/${curriculum}`,
        type: "GET",
        dataType: "json",
    })
        .done(function (data) {
            data.forEach((val) => {
                monitorHMTL += `
                <button type="button" class="btn btn-info btn-icon icon-left ml-3 p-2 listenrolledBtn " value='${val.section_name}'>
                        <i class="far fa-user"></i> ${val.section_name}
                        <span class="btnSection_${val.section_name}">
                        <span class="badge badge-transparent ">${val.total}</span>
                        </span>
                </button>
               `;
            });
            $(".sectionListAvailable").html(monitorHMTL);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSaveSectionNow").html("Save").attr("disabled", false);
        });
};
monitorSection(current_curriculum);
let findTableToRefresh = (current_curriculum) => {
    switch (current_curriculum) {
        case "STEM":
            tableCurriculum.ajax.reload();
            break;
        case "BEC":
            setTimeout(() => {
                tableCurriculumBec(
                    $('select[name="selectBarangay"]')
                        .prop("selectedIndex", 0)
                        .val()
                );
            }, 2000);
            break;

        case "SPA":
            setTimeout(() => {
                tableCurriculumSpa(
                    $('select[name="selectBarangay"]')
                        .prop("selectedIndex", 0)
                        .val()
                );
            }, 2000);
            break;
        case "SPJ":
            setTimeout(() => {
                tableCurriculumSpj(
                    $('select[name="selectBarangay"]')
                        .prop("selectedIndex", 0)
                        .val()
                );
            }, 2000);
            break;
        default:
            break;
    }
};

$("input[name='roll_no']").on("blur", function () {
    if ($(this).val() == "") {
        $("input[name='roll_no']").removeClass("is-valid is-invalid");
    } else {
        $.ajax({
            url: "check/lrn/" + $(this).val(),
            type: "GET",
        })
            .done(function (data) {
                if (data.warning) {
                    getToast("warning", "Warning", data.warning);
                    $("input[name='roll_no']").addClass("is-invalid");
                    $(".btnSaveEnroll").attr("disabled", true);
                } else {
                    $("input[name='roll_no']")
                        .removeClass("is-invalid")
                        .addClass("is-valid");
                    $(".btnSaveEnroll").attr("disabled", false);
                }
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
            });
    }
});

$("#btnModalStudent").on("click", function () {
    $("#staticBackdrop").modal("show");
    $("select[name='curriculum']").val(current_curriculum);
    searchSecionByLevel($('input[name="current_curriculum"]').val());
});
$('select[name="grade_level"]').attr("readonly", true);
$("#last_school_attended").hide();
$("select[name='status']").on("change", function () {
    if ($(this).val() != "") {
        if ($(this).val() == "new" || $(this).val() == "transferee") {
            $("#last_school_attended").show();
        } else {
            $("#last_school_attended").hide();
            $('select[name="grade_level"]').val("").attr("readonly", true);
        }
    } else {
        $('select[name="grade_level"]').val("").attr("readonly", true);
        $("#last_school_attended").hide();
    }
    if ($(this).val() == "new") {
        $('select[name="grade_level"]').val("7").attr("readonly", true);
    } else {
        $('select[name="grade_level"]').val("").attr("readonly", false);
    }
});

let searchSecionByLevel = (curriculum) => {
    if (curriculum != "") {
        let htmlHold = "";
        $.ajax({
            url: "section/search/by/level/" + curriculum,
            type: "GET",
        })
            .done(function (data) {
                htmlHold += ` <option></option>`;
                data.forEach((element) => {
                    htmlHold += `<option value="${element.id}">${element.section_name}</option>`;
                });
                $("select[name='section_id']").html(htmlHold);
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $(".btnSaveSection").html("Submit").attr("disabled", false);
            });
    }
};

$("select[name='curriculum']").on("change", function () {
    searchSecionByLevel($(this).val());
});

/**
 *
 * ENROLLMENT FORM FOR EVERY ONE
 *
 */

$("#enrollForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "save",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $(".btnSaveEnroll")
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
            $("input[name='roll_no']").removeClass("is-valid");
            getToast("success", "Ok", "Successfully added new enrolled");
            $(".btnSaveEnroll").html("Save").attr("disabled", false);
            document.getElementById("enrollForm").reset();
            $("#last_school_attended").hide();
            setTimeout(() => {
                monitorSection(current_curriculum);
                findTableToRefresh(current_curriculum);
                filterBarangay();
            }, 1500);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSaveEnroll").html("Save").attr("disabled", false);
        });
});

$(".modalClose").on("click", function () {
    $("#staticBackdrop").modal("hide");
    document.getElementById("enrollForm").reset();
    $("input[name='roll_no']").removeClass("is-valid is-invalid");
});

/**
 *
 * SHOW WARNING MESSAGE
 *
 */

$(".alert-warning").hide();
let filterSection = (curriculum) => {
    if (curriculum != "") {
        let htmlHold = "";
        $.ajax({
            url: `filter/section/${curriculum}`,
            type: "GET",
        })
            .done(function (data) {
                htmlHold += ` <option></option>`;
                data.forEach((element) => {
                    htmlHold += `<option value="${element.id}">${element.section_name}</option>`;
                });
                $("#sectionFilter").html(htmlHold);
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $(".btnSaveSection").html("Submit").attr("disabled", false);
            });
    }
};

/**
 * SET SECTION
 */
$("#setSectionForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "section/set",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $(".btnSaveSectionNow")
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
            if (data.warning) {
                $(".alert-warning").show().text(data.warning);
                $(".btnSaveSectionNow").attr("disabled", false);
                $("input[name='status_now']").val("force");
                $(".btnSaveSectionNow")
                    .html("Force to Enroll")
                    .attr("disabled", false);
            } else {
                $(".alert-warning").hide();
                $("input[name='status_now']").val("");
                $(".btnSaveSectionNow").html("Save").attr("disabled", false);
                $("input[name='roll_no']").removeClass("is-valid");
                getToast("success", "Ok", "Successfully assign section");
                document.getElementById("setSectionForm").reset();
                findTableToRefresh(current_curriculum);
                filterBarangay();
            }
            monitorSection(current_curriculum);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSaveSectionNow").html("Save").attr("disabled", false);
        });
});

$(".btnCancelSectionNow").on("click", function () {
    document.getElementById("setSectionForm").reset();
    $("input[name='enroll_id']").val("");
    $(".nameOfStudent").val("Please Select Student");
    $("#setSectionModal").modal("hide");
    $(".alert-warning").hide();
    $(".btnSaveSectionNow").html("Save").attr("disabled", false);
    $("input[name='status_now']").val("");
});

// $("select[name='section']").on("change", function () {
//     let enroll_id = $('input[name="enroll_id"]').val();
//     let section_id = $(this).val();
//     $.ajax({
//         url: `check/vacant/${section_id}/${enroll_id}`,
//         type: "GET",
//         dataType: "json",
//     })
//         .done(function (data) {
//             console.log(data);
//         })
//         .fail(function (jqxHR, textStatus, errorThrown) {
//             getToast("error", "Eror", errorThrown);
//             $(".btnSaveSectionNow").html("Save").attr("disabled", false);
//         });
// });

/**
 *
 * DELETE FUNCTIONALLITES PER CURRICULUM
 *
 */

$(document).on("click", ".cDelete", function () {
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

                getToast("success", "Success", "deleted one record");
                monitorSection(current_curriculum);
                findTableToRefresh(current_curriculum);
                filterBarangay();
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
                getToast("error", "Eror", errorThrown);
            });
    } else {
        return false;
    }
});

/**
 *
 * EDIT FUNCTIONALITIES PER CURRICULUM
 *
 *
 */

$(document).on("click", ".cEdit", function () {
    let id = $(this).attr("id");
    filterSection(current_curriculum);
    $.ajax({
        url: "edit/" + id,
        type: "GET",
        beforeSend: function () {
            $(".btnEdit_" + id).html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
        },
    })
        .done(function (response) {
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
            $("#setSectionModal").modal("show");
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});

$(document).on("click", ".listenrolledBtn", function () {
    let tableListHTML;
    let sectionOpen = $(this).val();
    let i = 1;
    $.ajax({
        url: "table/list/enrolled/student/" + sectionOpen,
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            $(".btnSection_" + sectionOpen)
                .html(`<div class="spinner-border spinner-border-sm ml-1 mr-1" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
        },
    })
        .done(function (data) {
            setTimeout(() => {
                data.forEach((val) => {
                    tableListHTML += `
                    <tr>
                    <td>${i++}</td>
                    <td>${val.fullname}</td>
                    </tr>
                `;
                });
                $(".titleSection").text(sectionOpen);
                $("#listEnrolled").html(tableListHTML);
                $(".btnSection_" + sectionOpen).html(
                    `<span class="badge badge-transparent">${data.length}</span>`
                );
                $(".eTotal").text(data.length);
                $("#listEnrolledModal").modal("show");
            }, 2000);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});
