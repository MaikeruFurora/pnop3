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
                    ${
                        
                    val.remarks != 'Repeated'
                    ?
                    `
                    <tr>
                        <td><b>${val.subject_code}</b> ${val.descriptive_title} - ${val.grade_level}</td>
                        <td class="text-center">${val.avg!=0?val.avg:''}</td>
                        <td class="text-center">${
                            val.avg_now != null ? val.avg_now : ""
                        }</td>
                        <td class="text-center">${
                            val.conducted_from != null ? val.conducted_from : ""
                        }</td>
                        <td class="text-center">${
                            val.conducted_to != null ? val.conducted_to : ""
                        }</td>
                        <td class="text-center">${
                            val.remarks == "Passed"
                                ? `<span class="text-success"><b>${val.remarks}</b></span>`
                                : ''
                        }</td>
                    </tr>
                    `
                    :
                    ''
                    
                    }
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
