<?php 
 function sendEmail($email,$html,$subject){
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->Host="smtp.gmail.com";
    $mail->Port=587;
    $mail->SMTPSecure="tls";
    $mail->SMTPAuth=true;
    $mail->Username="kaif97708@gmail.com";
    $mail->Password="ktbk znlp ajvx uzfe";
    $mail->SetFrom("kaif97708@gmail.com");
    $mail->addAddress($email);
    $mail->IsHTML(true);
    $mail->Subject=$subject;
    $mail->Body=$html;
    $mail->SMTPOptions=array('ssl'=>array(
      'verify_peer' => false,
      'verify_peer_name'=> false,
      'allow_self_signed'=>false,
    ));
    if($mail->send()){
    //   echo "Done";
    }
    else{
    //   echo "Error";
    }

  }

  function randStr(){
    $str = str_shuffle("abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz");
    return $str = substr($str,0,15);

  }
?>