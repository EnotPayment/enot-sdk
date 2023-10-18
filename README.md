# Enot sdk #

______

### ![compatible](https://img.shields.io/badge/php-%5E7.4-green?style=plastic) ###

## Установка ##

_____

```
composer require enot-payment/enot
```

## Использование ##

___

### Для работы нужно получить:

> - "shopId" - Идентификатор кассы
> - "shopSecretKey" - Секретный ключ кассы (полученный при генерации в личном кабинете в разделе: "Кассы" -> "Интеграция")
> - "userId" - Идентификатор пользователя
> - "userSecretKey" - Секретный ключ пользователя "userSecretKey" (полученным при генерации в личном кабинете в разделе: "Настройки профиля" -> "Интеграция")
> - "webhookPaymentKey" - Секретный ключ для вычисления хэша WebHook'а оплат (дополнительный ключ кассы)
> - "webhookPayoffKey" - Секретный ключ для вычисления хэша WebHook'а выводов (дополнительный ключ пользователя)

---

### Инициализация: ###

```php 
use Enot\Api\Http\EnotFacade;

$facade = new EnotFacade(
        $shopId,
        $shopSecretKey,
        $userId,
        $userSecretKey,
        $webhookPaymentKey,
        $webhookPayoffKey
);
```

---

### Получение доступных методов и тарифов оплаты: ###

```php
$response = $facade->getAvailablePaymentTariffs();
```

✅ При успешном ответе вернется объект PaymentAvailableTariffsDto, содержащий параметр "tariffs" - массив объектов PaymentTariffParamsResponseDto с параметрами

Обязательные:
- "percent" - Общий процент комиссии
- "fix" - Фиксированная комиссия
- "service" - Код метода оплаты
- "currency" - Валюта
- "status" - Статус тарифа (enabled или disabled)

Опциональные:
- "minSum" - Минимальная сумма оплаты
- "maxSum" - Максимальная сумма оплаты
- "shopPercent" - Процент комиссии, взимаемый с кассы
- "userPercent" - Процент комиссии, взимаемый с клиента
- "serviceLabel" - Название метода оплаты

❌ При неудачном ответе выбросится исключение типа PaymentException с описанием ошибки. 

---

### Создание платежа: ###

Метод createInvoice() принимает InvoiceCreateRequestDto.

InvoiceCreateRequestDto принимает параметры

Обязательные:
- "amount" - сумма инвойса
- "orderId" - идентификатор заказа в Вашей системе

Опциональные:
- "currency" - Валюта платежа (RUB, USD, EUR, UAH)
- "hookUrl" - URL для отправки webhook
- "customFields" - Строка, которая будет возвращена в уведомления после оплаты (webhook, callback), формат JSON строки
- "comment" - Назначение платежа (показывается клиенту при оплате)
- "failUrl" - URL для переадресовки пользователя при ошибке при оплате
- "successUrl" - URL для переадресовки пользователя при успешной оплате
- "expire" - Время жизни инвойса в минутах
- "includeService" - Методы оплаты доступные на странице счёта
- "excludeService" - Методы оплаты недоступные на странице счёта

```php
use Enot\Api\Dto\Request\Payment\InvoiceCreateRequestDto;

$invoiceCreateRequestDto = new InvoiceCreateRequestDto(
    50.05,
    'orderId',
    'RUB',
    'https://exaple.com',
    '{\"order\": \"74056\"}',
    'comment',
    'https://exaple.com/fail',
    'https://exaple.com/success',
    300.05,
    [
        'card'
    ],
    [
        'qiwi'
    ]
);

$response = $facade->createInvoice($invoiceCreateRequestDto);
```

✅ При успешном ответе вернется объект InvoiceCreateResponseDto, содержащий параметры

Обязательные:
- "id" - ID операции в нашей системе
- "amount" - Сумма инвойса (в рублях)
- "currency" - Валюта платежа (RUB, USD, EUR, UAH)
- "url" - Ссылка на форму оплаты
- "expired" - Время завершения инвойса в формате "Y-m-d H:i:s"

❌ При неудачном ответе выбросится исключение типа PaymentException с описанием ошибки.

---

### Получение информации об оплате: ###

Метод getInvoiceInfo() принимает InvoiceInfoRequestDto.

InvoiceInfoRequestDto принимает параметры

Обязательные:
- "invoiceId" - ID транзакции

Опциональные:
- "orderId" - Уникальный идентификатор платежа в Вашей системе

```php
use Enot\Api\Dto\Request\Payment\InvoiceInfoRequestDto;

$invoiceInfoRequestDto = new InvoiceInfoRequestDto(
    '3fa85f64-5717-4562-b3fc-2c963f66afa6',
    'orderId'
);

$response = $facade->getInvoiceInfo($invoiceInfoRequestDto);
```

✅ При успешном ответе вернется объект InvoiceInfoResponseDto, содержащий параметры

Обязательные:
- "invoiceId" - ID операции в нашей системе
- "orderId" - ID операции в Вашей системе
- "shopId" - ID кассы
- "status" - Статус транзакции
- "invoiceAmount" - Сумма платежа
- "currency" - Валюта платежа (RUB, USD, EUR, UAH)
- "createdAt" - Время создания инвойса
- "expiredAt" - Время истечения периода жизни

Опциональные:
- "credited" - Сумма зачисления на баланс
- "payService" - Метод оплаты
- "payerDetails" - Реквизиты плательщика
- "commissionAmount" - Общая комиссия в рублях
- "commissionPercent" - Общая комиссия в процентах
- "shopCommissionAmount" - Сумма комиссии c кассы
- "userCommissionAmount" - Сумма комиссии, взимаемая с клиента
- "userCommissionPercent" - Процент комиссии, взимаемый с клиента
- "customField" - Строка, которую вы передавали в параметрах при создании платежа
- "paidAt" - Время оплаты инвойса

❌ При неудачном ответе выбросится исключение типа InvoiceException с описанием ошибки.

---

### Проверка сигнатуры WebHook'а оплаты: ###

Наша система имеет возможность уведомления об изменении статуса платежа.

Вам требуется добавить необходимый URL для отправки http-уведомлений на страницу интеграции кассы.

Метод checkPaymentWebhookSignature() служит для проверки сигнатуры входящего WebHook'а, принимает параметры

Обязательные:
- "webhookRequest" - тело запроса в формате json
- "signature" - сигнатура, подтверждающая валидность (передается в параметре заголовка 'x-api-sha256-signature')

Пример кода для получения данных из входящего запроса:
```php
$webhookRequest = file_get_contents('php://input');
$headerParams = getallheaders();

if(!isset($signature = $headerParams['x-api-sha256-signature'])) {
    throw new Exception();
}

$facade->checkPaymentWebhookSignature($webhookRequest, $signature);
```

Пример входящего webhook запроса для оплат:
```php
{
"invoice_id":"a750dced-0f08-384a-a441-d0a4dba0cae8",
"status":"success",
"amount":"100.00",
"currency":"RUB",
"order_id":"89f2634c-afa9-3b16-bbde-e4a59ee94639",
"custom_fields":{"user":1},
"type":1,
"pay_time":"2023-04-06 15:53:28",
"pay_service":"card",
"payer_details":"553691******1279",
"code": 1,
"credited":"95.50"
}
```

✅ При успешной проверке сигнатуры в ответе вернется "True"

❌ При неудачной проверке сигнатуры в ответе вернется - "False"

---

### Получение баланса пользователя: ###

```php
$response = $facade->getUserBalance();
```
✅ При успешном ответе вернется объект UserBalanceResponseDto, содержащий параметры

Обязательные:

- "balance" - Общий баланс
- "activeBalance" - Баланс доступный для вывода
- "freezeBalance" - Баланс в заморозке

❌ При неудачном ответе выбросится исключение типа UserBalanceException с описанием ошибки. 

---

### Создание заявки на вывод: ###

Метод createPayoff() принимает CreatePayoffRequestDto.

CreatePayoffRequestDto принимает параметры

Обязательные:
- "service" - Сервис вывода (полный код)
- "walletTo" - Номер карты/телефона/кошелька для вывода
- "amount" - Сумма вывода

Опциональные:
- "orderId" - Уникальный идентификатор платежа в Вашей системе
- "comment" - Комментарий
- "hookUrl" - Url, на который отправлять webhook запрос с уведомлением по заявке на вывод
- "subtract" - С кого списывать комиссию, с баланса или с суммы. По умолчанию комиссия снимается с суммы.

```php
use Enot\Api\Dto\Request\Payoff\CreatePayoffRequestDto;

$createPayoffRequestDto = new CreatePayoffRequestDto(
    'card',
    '1234567890123456'
    100.05,
    'orderId',
    'comment',
    'https://exaple.com',
    1
);
```

✅ При успешном ответе вернется объект CreatePayoffResponseDto, содержащий параметры

Обязательные:
- "payoffId" - ID вывода
- "amountWithdrawRub" - Сумма списания с баланса (в рублях)
- "balance" - Баланс после списания суммы вывода

❌ При неудачном ответе выбросится исключение типа PayoffException с описанием ошибки.

---

### Получение информации о выводе: ###

Метод getPayoffInfo() принимает PayoffInfoRequestDto.

PayoffInfoRequestDto принимает параметры

Обязательные:
- "id" - ID вывода

Опциональные:
- "orderId" - Уникальный идентификатор платежа в Вашей системе

```php
use Enot\Api\Dto\Request\Payoff\PayoffInfoRequestDto;

$payoffInfoRequestDto = new PayoffInfoRequestDto(
    '3fa85f64-5717-4562-b3fc-2c963f66afa6',
    'orderId'
);
```

✅ При успешном ответе вернется объект PayoffInfoResponseDto, содержащий параметры

Обязательные:
- "payoffId" - ID вывода
- "status" - Статус вывода
- "orderId" - Уникальный идентификатор платежа в Вашей системе
- "service" - Сервис вывода (полный код)
- "type" - Тип вывода
- "subtract" - С кого списывать комиссию, с баланса или с суммы
- "amount" - Сумма вывода (в рублях)
- "amountWithdrawRub" - Сумма списания с баланса (в рублях)
- "commissionRub" - Комиссия (в рублях)
- "receiveCurrency" - Валюта вывода
- "amountReceive" - Сумма вывода в валюте
- "createdAt" - Время создания вывода

Опциональные:
- "wallet" - Номер карты/телефона/кошелька для вывода
- "comment" - Комментарий указанный при создании выплаты
- "paidAt" - Время вывода
- "errorMessage" - Причина отклонения

❌ При неудачном ответе выбросится исключение типа PayoffException с описанием ошибки.

---

### Проверка сигнатуры WebHook'а вывода: ###

Наша система имеет возможность уведомления об изменении статуса вывода средств.

Вам требуется добавить необходимый URL для отправки уведомлений на странице массовых выплат. Ссылку можете указать на любой из ваших сайтов.

>Уведомления отправляются только на те транзакции, которые были так же созданы с помощью API. Если вывод был запрошен с личного кабинета, уведомление отправлено не будет. После изменения статуса, вам будет приходить уведомление по вашей ссылке.

Метод checkPayoffWebhookSignature() служит для проверки сигнатуры входящего WebHook'а, принимает параметры

Обязательные:
- "webhookRequest" - тело запроса в формате json
- "signature" - сигнатура, подтверждающая валидность (передается в параметре заголовка 'x-api-sha256-signature')

Пример кода для получения данных из входящего запроса:
```php
$webhookRequest = file_get_contents('php://input');
$headerParams = getallheaders();

if(!isset($signature = $headerParams['x-api-sha256-signature'])) {
    throw new Exception();
}

$facade->checkPaymentWebhookSignature($webhookRequest, $signature);
```

Пример входящего webhook запроса для выводов:
```php
{
"amount": "763.46",
"status": "success",
"wallet": "5184559049166517",
"service": "card",
"order_id": "d1e747a4-8258-3e43-b600-7f320fbfb878",
"payoff_id": "306291d6-a432-47bf-8e4c-0744a7bad45a",
"commission": "20.66"
}
```

✅ При успешной проверке сигнатуры в ответе вернется "True"

❌ При неудачной проверке сигнатуры в ответе вернется - "False"