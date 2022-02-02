<?php
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    JSON(false, "");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

$name = trim(@$_POST["name"]);
$email = trim(@$_POST["email"]);
$handphone = trim(@$_POST["handphone"]);
$message = trim(@$_POST["message"]);
$token = trim(@$_POST["g-recaptcha-response"]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, array("secret" => "6Ld2mRMeAAAAAKmu7R6RJeCV4LzKJPb6Vqg9XEuh", "response" => @$token, "remoteip" => getUserIP()));
$output = curl_exec($ch);
curl_close($ch);
$res = json_decode($output, true);

if ($res["success"] == false) {
    JSON(false, "Recaptcha gagal diverifikasi.");
}

if (!$name || empty($name)) {
    JSON(false, "Nama tidak boleh kosong.");
}

if (!$email || empty($email)) {
    JSON(false, "Email tidak boleh kosong.");
}

if (!$handphone || empty($handphone)) {
    JSON(false, "No.HP/WhatsApp tidak boleh kosong.");
}

if (!$message || empty($message)) {
    JSON(false, "Pesan tidak boleh kosong.");
}

if (substr($handphone, 0, 1) === "0") {
    $handphone = "62" . substr($handphone, 1);
}

// config
$to = "sales02@glosindotech.com";
$bcc = [
    "glosindotech@gmail.com"
];

$date = date("Y-m-d");
$time = date("h:i:s");

try {
    $mail->isSMTP();
    $mail->Host       = 'globalintertech.co.id';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'dev@globalintertech.co.id';
    $mail->Password   = 'n@k@t@123';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('dev@globalintertech.co.id');
    $mail->addAddress($to);

    foreach ($bcc as $email) {
        $mail->addBCC = $email;
    }

    $mail->isHTML(true);
    $mail->Subject = "Pesan baru dari Web Global Integra Technology";
    $mail->Body    = "Tanggal: $date<br>Jam: $time<br><br>Nama: $name<br>Email: $email<br>No.HP/WhatsApp: <a href=\"https://wa.me/$handphone\">$handphone</a><br>Pesan:<br><br>$message";

    $mail->send();
    JSON(true, "Pesan telah berhasil dikirim");
} catch (Exception $e) {
    JSON(false, "Gagal mengirim pesan. Mailer Error: {$mail->ErrorInfo}");
}


function JSON($status, $message)
{
    header("content-type: application/json");
    echo json_encode([
        "success" => $status,
        "message" => $message
    ], JSON_PRETTY_PRINT);
    die();
}

function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}
