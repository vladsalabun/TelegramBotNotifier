<?php

namespace Salabun;

/**
 *  Я створив цю програму 6 серпня 2020 року.
 */

class TelegramBotNotifier
{
    public function __construct($token) 
    {
        $this->token = $token;
        $this->recipients = [];
        $this->text = '';
        $this->webPreview = true;
        $this->delay = 1;
    }
    
    public function addRecipient($id) 
    {
        $this->recipients[] = $id;
    }
    
    public function send() 
    {
        foreach($this->recipients as $recipient) {
        
            $ch = curl_init();
            
            curl_setopt_array(
                $ch,
                array(
                    CURLOPT_URL => 'https://api.telegram.org/bot' . $this->token . '/sendMessage',
                    CURLOPT_POST => TRUE,
                    CURLOPT_RETURNTRANSFER => TRUE,
                    CURLOPT_TIMEOUT => 10,
                    CURLOPT_POSTFIELDS => array(
                        'chat_id' => $recipient,
                        'text' => $this->text,
                        'parse_mode' => 'html',
                        'disable_web_page_preview' => $this->webPreview,
                    ),
                )
            );
            
            curl_exec($ch);
            $responses[$recipient] = curl_getinfo($ch);
            curl_close($ch);
            
            sleep($this->delay);
        
        }
        
        return $responses;
    }

    public function br() 
    {
        $this->text .= PHP_EOL;
        return $this;
    }
    
    public function text($text) 
    {
        $this->text .= $text;
        return $this;
    }
    
    public function bold($text) 
    {
        $this->text .= '<b>' . $text . '</b>';
        return $this;
    }
    
    public function italic($text) 
    {
        $this->text .= '<i>' . $text . '</i>';
        return $this;
    }
    
    public function em($text) 
    {
        $this->text .= '<em>' . $text . '</em>';
        return $this;
    }
    
    public function strong($text) 
    {
        $this->text .= '<strong>' . $text . '</strong>';
        return $this;
    }
    
    public function code($text) 
    {
        $this->text .= '<code>' . $text . '</code>';
        return $this;
    }
    
    public function pre($text) 
    {
        $this->text .= '<pre>' . $text . '</pre>';
        return $this;
    }
   
    public function url($array) 
    {
        $this->text .= '<a href="' . $array[0] . '">' . $array[1] . '</a>';
        return $this;
    }
    
    public function webPreview($boolean) 
    {
        if($boolean == true) {
            $this->webPreview = true;
        } else {
            $this->webPreview = false;
        }
        
        return $this;
    }
    
}