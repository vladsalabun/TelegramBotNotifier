<?php
/**
 *  Метод SendDocument:
 */
namespace Salabun\Helpers;

Trait SendDocument
{
    public function sendDocument() 
    {
        if(count($this->recipients) > 0) {
            if(count($this->files) > 0) {
                
                foreach($this->recipients as $recipient) {
                    foreach($this->files as $file) { 
                        $ch = curl_init();
                        
                        curl_setopt_array(
                            $ch,
                            array(
                                CURLOPT_URL => 'https://api.telegram.org/bot' . $this->token . '/sendDocument',
                                CURLOPT_POST => true,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_TIMEOUT => 10,
                                CURLOPT_POSTFIELDS => array(
                                    'chat_id' => $recipient,
                                    'caption' => $file['caption'],
                                    'parse_mode' => 'html',
                                    'document' => new \CurlFile($file['path']),
                                ),
                            )
                        );
                        
                        curl_exec($ch);
                        
                        var_dump(curl_getinfo($ch));
                        
                        // Зберігаю відповідь сервера:
                        $this->responses[$recipient][] = curl_getinfo($ch);
                        curl_close($ch);
                        
                        // Чекаю перед надсиланням наступного повідомлення:
                        usleep($this->udelay);
                        
                    } // <- надсилання файлів
                } // <- цикл отримувачів
                
            } else {
                return [
                    'status' => 404,
                    'data' => [],
                    'message' => 'You need to specify at least one file.'
                ];
            }
        } else {
            return [
                'status' => 404,
                'data' => [],
                'message' => 'You need to specify at least one recipient.'
            ];
        }
        
        // Після надсилання повідомлення очищаю масив файлів:
        $this->files = '';
        
        return [
            'status' => 200,
            'data' => $this->responses,
            'message' => 'Messages sent.'
        ];
    }
    
    public function addFile($path, $caption) 
    {
        $this->files[] = [
            'path' => $path,
            'caption' => $caption,
        ];
    }
    
    public function getFiles() 
    {
        return $this->files;
    }
}