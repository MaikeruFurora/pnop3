let gradeTable = (level, section,term) => {
    let htmlHold = "";
    $.ajax({
        url: `grade/list/${level}/${section}/${term}`,
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            $("#gradeTable").html(
                `<tr>
                        <td colspan="7" class="text-center">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </td>
                    </tr>
                    `
            );
        },
    })
        .done(function (data) {
            /**
             * <td class="">
                ${val.fullname == null ? "---" : val.fullname}
                </td>
             */
            setTimeout(() => {
                let overallGrade = 0;
                if (data.length > 0) {
                    $(".txtSectionName").text(data[0].section_name);
                    data.forEach((val) => {
                        overallGrade += parseInt(val.avg);
                        htmlHold += `
                        <tr style="background-color:${
                            val.avg < 75 && val.avg != null ? "#ffe6e6" : ""
                        }">
                            


                            <td class="">
                            ${val.descriptive_title}
                            </td>
                            <td class="text-center">
                            ${
                                val.first == null
                                    ? ""
                                    : val.first == 0
                                    ? ""
                                    : val.first
                            }
                            </td>
                            <td class="text-center">
                            ${
                                val.second == null
                                    ? ""
                                    : val.second == 0
                                    ? ""
                                    : val.second
                            }
                            </td>
                            <td class="text-center">
                            ${
                                val.avg == null
                                    ? ""
                                    : val.avg == 0
                                    ? ""
                                    : val.avg
                            }
                            </td>
                            <td class="text-center">
                            ${
                                val.avg != 0
                                    ? val.first == null || val.second == null
                                        ? ""
                                        : val.avg >= 75
                                        ? `<span class="ml-3 badge badge-success">Passed</span>`
                                        : `<span class="ml-3 badge badge-danger ">Failed</span>`
                                    : ""
                            }
                            </td>
                        </tr>
                    `;
                    });
                } else {
                    htmlHold = `
                    <tr>
                        <td colspan="8" class="text-center">
                            No subjects available
                        </td>
                    </tr>
                `;
                }
                $("#gradeTable").html(htmlHold);
                $("#overallGrade").html(
                    `<b>${ (isNaN(Math.round(overallGrade / data.length)))?'':Math.round(overallGrade / data.length)}</b>`
                );
                $("#overallRemark").html(
                    (isNaN(Math.round(overallGrade / data.length)))?'':
                    Math.round(overallGrade / data.length) > 75
                        ? `<span class="ml-3 badge badge-success ">Passed</span>`
                        : `<span class="ml-3 badge badge-danger ">Failed</span>`
                );
            }, 2000);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};
let active_term = $('input[name="active_term"]').val()
let filterGradeLevel = () => {
    let filterGradeLevelHTML = `<option value="">Select Grade Level</option>`;
    $.ajax({
        url: "level/list",
        type: "GET",
        dataType: "json",
    })
        .done(function (data) {
            $(".txtSectionName").text(data[0].section_name);
            data.forEach((val) => {
                console.log(val.status);
                filterGradeLevelHTML += `<option value="${val.grade_level}_${val.section_id}_${val.term}">Grade ${val.grade_level} - ${val.term} Term</option>`;
                // filterGradeLevelHTML += `<option ${ val.status == "1" && val.term == active_term ? "selected" : "" }
                // value="${val.grade_level}_${val.section_id}_${val.term}">Grade ${val.grade_level} - ${val.term} Term</option>`;
            });
            $("select[name='filterGradeLevel']").html(filterGradeLevelHTML);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};

filterGradeLevel();
setTimeout(() => {
    let val = $("select[name='filterGradeLevel']")
        .prop("selectedIndex", 0)
        .val()
        .split("_");
    if (val!="") {
        gradeTable(val[0], val[1],val[2]);
    }
}, 5000);

$("select[name='filterGradeLevel']").on("change", function () {
    let data = $(this).val().split("_");
    if (data!="") {
        gradeTable(data[0], data[1],data[2]);
    }
});
