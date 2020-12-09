<?php
/**
 *  Метод SendMessage:
 */
namespace Salabun\Helpers;

Trait SendMessage
{
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
                        CURLOPT_POST => true,
                        CURLOPT_RETURNTRANSFER => true,
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
     *  Аліас для надпислання повідомлення:
     */
    public function sendMessage() 
    {
        $this->send();
    }
}