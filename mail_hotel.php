<?php

$title = $_POST[title];                      
$check = $_POST[check];                      
$name = $_POST[name];                      
$companyName = $_POST[companyName];                        
$phoneNumber = $_POST[phoneNumber];
$personnel = $_POST[personnel];
$address = $_POST[address];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "./php_mailer/src/PHPMailer.php";
require "./php_mailer/src/SMTP.php";
require "./php_mailer/src/Exception.php";

$mail = new PHPMailer(true);

try {

    // 서버세팅    
    $mail -> SMTPDebug = 0;    // 디버깅 설정
    $mail -> isSMTP();               // SMTP 사용 설정

    $mail -> Host = "smtp.naver.com";                      // email 보낼때 사용할 서버를 지정
    $mail -> SMTPAuth = true;                                // SMTP 인증을 사용함
    $mail -> Username = "hypkorea2018";  // 메일 계정
    $mail -> Password = "hyp2018103!";                   // 메일 비밀번호
    $mail -> SMTPSecure = "ssl";                             // SSL을 사용함
    $mail -> Port = 465;                                        // email 보낼때 사용할 포트를 지정
    $mail -> CharSet = "utf-8";                                // 문자셋 인코딩

    // 보내는 메일
    $mail -> setFrom("hypkorea2018@naver.com", "문의합니다");

    // 받는 메일
    $mail -> addAddress("hypkorea2018@gmail.com", "receive01");
    
    // 첨부파일
//    $mail -> addAttachment("./test.zip");
//    $mail -> addAttachment("./anjihyn.jpg");

    // 메일 내용
    $mail -> isHTML(true);                                                         // HTML 태그 사용 여부
    $mail -> Subject = $title;                  // 메일 제목
    $mail -> Body = "고객구분 : $check<br><br>이름 : $name<br><br>상호명 : $companyName<br><br>전화번호 : $phoneNumber<br><br>요청인원 : $personnel<br><br>주소 : $address";    // 메일 내용
    
    // 메일 전송
    $mail -> send();
    
    echo "<script>alert('감사합니다, 메시지가 전송 되었습니다.');location.href='https://hypkorea.com/form.html';</script>";

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error : ", $mail -> ErrorInfo;
}
?>