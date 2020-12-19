# TelegramBotNotifier

Ця програма надсилає сповіщення у телеграмі з допомогою бота.

# Встановлення:

```sh
composer require salabun/telegram-bot-notifier
```

```sh
use Salabun\TelegramBotNotifier;
```


# Налаштування бота:

  - Додай [@BotFather](https://t.me/botfather)
  - Введи команду /newbot
  - Вигадай унікальне ім'я для бота, приклад: My Personal Helper
  - Вигадай унікальний логін, що закінчується на «bot», приклад: MyPersonalBot
  - Збережи згенерований токен
  - Напиши своєму боту @MyPersonalBot будь-яке 1 повідомлення
  - Дізнайся свій ID у телеграмі: [@ShowJsonBot](https://t.me/ShowJsonBot) (поле chat -> id)

# Використання:
Створи об'єкт:
```sh
$telegram = new TelegramBotNotifier($token);
```
Додай ID отримувача:
```sh
$telegram->addRecipient(389687316);
```
Додай повідомлення:
```sh
$telegram->text('Привіт')->br()->text('Мене звати Влад!');
```
Надішли:
```sh
$telegram->sendMessage();
```
# Методи для форматування тексту:
| Метод | Опис |
| ------ | ------ |
| $telegram->br() | Новий рядок |
| $telegram->bold('text') | Виділити жирним |
| $telegram->strong('text') | Виділити жирним |
| $telegram->italic('text') | Виділити курсивом |
| $telegram->em('text') | Виділити курсивом |
| $telegram->code('text') | Рядок коду |
| $telegram->pre('text') | Відформатований рядок |
| $telegram->url(['https://www.google.com', 'Google!'] | Посилання |
| $telegram->webPreview(true)  | Вимикач попереднього перегляду посилання |
| $telegram->enableWebPreview()  | Увімкнути попередній перегляд посилання |
| $telegram->disableWebPreview()  | Вимкнути попередній перегляд посилання |
| $telegram->recipients()  | Переглянути список отримувачів |


# Методи для роботи зі списком отримувачів:
Додати масив отримувачів:
```sh 
$telegram->addRecipients([1371880527, 1371880527], true); // true вказує додавати лише унікальних
``` 
Додати отримувача лише якщо його ще немає у списку:
```sh 
$telegram->addRecipient(1371880527, true);
``` 
Список отримувачів:
```sh 
$telegram->getRecipients();
``` 

# Методи для надсилання файлів:
Вкажи абсолютний шлях до файлу. Другим аргументом можна передати рядок тексту, або замикання:
```sh 
$telegram->addFile(realpath('test.png'), 'Test');

$telegram->addFile(realpath('test.png'), function() {
    $telegram = new TG();
    $telegram->text('Опис файлу');
    return $telegram->getText();
});
$telegram->sendDocument();
``` 

# Контакти:
Влад Салабун  
vlad@salabun.com  
[https://salabun.com](https://salabun.com)