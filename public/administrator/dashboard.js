let populationByGradeLevel = (data) => {
    var ctx = document.getElementById("myChart2").getContext("2d");
    var myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: data.grade_level,
            datasets: [
                {
                    label: "Statistics",
                    data: data.population,
                    borderWidth: 2,
                    backgroundColor: "#6777ef",
                    borderColor: "#6777ef",
                    borderWidth: 2.5,
                    pointBackgroundColor: "#ffffff",
                    pointRadius: 4,
                },
            ],
        },
    });
};

let loadData = () => {
    $.ajax({
        url: "chart/population/by/level",
        type: "GET",
        dataType: "json",
    })
        .done(function (data) {
            populationByGradeLevel(data);
            console.table(data);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};
loadData();

let populationBySex = (data) => {
    var ctx = document.getElementById("myChart4").getContext("2d");
    var myChart = new Chart(ctx, {
        type: "pie",
        data: {
            datasets: [
                {
                    data: [data.Male, data.Female],
                    backgroundColor: ["#191d21", "#63ed7a"],
                    label: "Dataset 1",
                },
            ],
            labels: ["Male", "Female"],
        },
        options: {
            responsive: true,
            legend: {
                position: "bottom",
            },
        },
    });
};

let loadDataSex = () => {
    $.ajax({
        url: "chart/population/by/sex",
        type: "GET",
        dataType: "json",
    })
        .done(function (data) {
            populationBySex(data[0]);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};
loadDataSex();

let populationByCurriculum = (data) => {
    var cbc = document.getElementById("myChart3").getContext("2d");
    return new Chart(cbc, {
        type: "pie",
        data: {
            datasets: [
                {
                    data: [data.stem, data.bec, data.spa, data.spj],
                    backgroundColor: [
                        "#191d21",
                        "#63ed7a",
                        "#fc544b",
                        "#6777ef",
                    ],
                    label: "Dataset 1",
                },
            ],
            labels: ["STEM", "BEC", "SPA", "SPJ"],
        },
        options: {
            responsive: true,
            legend: {
                position: "bottom",
            },
        },
    });
};

let loadDataCurriculum = () => {
    $.ajax({
        url: "chart/population/by/curriculum",
        type: "GET",
        dataType: "json",
    })
        .done(function (data) {
            populationByCurriculum(data[0]);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            // getToast("error", "Eror", errorThrown);
        });
};
loadDataCurriculum();
