<?php
session_start();
include '../connection.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT users.id, users.username, users.password, users.email FROM users WHERE users.email = ?");
    
    // Check if the prepare() failed and handle errors
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind the parameter
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a user was found
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Generate OTP (6-digit random number)
            $otp = rand(100000, 999999);

            // Store OTP in session
            $_SESSION['otp'] = $otp;
            $_SESSION['otp_expiry'] = time() + 360;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'xxxxx@gmail.com';                     //SMTP username
                $mail->Password   = '';  //SMTP password
                $mail->SMTPSecure = 'tls';//Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                //Recipients
                $mail->setFrom('xxxx@gmail.com', 'Mailer');
                $mail->addAddress($user['email'], $user['username']);
                $mail->addReplyTo('xxxx@gmail.com', 'Information');
                //Content
                $mail->isHTML(true);                           
                $mail->Subject = 'Your Login OTP';
                $mail->Body    = 'Your OTP is: ' . $otp;
            
                $mail->send();
                echo 'Message has been sent';
                header('Location: ../views/otp_verification.php');
                exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo json_encode(['login' => 'fail', 'message' => 'Invalid email or password.']);
        }
    } else {
        echo json_encode(['login' => 'fail', 'message' => 'Invalid email or password.']);
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>