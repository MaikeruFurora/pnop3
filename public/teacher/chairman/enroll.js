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

let monitorSection = (curriculum) => {
    let monitorHMTL = "";
    $.ajax({
        url: `monitor/section/${curriculum}`,
        type: "GET",
        dataType: "json",
    })
        .done(function (data) {
            data.forEach((val) => {
                monitorHMTL += `<div class="col-lg-2 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow">
                  <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>${val.section_name}</h4>
                    </div>
                    <div class="card-body">
                    ${val.total} 
                    </div>
                  </div>
                </div>
              </div>`;
            });
            $(".sectionListAvailable").html(monitorHMTL);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSaveSectionNow").html("Save").attr("disabled", false);
        });
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
                } else {
                    $("input[name='roll_no']")
                        .removeClass("is-invalid")
                        .addClass("is-valid");
                }
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
            });
    }
});

$("#btnModalStudent").on("click", function () {
    $("#staticBackdrop").modal("show");
    $("select[name='curriculum']").val(
        $('input[name="current_curriculum"]').val()
    );
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
            console.log(data);
            $("input[name='roll_no']").removeClass("is-valid");
            tableCurriculum.ajax.reload();
            getToast("success", "Ok", "Successfully added new enrolled");
            $(".btnSaveEnroll").html("Save");
            document.getElementById("enrollForm").reset();
            $("#last_school_attended").hide();
            monitorSection(current_curriculum);
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
 *
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

$("#setSectionForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "section/save",
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
                tableCurriculum.ajax.reload();
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
