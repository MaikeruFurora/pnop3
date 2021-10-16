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

let months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
];
function monthNameToNum(monthname) {
    let oneDigit = "0";
    let month = months.indexOf(monthname);
    return month
        ? /^\d$/.test(month)
            ? oneDigit.concat(month + 1)
            : month + 1
        : 0;
}

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

const popupCenter = ({ url, title, w, h }) => {
    const dualScreenLeft =
        window.screenLeft !== undefined ? window.screenLeft : window.screenX;
    const dualScreenTop =
        window.screenTop !== undefined ? window.screenTop : window.screenY;

    const width = window.innerWidth
        ? window.innerWidth
        : document.documentElement.clientWidth
        ? document.documentElement.clientWidth
        : screen.width;
    const height = window.innerHeight
        ? window.innerHeight
        : document.documentElement.clientHeight
        ? document.documentElement.clientHeight
        : screen.height;

    const systemZoom = width / window.screen.availWidth;
    const left = (width - w) / 2 / systemZoom + dualScreenLeft;
    const top = (height - h) / 2 / systemZoom + dualScreenTop;
    const newWindow = window.open(
        url,
        title,
        `
      scrollbars=yes,
      width=${w / systemZoom}, 
      height=${h / systemZoom}, 
      top=${top}, 
      left=${left}
      `
    );
    newWindow;
};

///////////////////////////////
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

$("#modalForBackUp").on("click", function () {});
