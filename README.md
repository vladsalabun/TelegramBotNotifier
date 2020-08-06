# TelegramBotNotifier

Ця програма надсилає сповіщення у телеграмі з допомогою бота.

# Швидке встановлення:

  - Додай [@BotFather](https://t.me/botfather)
  - Введи команду /newbot
  - Вигадай унікальне імя для бота, приклад: My Personal Helper
  - Вигадай унікальний логін, що закінчується на «bot», приклад: MyPersonalBot
  - Збережи згенерований токен
  - Напиши своєму боту @MyPersonalBot будь-яке 1 повідомлення
  - Дізнайся свій ID у телеграмі: [@ShowJsonBot](https://t.me/ShowJsonBot) (поле chat -> id)

# Використання:
Створіть об'єкт:
```sh
$telegram = new TelegramBotNotifier($token);
```
Додайте ID отримувача:
```sh
$telegram->addRecipient(389687316);
```
Додайте повідомлення:
```sh
    $telegram->text('Привіт')->br()->text('Мене звати Влад!');
```
Надішліть:
```sh
    $telegram->send();
```
# Додаткові методи:
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

# Контакти:
Влад Салабун  
vlad@salabun.com  
[https://salabun.com](https://salabun.com)
