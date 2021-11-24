// global variable for all curriculum
let current_curriculum = $('input[name="current_curriculum"]').val();
let current_glc = $("input[name='current_glc']").val();
$("#sectionGrouping").hide();
let filterBarangay = () => {
    let barangayHTML;
    $.ajax({
        url: `filter/barangay/${current_curriculum}`,
        type: "GET",
        dataType: "json",
    })
        .done(function (data) {
            barangayHTML = `<option>All</option>`;
            data.forEach((val) => {
                barangayHTML += `<option value="${val.barangay}">${
                    ucwords(val.city.toLowerCase()) + ` - ` + val.barangay
                }</option>`;
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
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-info btn-icon icon-left listenrolledBtn ml-3 p-2" value='${val.section_name}'>
                        <i class="far fa-user"></i> ${val.section_name}
                        <span class="btnSection_${val.section_name}">
                        <span class="badge badge-transparent ">${val.total}</span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-info border-left p-2 pl-3 pr-3 printBtn" value='${val.section_name}'><i class="fa fa-print" style="font-size:15px"></i></button>
                </div>
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
                tableCurriculum.ajax
                    .url(
                        "table/list/filtered/" +
                            current_curriculum +
                            "/" +
                            $('select[name="selectBarangay"]')
                                .prop("selectedIndex", 0)
                                .val()
                    )
                    .load();
            }, 1000);
            break;

        case "SPA":
            setTimeout(() => {
                tableCurriculum.ajax
                    .url(
                        "table/list/filtered/" +
                            current_curriculum +
                            "/" +
                            $('select[name="selectBarangay"]')
                                .prop("selectedIndex", 0)
                                .val()
                    )
                    .load();
            }, 1000);
            break;
        case "SPJ":
            setTimeout(() => {
                tableCurriculum.ajax
                    .url(
                        "table/list/filtered/" +
                            current_curriculum +
                            "/" +
                            $('select[name="selectBarangay"]')
                                .prop("selectedIndex", 0)
                                .val()
                    )
                    .load();
            }, 1000);
            break;
        default:
            break;
    }
};

$("input[name='roll_no']").on("blur", function () {
    if ($(this).val() == "") {
        document.getElementById("enrollForm").reset();
        $('select[name="grade_level"]').val(current_glc).attr("readonly", true);
        $("select[name='curriculum']")
            .val(current_curriculum)
            .attr("readonly", true);
        $("input[name='roll_no']").removeClass("is-valid is-invalid");
    } else {
        let status = $("select[name='status']").val();
        $.ajax({
            url: `check/lrn/${$(this).val()}/${current_curriculum}/${status}`,
            type: "GET",
        })
            .done(function (data) {
                if (data.warning) {
                    getToast("warning", "Warning", data.warning);
                    $("input[name='roll_no']").addClass("is-invalid");
                    $(".btnSaveEnroll").attr("disabled", true);
                } else {
                    $('select[name="grade_level"]').attr("disabled", false);
                    $("input[name='roll_no']")
                        .removeClass("is-invalid")
                        .addClass("is-valid");
                    $(".btnSaveEnroll").attr("disabled", false);
                    if (data.student) {
                        console.log(data.student);
                        $("select[name='curriculum']").val(
                            data.student.curriculum
                        );
                        $('input[name="last_school_attended"]').val(
                            data.student.last_school_attended
                        );
                        $("input[name='student_firstname']").val(
                            data.student.student_firstname
                        );
                        $("input[name='student_middlename']").val(
                            data.student.student_middlename
                        );
                        $("input[name='student_lastname']").val(
                            data.student.student_lastname
                        );
                        $("input[name='region']").val(data.student.region);
                        $("input[name='province']").val(data.student.province);
                        $("input[name='city']").val(data.student.city);
                        $("input[name='barangay']").val(data.student.barangay);
                        $("input[name='date_of_birth']").val(
                            data.student.date_of_birth
                        );

                        $("input[name='address']").val(
                            data.student.barangay +
                                ", " +
                                data.student.city +
                                ", " +
                                data.student.province
                        );
                        $("select[name='gender']").val(data.student.gender);
                        $("input[name='student_contact']").val(
                            data.student.student_contact
                        );
                        $("input[name='mother_name']").val(
                            data.student.mother_name
                        );
                        $("input[name='mother_contact_no']").val(
                            data.student.mother_contact_no
                        );
                        $("input[name='father_name']").val(
                            data.student.father_name
                        );
                        $("input[name='father_contact_no']").val(
                            data.student.father_contact_no
                        );
                        $("input[name='guardian_name']").val(
                            data.student.guardian_name
                        );
                        $("input[name='guardian_contact_no']").val(
                            data.student.guardian_contact_no
                        );
                    }
                }
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
            });
    }
});

$("#btnModalStudent").on("click", function () {
    $("#staticBackdrop").modal("show");
    $("select[name='curriculum']")
        .val(current_curriculum)
        .attr("readonly", true);
    $('select[name="grade_level"]').val(current_glc).attr("readonly", true);
    searchSecionByLevel($('input[name="current_curriculum"]').val());
});
$('select[name="grade_level"]').attr("disabled", true);
$("#last_school").hide();
$("select[name='status']").on("change", function () {
    if (current_glc == 7) {
        if ($(this).val() != "") {
            if ($(this).val() == "new" || $(this).val() == "transferee") {
                $("#last_school").show();
            } else {
                $("#last_school").hide();
                $('select[name="grade_level"]').val("").attr("disabled", true);
            }
        } else {
            // $('select[name="grade_level"]').val("").attr("disabled", true);
            $("#last_school").hide();
        }
        if ($(this).val() == "new") {
            $('select[name="grade_level"]')
                .val(current_glc)
                .attr("disabled", true);
            $('input[name="last_school_attended"]').attr("required", true);
        }
    } else {
        if ($(this).val() == "upperclass") {
            $('input[name="last_school_attended"]').attr("required", false);
            $("#last_school").hide();
            $("#notUpper").hide();
            $("#forUpper").show();
        } else if ($(this).val() == "transferee") {
            $("#last_school").show();
            $("#forUpper").hide();
            $("#notUpper").show();
            document.getElementById("enrollForm").reset();
            $('input[name="last_school_attended"]').attr("required", true);
            $("select[name='status']").val("transferee");
            $("input[name='roll_no']").removeClass("is-valid");
        } else if ($(this).val() == "nothing") {
            $("#last_school").hide();
            $('select[name="grade_level"]').attr("disabled", true);
            document.getElementById("enrollForm").reset();
            $("input[name='roll_no']").removeClass("is-valid");
            $("#forUpper").hide();
            $("#notUpper").show();
        } else {
            alert("wala");
        }
    }
    $('select[name="grade_level"]').val(current_glc).attr("readonly", true);
    $("select[name='curriculum']")
        .val(current_curriculum)
        .attr("readonly", true);
});
$("#forUpper").hide();
// let autoFillForm = (roll_no) => {
//     $.ajax({
//         url: "autofill/lrn/" + roll_no,
//         type: "GET",
//         dataType: "json",
//     })
//         .done(function (data) {
//             alert(data);
//         })
//         .fail(function (jqxHR, textStatus, errorThrown) {
//             getToast("error", "Eror", errorThrown);
//             $(".btnSaveSection").html("Submit").attr("disabled", false);
//         });
// };

//form enroll
let searchSecionByLevel = (curriculum) => {
    if (curriculum != "") {
        let htmlHold = "";
        $.ajax({
            url: "section/search/by/level/" + curriculum,
            type: "GET",
        })
            .done(function (data) {
                // htmlHold += ` <option></option>`;
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
    if ($("select[name='status']").val() != "nothing") {
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
                $(".btnSaveEnroll").html("Enroll").attr("disabled", false);
                document.getElementById("enrollForm").reset();
                $("#last_school").hide();
                setTimeout(() => {
                    monitorSection(current_curriculum);
                    findTableToRefresh(current_curriculum);
                    filterBarangay();
                }, 1500);
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $(".btnSaveEnroll").html("Enroll").attr("disabled", false);
            });
    } else {
        getToast(
            "warning",
            "Warning",
            "You must select student Status for verification"
        );
    }
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

//
$(".alert-warning").hide();
let filterSection = (curriculum) => {
    if (curriculum != "") {
        let htmlHold = "";
        $.ajax({
            url: `filter/section/${curriculum}`,
            type: "GET",
        })
            .done(function (data) {
                // htmlHold += ` <option></option>`;
                data.forEach((element) => {
                    htmlHold += `<option value="${element.id}">${element.section_name}</option>`;
                });
                $("#massSectioning").html(htmlHold);
                $("#sectionFilter").html(htmlHold);
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $(".btnSaveSection").html("Submit").attr("disabled", false);
            });
    }
};

$("#sectionFilter").on("change", function () {
    $(".btnSaveSectionNow").text("Save");
    $(".alert-warning").hide();
});

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

/**
 *
 * DELETE FUNCTIONALLITES PER CURRICULUM
 *
 */

$(document).on("click", ".cDelete", function () {
    let id = $(this).attr("id");
    $('.deleteYes').val(id)
    $("#teacherDeleteModal").modal("show");
    
    // if (confirm("Are you sure you want delete this student pernamently?")) {
    //     $.ajax({
    //         url: "delete/" + id,
    //         type: "DELETE",
    //         data: { _token: $('input[name="_token"]').val() },
    //         beforeSend: function () {
    //             $(".btnDelete_" + id).html(`
    //             <div class="spinner-border spinner-border-sm" role="status">
    //                 <span class="sr-only">Loading...</span>
    //             </div>`);
    //         },
    //     })
    //         .done(function (response) {
    //             $(".btnDelete_" + id).html("Delete");

    //             getToast("success", "Success", "deleted one record");
    //             monitorSection(current_curriculum);
    //             findTableToRefresh(current_curriculum);
    //             filterBarangay();
    //         })
    //         .fail(function (jqxHR, textStatus, errorThrown) {
    //             console.log(jqxHR, textStatus, errorThrown);
    //             getToast("error", "Eror", errorThrown);
    //         });
    // } else {
    //     return false;
    // }
});


$(".deleteYes").on('click', function () {
    $.ajax({
        url: "delete/" + $(this).val(),
        type: "DELETE",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".deleteYes").html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
        },
    })
        .done(function (response) {
            $(".deleteYes").html("Delete");
            getToast("success", "Success", "deleted one record");
            monitorSection(current_curriculum);
            findTableToRefresh(current_curriculum);
            filterBarangay();
            $(this).val('')
            $("#teacherDeleteModal").modal("hide");
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
})

/**
 *
 * EDIT FUNCTIONALITIES PER CURRICULUM
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
            $(".btnEdit_" + id).html(
                response.section_id != "" ? "Change" : "Section"
            );
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
                    <td>${val.gender}</td>
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

$(document).on("click", ".printBtn", function () {
    popupCenter({
        url: "print/report/" + $(this).val(),
        title: "report",
        w: 1200,
        h: 800,
    });
});

/**
 *
 *
 * ----------------------exporting--------------------
 *
 *
 **/

$("#btnModalExport").on("click", function () {
    $("#modalExport").modal("show");
});

$(".btnGenerate").on("click", function (e) {
    e.preventDefault();
    let myFormat = $("#myFormat").val();
    let mystatus = $("#mystatus").val();
    console.log(mystatus);
    window.open(
        `export/excel/${myFormat}/${mystatus}/${current_curriculum}/${current_glc}`,
        "_blank"
    );
});

/**
 *
 * ----------------------  Mass sectioing fucntionalities --------------------------------
 *
 */
filterSection(current_curriculum);
$("#tableCurriculum").on("click", 'input[type="checkbox"]', function () {
    if ($("input[type='checkbox']:checked").length > 0) {
        $("#sectionGrouping").fadeIn(1000);
    } else {
        $("#sectionGrouping").fadeOut(1000);
    }
});
$("#massSectioningForm").on("submit", function (e) {
    e.preventDefault();
    let array_selected = [];
    let tblData = tableCurriculum.rows(".selected").data();
    $.each(tblData, function (i, val) {
        array_selected.push(val.id);
    });
    if ($('select[name="sectioningNow"]').val() != "") {
        $.ajax({
            url: `section/mass/sectioning`,
            type: "POST",
            data: {
                _token: $('input[name="_token"]').val(),
                enroll_id: array_selected,
                section: $('select[name="sectioningNow"]').val(),
            },
            beforeSend: function () {
                $(".btnmassSectioning")
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
                    getToast("warning", "Warning", data.warning);
                    $(".btnmassSectioning")
                        .html("Save")
                        .attr("disabled", false);
                } else {
                    $(".btnmassSectioning")
                        .html("Save")
                        .attr("disabled", false);
                    $('select[name="sectioningNow"]').val("");
                    $("#sectionGrouping").fadeOut(1000);
                    monitorSection(current_curriculum);
                    findTableToRefresh(current_curriculum);
                    tableCurriculum.ajax.reload();
                }
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                $(".btnmassSectioning").html("Save").attr("disabled", false);
                getToast("error", "Eror", errorThrown);
                $(".btnSaveSection").html("Submit").attr("disabled", false);
            });
    } else {
        alert("Select Section");
    }
});
