// $('select[name="barangay"]').on("change", function () {
//     let province = $('select[name="province"] option:selected').text();
//     let city = $('select[name="city"] option:selected').text();
//     let barangay = $('select[name="barangay"] option:selected').text();
//     $('input[name="address"]').val(
//         ucwords(barangay.toLowerCase()) +
//             ", " +
//             ucwords(city.toLowerCase()) +
//             ", " +
//             ucwords(province.toLowerCase())
//     );
// });

$("input[name='roll_no']").on("blur", function () {
    if ($(this).val() == "") {
        $(".btnEnroll").show();
        $("#staticBackdrop").modal("hide");
    } else {
        $.ajax({
            url: "form/check/lrn/" + $(this).val(),
            type: "GET",
        })
            .done(function (data) {
                if (data.warning) {
                    $("#staticBackdrop").modal("show");
                    $(".modal-title").text("Warning");
                    $(".txt").text("You are already enrolled");
                    $(".btnEnroll").hide();
                    document.getElementById("enrollForm").reset();
                } else {
                    $("#staticBackdrop").modal("hide");
                    $(".btnEnroll").show();
                }
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
            });
    }
});

/**
 *
 *
 *
 *
 *
 *
 */
var my_handlers = {
    fill_provinces: function () {
        var region_code = $(this).val();
        $("#province").ph_locations("fetch_list", [
            { region_code: region_code },
        ]);
    },

    fill_cities: function () {
        var province_code = $(this).val();
        $("#city").ph_locations("fetch_list", [
            { province_code: province_code },
        ]);
    },

    fill_barangays: function () {
        var city_code = $(this).val();
        $("#barangay").ph_locations("fetch_list", [{ city_code: city_code }]);
    },
};

$("#region").on("change", my_handlers.fill_provinces);
$("#province").on("change", my_handlers.fill_cities);
$("#city").on("change", my_handlers.fill_barangays);

$("#region").ph_locations({ location_type: "regions" });
$("#province").ph_locations({ location_type: "provinces" });
$("#city").ph_locations({ location_type: "cities" });
$("#barangay").ph_locations({ location_type: "barangays" });

$("#region").ph_locations("fetch_list");

/**
 *
 *
 *
 *
 *
 *
 */

$('select[name="grade_level"]').attr("disabled", true);
$('select[name="status"]').on("change", function () {
    if ($(this).val() != "") {
        if ($(this).val() == "New") {
            $('select[name="grade_level"]').attr("disabled", true);
        } else {
            $('select[name="grade_level"]').attr("disabled", false);
        }
    } else {
        $('select[name="grade_level"]').attr("disabled", true);
    }
});

$("#enrollForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "form/save",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
    })
        .done(function (data) {
            if (data.warning) {
                getToast(
                    "warning",
                    "Warning",
                    data.warning + ", please contact the administrator"
                );
            } else {
                window.location.href = "/done";
            }
            // $("#staticBackdrop").modal("show");
            // $(".modal-title").text("Successful");
            // $(".txt").text("Successfull saved your data");
            // document.getElementById("enrollForm").reset();
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
        });
});
