let filterMyLoadSection = () => {
    let filterSectionHTML = `<option value="">Select Assign Section &nbsp;&nbsp;&nbsp;</option>`;
    $.ajax({
        url: "grading/load/subject",
        type: "GET",
        dataType: "json",
    })
        .done(function (data) {
            data.forEach((val) => {
                filterSectionHTML += `<option value="${val.id}_${
                    val.subject_id
                }">${val.section_name + `- ` + val.descriptive_title}</option>`;
            });
            $("select[name='filterMyLoadSection']").html(filterSectionHTML);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};
filterMyLoadSection();

let myClassTable = (section_id, subject_id) => {
    $("#myClassTable").dataTable().fnDestroy();
    $("#myClassTable").DataTable({
        pageLenth: 50,
        processing: true,
        language: {
            processing: `
                    <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>`,
        },

        ajax: `grading/load/student/${section_id}/${subject_id}`,
        columns: [
            { data: "fullname" },
            {
                data: null,
                orderable: false,
                render: function (data) {
                    return `<input type="text" pattern="^[0-9]{3}$" onkeypress="return numberOnly(event)" maxlength="3"  name="inGrade" class="noborder text-center"
                        value="${
                            data.first == null
                                ? ""
                                : data.first == 0
                                ? ""
                                : data.first
                        }"
                                    id="1st_${data.sid}"
                                    data-grade="${data.gid}" data-subject="${
                        data.subject_id
                    }">`;
                },
            },
            {
                data: null,
                orderable: false,
                render: function (data) {
                    return `<input type="text" pattern="^[0-9]{3}$" onkeypress="return numberOnly(event)" maxlength="3"  name="inGrade" class="noborder text-center"  value="${
                        data.second == null
                            ? ""
                            : data.second == 0
                            ? ""
                            : data.second
                    }" id="2nd_${data.sid}" data-grade="${
                        data.gid
                    }" data-subject="${data.subject_id}">`;
                },
            },
            {
                data: null,
                orderable: false,
                render: function (data) {
                    return `<input type="text" pattern="^[0-9]{3}$" onkeypress="return numberOnly(event)" maxlength="3"  name="inGrade" class="noborder text-center" value="${
                        data.third == null
                            ? ""
                            : data.third == 0
                            ? ""
                            : data.third
                    }" id="3rd_${data.sid}" data-grade="${
                        data.gid
                    }" data-subject="${data.subject_id}">`;
                },
            },
            {
                data: null,
                orderable: false,
                render: function (data) {
                    return `<input type="text" pattern="^[0-9]{3}$" onkeypress="return numberOnly(event)" maxlength="3"  name="inGrade" class="noborder text-center" value="${
                        data.fourth == null
                            ? ""
                            : data.fourth == 0
                            ? ""
                            : data.fourth
                    }" id="4th_${data.sid}" data-grade="${
                        data.gid
                    }" data-subject="${data.subject_id}">`;
                },
            },
            {
                data: null,
                orderable: false,
                render: function (data) {
                    myAverage = Math.round(
                        (data.first + data.second + data.third + data.fourth) /
                            4
                    );
                    return `${
                        myAverage != 0
                            ? data.first == null ||
                              data.second == null ||
                              data.third == null ||
                              data.fourth == null
                                ? ""
                                : `<span class="ml-4">${myAverage}</span>`
                            : ""
                    }`;
                },
            },
            {
                data: null,
                orderable: false,
                render: function (data) {
                    myAverage = Math.round(
                        (data.first + data.second + data.third + data.fourth) /
                            4
                    );
                    $(".txtSubjectName").text(data.descriptive_title);
                    return `${
                        myAverage != 0
                            ? data.first == null ||
                              data.second == null ||
                              data.third == null ||
                              data.fourth == null
                                ? ""
                                : myAverage >= 75
                                ? `<span class="ml-3 badge badge-success">Passed</span>`
                                : `<span class="ml-3 badge badge-danger ">Failed</span>`
                            : ""
                    }`;
                },
            },
        ],
        createdRow: function (row, data, index) {
            if (parseInt(data.avg) <= parseInt(75)) {
                // $(row).find("td:eq(10)").css("color", "red");
                $(row).css("backgroud-color", " red");
            }
        },
    });
};

$("#btnImport").hide();
$(".btnDownload").hide();
$("select[name='filterMyLoadSection']").on("change", function () {
    $("#btnImport").show()
    let containID = $(this).val().split("_");
    let section_id = containID[0];
    let subject_id = containID[1];
    if ($(this).val() != "") {
        myClassTable(section_id, subject_id);
        $(".btnDownload").show();
        $("#btnImport").show();
    } else {
        $(".btnDownload").hide();
        $("#btnImport").hide();
        $("#gradingTable").html(`
        <tr>
        <td colspan="7" class="text-center">No data available</td>
    </tr>`);
    }
});


$("#btnImport").on('click', function () {
   $("#exampleModalCenter").modal("show") 
});

$(".clickCancel").on('click', function () {
    $('input[name="file"]').val("")
});

$(".btnDownload").on('click', function () {
    let containID = $("select[name='filterMyLoadSection']").val().split("_");
    let section_id = containID[0];
    let subject_id = containID[1];
    window.open(`export/grade/${section_id}/${subject_id}/jhs`,
        '_target')
});

let selectedValue;
$(document).on("mouseup", "input[name='inGrade']", function () {
    selectedValue = $(this).val();
});

$(document).on("blur", "input[name='inGrade']", function () {
    if ($(this).val() < 70 || $(this).val() > 99) {
        $(this).val("");
    } else {
        if ($(this).val() != "" && $(this).val() != selectedValue) {
            let student_id = $(this).attr("id").split("_")[1];
            let subject_id = $(this).attr("data-subject");
            let grade_id =
                $(this).attr("data-grade") == "null"
                    ? "Nothing"
                    : $(this).attr("data-grade");
            let flag = false;
            switch ($(this).attr("id").split("_")[0]) {
                case "2nd":
                    flag = $("#1st_" + student_id).val() == "";
                    break;
                case "3rd":
                    flag =
                        $("#1st_" + student_id).val() == "" ||
                        $("#2nd_" + student_id).val() == "";
                    break;
                case "4th":
                    flag =
                        $("#1st_" + student_id).val() == "" ||
                        $("#2nd_" + student_id).val() == "" ||
                        $("#3rd_" + student_id).val() == "";
                    break;

                default:
                    break;
            }
            if (!flag) {
                let avg =
                    $("#4th_" + student_id).val() != ""
                        ? Math.round(
                              (parseInt($("#1st_" + student_id).val()) +
                                  parseInt($("#2nd_" + student_id).val()) +
                                  parseInt($("#3rd_" + student_id).val()) +
                                  parseInt($("#4th_" + student_id).val())) /
                                  4
                          )
                        : "";
                $.ajax({
                    url: "grade/student/now",
                    type: "POST",
                    data: {
                        _token: $('input[name="_token"]').val(),
                        student_id,
                        subject_id,
                        grade_id,
                        avg,
                        columnIn: $(this).attr("id").split("_")[0],
                        value: $(this).val(),
                    },
                    // beforeSend: function () {
                    //     $("input[name='inGrade']").addClass("is-valid");
                    // },
                })
                    .done(function (data) {
                        $("#4th_" + student_id).val() != ""
                            ? myClassTable(
                                  $("select[name='filterMyLoadSection']")
                                      .val()
                                      .split("_")[0],
                                  $("select[name='filterMyLoadSection']")
                                      .val()
                                      .split("_")[1]
                              )
                            : "";
                        console.log(data);
                    })
                    .fail(function (jqxHR, textStatus, errorThrown) {
                        console.log(jqxHR, textStatus, errorThrown);
                        getToast("error", "Eror", errorThrown);
                    });
            } else {
                $("#fillGradeInPrevious").modal("show");
                switch ($(this).attr("id").split("_")[0]) {
                    case "1st":
                        $("#1st_" + student_id).val("");
                        break;
                    case "2nd":
                        $("#2nd_" + student_id).val("");
                        break;
                    case "3rd":
                        $("#3rd_" + student_id).val("");
                        break;
                    case "4th":
                        $("#4th_" + student_id).val("");
                        break;

                    default:
                        break;
                }
            }
        }
    }
});

let loadMyStudent = (section_id, subject_id) => {
    let loadMyStudentHTML;
    let myAverage = 0;
    $.ajax({
        url: `grading/load/student/${section_id}/${subject_id}`,
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            $("#gradingTable").html(`<tr>
                            <td colspan="7" class="text-center">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </td>
                        </tr>`);
        },
    })
        .done(function (data) {
            //     if (data.length > 0) {
            //         $(".txtSubjectName").text(data[0].descriptive_title);
            //         data.forEach((val) => {
            //             myAverage = Math.round(
            //                 (val.first + val.second + val.third + val.fourth) / 4
            //             );
            //             loadMyStudentHTML += `
            //             <tr>
            //                 <td>${val.fullname}</td>
            //                 <td>
            //                 <input type="text" pattern="^[0-9]{3}$" onkeypress="return numberOnly(event)" maxlength="3"  name="inGrade" class="noborder form-control text-center"
            //                 value="${
            //                     val.first == null
            //                         ? ""
            //                         : val.first == 0
            //                         ? ""
            //                         : val.first
            //                 }"
            //                 id="1st_${val.sid}"
            //                 data-grade="${val.gid}" data-subject="${
            //                 val.subject_id
            //             }">
            //         </td>
            //         <td><input type="text" pattern="^[0-9]{3}$" onkeypress="return numberOnly(event)" maxlength="3"  name="inGrade" class="noborder form-control text-center"  value="${
            //             val.second == null ? "" : val.second == 0 ? "" : val.second
            //         }" id="2nd_${val.sid}" data-grade="${val.gid}" data-subject="${
            //                 val.subject_id
            //             }"></td>
            //                 <td><input type="text" pattern="^[0-9]{3}$" onkeypress="return numberOnly(event)" maxlength="3"  name="inGrade" class="noborder form-control text-center" value="${
            //                     val.third == null
            //                         ? ""
            //                         : val.third == 0
            //                         ? ""
            //                         : val.third
            //                 }" id="3rd_${val.sid}" data-grade="${
            //                 val.gid
            //             }" data-subject="${val.subject_id}"></td>
            //                 <td><input type="text" pattern="^[0-9]{3}$" onkeypress="return numberOnly(event)" maxlength="3"  name="inGrade" class="noborder form-control text-center" value="${
            //                     val.fourth == null
            //                         ? ""
            //                         : val.fourth == 0
            //                         ? ""
            //                         : val.fourth
            //                 }" id="4th_${val.sid}" data-grade="${
            //                 val.gid
            //             }" data-subject="${val.subject_id}"></td>
            //                 <td>
            //                 <input type="text" pattern="^[0-9]{3}$" onkeypress="return numberOnly(event)" maxlength="3"  class="noborder form-control text-center "  value="${
            //                     myAverage != 0
            //                         ? val.first == null ||
            //                           val.second == null ||
            //                           val.third == null ||
            //                           val.fourth == null
            //                             ? ""
            //                             : myAverage
            //                         : ""
            //                 }">
            //                 </td>
            //                 <td>${
            //                     myAverage != 0
            //                         ? val.first == null ||
            //                           val.second == null ||
            //                           val.third == null ||
            //                           val.fourth == null
            //                             ? ""
            //                             : myAverage >= 75
            //                             ? `<span class="text-success">Passed</span>`
            //                             : `<span class="text-danger">Failed</span>`
            //                         : ""
            //                 }</td>
            //             </tr>
            //             `;
            //         });
            //     } else {
            //         loadMyStudentHTML += `
            //         <tr>
            //         <td colspan="7" class="text-center">No data available</td>
            //     </tr>`;
            //     }
            //     $("#gradingTable").html(loadMyStudentHTML);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};


$("#importForm").submit(function (e) {
    e.preventDefault()
    let containID = $("select[name='filterMyLoadSection']").val().split("_");
    let section_id = containID[0];
    let subject_id = containID[1];
    $.ajax({
        url: "import/grade/"+section_id+"/"+subject_id+"/jhs",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $(".btnImportNow").html(
                `Importing...  <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
                    `
            );
        },
    }).done(function (data) {
        $('input[name="file"]').val("")
        $(".btnImportNow").html('Import Now')
        let containID = $("select[name='filterMyLoadSection']").val().split("_");
        let section_id = containID[0];
        let subject_id = containID[1];
        myClassTable(section_id, subject_id);
    }).fail(function (jqxHR, textStatus, errorThrown) {
         $(".btnImportNow").html('Import Now')
        console.log(jqxHR, textStatus, errorThrown);
    });
})