$("#announceForm").on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        url: "announcement/create",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $(".createMe")
                .html(
                    `Saving 
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`
                )
                .attr("disabled", true);
        },
    })
        .done(function (data) {
            $(".createMe")
            .text('Post')
                .attr("disabled", false);
            getToast("success", "Success", 'Announcement Save');
            $("#visible_by").val(null).trigger("change");
            $('#summernote').summernote('reset');
            document.getElementById('announceForm').reset()
            post_announcement()
            $('.clearMe').hide()
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            $(".createMe")
            .text('Post')
            .attr("disabled", false);
            getToast("error", "Eror", errorThrown);
        });
})


let post_announcement = () => {
    let holdMe = '';
    $.ajax({
        url: "announcement/list",
        type: "GET",
        // beforeSend: function () {
        //     $(".createMe")
        //         .html(
        //             ` 
        //     <div class="spinner-border spinner-border-sm" role="status">
        //         <span class="sr-only">Loading...</span>
        //     </div>`
        //         )
        // },
    })
        .done(function (data) {
            if (data.length<1) {
                holdMe = '<div class="text-center">No Annoucement</div>';
            } else {
                data.forEach((element,i) => {
                    holdMe += `<div class="card shadow mt-0 mb-2">
                    <div class="card-header" id="headingOne">
                      <h4 class="mb-0">
                        <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#${element.slug}" aria-expanded="true" aria-controls="${element.slug}">
                          ${element.headline}
                        </button>
                      </h4>
                      <div class="card-header-action">
                          <div class="btn-group">
                            <button class="btn btn-info edit_${element.id} edit" value="${element.id}">&nbsp;&nbsp;Edit&nbsp;&nbsp;</button>
                            <button class="btn btn-danger delete_${element.id} delete" value="${element.id}">Delete</button>
                          </div>
                        </div>
                    </div>
                
                    <div id="${element.slug}" class="collapse ${i==0?'show':''}" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body">
                        <small>Created: ${timesTamp(element.created_at)}</small>
                       <p>Visible by:${whatUser(element.visible_by)}</p>
                        ${element.content_body}
                      </div>
                    </div>
                  </div>`;
                });
            }

            $("#accordionExample").html(holdMe);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
        });
}
post_announcement()


$(document).on("click", ".edit", function () {
    let id = $(this).val()
   
        $.ajax({
            url: "announcement/edit/" + id,
            type: "GET",
            data: { _token: $('input[name="_token"]').val() },
            beforeSend: function () {
                $(".edit_" + id).html(`
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`).attr('disabled',true);
            },
        })
            .done(function (response) {
                $('.clearMe').show()
                $(".edit_" + id).html("Edit").attr('disabled',false);
                $("input[name='headline']").val(response.headline);
                $("#visible_by").val(response.visible_by).trigger("change");
                $('#summernote').summernote('code',response.content_body);
                $('input[name="id"]').val(response.id);
                getToast("success", "Success", "Retrive one record");
               
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
                getToast("error", "Eror", errorThrown);
                $(".edit_" + id).html("Edit").attr('disabled',false);
            });
});
$('.clearMe').hide()
$('.clearMe').on('click', function () {
    $('.clearMe').hide()
    $("#visible_by").val(null).trigger("change");
    $('#summernote').summernote('reset');
    document.getElementById('announceForm').reset()
})

$(document).on("click", ".delete", function () {
    let id = $(this).val()
    if (confirm("Are you sure you want delete this student pernamently?")) {
        $.ajax({
            url: "announcement/delete/" + id,
            type: "DELETE",
            data: { _token: $('input[name="_token"]').val() },
            beforeSend: function () {
                $(".delete_" + id).html(`
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`).attr('disabled',true);
            },
        })
            .done(function (response) {
                $(".delete_" + id).html("Delete").attr('disabled',false);
                getToast("success", "Success", "deleted one record");
                post_announcement()
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $(".delete_" + id).html("Delete").attr('disabled',false);
            });
    } else {
        return false;
    }
});

let whatUser = (user) => {
    let holdMeAgain = '';
    user.forEach(element => {
        switch (element) {
            case '1':
                    holdMeAgain+='<span class="ml-1 pt-1 pb-1 badge badge-primary">All user</span>'
                break;
            case '2':
                holdMeAgain+='<span class="ml-1 pt-1 pb-1 badge badge-primary">Teacher</span>'
                break;
            case '3':
                holdMeAgain+='<span class="ml-1 pt-1 pb-1 badge badge-primary">Chairman</span>'
                break;
            case '4':
                holdMeAgain+='<span class="ml-1 pt-1 pb-1 badge badge-primary">Student</span>'
                break;
            case '5':
                holdMeAgain+='<span class="ml-1 pt-1 pb-1 badge badge-primary">Junior High Student</span>'
            break;
            case '6':
                holdMeAgain+='<span class="ml-1 pt-1 pb-1 badge badge-primary">Senior High Student</span>'
                break;
            default:
                break;
        }
    })
    return holdMeAgain
}

let timesTamp = (val) => {
    return new Date(val).toLocaleDateString("en-US")
}

