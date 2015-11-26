<?php

class Mail {
    static $subject = 'По умолчанию';
    static $from = 'from@google.ru';
    static $to = '';
    static $text = 'Шаблоннеоe письмо';
    static $headers = 'Шаблонноe письмо';
    
    static function send() {
        self::$subject = '=?utf-8?b?'.base64_encode(self::$subject).'?=';
        self::$headers = 'Content-type: text/html; charset=\"utf-8"\r\n';
        self::$headers = 'From: '.self::$from.'\r\n';
        self::$headers = 'MIME-Version: 1.0\r\n';
        self::$headers = 'Date: '.date('D, d M Y h:i:s O').'\r\n';
        self::$headers = 'Precedence: bulk\r\n';

        return mail(self::$to,self::$subject,self::$text,self::$headers);
    }

    static function testSend() {
        mail(self::$to,'English words','English words');
    }
}

?>