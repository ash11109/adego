<?php
date_default_timezone_set('Asia/Kolkata');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../env/connection.php';
require_once 'modules.php';

extract($_REQUEST);
$data = [];

if ($action == 'login') {

    $username = isset($username) ? trim($username) : '';
    $password = isset($password) ? trim($password) : '';
    $type = isset($type) ? trim($type) : '';

    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    $sql = "SELECT * FROM `user` WHERE `username` = '$username'";
    $res = mysqli_query($con, $sql);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $dbpassword = $row['password'];
        $status = $row['status'];

        $user_type = $row['type'];
        $name = $row['name'];
        $id = $row['id'];

        if ($type == $user_type) {
            if ($password == $dbpassword) {
                if ($status == 1) {

                    $current_date_time = date('Y-m-d H:i:s');
                    $sql2 = "UPDATE `user` SET `last_login` = '$current_date_time' WHERE `id` = $id";
                    $res2 = mysqli_query($con, $sql2);

                    $data = [
                        "status" => 1,
                        "type" => $type,
                        "name" => $name,
                        "user_id" => $row["id"],
                    ];
                } else {
                    $data = [
                        "status" => 0,
                        "msg" => "Your account is blocked",
                    ];
                }
            } else {
                $data = [
                    "status" => 0,
                    "msg" => "Invalid password",
                ];
            }
        } else {
            $data = [
                "status" => 0,
                "msg" => "Unauthorized user",
            ];
        }
    } else {
        $data = [
            "status" => 0,
            "msg" => "Invalid username",
        ];
    }
} else if ($action == 'update_password') {

    $user_id = isset($user_id) ? trim($user_id) : 0;
    $old_pswd = isset($old_pswd) ? trim($old_pswd) : '';
    $new_pswd = isset($new_pswd) ? trim($new_pswd) : '';
    $confirm_pswd = isset($confirm_pswd) ? trim($confirm_pswd) : '';

    $sql_check = "SELECT * FROM `users` WHERE `id`='$user_id' AND `password` = '$old_pswd' LIMIT 1";
    $res_check = mysqli_query($con, $sql_check);

    $db_password = '';

    if ($res_check && mysqli_num_rows($res_check)) {
        $row_check = mysqli_fetch_assoc($res_check);
        $db_password = $row_check['password'];
    }

    if ($old_pswd == $db_password) {
        $sql = "UPDATE `users` SET
        `password` = '$new_pswd'
        WHERE `id` = '$user_id'";
        $res = mysqli_query($con, $sql);

        if ($res) {
            $data = [
                "status" => 1,
                "msg" => "Password updated successfully.",
            ];
        } else {
            $data = [
                "status" => 0,
                "msg" => "Failed to update password type",
            ];
        }
    } else {
        $data = [
            "status" => 0,
            "msg" => "Current Password is incorrect.",
        ];
    }
} else if ($action == 'website_contact_us') {

    $name = isset($name) ? sanitizeInput($con, $name) : '';
    $email = isset($email) ? sanitizeInput($con, $email) : '';
    $phone = isset($phone) ? sanitizeInput($con, $phone) : '';
    $address = isset($address) ? sanitizeInput($con, $address) : '';
    $interest = isset($interest) ? sanitizeInput($con, $interest) : '';
    $message = isset($message) ? sanitizeInput($con, $message) : '';

    $date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO `contact_us`(`name`,`email`,`phone`,`address`,`interest`,`message`,`trash`,`date`) 
        VALUES('$name', '$email', '$phone', '$address','$interest','$message', '0', '$date')";
    $res = mysqli_query($con, $sql);

    if ($res) {
        $isMailSent = sendEmail($name, $email, $phone, $address, $interest, $message);

        if ($isMailSent) {
            $data = [
                "status" => 1,
                "msg" => "We have recieved your request successfully.",
            ];
        } else {
            $data = [
                "status" => 1,
                "msg" => "We have recieved your request.",
            ];
        }
    } else {
        $data = [
            "status" => 0,
            "msg" => "Failed to recieve contact details.",
        ];
    }
} else if ($action == 'get_contact_us') {

    $columns = ['sno', 'name', 'email', 'phone', 'address', 'interest', 'message', 'date'];

    $draw   = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
    $start  = isset($_POST['start']) ? intval($_POST['start']) : 0;
    $length = isset($_POST['length']) ? intval($_POST['length']) : 10;

    $orderCol = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
    $orderDir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc';
    $search   = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

    $sqlTotal = "SELECT COUNT(*) AS total FROM contact_us WHERE trash = '0'";
    $resultTotal = mysqli_query($con, $sqlTotal);
    $rowTotal = mysqli_fetch_assoc($resultTotal);
    $totalData = $rowTotal['total'];
    $totalFiltered = $totalData;

    $where = "WHERE trash = '0'";
    if (!empty($search)) {
        $search = mysqli_real_escape_string($con, $search);
        $where .= " AND (
        name LIKE '%$search%' 
        OR email LIKE '%$search%' 
        OR phone LIKE '%$search%' 
        OR address LIKE '%$search%'
        OR interest LIKE '%$search%'
        OR subject LIKE '%$search%' 
        OR date LIKE '%$search%'
    )";
    }

    $sqlFiltered = "SELECT COUNT(*) AS total FROM contact_us $where";
    $resultFiltered = mysqli_query($con, $sqlFiltered);
    $rowFiltered = mysqli_fetch_assoc($resultFiltered);
    $totalFiltered = $rowFiltered['total'];

    if (!isset($_POST['order'])) {
        $orderBy = 'id';
        $orderDir = 'DESC';
    } else {
        $orderBy = $columns[$orderCol];

        if ($orderBy == 'sno') {
            $orderBy  = 'id';
            $orderDir = 'DESC';
        }
    }

    $sqlData = "SELECT * FROM contact_us $where ORDER BY $orderBy $orderDir LIMIT $start, $length";
    $resultData = mysqli_query($con, $sqlData);

    $data = [];
    $sno = $start + 1;
    while ($row = mysqli_fetch_assoc($resultData)) {
        $row['sno'] = $sno;
        $sno++;
        $data[] = $row;
    }

    $data = [
        "draw" => intval($draw),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data" => $data
    ];
} else if ($action == 'delete_contact_us') {
    $id = isset($id) ? sanitizeInput($con, $id) : 0;

    $sql = "UPDATE `contact_us` SET `trash` = '1' WHERE `id` = '$id'";
    $res = mysqli_query($con, $sql);

    if ($res) {
        $data = [
            "status" => 1,
            "msg" => "Message deleted successfully.",
        ];
    } else {
        $data = [
            "status" => 0,
            "msg" => "Failed to delete message.",
        ];
    }
} else if ($action == 'save_career_application') {

    $name = isset($name) ? sanitizeInput($con, $name) : '';
    $email = isset($email) ? sanitizeInput($con, $email) : '';
    $mobile = isset($mobile) ? sanitizeInput($con, $mobile) : '';
    $position = isset($position) ? sanitizeInput($con, $position) : '';

    $status = "applied";
    $applied_at = date("Y-m-d H:i:s");

    $sql_check = "SELECT id FROM career WHERE applicant_name='$name' AND mobile='$mobile' AND apply_for='$position' AND status='$status'";
    $res_check = mysqli_query($con, $sql_check);

    if ($res_check && mysqli_num_rows($res_check) > 0) {
        $data = [
            "status" => 0,
            "msg" => "You have already applied for this post. Please wait for response.",
        ];
    } else {

        $target_path = '../uploads/resume/';

        $file_name = $mobile . '.pdf';
        $upload_error = '';

        $upload_result = move_uploaded_file($_FILES['resume']['tmp_name'], $target_path . $file_name);

        if ($upload_result) {
            $file_name = $file_name;
        } else {
            $upload_error = "Failed to upload resume file.";
        }

        if ($upload_result) {

            $sql = "INSERT INTO career (applicant_name,email,mobile,apply_for,resume,status,applied_at) VALUES('$name','$email','$mobile','$position','$file_name','$status','$applied_at')";
            $res = mysqli_query($con, $sql);

            if ($res) {
                // sendJobEmail($name, $email, $mobile, $position, $resume_file);

                $data = [
                    "status" => 1,
                    "msg" => "Application sent successfully. We will contact you when required.",
                ];
            } else {

                $data = [
                    "status" => 0,
                    "msg" => "Failed to receive job application details.",
                ];
            }
        } else {
            $data = [
                "status" => 0,
                "msg" => $upload_error,
            ];
        }
    }
} else if ($action == 'get_career_applications') {

    $columns = ['sno', 'applicant_name', 'email', 'mobile', 'apply_for', 'resume', 'status', 'applied_at'];

    $draw   = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
    $start  = isset($_POST['start']) ? intval($_POST['start']) : 0;
    $length = isset($_POST['length']) ? intval($_POST['length']) : 10;

    $orderCol = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
    $orderDir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc';
    $search   = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

    $sqlTotal = "SELECT COUNT(*) AS total FROM career";
    $resultTotal = mysqli_query($con, $sqlTotal);
    $rowTotal = mysqli_fetch_assoc($resultTotal);
    $totalData = $rowTotal['total'];
    $totalFiltered = $totalData;

    $where = "";
    if (!empty($search)) {
        $search = mysqli_real_escape_string($con, $search);
        $where .= " AND (
        applicant_name LIKE '%$search%' 
        OR email LIKE '%$search%' 
        OR mobile LIKE '%$search%' 
        OR apply_for LIKE '%$search%'
        OR status LIKE '%$search%'
        OR applied_at LIKE '%$search%' 
    )";
    }

    $sqlFiltered = "SELECT COUNT(*) AS total FROM career $where";
    $resultFiltered = mysqli_query($con, $sqlFiltered);
    $rowFiltered = mysqli_fetch_assoc($resultFiltered);
    $totalFiltered = $rowFiltered['total'];

    if (!isset($_POST['order'])) {
        $orderBy = 'id';
        $orderDir = 'DESC';
    } else {
        $orderBy = $columns[$orderCol];

        if ($orderBy == 'sno') {
            $orderBy  = 'id';
            $orderDir = 'DESC';
        }
    }

    $sqlData = "SELECT * FROM career $where ORDER BY $orderBy $orderDir LIMIT $start, $length";
    $resultData = mysqli_query($con, $sqlData);

    $data = [];
    $sno = $start + 1;
    while ($row = mysqli_fetch_assoc($resultData)) {
        $row['sno'] = $sno;
        $sno++;
        $data[] = $row;
    }

    $data = [
        "draw" => intval($draw),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data" => $data
    ];
} else {
    $data['error'] = "Invalid Type";
}

echo json_encode($data);
mysqli_close($con);
exit;
