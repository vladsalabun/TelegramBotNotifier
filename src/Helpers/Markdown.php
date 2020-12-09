<?php
/**
 *  Методи для форматування тексту повідомлення:
 */
namespace Salabun\Helpers;

Trait Markdown
{
    
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
     *  Повертаю текст:
     */
    public function getText() 
    {
        return $this->text;
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
    
}