<?php

/*
* Для тестирования использовать mail-tester.com
*/

class mailLibrary {
    
    // Hosting vars
    private $hosting;
    private $port;
    private $login;
    private $pass;
    
    // Libs vars
    private $h2t;
    private $mail_lib;
    
    function __construct($hosting_mail, $port_mail, $mail_from, $pass_login, $name_from, $unsub_link) { 
        
        // Файлы phpmailer
        require_once  ENGINE_DIR."/libs/phpmailer/class.phpmailer.php";
        require_once  ENGINE_DIR."/libs/phpmailer/class.smtp.php";
        require_once  ENGINE_DIR."/libs/phpmailer/extras/class.html2text.php";

		$this->hosting = $hosting_mail;
		$this->port = $port_mail;
		$this->login = $mail_from;
		$this->pass = $pass_login;
        
        $this->mail_lib = new PHPMailer;
        // Настройки
        $this->mail_lib->isSMTP(); 
        $this->mail_lib->Host = $this->hosting;
        $this->mail_lib->SMTPAuth = true; 
        $this->mail_lib->Username = $this->login;// Ваш логин 
        $this->mail_lib->Password = $this->pass;    // Ваш пароль
        $this->mail_lib->SMTPSecure = "tls";        //tls
        $this->mail_lib->Port = $this->port;
        
        $this->mail_lib->setFrom($this->login, $this->toCode($name_from)); // Проверка сервера, логина и пароля
        $this->mail_lib->setUnsubscribeLink($unsub_link."?mail=".$to_mail);
        
        // Письмо
        $this->mail_lib->isHTML(true);
	}
    
    public function send_smtp($title, $text, $to_name, $to_mail, $file = false){
        require_once  ENGINE_DIR."/libs/phpmailer/extras/class.html2text.php";
        
        $this->h2t = new Html2Text($text);
        $this->mail_lib->AltBody = $this->h2t->get_text();

        // Email получателя
        $this->mail_lib->addAddress($to_mail, $this->toCode($to_name));

        // Заголовок и текст письма
        $this->mail_lib->Subject = $this->toCode($title);
        $this->mail_lib->Body = $text;

        // Прикреплённые файлы
        if($file) $this->mail_lib->addAttachment($file['path'], $file['name']);

        // Отправка и результат
        if(!$this->mail_lib->send()) "Message could not be sent"."Mailer Error: ". $this->mail_lib->ErrorInfo;
        else "Message send. OK";/**/
    }
    
    private function toCode($text){
        return "=?UTF-8?Q?".str_replace("+","_",str_replace("%","=",urlencode($text)))."?= ";
    }
}

?>