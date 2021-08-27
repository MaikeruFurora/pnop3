let backsubjectTable = () => {
    let backsubjectHTML = "";
    $.ajax({
        url: "backsubject/list",
        type: "GET",
        dataType: "json",
    })
        .done(function (data) {
            console.log(data);
            data.forEach((val) => {
                backsubjectHTML += `
                    <tr>
                        <td>${val.descriptive_title}</td>
                        <td class="text-center">${val.grade_level}</td>
                        <td class="text-center">${val.prev_avg}</td>
                        <td class="text-center">${
                            val.avg_now != null ? val.avg_now : ""
                        }</td>
                        <td class="text-center">${
                            val.remarks == "Passed"
                                ? `<span class="text-success"><b>${val.remarks}</b></span>`
                                : val.remarks
                        }</td>
                    </tr>
                `;
            });
            $("#backsubjectTable").html(backsubjectHTML);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};

backsubjectTable();
