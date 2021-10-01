const assignArraySubject = [];
let loadTableSubject = (student, term) => {
    let hold = "";
    $.ajax({
        url: "assign/load/student/subject/" + student + "/" + term,
        type: "GET",
        dataType: "json",
    })
        .done(function (response) {
            if (response.length > 0) {
                response.forEach((val, i) => {
                    assignArraySubject.length = 0;
                    assignArraySubject.push({ id: val.subject_id });
                    hold += `<tr>
                                <td class="pt-0 pb-0">
                                ${++i}
                                </td>
                                <td class="pt-0 pb-0">
                                ${val.descriptive_title}
                                </td>
                                <td class="pt-0 pb-0">
                                <button class="btn btn-warning odelete odeleteBtn_${
                                    val.id
                                }" id="${
                        val.id
                    }"> <i class="fas fa-times"></i></button>
                                </td>
                            </tr>`;
                });
            } else {
                hold = `<tr>
                        <td colspan="3" class="text-center">No Subject Available</td>
                    </tr>`;
            }
            $("#showSubjectSelect").html(hold);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};

// show backsubject of student
let getBackSubjectSeniorStudent = (student) => {
    let hold = "";
    $.ajax({
        url: "assign/backsubject/load/student/" + student,
        type: "GET",
        dataType: "json",
    })
        .done(function (response) {
            if (response.length > 0) {
                response.forEach((val, i) => {
                    hold += `<li class="list-group-item p-2">${val.descriptive_title}</li>`;
                });
            } else {
                hold = `<li class="list-group-item p-2 text-center">No data available</li>`;
            }
            $("#showFailSubject").html(hold);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
};

/////////////////// open modal per student subject info
$(document).on("click", ".enrolledSubjectBtn", function () {
    showAvailableSubject($('select[name="term"]').val());
    $("#staticBackdropLabel").text(
        "Enrolled Subject in " + $('select[name="term"]').val() + " Term"
    );
    let info = $(this).val();
    $(".selected-name").text(info.split("_")[0]);
    $(".selected-lrn").text("LRN: " + info.split("_")[1]);
    $('input[name="student_id"]').val(info.split("_")[2]);
    loadTableSubject(info.split("_")[2], $('select[name="term"]').val());
    getBackSubjectSeniorStudent(info.split("_")[2]);
    let id = $(this).attr("id");
    $.ajax({
        url: "assign/student/" + $('select[name="term"]').val() + "/" + id,
        type: "GET",
        beforeSend: function () {
            $(".btn_" + id).html(`
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>`);
        },
    })
        .done(function (response) {
            setTimeout(() => {
                $(".btn_" + id).html("Subject");
                $("#enrolledSubjectModal").modal("show");
            }, 2000);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
        });
});

let showAvailableSubject = (term) => {
    let holdMe = "";
    $.ajax({
        url: "assign/list/subject/section/" + term,
        type: "GET",
        dataType: "json",
    })
        .done(function (data) {
            holdMe += `<option value="">Subject</option>`;
            data.forEach((val) => {
                // holdMe += `<option value="${val.id}_${val.descriptive_title}">${val.descriptive_title}</option>`;
                holdMe += `<option value="${val.subj_id}">${val.descriptive_title}</option>`;
            });
            $('select[name="assign_subject_id"]').html(holdMe);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
        });
};

let showAlert = (msg) => {
    $(".showAlert").html(
        `<div class="alert alert-warning alert-dismissible pt-1 pb-1">
            <div class="alert-body">
            ${msg}
            </div>
        </div>`
    );
    setTimeout(() => {
        $(".showAlert").html(``);
    }, 2000);
};

$(".closeModal").on("click", function () {
    $("#enrolledSubjectModal").modal("hide");
    assignArraySubject.length = 0;
});

$("#AddFormSubject").submit(function (e) {
    e.preventDefault();
    if (
        assignArraySubject.find(
            (val) => val.id == $('select[name="assign_subject_id"]').val()
        )
    ) {
        showAlert("This subject Already added");
    } else {
        $.ajax({
            url: "assign/load/student/subject/save",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $(".addOn")
                    .html(
                        `<div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                        `
                    )
                    .attr("disabled", true);
            },
        })
            .done(function (data) {
                $(".addOn").html("Save").attr("disabled", false);
                loadTableSubject(
                    $('input[name="student_id"]').val(),
                    $('select[name="term"]').val()
                );
                $('select[name="assign_subject_id"]').val("");
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                $(".addOn").html("Save").attr("disabled", false);
                console.log(jqxHR, textStatus, errorThrown);
                getToast("error", "Eror", errorThrown);
            });
    }
});

$(document).on("click", ".odelete", function () {
    let id = $(this).attr("id");
    if (confirm("Are you sure you want to delete this?")) {
        $.ajax({
            url: "assign/load/student/subject/delete/" + id,
            type: "DELETE",
            data: { _token: $('input[name="_token"]').val() },
            beforeSend: function () {
                $(".odeleteBtn_" + id).html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
            },
        })
            .done(function (response) {
                loadTableSubject(
                    $('input[name="student_id"]').val(),
                    $('select[name="term"]').val()
                );
                $('select[name="assign_subject_id"]').val("");
                getToast("success", "Success", "deleted one record");
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                $(".odeleteBtn_" + id).html(`<i class="fas fa-times"></i>`);
                console.log(jqxHR, textStatus, errorThrown);
                getToast("error", "Eror", errorThrown);
            });
    } else {
        return false;
    }
});

// $(".addOn").on("click", function () {
//     let data = $('select[name="assign_subject_id"]').val();
//     if (data != "") {
//         myListedSubjectEnrolled(
//             (subject_id = data.split("_")[0]),
//             (descriptive_title = data.split("_")[1])
//         );
//     } else {
//         showAlert("Please select subject");
//     }
// });

// const arryOfSubjectSelected = [];
// let myListedSubjectEnrolled = (subject_id, descriptive_title) => {
//     if (arryOfSubjectSelected.find((val) => val.subject_id == subject_id)) {
//         showAlert("This subject Already added");
//     } else {
//         arryOfSubjectSelected.push({ subject_id, descriptive_title });
//         tableListSubject();
//     }
//     $('select[name="assign_subject_id"]').val("");
// };

// let tableListSubject = () => {
//     let hold = ``;
//     let i = 1;
//     if (arryOfSubjectSelected.length > 0) {
//         arryOfSubjectSelected.forEach((val, j) => {
//             hold += `<tr>
//                 <td class="pt-0 pb-0">
//                 ${i++}
//                 </td>
//                 <td class="pt-0 pb-0">
//                 ${val.descriptive_title}
//                 </td>
//                 <td class="pt-0 pb-0">
//                 <button class="btn btn-warning odelete" id="${j}"> <i class="fas fa-times"></i></button>
//                 </td>
//             </tr>`;
//         });
//     } else {
//         hold = `<tr>
//             <td colspan="3" class="text-center">No Subject Available</td>
//         </tr>`;
//     }

//     $("#showSubjectSelect").html(hold);
// };

// $(document).on("click", ".odelete", function () {
//     let i = $(this).attr("id");
//     arryOfSubjectSelected.splice(i, 1);
//     tableListSubject();
// });

// // saving subject to DB

// $(".saveModal").on("click", function (e) {
//     if (
//         confirm(
//             "Are you sure do you want save this?, This subject didn't change anymore"
//         )
//     ) {
//         e.preventDefault();
//         $.ajax({
//             url: "assign/delete/" + id,
//             type: "POST",
//             data: { _token: $('input[name="_token"]').val() },
//             beforeSend: function () {
//                 $(".btnDelete_" + id).html(`
//             <div class="spinner-border spinner-border-sm" role="status">
//                 <span class="sr-only">Loading...</span>
//             </div>`);
//             },
//         })
//             .done(function (response) {
//                 tableAssign($('select[name="term"]').val());
//                 getToast("success", "Success", "deleted one record");
//             })
//             .fail(function (jqxHR, textStatus, errorThrown) {
//                 console.log(jqxHR, textStatus, errorThrown);
//                 getToast("error", "Eror", errorThrown);
//             });
//     } else {
//         return false;
//     }
// });
