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
