<?php

namespace Classes;

class Mail {

   private $from           = "From: tamere@enstring.fr";
   private $email_to       = "ugo.rougelot@epsi.fr";
   private $email_subject  = "Test mail";
   private $email_body     = "Hello! This is a simple email message.";

   public function __construct(){

   }

   public function setHeader($header){
      $this->header = $header;
   }

   public function setContent($email_body){
      $this->email_body = $email_body;
   }

   public function setSubject($subject){
      $this->email_subject = $subject;
   }

   public function setEmailTo($to){
      $this->email_to = $to;
   }

   public function setEmailToFromArray($tos){
      $this->setEmailTo(implode(',' , $tos));
   }

   public function setFrom($from){
      $this->from = $from;
   }

   public function getTargets(){
      return $this->email_to;
   }

   private function setDefaultHeader(){
      $headers  = "MIME-Version: 1.0\n" ;
      $headers .= "From: $this->from\n";
      $headers .= "X-Priority: 1 (Highest)\n";
      $headers .= "X-MSMail-Priority: High\n";
      $headers .= "Importance: High\n";
      $headers .= "Content-Type: text/html; charset=UTF-8";
      return $headers;
   }

   public function sendMail(){

      try {
         mail($this->email_to, $this->email_subject, $this->email_body , $this->setDefaultHeader());
         return null;
      } catch (\Exception $e) {
         return $e->getTraceAsString();
      }
   }

   public function repeatSend($numberOfTime){
      for ($i=0; $i < $numberOfTime ; $i++) {
         $this->sendMail();
      }
   }
}

?>
