////////// main variables /////////

let dataDelete;
let dataFinish;
let addTaskUrl = $("#add-task-route").val();
let deleteTaskImg = $("#delete-task-img").val();
let doneTaskImg = $("#done-task-img").val();
let doneTaskUrl = $("#url-done-task").val();
let deleteTaskUrl = $("#url-delete-task").val();
let csrf = $("#csrf_token").val();
let all_tasks = $("#all-tasks").val();
let done_tasks = $("#done-tasks").val();
let urlTasks = $("#url-tasks-json").val();
let updateRoute = $("#update-route").val();
let name_user = $("input[name=name]").val();
let username = $("input[name=username]").val();
let password = $("input[name=password]").val();
let textUsername = $(".text-username").text().trim();
let textPassword = $(".text-password").text().trim();
let textName = $(".text-name").text().trim();
let checkboxStates = $("input[type=checkbox]").is(":checked");

///////// End Variables ////////////

$(document).on("click",".delete-task", function () {
    $(".confirm-delete,.full-screen-shadow").show();
    $(".full-screen-shadow").animate(
        {
            opacity: 1,
        },
        300
    );
    $(".confirm-delete").animate(
        {
            opacity: 1,
        },
        300
    );
    dataDelete = $(this).parent().parent().parent().attr("data");
});
$(document).on("click",".done-task",function(){
    $(".confirm-finish,.full-screen-shadow").show();
    $(".full-screen-shadow").animate(
        {
            opacity: 1,
        },
        300
    );
    $(".confirm-finish").animate(
        {
            opacity: 1,
        },
        300
    );
    dataFinish = $(this).parent().parent().parent().attr("data");
});
$(".no-delete").on("click", function () {
    hideConfrimDelete();
});
$(".no-finish").on("click",function(){
    hideConfrimFinish();
});
$(".yes-delete").on("click", function () {
    hideConfrimDelete();
    $(".full-screen-shadow").show();
    $(".spinner-loading").removeClass("d-none");
    $.ajax(deleteTaskUrl,{
        dataType:"json",
        method:"POST",
        data:{
            _token:csrf,
            id : dataDelete,
        },
        success:function(data){
            $(".counter-all-tasks").each(function(){
                let value = parseInt($(this).html()) - 1;
                $(this).html(value);
            });
            all_tasks = $(".counter-all-tasks").first().html();
            showRightMessage(done_tasks);
            $(".full-screen-shadow").hide();
            $(".spinner-loading").addClass("d-none");
        }
    });
    $(".task[data=" + dataDelete + "]").animate(
        { opacity: 0 },
        300,
        function () {
            $(this).remove();
        }
    );
});
$(".yes-finish").on("click",function(){
    hideConfrimFinish();
    $(".full-screen-shadow").show();
    $(".spinner-loading").removeClass("d-none");

    $.ajax(doneTaskUrl,{
        dataType:"json",
        method:"POST",
        data:{
            _token:csrf,
            id : dataFinish,
        },
        success:function(data){
            $(".counter-done-tasks").each(function(){
                let value = parseInt($(this).html()) + 1;
                $(this).html(value);
            });
            $(".counter-all-tasks").each(function(){
                let value = parseInt($(this).html()) - 1;
                $(this).html(value);
            });
            all_tasks = $(".counter-all-tasks").first().html();
            done_tasks = $(".counter-done-tasks").first().html();
            showRightMessage(done_tasks);
            $(".full-screen-shadow").hide();
            $(".spinner-loading").addClass("d-none");
        }
    });

    $(".task[data=" + dataFinish + "]").animate(
        { opacity: 0 },
        300,
        function () {
            $(this).remove();
        }
    );
});
$("#text-task").on("input",function(){
    if ($(this).val().length < 10 || $(this).val().length > 200) {
        $(".add-task").addClass("disabled");;
        $("#text-task").addClass("is-invalid");
        $(".task-note").addClass("text-danger");
    }else{
        $(".add-task").removeClass("disabled");
        $("#text-task").removeClass("is-invalid").addClass("is-valid");
        $(".task-note").removeClass("text-danger").addClass("text-success");
    }
})
$(".add-task").on("click", function () {
    if ($(this).hasClass("disabled")) return;
    $(".add-task > span,.add-task > div").toggleClass("active-loading");
    $(this).css("pointer-events", "none");
    $.ajax(addTaskUrl, {
        method: "POST",
        datatype: "json",
        data: {
            _token: csrf,
            description: $("#text-task").val(),
        },
        success: function (data) {
            $(".counter-all-tasks").each(function(){
                let value = parseInt($(this).html()) + 1;
                $(this).html(value);
            });
            all_tasks = $(".counter-all-tasks").first().html();
            insertTask(data["id_task"],data["description"]);
            showRightMessage(done_tasks);
            $(".form-control").removeClass("is-valid").val("").trigger("focus");
            $(".add-task").addClass("disabled");
            $(".task-note").removeClass("text-success");
        },
        complete: function () {
            $(".add-task > span,.add-task > div").toggleClass("active-loading");
            $(".add-task").css("pointer-events", "unset");
        },
    });
});

$("#btn-copy").on("click",function(){
    let old = $(this).text().trim();
    $(this).text($("#done").val());
    $(".url-id").trigger("select");
    document.execCommand("copy");
    setTimeout(function(){
        $("#btn-copy").text(old);
    },1000);
})
// $("#btn-copy").on("click",function(){
//     $("#url_user").trigger("focus");
//     $("#url_user").trigger("select");
//     document.execCommand("copy");
//     console.log("fu");
// });

/////// my main functions /////////////
function hideConfrimDelete() {
    $(".full-screen-shadow").animate(
        {
            opacity: 0,
        },
        300,
        function () {
            $(this).hide();
        }
    );
    $(".confirm-delete").animate(
        {
            opacity: 0,
        },
        300,
        function () {
            $(this).hide();
        }
    );
}
function hideConfrimFinish() {
    $(".full-screen-shadow").animate(
        {
            opacity: 0,
        },
        300,
        function () {
            $(this).hide();
        }
    );
    $(".confirm-finish").animate(
        {
            opacity: 0,
        },
        300,
        function () {
            $(this).hide();
        }
    );
}
function insertTask(id , description){
    let htmlTask = `
<div class="col-10 col-md-5 col-lg-3 mb-2 bg-info rounded task" data="` + id + `">
    <div class="row justify-content-center align-items-center p-2">
        <div class="col-8 text-truncate">
            ` + description + `
        </div>
        <div class="col-2">
            <img class="done-task" src="` + doneTaskImg + `" alt="Done task" title="Finish Task"
                width="35">
        </div>
        <div class="col-2">
            <img class="delete-task" src="` + deleteTaskImg + `" alt="Delete task"
                title="Delete Task" width="35">
        </div>
    </div>
</div>
</div>
`
    $(".my-row").prepend(htmlTask);
}

function hideWrongMessages(arr,except){
    $(arr).each(function(){
        if (this != except)
            this.addClass("d-none");
        else except.removeClass("d-none");
    });
}
function showRightMessage(done_tasks){
    let x1 = $(".message-danger");
    let x2 = $(".message-warning");
    let x3 = $(".message-success");

    let arr = [x1, x2, x3]; // All of my messages

    if (done_tasks == 0){
        hideWrongMessages(arr,x1);
    }
    else if (done_tasks > 0 && done_tasks < 5){
        hideWrongMessages(arr,x2);
    }
    else if (done_tasks >= 5){
        hideWrongMessages(arr,x3);
    }
}
function resetFormUpdate(code, msg,class_name,new_name , new_user ){
    if (code == 0){
        name_user = new_name;
        username = new_user;
        //password = "";
        checkboxStates = $("input[type=checkbox]").is(":checked");
        $("#password").val("");
    }
    var thirdClass = $(".result").attr("class").split(" ")[2];
    if (thirdClass != undefined) $(".result").removeClass(thirdClass);
    $(".result").show();
    $(".result").addClass("alert-" + class_name).html(msg);
    if (code == 0){
        setTimeout(function(){
            $(".result").hide(300);
        },5000);
    }
    $(".text-name,.text-user,.text-password").removeClass("text-danger").addClass("text-info");
    $(".text-name").html(textName);
    $(".text-password").html(textPassword);
    $(".text-user").html(textUsername);
}
////////// end functions ///////////////

$(window).on("load", function () {
    $(".title-guest").animate(
        {
            opacity: 1,
            left: 0,
        },
        900
    );
    if (urlTasks != undefined){
        $.ajax(urlTasks,{
            dataType:"json",
            success:function(data){
                for (let i = 0 ; i < data.length ;i++){
                    insertTask(data[i]["id"],data[i]["task_description"]);
                }
            }
        })
    }
    $(".counter-done-tasks").html(done_tasks);
    $(".counter-all-tasks").html(all_tasks);
    showRightMessage(done_tasks);
    $("#text-task").trigger("focus");
    
});

$("button[type=submit]").on("click",function(){
    let name_n = $("input[name=name]").val();
    let username_n = $("input[name=username]").val();
    let password_n = $("input[name=password]").val();

    if (name_user != name_n || username != username_n || password != password_n || $("input[type=checkbox]").is(":checked") != checkboxStates){
        let private;
        if ($("input[type=checkbox]").is(":checked")){
            private = 1;
        }else private = 0;

        $.ajax(updateRoute,{
            dataType:"json",
            method:"POST",
            data:{
                _token:csrf,
                name : name_n,
                username :username_n,
                password : password_n,
                private:private,
            },
            success:function(data){
                if (data["error"] == 1){
                    resetFormUpdate(1,data["msg"],"danger")
                }else if (data["error"] == 2){
                    resetFormUpdate(2,data["msg"],"danger");
                }
                else if (data["error"] == 0){
                    resetFormUpdate(0,data["msg"],"success",name_n,username_n);
                }
            }
        });
    }else{
        $(".no-update").toggleClass("d-none");
        setTimeout(function(){
            $(".no-update").toggleClass("d-none")
        },3000);
    }
});