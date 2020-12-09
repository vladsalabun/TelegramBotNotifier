<?php
/**
 *  Методи для керуванням списку отримувачів повідомлення:
 */
namespace Salabun\Helpers;

Trait Recipient
{
    /**
     *  Додаю отримувача до списку:
     */
    public function addRecipient($id, $uniqueOnly = false) 
    {
        if($uniqueOnly == true) {
            if(!in_array($id, $this->recipients)) {
                $this->recipients[] = $id;
            }
        } else {
            $this->recipients[] = $id;
        }
    }
    
    /**
     *  Додаю отримувачів до списку:
     */
    public function addRecipients($array, $uniqueOnly = false) 
    {
        foreach($array as $id) {
            // Вибираю лише унікальних:
            if($uniqueOnly == true) {
                if(!in_array($id, $this->recipients)) {
                    $this->recipients[] = $id;
                }
            } else {
                // Додаю всіх:
                $this->recipients[] = $id;
            }
        }
    }
    
    /**
     *  Повертаю масив отримувачів:
     */    
    public function getRecipients() 
    {
        return $this->recipients;
    }
    
}