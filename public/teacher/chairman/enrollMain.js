const mySelectedSubject = [];

let studentInfo = (id) => {
    $.ajax({
        url: "enrollee/student/info/"+id,
        type: "GET",
    })
        .done(function (data) {
        $("input[name='show_fullname']").val(data.fullname);
        $("input[name='show_lrn']").val(data.roll_no);
        $("input[name='show_strand']").val(data.strand+' - '+data.description);
        $("input[name='show_status']").val(data.enroll_status);
        $("input[name='show_state']").val(data.state);
        $("input[name='show_term']").val(data.term+' Semester');
        $('input[name="show_section"]').val(data.section_name);
        $("input[name='student_id']").val(data.student_id);
        $("input[name='enroll_id']").val(data.enrolId);
        $('input[name="term"]').val(data.term);
        $('input[name="section_id"]').val(data.section_id);
        showMySubject(data.strId, data.grade_level,data.student_id,data.term);
    })
    .fail(function (jqxHR, textStatus, errorThrown) {
        getToast("error", "Eror", errorThrown);
    });
}

$(document).on('click', ".btnMain", function () {
    $("#mainForm").modal("show");
    studentInfo($(this).val())
    // setTimeout(() => {
    //     studentSubjectList($("input[name='student_id']").val(),$("input[name='section_id']").val())
    // }, 5000);
});


/**
 * 
 * GET ALL SUBJECT
 * 
 */
let showMySubject = (strand, grade_level,student,term) => {
    let hold = '';
    let holdBack = '';
    $.ajax({
        url: "subject/list/"+strand+"/"+grade_level+"/"+student+"/"+term,
        type: "GET",
        beforeSend: function () {
            $("#studentSubjectList").html(`
            <tr>
                <td colspan="3" class="text-center">
                <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </td>
            </tr>
            ` ).attr("disabled", true);
        }
    })
        .done(function (data) {
            // console.table(data)
            let arr = data.mySubject
            let NewId = data.NewId
            if (data.length == 0) {
                hold = `
                <tr>
                    <td colspan="3" class="text-center">No data</td>
                </tr>
                `;
            } else {
                data.origSubject.forEach(val => {
                    hold += `
                       <tr>
                            <td>
                                <input type="checkbox"  ${checkSubject(arr, val.id)}  class="text-center checkMe deleteSec_${val.id}" value="${val.id}">
                            </td>
                            <td>${val.subject_code}</td>
                            <td>${val.descriptive_title}</td>
                        </tr>  
                        `;
                })
            }
           
            $("#studentSubjectList").html(hold);


            //back subject list
            if (data.backsubject==0) {
                holdBack = `
                <tr>
                    <td colspan="3" class="text-center">No data</td>
                </tr>
                `;
            } else {
            data.backsubject.forEach(val => {
                holdBack += `
                ${

                    data.origSubject.some(item => item.id == val.id)
                    ?
                    ``
                    :
                    `
                    <tr>
                        <td>
                        <input type="checkbox" ${disabledSubject(arr, val.id)} ${checkSubject(arr, val.id)}  class="text-center checkMe deleteSec_${val.id}" value="${val.id}">
                        </td>
                        <td>${val.subject_code}</td>
                        <td>${val.descriptive_title}</td>
                    </tr> 
                    `

                }
                
                `;
            })
        }
            $("#studentBackSubjectList").html(holdBack);

    })
    .fail(function (jqxHR, textStatus, errorThrown) {
        getToast("error", "Eror", errorThrown);
    });
}

let checkSubject = (arr, id) => {
    return arr.some(item => item === id)?'checked':''
}

let disabledSubject = (arr, id) => {
    return arr.some(item => item === id)?'disabled':''
}

$(document).on('change', '.checkMe', function () {
    if (this.checked) {     
            mySelectedSubject.push($(this).val())
            $.ajax({
                url: "subject/save",
                type: "POST",
                data: {
                    _token: $('input[name="_token"]').val(),
                    student_id: $("input[name='student_id']").val(),
                    section_id: $("input[name='section_id']").val(),
                    // term: $("select[name='term']").val(),
                    subject_id: $(this).val()
                },
              
            }).done(function (data) {
                if (data.msg) {
                    getToast("warning", "Warning",data.msg);
                } else {
                    getToast("success", "Success", "Add new subject");
                }
                
            }).fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
            });
    } else {
        var index = mySelectedSubject.indexOf($(this).val());
        mySelectedSubject.splice(index, 1);
        $.ajax({
            url: "subject/delete",
            type: "DELETE",
            data: {
                _token: $('input[name="_token"]').val(),
                student_id: $("input[name='student_id']").val(),
                section_id: $("input[name='section_id']").val(),
                term: $("input[name='term']").val(),
                subject_id: $(this).val(),
            },
          
        })
            .done(function (response) {
               if (response=='not') {
                   getToast("warning", "Warning", "it is forbidden to remove");
               } else {
                getToast("success", "Success", "deleted one record");
               }
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
                getToast("error", "Eror", errorThrown);
            });
    }
});




// $('#selectAll').click(function(event) {
//     if(this.checked) {
//         // Iterate each checkbox
//         $('.checkMe').each(function() {
//             this.checked = true;
//             mySelectedSubject.push($(this).val())
//         });
//     } else {
//         $('.checkMe').each(function() {
//             this.checked = false;                       
//         });
//     }
// }); 

let retriveGrade = (grade_level,term) => {
    let holdGrade = '';
    $.ajax({
        url: `retrive/grade/${grade_level}/${term}/`+$("input[name='student_id']").val(),
        type: 'GET',
        beforeSend: function () {
            $("#retriveGrade").html(`
            <tr>
                <td colspan="4" class="text-center">
                <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </td>
            </tr>
            ` );
        }
    }).done(function (data) {
        console.log(data);
        if (data.length!=0) {
            data.forEach(val => {
                holdGrade += ` <tr>
                                <td>${val.subject_code}</td>
                                <td>${val.descriptive_title}</td>
                                <td>${val.avg!=null?val.avg:''}</td>
                                <td>${val.avg!=null?(val.avg<75?'Failed':'Passed'):''}</td>
                            </tr>`;
            })
        } else {
            holdGrade = `
            <tr>
                <td colspan="4" class="text-center">No data</td>
            </tr>
            `;
        }

        $("#retriveGrade").html(holdGrade);
    })
    .fail(function (jqxHR, textStatus, errorThrown) {
        getToast("error", "Eror", errorThrown);
    });
}

$("#select_grade_level").on('change', function () {
    if ($(this).val()!="") {
        retriveGrade($(this).val(),$("#select_term").val())
    }
})

$("#select_term").on('change', function () {
    if ($("#select_grade_level").val()!="") {
        retriveGrade($("#select_grade_level").val(),$(this).val())
    }
})