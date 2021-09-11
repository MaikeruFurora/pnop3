let d = new Date();
let month = d.getMonth();

let numericMonth = (month) => {
    let oneDigit = "0";
    return /^\d$/.test(month) ? oneDigit.concat(month + 1) : month + 1;
};
let eventList = [];
let myAllAppointment = () => {
    $.ajax({
        url: "appointment/list/" + numericMonth(month),
        type: "GET",
    })
        .done(function (data) {
            data.forEach((element) => {
                eventList.push({
                    start: element.start,
                    end: element.end == null ? element.start : element.end,
                    title: element.title,
                    backgroundColor: element.backgroundColor,
                    borderColor: element.borderColor,
                    textColor: element.textColor,
                    className: element.className,
                });
            });
            myEvent();
        })
        .fail(function (a, b, c) {
            console.log(a, b, c);
        });
};
myAllAppointment();
/**
 *
 *
 *
 *
 *
 *
 *
 */

$("#btnModalHoliday").on("click", function () {
    $("#holidayModal").modal("show");
});

$(".datepicker1").datepicker({
    dateFormat: "MM dd",
});
$(".datepicker2").datepicker({
    dateFormat: "MM dd",
});

$("#holidayForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "holiday/save",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $(".btnSaveHoliday")
                .html(
                    `Saving ...
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`
                )
                .attr("disabled", true);
        },
    })
        .done(function (response) {
            $(".btnSaveHoliday").html("Save").attr("disabled", false);
            getToast("success", "Success", "Successfully added new Date");
            document.getElementById("holidayForm").reset();
            $('input[name="id"]').val("");
            tableHoliday.ajax.reload();
            myAllAppointment();
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            $(".btnSaveHoliday").html("Save").attr("disabled", false);
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});

$(".btnCancelHoliday").on("click", function () {
    document.getElementById("holidayForm").reset();
    $("#holidayModal").modal("hide");
    $('input[name="id"]').val("");
});

let tableHoliday = $("#tableHoliday").DataTable({
    lengthChange: false,
    processing: true,
    language: {
        processing: `
            <div class="spinner-border spinner-border-sm" role="status">
            <span class="sr-only">Loading...</span>
          </div>`,
    },
    ajax: "holiday/list",
    columns: [
        {
            data: null,
            render: function (data) {
                if (data.holi_date_to == null) {
                    return `${data.holi_date_from}`;
                } else {
                    return `${data.holi_date_from}-${
                        data.holi_date_to.split(" ")[1]
                    }`;
                }
            },
        },
        { data: "description" },
        {
            data: null,
            render: function (data) {
                return `
                    <button class="btn btn-sm btn-info btnEdit btnload_${data.id}" value="${data.id}">Edit</button>
                    <button class="btn btn-sm btn-danger btnDelete btnDLoad_${data.id}" value="${data.id}">Delete</button>
                `;
            },
        },
    ],
});

$(".datepicker2").on("blur", function () {
    setTimeout(() => {
        let fromData = $("input[name='holi_date_from']").val().split(" ");
        let fromTo = $(this).val().split(" ");
        let from = monthNameToNum(fromData[0]) + "/" + fromData[1];
        let to = monthNameToNum(fromTo[0]) + "/" + fromTo[1];
        if (from > to) {
            $(this).val("");
        }
    }, 1000);
});

$(document).on("click", ".btnEdit", function () {
    let id = $(this).val();
    $.ajax({
        url: "holiday/edit/" + $(this).val(),
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            $(".btnload_" + id)
                .html(
                    `
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`
                )
                .attr("disabled", true);
        },
    })
        .done(function (response) {
            $(".btnload_" + id)
                .html("Edit")
                .attr("disabled", false);
            $('input[name="id"]').val(response.id);
            $('input[name="holi_date_from"]').val(response.holi_date_from);
            $('input[name="holi_date_to"]').val(response.holi_date_to);
            $('textarea[name="description"]').val(response.description);
            $('input[name="status"]').val(response.status);
            $("#holidayModal").modal("show");
            $("#myEvent").fullCalendar("refetchResources");
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            $(".btnload_" + id)
                .html("Save")
                .attr("disabled", false);
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});

$(document).on("click", ".btnDelete", function () {
    let id = $(this).val();
    $.ajax({
        url: "holiday/delete/" + $(this).val(),
        type: "DELETE",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".btnDLoad_" + id)
                .html(
                    `
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`
                )
                .attr("disabled", true);
        },
    })
        .done(function (response) {
            $(".btnDLoad_" + id)
                .html("Edit")
                .attr("disabled", false);
            tableHoliday.ajax.reload();
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            $(".btnDLoad_" + id)
                .html("Save")
                .attr("disabled", false);
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});

/**
 *
 * --------------------- CALENDARA EVENT-----------------------------
 *
 *
 */

let showListOfAppointed = (selected) => {
    $("#appointedTable").DataTable({
        destroy: true,
        ajax: "appointment/list/selected/" + selected,
        columns: [
            { data: "appoint_no", orderable: false },
            { data: "fullname", orderable: false },
            { data: "contact_no", orderable: false },
            { data: "email", orderable: false },
            { data: "address", orderable: false },
            { data: "purpose", orderable: false },
        ],
    });
    $("#appointedModal").modal("show");
    $("#appointedModalLabel").text(selected);
};

let myEvent = () => {
    $("#myEvent").fullCalendar({
        height: "auto",
        header: {
            right: "prev,next today",
            left: "title",
            // right: "month",
        },
        weekends: false,
        initialView: "dayGridMonth",
        // selectable: true,
        // dayClick: function (date, jsEvent, view) {
        // $("#appointedModal").modal("show");
        // $("#appointedModalLabel").text(date.format());
        // },
        eventClick: function (info) {
            let myDateSelected = $.fullCalendar.formatDate(
                info.start,
                "MM-DD-Y"
            );
            console.log(info);
            showListOfAppointed(myDateSelected);
        },
        eventRender: function (event, element) {
            let dateString = $.fullCalendar.formatDate(event.start, "Y-MM-DD");

            if (event.className == "full") {
                $('td[data-date="' + dateString + '"]')
                    .css("background", "#ffa366")
                    .css("color", "white")
                    .css("border-top", "1px solid white")
                    .css("border-right", "1px solid white");
                element
                    .find(".fc-title")
                    .prepend("<i class='fas fa-users'></i>&nbsp;&nbsp;");
            } else if (event.className == "vacant") {
                $('td[data-date="' + dateString + '"]')
                    // .css("background", "#66cc66")
                    .css("background", "white")
                    .css("color", "black")
                    .css("border-top", "1px solid white")
                    .css("border-right", "1px solid white");
                element
                    .find(".fc-title")
                    .prepend("<i class='fas fa-users'></i>&nbsp;&nbsp;");
            } else {
                // $('td[data-date="' + dateString + '"]')
                //     .css("background", "#9999ff")
                //     .css("color", "white")
                //     .css("border-top", "1px solid white")
                //     .css("border-right", "1px solid white");
                element
                    .find(".fc-title")
                    .prepend("<i class='fas fa-thumbtack'></i>&nbsp;&nbsp;");
            }
        },
        viewRender: function (i) {
            let ini = moment();
            if (ini >= i.start && ini <= i.end) {
                $(".fc-prev-button")
                    .prop("disabled", true)
                    .addClass("fc-state-disabled");
            } else {
                $(".fc-prev-button")
                    .removeClass("fc-state-disabled")
                    .prop("disabled", false);
            }
        },
        events: eventList,
    });
};
