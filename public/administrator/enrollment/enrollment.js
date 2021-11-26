let enrollmentTable = (level, year) => {
    $("#enrollmentTable").dataTable().fnDestroy();
    $("#enrollmentTable").dataTable({
        processing: true,
        order: [3, "asc"],
        language: {
            processing: `
                    <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>`,
        },

        ajax: "enrollment/list/" + level + "/" + year,
        columns: [
            { data: "roll_no" },
            { data: "fullname" },
            {
                data: null,
                render: function (data) {
                    return data.curriculum != null
                        ? data.curriculum
                        : data.strand;
                },
            },
            {
                data: null,
                render: function (data) {
                    switch (data.term) {
                        case "1st":
                            return `<span class="badge badge-primary">Fist Sem</span>`;
                            break;
                        case "2nd":
                            return `<span class="badge badge-info">Second Sem</span>`;
                            break;
                        default:
                            return '-----------';
                            break;
                    }
                },
            },
            { data: "section_name" },
            {
                data: null,
                render: function (data) {
                    switch (data.enroll_status) {
                        case "Pending":
                            return `<span class="badge badge-warning">${data.enroll_status}</span>`;
                            break;
                        case "Enrolled":
                            return `<span class="badge badge-success">${data.enroll_status}</span>`;
                            break;
                        case "Dropped":
                            return `<span class="badge badge-danger">${data.enroll_status}</span>`;
                            break;
                        default:
                            return false;
                            break;
                    }
                },
            },
            {
                data: null,
                render: function (data) {
                    if (data.isbalik_aral == "Yes") {
                        return `${data.isbalik_aral} - ${data.last_schoolyear_attended}`;
                    } else {
                        return `${data.isbalik_aral}`;
                    }
                },
            },
            { data: "date_of_enroll" },
        ],
    });
};
enrollmentTable("all",$("select[name='school_year_id']").val());
$("select[name='selectedGL']").on("change", function () {
    enrollmentTable($(this).val(),$("select[name='school_year_id']").val());
});

$("select[name='school_year_id']").on("change", function () {
    enrollmentTable($("select[name='selectedGL']").val(),$(this).val());
});


$("button[name='btnExport']").on('click', function () {
    window.open("enrollment/export/by/level/"+$("select[name='school_year_id']").val()+"/"+$("select[name='selectedGL']").val())
});