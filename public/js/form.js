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
                    $(".txt").text("You are already registered");
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
 */
// $("#forStrand").hide();
// $('select[name="grade_level"]').on("change", function () {
//     if (parseInt($(this).val()) > 10) {
//         $("#forStrand").show();
//         $("#forcurriculum").hide();
//     } else {
//         $("#forStrand").hide();
//         $("#forcurriculum").show();
//     }
// });
/**
 *
 *
 *
 *
 *
 *
 */
$("#forBalik").hide();
$('select[name="grade_level"]').attr("disabled", true);
$('select[name="status"]').on("change", function () {
    if ($(this).val() == "new") {
        $('select[name="grade_level"]').val("").attr("disabled", true);
    } else {
        $('select[name="grade_level"]').attr("disabled", false);
    }
    if ($(this).val() == "balikAral") {
        $("#forBalik").show();
    } else {
        $("#forBalik").hide();
    }
});

$("#enrollForm").submit(function (e) {
    $(".btnEnroll").attr("disabled", true);
    e.preventDefault();
    $.ajax({
        url: "form/save",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function (data) {
            $(".btnEnroll")
                .html(` <div class="spinner-border spinner-border-sm" role="status">
            <span class="sr-only">Loading...</span>
          </div>`);
        },
    })
        .done(function (data) {
            if (data.warning) {
                getToast(
                    "warning",
                    "Warning",
                    data.warning + ", please contact the administrator"
                );
                $(".btnEnroll").html("Submit");
                $(".btnEnroll").attr("disabled", false);
            } else {
                window.location.href = "/done/" + data;
            }
            // $("#staticBackdrop").modal("show");
            // $(".modal-title").text("Successful");
            // $(".txt").text("Successfull saved your data");
            // document.getElementById("enrollForm").reset();
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            $(".btnEnroll").html("Submit");
            $(".btnEnroll").attr("disabled", false);
            getToast("error", "Eror", errorThrown);
        });
});
