<?php
// input sanitization
function sanitizeInput($conn, $input)
{
    $input = trim($input);
    $input = strip_tags($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    $input = mysqli_real_escape_string($conn, $input);

    return $input;
}

// sending Email
function sendEmail($name, $email, $phone, $address, $interest, $message)
{
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $address = $_REQUEST['address'];
    $interest = $_REQUEST['interest'];
    $message = $_REQUEST['message'];

    $subject = "Contact Us | New Request";

    $to = "adegocommunication@gmail.com";   // official email address

    $headers = "From: " . $name . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $email_subject = $subject;

    $email_body = "<h2>Contact Us Request</h2>";
    $email_body .= "<p><strong>Name:</strong><br>{$name}</p>";
    $email_body .= "<p><strong>Email:</strong><br>{$email}</p>";
    $email_body .= "<p><strong>Phone:</strong><br>{$phone}</p>";
    $email_body .= "<p><strong>Address:</strong><br>{$address}</p>";
    $email_body .= "<p><strong>Training Program of Interest:</strong><br>{$interest}</p>";
    $email_body .= "<p><strong>Message:</strong><br>{$message}</p>";

    $result = mail($to, $email_subject, $email_body, $headers);

    if ($result) {
        $msg = "<div class='alert alert-success alert-dismissible fade show mt-3' role='alert'>
        <strong>Success:</strong> Message sent successfully! We will contact you as soon as possible.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        echo json_encode([
            "status" => 1,
            "msg" => $msg
        ]);
    } else {
        $msg = "<div class='alert alert-danger alert-dismissible fade show mt-3' role='alert'>
        <strong>Failed:</strong> Message not send due to some error. Please try again.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        echo json_encode([
            "status" => 0,
            "msg" => $msg
        ]);
    }
}

// send job application (mail)
function sendJobEmail()
{
    $name     = $_POST['name'] ?? '';
    $email    = $_POST['email'] ?? '';
    $mobile   = $_POST['mobile'] ?? '';
    $position = $_POST['position'] ?? '';
    $resume   = $_FILES['resume'] ?? null;

    if (empty($name) || empty($email) || empty($mobile) || empty($position)) {
        return false;
    }

    $to = "adegocommunication@gmail.com";
    $subject = "ADEGO | Job Application for " . $position;

    // Sanitize email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $boundary = md5(time());

    $headers  = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"".$boundary."\"\r\n";

    // HTML Body
    $body  = "--".$boundary."\r\n";
    $body .= "Content-Type: text/html; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";

    $body .= "<h2>Job Application</h2>";
    $body .= "<p><strong>Name:</strong> {$name}</p>";
    $body .= "<p><strong>Email:</strong> {$email}</p>";
    $body .= "<p><strong>Mobile:</strong> {$mobile}</p>";
    $body .= "<p><strong>Position:</strong> {$position}</p>\r\n\r\n";

    // Attachment
    if ($resume && $resume['error'] == UPLOAD_ERR_OK) {

        $allowed = ['pdf','doc','docx'];
        $file_ext = strtolower(pathinfo($resume['name'], PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed)) {

            $file_content = chunk_split(base64_encode(file_get_contents($resume['tmp_name'])));
            $file_name = basename($resume['name']);

            $body .= "--".$boundary."\r\n";
            $body .= "Content-Type: application/octet-stream; name=\"".$file_name."\"\r\n";
            $body .= "Content-Disposition: attachment; filename=\"".$file_name."\"\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $body .= $file_content."\r\n\r\n";
        }
    }

    $body .= "--".$boundary."--";

    return mail($to, $subject, $body, $headers);
}


// uploading files (max 2MB File Size, default)
function uploadFile($fileInputName, $uploadDir, $customName = '', $allowedTypes = [], $maxSize = 2097152)
{
    // Check if file exists
    if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] === UPLOAD_ERR_NO_FILE) {
        return [
            'status' => 2,
            'msg' => "No file uploaded."
        ];
    }

    $file = $_FILES[$fileInputName];

    // Check for upload error
    // if ($file['error'] !== UPLOAD_ERR_OK) {
    //     return [
    //         'status' => 0,
    //         'msg' => "Error during file upload."
    //     ];
    // }

    $fileTmpPath = $file['tmp_name'];
    $fileName = $file['name'];
    $fileSize = $file['size'];
    $fileType = mime_content_type($fileTmpPath);
    $fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Check file size
    // if ($fileSize > $maxSize) {
    //     return [
    //         'status' => 0,
    //         'msg' => "File size exceeds limit."
    //     ];
    // }

    // Validate MIME type
    // if (!empty($allowedTypes)) {

    //     if (!in_array($fileType, $allowedTypes)) {
    //         return [
    //             'status' => 0,
    //             'msg' => "Invalid file type."
    //         ];
    //     }

    //     $allowedExt = ['pdf', 'jpg', 'jpeg', 'png', 'webp'];

    //     if (!in_array($fileExt, $allowedExt)) {
    //         return [
    //             'status' => 0,
    //             'msg' => "Invalid file extension."
    //         ];
    //     }
    // }


    // Create directory if not exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Generate new file name
    if (!empty($customName)) {
        $newFileName = $customName . '_' . date('YmdHis') . '.' . $fileExt;
    } else {
        $newFileName = date('YmdHis') . '.' . $fileExt;
    }

    $destination = rtrim($uploadDir, '/') . '/' . $newFileName;

    // Move file
    if (move_uploaded_file($fileTmpPath, $destination)) {
        return [
            'status' => 1,
            'file_name' => $newFileName,
            'file_path' => $destination
        ];
    } else {
        return [
            'status' => 0,
            'msg' => "Failed to move uploaded file."
        ];
    }
}
