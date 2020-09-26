<?php
/**
 *  Що корисного можна написати на початку файлу? Напевно, що це чудовий винахід і він колись присене користь людству?! 
 *  Або ні. 
 */
namespace Salabun;

/**
 *  Я створив цю програму 6 серпня 2020 року.
 */

class TelegramBotNotifier
{
    
    protected $token = null;
    protected $disableWebPreview = true;
    
    protected $recipients = [];
    protected $responses = [];
    
    protected $udelay = 300000; // 0,3 сек.
    protected $text = '';
    
    /**
     *  Чи варто передавати токен у конструктор? Може краще в метод?
     */
    public function __construct($token) 
    {
        $this->token = $token;
    }
    
    /**
     *  Додаю отримувача до списку:
     */
    public function addRecipient($id) 
    {
        $this->recipients[] = $id;
    }
    
    /**
     *  Надсилаю повідомлення усім отримувачам:
     */
    public function send() 
    {
        if(count($this->recipients) > 0) {
            
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
                            'disable_web_page_preview' => $this->disableWebPreview,
                        ),
                    )
                );
                
                curl_exec($ch);
                
                // Зберігаю відповідь сервера:
                $this->responses[$recipient][] = curl_getinfo($ch);
                curl_close($ch);
                
                // Чекаю перед надсиланням наступного повідомлення:
                usleep($this->udelay);
            
            }
        } else {
            return [
                'status' => 404,
                'data' => [],
                'message' => 'You need to specify at least one recipient.'
            ];
        }
        
        // Після надсилання повідомлення очищаю текст:
        $this->text = '';
        
        return [
            'status' => 200,
            'data' => $this->responses,
            'message' => 'Messages sent.'
        ];
        
    }

    /**
     *  З нового рядка:
     */
    public function br() 
    {
        $this->text .= PHP_EOL;
        return $this;
    }
   
    /**
     *  Додаю текст:
     */
    public function text($text) 
    {
        $this->text .= $text;
        return $this;
    }
    
    /**
     *  Жирним:
     */
    public function bold($text) 
    {
        $this->text .= '<b>' . $text . '</b>';
        return $this;
    }
    
    /**
     *  Жирним:
     */
    public function strong($text) 
    {
        $this->text .= '<strong>' . $text . '</strong>';
        return $this;
    }
   
    /**
     *  Курсивом:
     */
    public function italic($text) 
    {
        $this->text .= '<i>' . $text . '</i>';
        return $this;
    }
    
    /**
     *  Курсивом:
     */
    public function em($text) 
    {
        $this->text .= '<em>' . $text . '</em>';
        return $this;
    }
    
    /**
     *  Виділяю код:
     */
    public function code($text) 
    {
        $this->text .= '<code>' . $text . '</code>';
        return $this;
    }
    
    /**
     *  Форматую:
     */
    public function pre($text) 
    {
        $this->text .= '<pre>' . $text . '</pre>';
        return $this;
    }
   
    /**
     *  Додаю посилання:
     */
    public function url($array) 
    {
        $this->text .= '<a href="' . $array[0] . '">' . $array[1] . '</a>';
        return $this;
    }
    
    /**
     *  Попередній перегляд посилання:
     */
    public function webPreview($boolean) 
    {
        if($boolean == true) {
            $this->disableWebPreview = false;
        } else {
            $this->disableWebPreview = true;
        }
        
        return $this;
    }
    
    /**
     *  Вимикаю попередній перегляд посилання:
     */
    public function disableWebPreview() 
    {
        $this->disableWebPreview = true;
        return $this;
    }
    
    /**
     *  Вмикаю попередній перегляд посилання:
     */
    public function enableWebPreview() 
    {
        $this->disableWebPreview = false;
        return $this;
    }
    
    /**
     *  Налаштовую затримку між надсиланнями:
     */
    public function udelay($int) 
    {
        $this->udelay = $int;
        return $this;
    }
    
    /**
     *  Повертаю масив отримувачів:
     */
    public function recipients() 
    {
        return $this->recipients;
    }
    
}