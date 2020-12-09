<?php
/**
 *  Ця програма надсилає сповіщення у телеграмі з допомогою бота.
 */
namespace Salabun;

use Salabun\Helpers\Markdown;
use Salabun\Helpers\Recipient;
use Salabun\Helpers\SendMessage;
use Salabun\Helpers\SendDocument;

/**
 *  Я створив цю програму 6 серпня 2020 року.
 */

class TelegramBotNotifier
{
    use Markdown, Recipient, SendMessage, SendDocument;
    
    protected $v = "1.07";
    protected $token = null;
    protected $disableWebPreview = true;
    
    protected $recipients = [];
    protected $responses = [];
    
    protected $udelay = 300000; // 0,3 сек.
    protected $text = '';
    protected $textLengthLimit = 4096; // Розрахунок відбувається після парсинга
    protected $captionLengthLimit = 1096; // Розрахунок відбувається після парсинга
    protected $files = [];
    
    /**
     *  Чи варто передавати токен у конструктор? Може краще в метод?
     */
    public function __construct($token = null) 
    {
        if($token != null) {
            $this->token = $token;
        }
    }

    /**
     *  Налаштовую затримку між надсиланнями:
     */
    public function udelay($int) 
    {
        $this->udelay = $int;
        return $this;
    }
    
    
}