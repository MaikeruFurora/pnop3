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
