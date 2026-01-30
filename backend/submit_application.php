<?php 
    $name = $_REQUEST['name'] ?? '';
    $email = $_REQUEST['email'] ?? '';
    $mobile = $_REQUEST['mobile'] ?? '';
    $position = $_REQUEST['position'] ?? '';
    $resume = $_FILES['resume'] ?? null;

    $subject = "Job Application for " . $position;

    $to = ""; // official email address

    // Create the email headers
    $headers = "From: " . $name . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Email subject
    $email_subject = $subject;

    // Email body
    $email_body = "<h2>Job Application</h2>";
    $email_body .= "<p><strong>Name:</strong><br>{$name}</p>";
    $email_body .= "<p><strong>Email:</strong><br>{$email}</p>";
    $email_body .= "<p><strong>Mobile Number:</strong><br>{$mobile}</p>";
    $email_body .= "<p><strong>Position Applied For:</strong><br>{$position}</p>";

    // Handle file upload
    if ($resume && $resume['error'] == UPLOAD_ERR_OK) {
        $file_tmp_path = $resume['tmp_name'];
        $file_name = basename($resume['name']);
        $file_size = $resume['size'];
        $file_type = $resume['type'];

        // Read the file content
        $handle = fopen($file_tmp_path, "r");
        $content = fread($handle, $file_size);
        fclose($handle);
        $encoded_content = chunk_split(base64_encode($content));

        // Create a boundary string
        $boundary = md5(time());

        // Add attachment to email body
        $email_body .= "--" . $boundary . "\r\n";
        $email_body .= "Content-Type: " . $file_type . "; name=\"" . $file_name . "\"\r\n";
        $email_body .= "Content-Disposition: attachment; filename=\"" . $file_name . "\"\r\n";
        $email_body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $email_body .= $encoded_content . "\r\n";
        $email_body .= "--" . $boundary . "--";

        // Update headers for attachment
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n";
    }

    $result = mail($to, $email_subject, $email_body, $headers);

    // Send the email
    if ($result) {
        header("Location: ../career.php?status=success");
    } else {
        header("Location: ../career.php?status=error");
    }
    exit();

?>
