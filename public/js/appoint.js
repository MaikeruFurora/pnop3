let d = new Date();
let n = d.getFullYear();

let eventHoliday = [];
$.ajax({
    url: "holiday/list",
    type: "GET",
})
    .done(function (data) {
        data.forEach((element) => {
            eventHoliday.push(
                monthNameToNum(element.holi_date_from.split(" ")[0]) +
                    "/" +
                    element.holi_date_from.split(" ")[1] +
                    "/" +
                    n
            );
            if (element.holi_date_to != null) {
                for (
                    let i = parseInt(element.holi_date_from.split(" ")[1]);
                    i <= parseInt(element.holi_date_to.split(" ")[1]);
                    i++
                ) {
                    eventHoliday.push(
                        monthNameToNum(element.holi_date_to.split(" ")[0]) +
                            "/" +
                            i +
                            "/" +
                            n
                    );
                }
            }
        });
        console.log(eventHoliday);
    })
    .fail(function (a, b, c) {
        console.log(a, b, c);
    });
// $(".datepicker").datepicker({
//     dateFormat: "mm/dd/yy",
//     minDate: 0,
//     // beforeShowDay : function (date) {
//     //       // 0 : Sunday, 1 : Monday, ...
//     //       return dayOfWeek == 0 || dayOfWeek == 6? [false]: [true];

//     //    },
//     beforeShowDay: function (date) {
//         let dayOfWeek = date.getDay();
//         let datew = $.datepicker.formatDate("mm/dd/yy", date);
//         // dayOfWeek == 0 || dayOfWeek == 6 ? [false] : [true];

//         // if (dayOfWeek > 0 && dayOfWeek < 6) {
//         //     return [true];
//         // }
//         return [eventHoliday.indexOf(datew) == -1];
//     },
// });

let dateFetch = [];
$.ajax({
    url: "list",
    type: "GET",
})
    .done(function (data) {
        data.forEach((val) => {
            dateFetch.push({
                set_date: val.set_date,
                inTotal: val.inTotal,
            });
        });
    })
    .fail(function (a, b, c) {
        console.log(a, b, c);
    });

$(".datepicker").datepicker({
    dateFormat: "mm/dd/yy",
    minDate: 0,
    beforeShowDay: function (date) {
        let day = date.getDay();

        // First convert all values in dateArray to date Object and compare with current date
        let dateFound = eventHoliday.find((item) => {
            let formattedDate = new Date(item);
            return (
                date.toLocaleDateString() === formattedDate.toLocaleDateString()
            );
        });
        //give color
        let changeColor = dateFetch.find((item) => {
            let datew = $.datepicker.formatDate("mm/dd/yy", date);
            if (item.set_date.toString() == datew.toString()) {
                return item.inTotal >= 100;
            }
        });

        if (changeColor || dateFound) {
            return [false, "full", ""];
        } else {
            return [true && day != 0 && day != 6, "vacant", ""];
        }
        // check if date is in your array of dates
        // if () {
        //     // if it is return the following.
        //     return [false, "not", "tooltip text"];
        // } else {
        //     // default
        //     // Disable all sundays
        //     return [day != 0 && day != 6, "", ""];
        // }
    },
});

// var holiDays =[[2011,01,01,'New Years Day'],[2010,01,14,'Pongal'],[2011,12,25,'Christmas Day']];
// $(function() {
//     $("#date").datepicker({
//        beforeShowDay: setHoliDays
//     });

//     // set holidays function which is configured in beforeShowDay
//    function setHoliDays(date) {
//      for (i = 0; i < holiDays.length; i++) {
//        if (date.getFullYear() == holiDays[i][0]
//             && date.getMonth() == holiDays[i][1] - 1
//             && date.getDate() == holiDays[i][2]) {
//           return [true, 'holiday', holiDays[i][3]];
//        }
//      }
//     return [true, ''];
//   }

//   });

// $("#datepicker").datepicker({
//     minDate: 0,
//     beforeShowDay: function (date) {
//         // it is possible to write the following function using one line
//         // of code; instead, multiple if/else are used for readability
//         var ok = true;
//         if (date.getDay() === 0) { // is sunday
//             ok = false;
//         } else {
//             var dateStr = $.datepicker.formatDate("m-dd-yy", date);
//             if ($.inArray(dateStr, disabledDays) >= 0) { // is holiday
//                 ok = false;
//             }
//         }
//         return [ok, ""];
//     }
// });
// });
