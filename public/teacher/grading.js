let filterMyLoadSection = () => {
    let filterSectionHTML = `<option value="">Choose... &nbsp;&nbsp;&nbsp;</option>`;
    $.ajax({
        url: "grading/load/subject",
        type: "GET",
        dataType: "json",
    })
        .done(function (data) {
            data.forEach((val) => {
                filterSectionHTML += `<option value="${val.id}">${val.section_name}</option>`;
            });
            $("select[name='filterMyLoadSection']").html(filterSectionHTML);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};
filterMyLoadSection();

let loadMyStudent = (section) => {
    let loadMyStudentHTML;
    let myAverage = 0;
    $.ajax({
        url: `grading/load/student/${section}`,
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
            // console.log(data);
            if (data.length > 0) {
                data.forEach((val) => {
                    myAverage = Math.round(
                        (val.first + val.second + val.third + val.fourth) / 4
                    );
                    loadMyStudentHTML += `
                        <tr>
                            <td>${val.fullname}</td>
                            <td>
                            <input type="text" pattern="^[0-9]{3}$" onkeypress="return numberOnly(event)" maxlength="3"  name="inGrade" class="noborder form-control text-center"
                            value="${
                                val.first == null
                                    ? ""
                                    : val.first == 0
                                    ? ""
                                    : val.first
                            }"
                            id="1st_${val.sid}"
                            data-grade="${val.gid}" data-subject="${
                        val.subject_id
                    }">
                    </td>
                    <td><input type="text" pattern="^[0-9]{3}$" onkeypress="return numberOnly(event)" maxlength="3"  name="inGrade" class="noborder form-control text-center"  value="${
                        val.second == null
                            ? ""
                            : val.second == 0
                            ? ""
                            : val.second
                    }" id="2nd_${val.sid}" data-grade="${
                        val.gid
                    }" data-subject="${val.subject_id}"></td>
                            <td><input type="text" pattern="^[0-9]{3}$" onkeypress="return numberOnly(event)" maxlength="3"  name="inGrade" class="noborder form-control text-center" value="${
                                val.third == null
                                    ? ""
                                    : val.third == 0
                                    ? ""
                                    : val.third
                            }" id="3rd_${val.sid}" data-grade="${
                        val.gid
                    }" data-subject="${val.subject_id}"></td>
                            <td><input type="text" pattern="^[0-9]{3}$" onkeypress="return numberOnly(event)" maxlength="3"  name="inGrade" class="noborder form-control text-center" value="${
                                val.fourth == null
                                    ? ""
                                    : val.fourth == 0
                                    ? ""
                                    : val.fourth
                            }" id="4th_${val.sid}" data-grade="${
                        val.gid
                    }" data-subject="${val.subject_id}"></td>
                            <td>
                            <input type="text" pattern="^[0-9]{3}$" onkeypress="return numberOnly(event)" maxlength="3"  class="noborder form-control text-center "  value="${
                                myAverage != 0
                                    ? val.first == null ||
                                      val.second == null ||
                                      val.third == null ||
                                      val.fourth == null
                                        ? ""
                                        : myAverage
                                    : ""
                            }">
                            </td>
                            <td>${
                                myAverage != 0
                                    ? val.first == null ||
                                      val.second == null ||
                                      val.third == null ||
                                      val.fourth == null
                                        ? ""
                                        : myAverage >= 75
                                        ? `<span class="text-success">Passed</span>`
                                        : `<span class="text-danger">Failed</span>`
                                    : ""
                            }</td>
                        </tr>
                        `;
                });
            } else {
                loadMyStudentHTML += `
                    <tr>
                    <td colspan="7" class="text-center">No data available</td>
                </tr>`;
            }
            $("#gradingTable").html(loadMyStudentHTML);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};
$("select[name='filterMyLoadSection']").on("change", function () {
    if ($(this).val() != "") {
        loadMyStudent($(this).val());
    } else {
        $("#gradingTable").html(`
        <tr>
        <td colspan="7" class="text-center">No data available</td>
    </tr>`);
    }
});

$(document).on("blur", "input[name='inGrade']", function () {
    // if ($(this).val() != "") {
    let student_id = $(this).attr("id").split("_")[1];
    let subject_id = $(this).attr("data-subject");
    let grade_id =
        $(this).attr("data-grade") == "null"
            ? "Nothing"
            : $(this).attr("data-grade");
    $.ajax({
        url: "grade/student/now",
        type: "POST",
        data: {
            _token: $('input[name="_token"]').val(),
            student_id,
            subject_id,
            grade_id,
            columnIn: $(this).attr("id").split("_")[0],
            value: $(this).val(),
        },
        // beforeSend: function () {
        //     $("input[name='inGrade']").addClass("is-valid");
        // },
    })
        .done(function (data) {
            console.log(data);
            loadMyStudent($("select[name='filterMyLoadSection']").val());
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
    // }
});
