// CUSTOM FUNCTIONS ========================================================================================

// alert handler
function srsAlert(message = "No Message", bgToast = "primary") {
    const $toast = $("#myToast");
    $toast.find(".toast-body").text(message);

    $toast.removeClass(function (index, className) {
        return (className.match(/(^|\s)bg-\S+|text-\S+/g) || []).join(' ');
    });

    const bootstrapBG = `bg-${bgToast}`;
    const textColor = bgToast === "light" ? "text-dark" : "text-white";

    $toast.addClass(`${bootstrapBG} ${textColor}`);

    const toast = new bootstrap.Toast($toast[0]);
    toast.show();
}

// Format date (Alpha Numeric)
function formatDate(new_date) {
    var date = new Date(new_date);
    var options = { year: 'numeric', month: 'long', day: 'numeric' };

    return date.toLocaleDateString('en-US', options);
}

// Format date (Numeric - DD/MM/YYYY)
function formatDate2(new_date) {
    const date = new Date(new_date);

    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();

    return `${day}-${month}-${year}`;
}


// format time (from date and time)
function formatTime(new_time) {
    const date = new Date(new_time);
    let hours = date.getHours();
    const minutes = date.getMinutes();

    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12;
    const paddedHours = String(hours).padStart(2, '0');
    const paddedMinutes = String(minutes).padStart(2, '0');

    return `${paddedHours}:${paddedMinutes} ${ampm}`;
}

// format Amount
function formatAmount(amount) {
    return Number(amount).toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}


// select2
if ($(".js-example-basic-single").length) {
    $(".js-example-basic-single").select2();
}

// State dropdown list
async function getStatesDropList() {
    try {
        const formData = new FormData();
        formData.append("action", "get_states_droplist");

        const response = await fetch(API, {
            method: "POST",
            body: formData,
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const result = await response.json();

        if (result.status == 1) {
            result.states.forEach(state => {
                $('.state-data').append(`<option value="${state.id}">${state.state_name}</option>`);
            });
        } else {
            // console.log("No States Available");
        }
    } catch (error) {
        let err = error.message || "Something went wrong.";
        console.log(err);
    }
}

// to handle clear button for forms and select2
$(".clearBtn").on("click", function () {
    $(".js-example-basic-single").val(null).trigger("change");
    $("input[type='text']").val("");
    $("input[type='number']").val("");
});


// ADMIN LOGIN HANDLERS ====================================================================================

// ADMIN | Check Login

function isLoggedIn() {

    let logged_in = localStorage.getItem("logged_in");
    let type = localStorage.getItem("type");

    if (logged_in != null || logged_in == true) {
        if (type == 1) {
            location.href = "home.php";
            return;
        }
    }
}

function isLoggedOut() {

    let logged_in = localStorage.getItem("logged_in");

    if (logged_in == null || logged_in == false) {
        location.href = "index.php";
        return;
    }

}

// ADMIN | Logging Out
function logout() {
    localStorage.clear();
    location.href = "index.php";
}

// LOADING DATA ============================================================================================

// ADMIN | Getting Name
function getUserName() {
    let first_name = localStorage.getItem("name").split(" ")[0] || "Admin";
    let full_name = localStorage.getItem("name") || "Admin";
    $("#user_name").text(first_name);
    $("#dropdown_user_name").text(full_name);
}

// Greetings
function greetUSer() {
    const currentHour = new Date().getHours();
    let greeting = "";

    if (currentHour < 12) {
        greeting = "Good Morning";
    } else if (currentHour < 18) {
        greeting = "Good Afternoon";
    } else {
        greeting = "Good Evening";
    }

    $('#greeting').text(greeting);
}

// Loading Data
function loadData() {
    greetUSer();
    getUserName();
}


// APPLICATION =============================================================================================

// LOGIN HANDLER
$("#login_form").submit(async function (e) {
    e.preventDefault();

    if ($("#username").val().trim() == "" || $("#password").val().trim() == "") {
        var msg = "Please enter your username and password.";
        Swal.fire({
            title: "Missing Details",
            icon: "question",
            text: msg
        });
        return;
    }

    try {
        let formData = new FormData(this);
        formData.append("action", "login");
        formData.append("type", "1");

        let response = await fetch(API, {
            method: "POST",
            body: formData,
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        let result = await response.json();

        if (result.status == 1) {
            localStorage.setItem("logged_in", true);
            localStorage.setItem("user_id", result.user_id);
            localStorage.setItem("name", result.name);
            localStorage.setItem("type", result.type);

            location.href = "home.php"
        } else {
            Swal.fire({
                title: result.msg,
                icon: "error",
            }).then((result) => {
                $("#login_form")[0].reset();
            });
        }
    } catch (error) {
        Swal.fire({
            icon: "error",
            text: error,
        }).then((result) => {
            $("#login_form")[0].reset();
        });
    }

});

// LOGOUT HANDLER
$("#logout-btn, #logout-btn-mobile").on("click", (e) => {
    e.preventDefault();

    Swal.fire({
        title: "Logging Out",
        text: "Do you want to logout?",
        showCancelButton: true,
        confirmButtonText: "Yes, Please Log Out",
        confirmButtonColor: "#dc3545",
    }).then((result) => {
        if (result.isConfirmed) {
            logout();
        }
    });

})

// CHANGE PASSWORD
$("#update_password_form").submit(async function (e) {
    e.preventDefault();
    $("#update_password_btn").prop("disabled", true);

    let new_password = $("#new_password").val();
    let confirm_password = $("#confirm_password").val();

    if (new_password !== confirm_password) {
        srsAlert("New Password and Current Password do not match.", 'danger');
        $("#update_password_btn").prop("disabled", false);
        return 0;
    }

    try {
        let user_id = localStorage.getItem("user_id");

        const formData = new FormData(this);
        formData.append("action", "update_password");
        formData.append("user_id", user_id);

        const response = await fetch(API, {
            method: "POST",
            body: formData,
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const result = await response.json();

        if (result.status == 1) {
            srsAlert(result.msg, "success");
            this.reset();
        } else {
            srsAlert(result.msg, "danger");
        }
    } catch (error) {
        let err = error.message || "Something went wrong.";
        srsAlert(err, "danger");
    } finally {
        $("#update_password_btn").prop("disabled", false);
    }
});


// CONTACT REQUESTS ========================================================================================

function getContactRequests() {

    $('#contactRequestTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        destroy: true,
        ajax: {
            url: API,
            type: "POST",
            data: {
                action: "get_contact_us",
            }
        },
        // order: [[6, 'desc']],
        columns: [
            { data: "sno" },
            { data: "name" },
            { data: "email" },
            { data: "phone" },
            { data: "address" },
            { data: "interest" },
            { data: "message" },
            {
                data: "date",
                render: function (data, type, row) {
                    let date = formatDate(data);
                    let time = formatTime(data);

                    return `${date} AT (${time})`;
                }
            },
            {
                data: null,
                "orderable": false,
                render: function (data, type, row) {
                    return `
                    <div class="d-flex gap-1 justify-content-center align-items-center">
                        <button class="btn btn-sm btn-danger d-flex gap-1 justify-content-center align-items-center text-white rounded-1 p-1" title="Delete Message" onclick='deleteMessage(${JSON.stringify(row)})'>
                            <i class="mdi mdi-delete-outline"></i>
                        </button>
                    </div>`;
                }
            }
        ]
    });
}

function deleteMessage(row) {
    Swal.fire({
        title: "Are you sure?",
        html: `Do you want to delete the message of <br><b>${row.name}</b>?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel",
        confirmButtonColor: "#d33",
    }).then(async (result) => {
        if (result.isConfirmed) {

            try {
                const formData = new FormData();
                formData.append("action", "delete_contact_us");
                formData.append("id", row.id);

                const response = await fetch(API, {
                    method: "POST",
                    body: formData,
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const result = await response.json();

                if (result.status == 1) {
                    srsAlert(result.msg, "success");

                    $('#contactRequestTable').DataTable().ajax.reload(null, false);
                } else {
                    srsAlert(result.msg, "danger");
                }

            } catch (error) {
                let err = error.message || "Something went wrong.";
                console.log(err);
            }
        }
    });

}

// CAREER APPLICATIONS =====================================================================================

function getJobApplications() {

    $('#careerApplicationsTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        destroy: true,
        ajax: {
            url: API,
            type: "POST",
            data: {
                action: "get_career_applications",
            }
        },
        // order: [[6, 'desc']],
        columns: [
            { data: "sno" },
            { data: "applicant_name" },
            { data: "email" },
            { data: "mobile" },
            { data: "apply_for" },
            {
                data: "resume",
                render: function (data, type, row) {
                    if (data !== "") {
                        return `<a href="../uploads/resume/${data}" class="btn btn-info btn-sm px-3" target="_blank">View Resume</a>`;
                    }
                    return 'Not Available';
                }
            },
            { data: "status" },
            {
                data: "applied_at",
                render: function (data, type, row) {
                    let date = formatDate(data);
                    let time = formatTime(data);
                    return `${date} AT (${time})`;
                }
            }
        ]
    });
}