$("#btnModalHoliday").on("click", function () {
    $("#holidayForm").modal("show");
});

$(".datepicker").datepicker({
    dateFormat: "MM dd",
    dayNames: [
        "Dimanche",
        "Lundi",
        "Mardi",
        "Mercredi",
        "Jeudi",
        "Vendredi",
        "Samedi",
    ],
});
