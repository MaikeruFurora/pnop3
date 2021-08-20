let getToast = (type, title, message) => {
    switch (type) {
        case "info":
            iziToast.info({
                title: title,
                message: message,
                position: "topRight",
            });
            break;
        case "success":
            iziToast.success({
                title: title,
                message: message,
                position: "topRight",
            });
            break;
        case "error":
            iziToast.error({
                title: title,
                message: message,
                position: "topRight",
            });
            break;
        case "warning":
            iziToast.warning({
                title: title,
                message: message,
                position: "topRight",
            });
            break;
        default:
            console.log("nothing");
            break;
    }
};

let numberOnly = (evt) => {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    return true;
};

String.prototype.capitalize = function () {
    return this.charAt(0).toUpperCase() + this.slice(1);
};
let ucwords = (str) => {
    return (str + "").replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
};

/**
 *
 * SET GLOBAL
 *
 */

$('select[name="region_text"]').on("change", function () {
    let region = $('select[name="region_text"] option:selected').text();
    $('input[name="region"]').val(region);
});

$('select[name="province_text"]').on("change", function () {
    let province = $('select[name="province_text"] option:selected').text();
    $('input[name="province"]').val(province);
});

$('select[name="city_text"]').on("change", function () {
    let city = $('select[name="city_text"] option:selected').text();
    $('input[name="city"]').val(city);
});

$('select[name="barangay_text"]').on("change", function () {
    let barangay = $('select[name="barangay_text"] option:selected').text();
    $('input[name="barangay"]').val(barangay);
});
