 <?php
    // include '../inc/connection.php';

    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $address = $_REQUEST['address'];
    $interest = $_REQUEST['interest'];
    $message = $_REQUEST['message'];

    $subject = "Contact Us | New Request";

    $to = "adegocommunication@gmail.com"; // official email address

    // Create the email headers
    $headers = "From: " . $name . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Email subject
    $email_subject = $subject;

    // Email body
    $email_body = "<h2>Contact Us Request</h2>";
    $email_body .= "<p><strong>Name:</strong><br>{$name}</p>";
    $email_body .= "<p><strong>Email:</strong><br>{$email}</p>";
    $email_body .= "<p><strong>Phone:</strong><br>{$phone}</p>";
    $email_body .= "<p><strong>Address:</strong><br>{$address}</p>";
    $email_body .= "<p><strong>Training Program of Interest:</strong><br>{$interest}</p>";
    $email_body .= "<p><strong>Message:</strong><br>{$message}</p>";

    // $result = mail($to, $email_subject, $email_body, $headers);

    // Send the email
    if (true) {
        $msg = "<div class='alert alert-success alert-dismissible fade show mt-3' role='alert'>
        <strong>Success:</strong> Message sent successfully! We will contact you as soon as possible.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        echo json_encode([
            "status" => 1,
            "msg" => $msg
        ]);
    } else {
        // echo "Failed to send the message.";
         $msg = "<div class='alert alert-danger alert-dismissible fade show mt-3' role='alert'>
        <strong>Failed:</strong> Message not send due to some error. Please try again.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        echo json_encode([
            "status" => 0,
            "msg" => $msg
        ]);
    }

    ?>