$("#userForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "user/save",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $(".btnSaveUser")
                .html(
                    `Saving ...
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`
                )
                .attr("disabled", true);
        },
    })
        .done(function (data) {
            $(".btnSaveUser").html("Submit").attr("disabled", false);
            cancelUser.hide();
            document.getElementById("userForm").reset();
            $("input[name='id']").val("");
            userTable();
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSaveUser").html("Submit").attr("disabled", false);
        });
});
let cancelUser = $(".cancelUser").hide();
$(".cancelUser").on("click", function () {
    $(this).hide();
    document.getElementById("userForm").reset();
    $(".btnSaveUser").html("Submit");
    $("input[name='id']").val("");
});

const userTable = (level) => {
    let htmlHold = "";
    let i = 1;
    $.ajax({
        url: `user/list/`,
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            $("#userTable").html(
                `<tr>
                        <td colspan="5" class="text-center">
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
            if (data.length > 0) {
                data.forEach((val) => {
                    htmlHold += `
                        <tr>
                            <td>
                                ${i++}
                            </td>
                            <td>
                                ${val.name}
                            </td>
                            <td>
                                ${val.username}
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" style="font-size:9px" class="btn btn-sm btn-info pl-3 pr-3 editUser edit_${
                                        val.id
                                    }" id="${val.id}">Edit</button>
                                    <button type="button" style="font-size:9px" class="btn btn-sm btn-danger deleteUser delete_${
                                        val.id
                                    }" id="${val.id}">Delete</button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            } else {
                htmlHold = `
                            <tr>
                                <td colspan="4" class="text-center">No available data</td>
                            </tr>`;
            }
            $("#userTable").html(htmlHold);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
        });
};

userTable();

$("input[name='confirmPassword']").on("blur", function () {
    password = $("input[name='password']").val();
    confirmPassword = $(this).val();
    if (password != confirmPassword) {
        $("input[name='password']").val("");
        $(this).val("");
    }
});

$(document).on("click", ".deleteUser", function () {
    let id = $(this).attr("id");
    $.ajax({
        url: "user/delete/" + id,
        type: "DELETE",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".delete_" + id).html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
        },
    })
        .done(function (response) {
            $(".delete_" + id).html("Delete");
            userTable();
            getToast("success", "Success", "deleted one record");
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});

$(document).on("click", ".editUser", function () {
    let id = $(this).attr("id");
    $.ajax({
        url: "user/edit/" + id,
        type: "GET",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".edit_" + id).html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
        },
    })
        .done(function (data) {
            cancelUser.show();
            $(".edit_" + id).html("Edit");
            $(".btnSaveUser").html("Update");
            $("input[name='id']").val(data.id);
            $("input[name='name']").val(data.name);
            $("input[name='username']").val(data.username);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});
