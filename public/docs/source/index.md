---
title: API Reference

language_tabs:
- bash
- javascript
- php
- python

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](https://bafa436a.ngrok.io/docs/collection.json)

<!-- END_INFO -->

#Account


APIs for managing accounts
<!-- START_ecb97bf722bf165bb312afaa17ef20f3 -->
## Create Account

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/accounts/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"name":"nobis","bank_account_number":"adipisci","mobile_money_wallet":"sequi","account_type_id":"blanditiis","currency_id":"ullam","business_id":"impedit"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/accounts/create");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "name": "nobis",
    "bank_account_number": "adipisci",
    "mobile_money_wallet": "sequi",
    "account_type_id": "blanditiis",
    "currency_id": "ullam",
    "business_id": "impedit"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/accounts/create", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "name" => "nobis",
            "bank_account_number" => "adipisci",
            "mobile_money_wallet" => "sequi",
            "account_type_id" => "blanditiis",
            "currency_id" => "ullam",
            "business_id" => "impedit",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/accounts/create'
payload = {
    'name': 'nobis',
    'bank_account_number': 'adipisci',
    'mobile_money_wallet': 'sequi',
    'account_type_id': 'blanditiis',
    'currency_id': 'ullam',
    'business_id': 'impedit'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "Could not create account.",
    "errors": {
        "business_id": [
            "The selected business id is invalid."
        ]
    }
}
```

### HTTP Request
`POST /api/v1/accounts/create`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | The name of the account.
    bank_account_number | string |  required  | The bank account number of the account.
    mobile_money_wallet | string |  required  | The MTN Mobile Money wallet number of the account.
    account_type_id | string |  required  | The type id of the account.
    currency_id | string |  required  | The id of the default currency.
    business_id | string |  required  | The id of the business.

<!-- END_ecb97bf722bf165bb312afaa17ef20f3 -->

<!-- START_474fa17c9798bf9a34c3b20115c484c3 -->
## Update Account

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Update the information of an account

> Example request:

```bash
curl -X PUT "https://bafa436a.ngrok.io/api/v1/accounts/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"name":"sed","bank_account_number":"accusamus","mobile_money_wallet":"et","account_type_id":"dolorem","currency_id":"et","business_id":"illo"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/accounts/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "name": "sed",
    "bank_account_number": "accusamus",
    "mobile_money_wallet": "et",
    "account_type_id": "dolorem",
    "currency_id": "et",
    "business_id": "illo"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("https://bafa436a.ngrok.io/api/v1/accounts/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "name" => "sed",
            "bank_account_number" => "accusamus",
            "mobile_money_wallet" => "et",
            "account_type_id" => "dolorem",
            "currency_id" => "et",
            "business_id" => "illo",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/accounts/1'
payload = {
    'name': 'sed',
    'bank_account_number': 'accusamus',
    'mobile_money_wallet': 'et',
    'account_type_id': 'dolorem',
    'currency_id': 'et',
    'business_id': 'illo'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('PUT', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "Could not update account.",
    "errors": {
        "name": [
            "The name may not be greater than 255 characters."
        ]
    }
}
```
> Example response (200):

```json
{
    "status_code": 200,
    "message": "Account updated successfully"
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Account not found"
}
```

### HTTP Request
`PUT /api/v1/accounts/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  optional  | The name of the account.
    bank_account_number | string |  optional  | The bank account number of the account.
    mobile_money_wallet | string |  optional  | The MTN Mobile Money wallet number of the account.
    account_type_id | string |  optional  | The type id of the account.
    currency_id | string |  optional  | The id of the default currency.
    business_id | string |  optional  | The id of the business.

<!-- END_474fa17c9798bf9a34c3b20115c484c3 -->

<!-- START_ad770a5280524cdb344812001110b1ee -->
## View  Account

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of an account

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/accounts/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/accounts/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/accounts/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/accounts/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Account not found"
}
```

### HTTP Request
`GET /api/v1/accounts/{id}`


<!-- END_ad770a5280524cdb344812001110b1ee -->

<!-- START_bd02191801ce901529ead0a2741a0c75 -->
## Delete Account

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE "https://bafa436a.ngrok.io/api/v1/accounts/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/accounts/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("https://bafa436a.ngrok.io/api/v1/accounts/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/accounts/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "status_code": 200,
    "message": "Account deleted successfully"
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Account not found"
}
```

### HTTP Request
`DELETE /api/v1/accounts/{id}`


<!-- END_bd02191801ce901529ead0a2741a0c75 -->

#Account Types


APIs for managing account types
<!-- START_e3c4978dc9b86e790d623826339356c5 -->
## All Account Types

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all account Types

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/account-types" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/account-types");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/account-types", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/account-types'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "data": [
        {
            "name": "Expenses",
            "code": 1,
            "id": "9b6RVVPyNb"
        },
        {
            "name": "Revenues",
            "code": 2,
            "id": "DbDMZwBAdl"
        }
    ]
}
```

### HTTP Request
`GET /api/v1/account-types`


<!-- END_e3c4978dc9b86e790d623826339356c5 -->

#Adverts


APIs for managing adverts
<!-- START_9b3056c7aa14e051e35c0cb4f938bd58 -->
## View Advert

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of an advert

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/adverts/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/adverts/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/adverts/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/adverts/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Advert not found"
}
```
> Example response (200):

```json
{
    "data": {
        "id": null,
        "title": null,
        "feature_image": null,
        "status": null,
        "author": null
    }
}
```

### HTTP Request
`GET /api/v1/adverts/{id}`


<!-- END_9b3056c7aa14e051e35c0cb4f938bd58 -->

<!-- START_4f58399ca6105986e9390f5596995daf -->
## All Adverts

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all adverts.

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/adverts/all" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/adverts/all");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/adverts/all", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/adverts/all'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "data": {
        "id": null,
        "title": null,
        "feature_image": null,
        "status": null,
        "author": null
    }
}
```

### HTTP Request
`GET /api/v1/adverts/all`


<!-- END_4f58399ca6105986e9390f5596995daf -->

#Businesses


APIs for managing businesses
<!-- START_349963107bf62b82d71e98244ef25392 -->
## Create a business

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/businesses/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"name":"consectetur","type":"perspiciatis","location":"iusto","owner_id":"voluptatem","logo":"laudantium","reg_no":"sit","tax_no":"minima","vat_no":"dicta","currency":"voluptatibus"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/businesses/create");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "name": "consectetur",
    "type": "perspiciatis",
    "location": "iusto",
    "owner_id": "voluptatem",
    "logo": "laudantium",
    "reg_no": "sit",
    "tax_no": "minima",
    "vat_no": "dicta",
    "currency": "voluptatibus"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/businesses/create", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "name" => "consectetur",
            "type" => "perspiciatis",
            "location" => "iusto",
            "owner_id" => "voluptatem",
            "logo" => "laudantium",
            "reg_no" => "sit",
            "tax_no" => "minima",
            "vat_no" => "dicta",
            "currency" => "voluptatibus",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/businesses/create'
payload = {
    'name': 'consectetur',
    'type': 'perspiciatis',
    'location': 'iusto',
    'owner_id': 'voluptatem',
    'logo': 'laudantium',
    'reg_no': 'sit',
    'tax_no': 'minima',
    'vat_no': 'dicta',
    'currency': 'voluptatibus'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (404):

```json
{
    "status_code": 422,
    "message": "The name has already been taken.",
    "errors": {
        "name": [
            "The name has already been taken."
        ]
    }
}
```
> Example response (200):

```json
{
    "data": {
        "id": null,
        "name": "Crist-Lehner",
        "nature": "company",
        "location": "8444 Welch Ferry Apt. 767\nDickinsonshire, AZ 27308",
        "owner": "Liana Murazik",
        "currency": {
            "code": "GHS",
            "sign": "¢",
            "name": "Ghana Cedi",
            "id": "Dwo0RZkPH5DD4mpD"
        },
        "reg_no": "e817531a17",
        "tax_no": "7b5e198529",
        "vat_no": "58772925ab",
        "logo": "https:\/\/lorempixel.com\/640\/480\/?93789"
    }
}
```

### HTTP Request
`POST /api/v1/businesses/create`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | The name of the business.
    type | string |  required  | The nature of the business.
    location | string |  required  | The location of the business.
    owner_id | string |  required  | The id of the user creating the business.
    logo | file |  optional  | Logo of the business
    reg_no | string |  optional  | The registration number of the business
    tax_no | string |  optional  | The tax identification number of the business
    vat_no | string |  optional  | The vat number of the business
    currency | string |  optional  | The the default currency for all transactions

<!-- END_349963107bf62b82d71e98244ef25392 -->

<!-- START_b160537e85643cd26e8b40eb05fa7588 -->
## Update a business

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Update the information of a business

> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/businesses/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"name":"explicabo","type":"assumenda","location":"molestiae","logo":"possimus","reg_no":"doloribus","tax_no":"ut","vat_no":"ut","currency":"quaerat"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/businesses/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "name": "explicabo",
    "type": "assumenda",
    "location": "molestiae",
    "logo": "possimus",
    "reg_no": "doloribus",
    "tax_no": "ut",
    "vat_no": "ut",
    "currency": "quaerat"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/businesses/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "name" => "explicabo",
            "type" => "assumenda",
            "location" => "molestiae",
            "logo" => "possimus",
            "reg_no" => "doloribus",
            "tax_no" => "ut",
            "vat_no" => "ut",
            "currency" => "quaerat",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/businesses/1'
payload = {
    'name': 'explicabo',
    'type': 'assumenda',
    'location': 'molestiae',
    'logo': 'possimus',
    'reg_no': 'doloribus',
    'tax_no': 'ut',
    'vat_no': 'ut',
    'currency': 'quaerat'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "The name may not be greater than 255 characters.",
    "errors": {
        "name": [
            "The name may not be greater than 255 characters."
        ]
    }
}
```
> Example response (200):

```json
{
    "status_code": 200,
    "message": "Business updated successfully"
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```

### HTTP Request
`POST /api/v1/businesses/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  optional  | The email of the user.
    type | string |  optional  | The nature of the business.
    location | string |  optional  | The location of the business.
    logo | file |  optional  | Logo of the business
    reg_no | string |  optional  | The registration number of the business
    tax_no | string |  optional  | The tax identification number of the business
    vat_no | string |  optional  | The vat number of the business
    currency | string |  optional  | This is the default currency for all transactions

<!-- END_b160537e85643cd26e8b40eb05fa7588 -->

<!-- START_e463b6a71082a4ffa3a0f73f3b68ea1e -->
## View a business

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of the business
All business will be returned if no id is et

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/businesses?id=Wpmbk5ezJn" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/businesses");

    let params = {
            "id": "Wpmbk5ezJn",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/businesses", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'query' => [
            "id" => "Wpmbk5ezJn",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/businesses'
params = {
	'id': 'Wpmbk5ezJn'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers, params=params)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```
> Example response (200):

```json
{
    "data": [
        {
            "id": null,
            "name": "Upton, Barrows and Fritsch",
            "nature": "company",
            "location": "929 Caleigh Shoals\nRoweberg, OR 94183",
            "owner": "Nestor Dach",
            "currency": {
                "code": "GHS",
                "sign": "¢",
                "name": "Ghana Cedi",
                "id": "Dwo0RZkPH5DD4mpD"
            },
            "reg_no": "9918772b55",
            "tax_no": "8391b58397",
            "vat_no": "1f582a17b5",
            "logo": "https:\/\/lorempixel.com\/640\/480\/?23547"
        },
        {
            "id": null,
            "name": "Upton, Barrows and Fritsch",
            "nature": "company",
            "location": "929 Caleigh Shoals\nRoweberg, OR 94183",
            "owner": "Nestor Dach",
            "currency": {
                "code": "GHS",
                "sign": "¢",
                "name": "Ghana Cedi",
                "id": "Dwo0RZkPH5DD4mpD"
            },
            "reg_no": "9918772b55",
            "tax_no": "8391b58397",
            "vat_no": "1f582a17b5",
            "logo": "https:\/\/lorempixel.com\/640\/480\/?23547"
        }
    ]
}
```

### HTTP Request
`GET /api/v1/businesses`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | The id of the business.

<!-- END_e463b6a71082a4ffa3a0f73f3b68ea1e -->

<!-- START_4ba2bcfbf4666972526dfc8b3f2a9068 -->
## Delete a business

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE "https://bafa436a.ngrok.io/api/v1/businesses/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/businesses/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("https://bafa436a.ngrok.io/api/v1/businesses/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/businesses/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "status_code": 200,
    "message": "Business deleted successfully"
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```

### HTTP Request
`DELETE /api/v1/businesses/{id}`


<!-- END_4ba2bcfbf4666972526dfc8b3f2a9068 -->

#Currency


APIs for managing currencies
<!-- START_3aedc2901d3078d880b2269a330f1159 -->
## All currencies

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all currencies

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/currencies" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/currencies");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/currencies", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/currencies'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "data": {
        "id": null,
        "name": "Ghana Cedi",
        "sign": "¢",
        "code": "GHC"
    }
}
```

### HTTP Request
`GET /api/v1/currencies`


<!-- END_3aedc2901d3078d880b2269a330f1159 -->

#Customer


APIs for managing customers
<!-- START_09cceca568c04891f406a915e32c1237 -->
## Create Customer

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/customers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"first_name":"nobis","last_name":"voluptas","email":"ab","phone_number":"praesentium","location":"accusantium","business_id":"id"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/customers");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "first_name": "nobis",
    "last_name": "voluptas",
    "email": "ab",
    "phone_number": "praesentium",
    "location": "accusantium",
    "business_id": "id"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/customers", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "first_name" => "nobis",
            "last_name" => "voluptas",
            "email" => "ab",
            "phone_number" => "praesentium",
            "location" => "accusantium",
            "business_id" => "id",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/customers'
payload = {
    'first_name': 'nobis',
    'last_name': 'voluptas',
    'email': 'ab',
    'phone_number': 'praesentium',
    'location': 'accusantium',
    'business_id': 'id'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "The selected business id is invalid.",
    "errors": {
        "business_id": [
            "The selected business id is invalid."
        ]
    }
}
```

### HTTP Request
`POST /api/v1/customers`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    first_name | string |  required  | The first name of the customer.
    last_name | string |  required  | The last name of the customer.
    email | string |  optional  | The email of the customer.
    phone_number | string |  optional  | The phone number of the customer.
    location | string |  optional  | The location of the customer.
    business_id | string |  required  | The id of the business.

<!-- END_09cceca568c04891f406a915e32c1237 -->

<!-- START_7a92243f3e09a66a3c104e07c74a5d8b -->
## View Customer

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of a customer

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/customers/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/customers/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/customers/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/customers/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Customer not found"
}
```

### HTTP Request
`GET /api/v1/customers/{id}`


<!-- END_7a92243f3e09a66a3c104e07c74a5d8b -->

<!-- START_5a780e93f24edbf7e140e1d70d341b9f -->
## All Customers

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all customers of a business

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/customers/all/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/customers/all/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/customers/all/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/customers/all/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```

### HTTP Request
`GET /api/v1/customers/all/{business_id}`


<!-- END_5a780e93f24edbf7e140e1d70d341b9f -->

<!-- START_160d7c461867a6a61aed3ba7e0410090 -->
## Update Customer

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Update the information of a customer

> Example request:

```bash
curl -X PUT "https://bafa436a.ngrok.io/api/v1/customers/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"first_name":"corporis","last_name":"et","email":"exercitationem","phone_number":"eveniet","location":"enim"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/customers/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "first_name": "corporis",
    "last_name": "et",
    "email": "exercitationem",
    "phone_number": "eveniet",
    "location": "enim"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("https://bafa436a.ngrok.io/api/v1/customers/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "first_name" => "corporis",
            "last_name" => "et",
            "email" => "exercitationem",
            "phone_number" => "eveniet",
            "location" => "enim",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/customers/1'
payload = {
    'first_name': 'corporis',
    'last_name': 'et',
    'email': 'exercitationem',
    'phone_number': 'eveniet',
    'location': 'enim'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('PUT', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "The email must be a valid email address.",
    "errors": {
        "email": [
            "The email must be a valid email address."
        ]
    }
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Customer not found"
}
```

### HTTP Request
`PUT /api/v1/customers/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    first_name | string |  optional  | The first name of the customer.
    last_name | string |  optional  | The last name of the customer.
    email | string |  optional  | The email of the customer.
    phone_number | string |  optional  | The phone number of the customer.
    location | string |  optional  | The location of the customer.

<!-- END_160d7c461867a6a61aed3ba7e0410090 -->

<!-- START_1fb43efb00fa87df3426f22079f34031 -->
## Delete Customer

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE "https://bafa436a.ngrok.io/api/v1/customers/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/customers/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("https://bafa436a.ngrok.io/api/v1/customers/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/customers/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "status_code": 200,
    "message": "Customer deleted successfully"
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Customer not found"
}
```

### HTTP Request
`DELETE /api/v1/customers/{id}`


<!-- END_1fb43efb00fa87df3426f22079f34031 -->

<!-- START_dd2bef63b557e3edb5209bbfc9b56637 -->
## Total Customer

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the total number of customers of a business

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/customers/1/reports/total-customers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/customers/1/reports/total-customers");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/customers/1/reports/total-customers", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/customers/1/reports/total-customers'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```

### HTTP Request
`GET /api/v1/customers/{business_id}/reports/total-customers`


<!-- END_dd2bef63b557e3edb5209bbfc9b56637 -->

#Employee


APIs for managing employees
<!-- START_f63fe911363e906bd6e34d4d784d7352 -->
## Create Employee

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/employees" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"email":"omnis","first_name":"doloremque","last_name":"aliquam","phone_number":"atque","country":"atque","role":"sunt","business_id":"sunt"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/employees");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "email": "omnis",
    "first_name": "doloremque",
    "last_name": "aliquam",
    "phone_number": "atque",
    "country": "atque",
    "role": "sunt",
    "business_id": "sunt"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/employees", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "email" => "omnis",
            "first_name" => "doloremque",
            "last_name" => "aliquam",
            "phone_number" => "atque",
            "country" => "atque",
            "role" => "sunt",
            "business_id" => "sunt",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/employees'
payload = {
    'email': 'omnis',
    'first_name': 'doloremque',
    'last_name': 'aliquam',
    'phone_number': 'atque',
    'country': 'atque',
    'role': 'sunt',
    'business_id': 'sunt'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "The selected business id is invalid.",
    "errors": {
        "business_id": [
            "The selected business id is invalid."
        ]
    }
}
```
> Example response (200):

```json
{
    "data": {
        "id": "LGVLM1GCVj3wZK0",
        "last_name": "Araceli Conroy",
        "first_name": "Adele Schuppe",
        "country": null,
        "phone_number": "(474) 236-9127 x9313",
        "email": "user13862@gmail.com",
        "type": "employee",
        "mobile_money_number": null,
        "user_id": "7LX7LR9RizVZVXom",
        "role": "Attendant",
        "business": "Schamberger, Mante and Lind"
    }
}
```

### HTTP Request
`POST /api/v1/employees`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | 
    first_name | string |  required  | 
    last_name | string |  required  | 
    phone_number | string |  required  | 
    country | string |  optional  | optional
    role | string |  optional  | optional The role of the employee. Default to 'Attendant' if not set.
    business_id | string |  required  | The id of the business.

<!-- END_f63fe911363e906bd6e34d4d784d7352 -->

<!-- START_df8fa719fcf4f9ee388c12609ad4540e -->
## View Employee

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of an employee

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/employees/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/employees/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/employees/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/employees/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Employee not found"
}
```
> Example response (200):

```json
{
    "data": {
        "id": "LGVLM1GCVj3wZK0",
        "last_name": "Araceli Conroy",
        "first_name": "Adele Schuppe",
        "country": null,
        "phone_number": "(474) 236-9127 x9313",
        "email": "user13862@gmail.com",
        "type": "employee",
        "mobile_money_number": null,
        "user_id": "7LX7LR9RizVZVXom",
        "role": "Attendant",
        "business": "Schamberger, Mante and Lind"
    }
}
```

### HTTP Request
`GET /api/v1/employees/{id}`


<!-- END_df8fa719fcf4f9ee388c12609ad4540e -->

<!-- START_ebe84d42f071f24b94c13b5944b04948 -->
## All Employees

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all employees of a business

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/employees/all/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/employees/all/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/employees/all/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/employees/all/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```
> Example response (200):

```json
{
    "data": {
        "id": "LGVLM1GCVj3wZK0",
        "last_name": "Araceli Conroy",
        "first_name": "Adele Schuppe",
        "country": null,
        "phone_number": "(474) 236-9127 x9313",
        "email": "user13862@gmail.com",
        "type": "employee",
        "mobile_money_number": null,
        "user_id": "7LX7LR9RizVZVXom",
        "role": "Attendant",
        "business": "Schamberger, Mante and Lind"
    }
}
```

### HTTP Request
`GET /api/v1/employees/all/{business_id}`


<!-- END_ebe84d42f071f24b94c13b5944b04948 -->

<!-- START_e62245ac403404e16cca7737f7dcb36e -->
## Update Employee

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Update the information of an employee.
Since an employee is a normal user, all the other information (first_name, last_name, email, etc)
can be updated using the users api.
This api is for changing only role and the business of the employee.

> Example request:

```bash
curl -X PUT "https://bafa436a.ngrok.io/api/v1/employees/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/employees/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("https://bafa436a.ngrok.io/api/v1/employees/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/employees/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('PUT', url, headers=headers)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "The selected business id is invalid.",
    "errors": {
        "business_id": [
            "The selected business id is invalid."
        ]
    }
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Customer not found"
}
```
> Example response (200):

```json
{
    "data": {
        "id": "LGVLM1GCVj3wZK0",
        "last_name": "Araceli Conroy",
        "first_name": "Adele Schuppe",
        "country": null,
        "phone_number": "(474) 236-9127 x9313",
        "email": "user13862@gmail.com",
        "type": "employee",
        "mobile_money_number": null,
        "user_id": "7LX7LR9RizVZVXom",
        "role": "Attendant",
        "business": "Schamberger, Mante and Lind"
    }
}
```

### HTTP Request
`PUT /api/v1/employees/{id}`


<!-- END_e62245ac403404e16cca7737f7dcb36e -->

<!-- START_7380c11cbb45ddc97652cae2acfa39d1 -->
## Delete Employee

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE "https://bafa436a.ngrok.io/api/v1/employees/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/employees/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("https://bafa436a.ngrok.io/api/v1/employees/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/employees/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "status_code": 200,
    "message": "Employee deleted successfully"
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Employee not found"
}
```

### HTTP Request
`DELETE /api/v1/employees/{id}`


<!-- END_7380c11cbb45ddc97652cae2acfa39d1 -->

#Expense


APIs for managing paid expenses
<!-- START_b2eb54f62d1991da7914fc24edcd9ba4 -->
## Create Paid Expense

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/expenses/paid" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"description":"quibusdam","date":"libero","category":"debitis","amount_paid":2.5,"business_id":"vitae"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/expenses/paid");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "description": "quibusdam",
    "date": "libero",
    "category": "debitis",
    "amount_paid": 2.5,
    "business_id": "vitae"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/expenses/paid", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "description" => "quibusdam",
            "date" => "libero",
            "category" => "debitis",
            "amount_paid" => "2.5",
            "business_id" => "vitae",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/expenses/paid'
payload = {
    'description': 'quibusdam',
    'date': 'libero',
    'category': 'debitis',
    'amount_paid': '2.5',
    'business_id': 'vitae'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "The type field is required.",
    "errors": {
        "type": [
            "The type field is required."
        ]
    }
}
```
> Example response (200):

```json
{
    "data": {
        "id": "PDpwMqxc425Ev4G",
        "due_date": null,
        "type": "paid",
        "payment_date": "2020-02-29",
        "description": "Sit repellat dolorem ratione.",
        "category": "Space & Equipment or Assets",
        "total_amount": 555,
        "amount_paid": 555,
        "amount_owed": null,
        "amount_remaining": null,
        "vendor_id": null,
        "business_id": "99kz5WlPuAxGDkWm",
        "created_at": "2020-02-23"
    }
}
```

### HTTP Request
`POST /api/v1/expenses/paid`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    description | string |  optional  | The description of the expense.
    date | string |  optional  | The date of the expense.
    category | string |  optional  | The category of the expense.
    amount_paid | float |  optional  | The total amount of the expense.
    business_id | string |  required  | The id of the business.

<!-- END_b2eb54f62d1991da7914fc24edcd9ba4 -->

<!-- START_c6ae72b72c9e31ed2bf7c7e197b83d0e -->
## Create Partial Expense

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/expenses/partial" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"due_date":"consequuntur","category":"possimus","total_amount":311.88064000000002806700649671256542205810546875,"amount_paid":199631360.4387714564800262451171875,"amount_remaining":230389.6052999999956227838993072509765625,"vendor_id":"nobis","business_id":"iure"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/expenses/partial");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "due_date": "consequuntur",
    "category": "possimus",
    "total_amount": 311.88064000000002806700649671256542205810546875,
    "amount_paid": 199631360.4387714564800262451171875,
    "amount_remaining": 230389.6052999999956227838993072509765625,
    "vendor_id": "nobis",
    "business_id": "iure"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/expenses/partial", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "due_date" => "consequuntur",
            "category" => "possimus",
            "total_amount" => "311.88064",
            "amount_paid" => "199631360.43877",
            "amount_remaining" => "230389.6053",
            "vendor_id" => "nobis",
            "business_id" => "iure",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/expenses/partial'
payload = {
    'due_date': 'consequuntur',
    'category': 'possimus',
    'total_amount': '311.88064',
    'amount_paid': '199631360.43877',
    'amount_remaining': '230389.6053',
    'vendor_id': 'nobis',
    'business_id': 'iure'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "The type field is required.",
    "errors": {
        "type": [
            "The type field is required."
        ]
    }
}
```
> Example response (200):

```json
{
    "data": {
        "id": "PDpwMqxc425Ev4G",
        "due_date": null,
        "type": "paid",
        "payment_date": "2020-02-29",
        "description": "Sit repellat dolorem ratione.",
        "category": "Space & Equipment or Assets",
        "total_amount": 555,
        "amount_paid": 555,
        "amount_owed": null,
        "amount_remaining": null,
        "vendor_id": null,
        "business_id": "99kz5WlPuAxGDkWm",
        "created_at": "2020-02-23"
    }
}
```

### HTTP Request
`POST /api/v1/expenses/partial`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    due_date | string |  optional  | The due date of the expense.
    category | string |  optional  | The category of the expense.
    total_amount | float |  optional  | The total amount of the expense.
    amount_paid | float |  optional  | The amount paid for the expense.
    amount_remaining | float |  optional  | The amount remaining for the expense.
    vendor_id | string |  optional  | The id of the vendor.
    business_id | string |  required  | The id of the business.

<!-- END_c6ae72b72c9e31ed2bf7c7e197b83d0e -->

<!-- START_e3b0a75f41e659b96ebeccd64b82a300 -->
## Create Owing Expense

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/expenses/owing" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"due_date":"dolores","category":"eum","amount_owed":3459875.22618369944393634796142578125,"vendor_id":"tenetur","business_id":"nemo"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/expenses/owing");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "due_date": "dolores",
    "category": "eum",
    "amount_owed": 3459875.22618369944393634796142578125,
    "vendor_id": "tenetur",
    "business_id": "nemo"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/expenses/owing", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "due_date" => "dolores",
            "category" => "eum",
            "amount_owed" => "3459875.2261837",
            "vendor_id" => "tenetur",
            "business_id" => "nemo",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/expenses/owing'
payload = {
    'due_date': 'dolores',
    'category': 'eum',
    'amount_owed': '3459875.2261837',
    'vendor_id': 'tenetur',
    'business_id': 'nemo'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "The type field is required.",
    "errors": {
        "type": [
            "The type field is required."
        ]
    }
}
```
> Example response (200):

```json
{
    "data": {
        "id": "PDpwMqxc425Ev4G",
        "due_date": null,
        "type": "paid",
        "payment_date": "2020-02-29",
        "description": "Sit repellat dolorem ratione.",
        "category": "Space & Equipment or Assets",
        "total_amount": 555,
        "amount_paid": 555,
        "amount_owed": null,
        "amount_remaining": null,
        "vendor_id": null,
        "business_id": "99kz5WlPuAxGDkWm",
        "created_at": "2020-02-23"
    }
}
```

### HTTP Request
`POST /api/v1/expenses/owing`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    due_date | string |  optional  | The due date of the expense.
    category | string |  optional  | The category of the expense.
    amount_owed | float |  optional  | The amount owing for the expense.
    vendor_id | string |  optional  | The id of the vendor.
    business_id | string |  required  | The id of the business.

<!-- END_e3b0a75f41e659b96ebeccd64b82a300 -->

<!-- START_3383e1377946b35f302384a48114da94 -->
## View Expense

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of an expense

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/expenses/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/expenses/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/expenses/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/expenses/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Expense not found"
}
```
> Example response (200):

```json
{
    "data": {
        "id": "PDpwMqxc425Ev4G",
        "due_date": null,
        "type": "paid",
        "payment_date": "2020-02-29",
        "description": "Sit repellat dolorem ratione.",
        "category": "Space & Equipment or Assets",
        "total_amount": 555,
        "amount_paid": 555,
        "amount_owed": null,
        "amount_remaining": null,
        "vendor_id": null,
        "business_id": "99kz5WlPuAxGDkWm",
        "created_at": "2020-02-23"
    }
}
```

### HTTP Request
`GET /api/v1/expenses/{id}`


<!-- END_3383e1377946b35f302384a48114da94 -->

<!-- START_399ebd492d2951fa2b8cc553fa81af35 -->
## Expenses Categories

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all categories of expenses

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/expenses/categories/all" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/expenses/categories/all");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/expenses/categories/all", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/expenses/categories/all'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```
> Example response (200):

```json
{
    "data": [
        {
            "id": "83MmEAQ8c4WX9En",
            "name": "Operational Services"
        },
        {
            "id": "83MmEAQ8c4WX9En",
            "name": "Operational Services"
        }
    ]
}
```

### HTTP Request
`GET /api/v1/expenses/categories/all`


<!-- END_399ebd492d2951fa2b8cc553fa81af35 -->

<!-- START_9b2b6ecb1466145efe4e731293e90a22 -->
## All Expenses

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all expenses of a business

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/expenses/all/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/expenses/all/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/expenses/all/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/expenses/all/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```
> Example response (200):

```json
{
    "data": [
        {
            "id": "PDpwMqxc425Ev4G",
            "due_date": null,
            "type": "paid",
            "payment_date": "2020-02-29",
            "description": "Sit repellat dolorem ratione.",
            "category": "Space & Equipment or Assets",
            "total_amount": 555,
            "amount_paid": 555,
            "amount_owed": null,
            "amount_remaining": null,
            "vendor_id": null,
            "business_id": "99kz5WlPuAxGDkWm",
            "created_at": "2020-02-23"
        },
        {
            "id": "PDpwMqxc425Ev4G",
            "due_date": null,
            "type": "paid",
            "payment_date": "2020-02-29",
            "description": "Sit repellat dolorem ratione.",
            "category": "Space & Equipment or Assets",
            "total_amount": 555,
            "amount_paid": 555,
            "amount_owed": null,
            "amount_remaining": null,
            "vendor_id": null,
            "business_id": "99kz5WlPuAxGDkWm",
            "created_at": "2020-02-23"
        }
    ]
}
```

### HTTP Request
`GET /api/v1/expenses/all/{business_id}`


<!-- END_9b2b6ecb1466145efe4e731293e90a22 -->

<!-- START_8b47e9d2f4bde90afe1e472c12a90425 -->
## Update Expense

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Update the information of an expense

> Example request:

```bash
curl -X PUT "https://bafa436a.ngrok.io/api/v1/expenses/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"type":"sit","description":"aliquam","date":"quia","due_date":"iusto","category":"aut","total_amount":4.95743422299999991764707374386489391326904296875,"amount_paid":208650173.6879999935626983642578125,"amount_remaining":0.7677340200000000169922032000613398849964141845703125,"amount_owed":4698.787072400000397465191781520843505859375,"vendor_id":"quia","business_id":"qui"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/expenses/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "type": "sit",
    "description": "aliquam",
    "date": "quia",
    "due_date": "iusto",
    "category": "aut",
    "total_amount": 4.95743422299999991764707374386489391326904296875,
    "amount_paid": 208650173.6879999935626983642578125,
    "amount_remaining": 0.7677340200000000169922032000613398849964141845703125,
    "amount_owed": 4698.787072400000397465191781520843505859375,
    "vendor_id": "quia",
    "business_id": "qui"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("https://bafa436a.ngrok.io/api/v1/expenses/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "type" => "sit",
            "description" => "aliquam",
            "date" => "quia",
            "due_date" => "iusto",
            "category" => "aut",
            "total_amount" => "4.957434223",
            "amount_paid" => "208650173.688",
            "amount_remaining" => "0.76773402",
            "amount_owed" => "4698.7870724",
            "vendor_id" => "quia",
            "business_id" => "qui",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/expenses/1'
payload = {
    'type': 'sit',
    'description': 'aliquam',
    'date': 'quia',
    'due_date': 'iusto',
    'category': 'aut',
    'total_amount': '4.957434223',
    'amount_paid': '208650173.688',
    'amount_remaining': '0.76773402',
    'amount_owed': '4698.7870724',
    'vendor_id': 'quia',
    'business_id': 'qui'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('PUT', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "The type field is required.",
    "errors": {
        "type": [
            "The type field is required."
        ]
    }
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Expense not found"
}
```

### HTTP Request
`PUT /api/v1/expenses/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    type | string |  required  | The type of the expense. Accepted values are: paid, partial or owing.
    description | string |  optional  | The description of the expense. Normally for paid expenses.
    date | string |  optional  | The date of the expense. Normally for paid expenses.
    due_date | string |  optional  | The due date of the expense. Normally for partial and owing expenses.
    category | string |  optional  | The category of the expense.
    total_amount | float |  optional  | The total amount of the expense. Required if the expense is partial or paid
    amount_paid | float |  optional  | The amount paid for the expense. Required if the expense is partial
    amount_remaining | float |  optional  | The amount remaining for the expense. Required if the expense is partial
    amount_owed | float |  optional  | The amount remaining for the expense. Required if the expense is owing
    vendor_id | string |  optional  | The id of the vendor. Required if the expense is partial or owing.
    business_id | string |  required  | The id of the business.

<!-- END_8b47e9d2f4bde90afe1e472c12a90425 -->

<!-- START_aa407457c30803fc7c895e9c5bbd7a43 -->
## Delete Expense

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE "https://bafa436a.ngrok.io/api/v1/expenses/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/expenses/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("https://bafa436a.ngrok.io/api/v1/expenses/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/expenses/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "status_code": 200,
    "message": "Expense deleted successfully"
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Expense not found"
}
```

### HTTP Request
`DELETE /api/v1/expenses/{id}`


<!-- END_aa407457c30803fc7c895e9c5bbd7a43 -->

<!-- START_5cf86b981284ed70e66715d987735421 -->
## Summary

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the summary report of all expenses

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/expenses/1/reports/summary" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/expenses/1/reports/summary");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/expenses/1/reports/summary", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/expenses/1/reports/summary'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```

### HTTP Request
`GET /api/v1/expenses/{business_id}/reports/summary`


<!-- END_5cf86b981284ed70e66715d987735421 -->

#Inventory


APIs for managing inventory
<!-- START_52e2a2f377f87fb8ac7c757b67030e8f -->
## All Products &amp; Services

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all products & services belonging to a business

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/inventories/all/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/inventories/all/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/inventories/all/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/inventories/all/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "data": {
        "products": [
            {
                "id_hash": "vj1jDwyOf2jMnBDx",
                "name": "Odit tempore adipisci enim occaecateum.",
                "amount": 4343,
                "business_id": 15,
                "category_id": null
            }
        ],
        "services": [
            {
                "id_hash": "vj1jDwyOf2jMnBDx",
                "name": "Odit tempore adipisci enim occaecateum.",
                "amount": 4343,
                "business_id": 15
            }
        ]
    }
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```

### HTTP Request
`GET /api/v1/inventories/all/{business_id}`


<!-- END_52e2a2f377f87fb8ac7c757b67030e8f -->

#Inventory - Category


APIs for managing inventory categories
<!-- START_a6218b7e643a11d7f8f4f45c5632e669 -->
## All Categories

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all categories

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/inventories/categories" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/inventories/categories");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/inventories/categories", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/inventories/categories'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "data": {
        "id": "VA5MkwOqimr0mZEl",
        "name": "Product"
    }
}
```

### HTTP Request
`GET /api/v1/inventories/categories`


<!-- END_a6218b7e643a11d7f8f4f45c5632e669 -->

<!-- START_4ea9cde99e595f344f6e30b3bcc0fad3 -->
## View Category

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of a category

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/inventories/categories/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/inventories/categories/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/inventories/categories/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/inventories/categories/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Category not found"
}
```
> Example response (200):

```json
{
    "data": {
        "id": "VA5MkwOqimr0mZEl",
        "name": "Product"
    }
}
```

### HTTP Request
`GET /api/v1/inventories/categories/{id}`


<!-- END_4ea9cde99e595f344f6e30b3bcc0fad3 -->

#Inventory - Products


APIs for managing inventory products
<!-- START_b19ba89c322a883ec49e9a73017abd94 -->
## Create Product

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/inventories/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"name":"explicabo","cost_price":21394408.60999999940395355224609375,"selling_price":3165.1356999999998151906765997409820556640625,"stock_threshold":303.67144999999999299689079634845256805419921875,"can_expire":"soluta","location":"eum","category":"Product","business_id":"at"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/inventories/products");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "name": "explicabo",
    "cost_price": 21394408.60999999940395355224609375,
    "selling_price": 3165.1356999999998151906765997409820556640625,
    "stock_threshold": 303.67144999999999299689079634845256805419921875,
    "can_expire": "soluta",
    "location": "eum",
    "category": "Product",
    "business_id": "at"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/inventories/products", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "name" => "explicabo",
            "cost_price" => "21394408.61",
            "selling_price" => "3165.1357",
            "stock_threshold" => "303.67145",
            "can_expire" => "soluta",
            "location" => "eum",
            "category" => "Product",
            "business_id" => "at",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/inventories/products'
payload = {
    'name': 'explicabo',
    'cost_price': '21394408.61',
    'selling_price': '3165.1357',
    'stock_threshold': '303.67145',
    'can_expire': 'soluta',
    'location': 'eum',
    'category': 'Product',
    'business_id': 'at'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "The selected business id is invalid.",
    "errors": {
        "business_id": [
            "The selected business id is invalid."
        ]
    }
}
```
> Example response (200):

```json
{
    "data": {
        "id": null,
        "name": "Qui et enim sit expedita odio dignissimos explicabo commodi quas voluptas est alias ab.",
        "location": "2503 Upton Wall Suite 097\nPort Imogene, AR 86262-7361",
        "quantity": 593252,
        "category": "Product",
        "stock_threshold": 11,
        "cost_price": 401968,
        "selling_price": 985787,
        "can_expire": null
    }
}
```

### HTTP Request
`POST /api/v1/inventories/products`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | The name of the product.
    cost_price | float |  optional  | The price at which the product was bought or produced.
    selling_price | float |  optional  | The price at which the product is sold.
    stock_threshold | float |  optional  | The minimum quantity at which reorder is placed.
    can_expire | string |  optional  | Whether the product expires or not.
    location | string |  optional  | The location of the product.
    category | string |  required  | The name of the inventory category.
    business_id | string |  required  | The id of the business.

<!-- END_b19ba89c322a883ec49e9a73017abd94 -->

<!-- START_e2ed9958a1cc9fdabbcb3ad77354bce8 -->
## View Product

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of a product

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/inventories/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/inventories/products/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/inventories/products/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/inventories/products/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Product not found"
}
```
> Example response (200):

```json
{
    "data": {
        "id": null,
        "name": "Ut odit beatae odio ea rerum cum qui quas vel voluptatem in voluptatem quod.",
        "location": "15967 Major Station\nLake Irwinchester, UT 20614",
        "quantity": 124693,
        "category": "Product",
        "stock_threshold": 88,
        "cost_price": 284330,
        "selling_price": 959186,
        "can_expire": null
    }
}
```

### HTTP Request
`GET /api/v1/inventories/products/{id}`


<!-- END_e2ed9958a1cc9fdabbcb3ad77354bce8 -->

<!-- START_05665e4b4e15cb423088511793b03fc3 -->
## All Products

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all products belonging to a business

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/inventories/1/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/inventories/1/products");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/inventories/1/products", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/inventories/1/products'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```
> Example response (200):

```json
{
    "data": {
        "id": null,
        "name": "Alias quae quasi voluptas consectetur et voluptatem eos rerum quia.",
        "location": "442 Rosamond Valleys\nPort Eldora, PA 68108-0088",
        "quantity": 747500,
        "category": "Product",
        "stock_threshold": 186,
        "cost_price": 712137,
        "selling_price": 742561,
        "can_expire": null
    }
}
```

### HTTP Request
`GET /api/v1/inventories/{business_id}/products`


<!-- END_05665e4b4e15cb423088511793b03fc3 -->

<!-- START_6ff658503cd18fbdbcfaa62ed5c42c46 -->
## Update Product

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Update the information of an product

> Example request:

```bash
curl -X PUT "https://bafa436a.ngrok.io/api/v1/inventories/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"name":"et","cost_price":690.5034346099999993384699337184429168701171875,"selling_price":258588356,"stock_threshold":58346628.179811097681522369384765625,"can_expire":"repudiandae","location":"enim","category":"Product","business_id":"ut"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/inventories/products/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "name": "et",
    "cost_price": 690.5034346099999993384699337184429168701171875,
    "selling_price": 258588356,
    "stock_threshold": 58346628.179811097681522369384765625,
    "can_expire": "repudiandae",
    "location": "enim",
    "category": "Product",
    "business_id": "ut"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("https://bafa436a.ngrok.io/api/v1/inventories/products/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "name" => "et",
            "cost_price" => "690.50343461",
            "selling_price" => "258588356",
            "stock_threshold" => "58346628.179811",
            "can_expire" => "repudiandae",
            "location" => "enim",
            "category" => "Product",
            "business_id" => "ut",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/inventories/products/1'
payload = {
    'name': 'et',
    'cost_price': '690.50343461',
    'selling_price': '258588356',
    'stock_threshold': '58346628.179811',
    'can_expire': 'repudiandae',
    'location': 'enim',
    'category': 'Product',
    'business_id': 'ut'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('PUT', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "The selected business id is invalid.",
    "errors": {
        "name": [
            "The name may not be greater than 255 characters."
        ]
    }
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Product not found"
}
```
> Example response (200):

```json
{
    "data": {
        "id": null,
        "name": "Placeat rerum aut provident dolorem esse ut at.",
        "location": "268 Chelsey Well Suite 558\nSouth Delphine, NC 54519",
        "quantity": 207403,
        "category": "Product",
        "stock_threshold": 164,
        "cost_price": 367036,
        "selling_price": 919456,
        "can_expire": null
    }
}
```

### HTTP Request
`PUT /api/v1/inventories/products/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  optional  | The name of the product.
    cost_price | float |  optional  | The price at which the product was bought or produced.
    selling_price | float |  optional  | The price at which the product is sold.
    stock_threshold | float |  optional  | The minimum quantity at which reorder is placed.
    can_expire | string |  optional  | Whether the product expires or not.
    location | string |  optional  | The location of the product.
    category | string |  required  | The name of the inventory category.
    business_id | string |  optional  | The id of the business.

<!-- END_6ff658503cd18fbdbcfaa62ed5c42c46 -->

<!-- START_633ec27b7dd30c58270faacbdebb5fa7 -->
## Delete Product

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE "https://bafa436a.ngrok.io/api/v1/inventories/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/inventories/products/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("https://bafa436a.ngrok.io/api/v1/inventories/products/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/inventories/products/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "status_code": 200,
    "message": "Product deleted successfully"
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Product not found"
}
```

### HTTP Request
`DELETE /api/v1/inventories/products/{id}`


<!-- END_633ec27b7dd30c58270faacbdebb5fa7 -->

#Inventory - Reorder


APIs for managing inventory reorder
<!-- START_b5ad7aa17044d05fc0ca914722ed66f3 -->
## Pending Reorder

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all products which needs reorder

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/inventories/reorders/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/inventories/reorders/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/inventories/reorders/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/inventories/reorders/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "data": [
        {
            "name": "Commodi dicta in soluta nesciunt",
            "id": "ypZvg7gBHYJlGGWP",
            "quantity": 10,
            "selling_price": 434,
            "cost_price": 4343.4300000000002910383045673370361328125,
            "stock_threshold": 10,
            "location": "Non repellendus qid est minus.",
            "category_id": null
        }
    ]
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```

### HTTP Request
`GET /api/v1/inventories/reorders/{business_id}`


<!-- END_b5ad7aa17044d05fc0ca914722ed66f3 -->

<!-- START_9c9a9ca46589f77113e47e765478ab77 -->
## Place Reorder

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/inventories/reorders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"quantity":67069.648289999997359700500965118408203125,"product_id":"ut"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/inventories/reorders");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "quantity": 67069.648289999997359700500965118408203125,
    "product_id": "ut"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/inventories/reorders", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "quantity" => "67069.64829",
            "product_id" => "ut",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/inventories/reorders'
payload = {
    'quantity': '67069.64829',
    'product_id': 'ut'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "Could not update prodcuct.",
    "errors": {
        "product_id": [
            "The selected product id is invalid."
        ]
    }
}
```
> Example response (200):

```json
{
    "data": {
        "id": null,
        "name": "Nisi qui et omnis illum aliquam mollitia sed.",
        "location": "43144 Wilkinson Parkways Apt. 615\nLake Allanton, NY 78998",
        "quantity": 745651,
        "category": "Product",
        "stock_threshold": 22,
        "cost_price": 757534,
        "selling_price": 321337,
        "can_expire": null
    }
}
```

### HTTP Request
`POST /api/v1/inventories/reorders`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    quantity | float |  required  | The quantity to be added to the product.
    product_id | string |  required  | The id of the product.

<!-- END_9c9a9ca46589f77113e47e765478ab77 -->

#Inventory - Services


APIs for managing inventory services
<!-- START_d50242e558e9fa4599a0bb8aacd3cebc -->
## Create Service

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/inventories/services" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"name":"doloribus","amount":18095.0400000000008731149137020111083984375,"category":"Service","business_id":"quia"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/inventories/services");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "name": "doloribus",
    "amount": 18095.0400000000008731149137020111083984375,
    "category": "Service",
    "business_id": "quia"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/inventories/services", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "name" => "doloribus",
            "amount" => "18095.04",
            "category" => "Service",
            "business_id" => "quia",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/inventories/services'
payload = {
    'name': 'doloribus',
    'amount': '18095.04',
    'category': 'Service',
    'business_id': 'quia'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "The selected business id is invalid.",
    "errors": {
        "business_id": [
            "The selected business id is invalid."
        ]
    }
}
```
> Example response (200):

```json
{
    "data": {
        "id": null,
        "name": "Laborum accusamus error provident molestiae error magnam eligendi aut.",
        "amount": 7398372,
        "category": "Product"
    }
}
```

### HTTP Request
`POST /api/v1/inventories/services`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | The name of the service.
    amount | float |  required  | The amount charged for the service.
    category | string |  required  | The name of the inventory category.
    business_id | string |  required  | The id of the business.

<!-- END_d50242e558e9fa4599a0bb8aacd3cebc -->

<!-- START_0dcd86aa04670a46ccbdd05226322b37 -->
## Update Service

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Update the information of a service

> Example request:

```bash
curl -X PUT "https://bafa436a.ngrok.io/api/v1/inventories/services/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"name":"optio","amount":26903.173543400000198744237422943115234375,"category":"Service","business_id":"illo"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/inventories/services/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "name": "optio",
    "amount": 26903.173543400000198744237422943115234375,
    "category": "Service",
    "business_id": "illo"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("https://bafa436a.ngrok.io/api/v1/inventories/services/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "name" => "optio",
            "amount" => "26903.1735434",
            "category" => "Service",
            "business_id" => "illo",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/inventories/services/1'
payload = {
    'name': 'optio',
    'amount': '26903.1735434',
    'category': 'Service',
    'business_id': 'illo'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('PUT', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "The name may not be greater than 255 characters.",
    "errors": {
        "name": [
            "The name may not be greater than 255 characters."
        ]
    }
}
```
> Example response (200):

```json
{
    "status_code": 200,
    "message": "Service updated successfully"
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Service not found"
}
```

### HTTP Request
`PUT /api/v1/inventories/services/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  optional  | The name of the service.
    amount | float |  optional  | The amount charged for the service.
    category | string |  required  | The name of the inventory category.
    business_id | string |  optional  | The id of the business.

<!-- END_0dcd86aa04670a46ccbdd05226322b37 -->

<!-- START_c88ecceffcd7668fa65ce4df6231ff41 -->
## All Services

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all services belonging to a business

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/inventories/1/services" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/inventories/1/services");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/inventories/1/services", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/inventories/1/services'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```
> Example response (200):

```json
{
    "data": {
        "id": null,
        "name": "Quidem qui eum doloremque soluta.",
        "amount": 1297817,
        "category": "Product"
    }
}
```

### HTTP Request
`GET /api/v1/inventories/{business_id}/services`


<!-- END_c88ecceffcd7668fa65ce4df6231ff41 -->

<!-- START_7ea1cc86f39b1d210da391977849abac -->
## View Services

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of a service

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/inventories/services/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/inventories/services/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/inventories/services/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/inventories/services/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Service not found"
}
```
> Example response (200):

```json
{
    "data": {
        "id": null,
        "name": "Consequuntur provident sapiente laborum quia id quaerat accusantium minima.",
        "amount": 8996583,
        "category": "Product"
    }
}
```

### HTTP Request
`GET /api/v1/inventories/services/{id}`


<!-- END_7ea1cc86f39b1d210da391977849abac -->

<!-- START_8ebc699caa40b02750a880dc625d3987 -->
## Delete Service

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE "https://bafa436a.ngrok.io/api/v1/inventories/services/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/inventories/services/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("https://bafa436a.ngrok.io/api/v1/inventories/services/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/inventories/services/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "status_code": 200,
    "message": "Service deleted successfully"
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Service not found"
}
```

### HTTP Request
`DELETE /api/v1/inventories/services/{id}`


<!-- END_8ebc699caa40b02750a880dc625d3987 -->

#Payments


APIs for managing sales payments
<!-- START_3fc6d1637f13b5e42ca945841a2b5ee9 -->
## Create Payment

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/payments" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"type":"sit","description":"quam","payment_method":"illo","phone_number":"dolor","date":"et","due_date":"vero","total_amount":179737.0613000000012107193470001220703125,"amount_paid":137959.1805499999900348484516143798828125,"amount_remaining":574.669599999999945794115774333477020263671875,"amount_owed":1597.063699999999926149030216038227081298828125,"discount_applied":false,"discount_type":3518.8348489999998491839505732059478759765625,"discount_value":303.6000000000000227373675443232059478759765625,"shopping_cart_id":"temporibus","customer_id":"vero","business_id":"iste"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/payments");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "type": "sit",
    "description": "quam",
    "payment_method": "illo",
    "phone_number": "dolor",
    "date": "et",
    "due_date": "vero",
    "total_amount": 179737.0613000000012107193470001220703125,
    "amount_paid": 137959.1805499999900348484516143798828125,
    "amount_remaining": 574.669599999999945794115774333477020263671875,
    "amount_owed": 1597.063699999999926149030216038227081298828125,
    "discount_applied": false,
    "discount_type": 3518.8348489999998491839505732059478759765625,
    "discount_value": 303.6000000000000227373675443232059478759765625,
    "shopping_cart_id": "temporibus",
    "customer_id": "vero",
    "business_id": "iste"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/payments", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "type" => "sit",
            "description" => "quam",
            "payment_method" => "illo",
            "phone_number" => "dolor",
            "date" => "et",
            "due_date" => "vero",
            "total_amount" => "179737.0613",
            "amount_paid" => "137959.18055",
            "amount_remaining" => "574.6696",
            "amount_owed" => "1597.0637",
            "discount_applied" => "",
            "discount_type" => "3518.834849",
            "discount_value" => "303.6",
            "shopping_cart_id" => "temporibus",
            "customer_id" => "vero",
            "business_id" => "iste",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/payments'
payload = {
    'type': 'sit',
    'description': 'quam',
    'payment_method': 'illo',
    'phone_number': 'dolor',
    'date': 'et',
    'due_date': 'vero',
    'total_amount': '179737.0613',
    'amount_paid': '137959.18055',
    'amount_remaining': '574.6696',
    'amount_owed': '1597.0637',
    'discount_applied': '',
    'discount_type': '3518.834849',
    'discount_value': '303.6',
    'shopping_cart_id': 'temporibus',
    'customer_id': 'vero',
    'business_id': 'iste'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "Could not add sales.",
    "errors": {
        "business_id": [
            "The selected business id is invalid."
        ]
    }
}
```
> Example response (200):

```json
{
    "data": {
        "id": "vllM2knGHypw7oBZ",
        "total_amount": -44342534.57999999821186065673828125,
        "payment_method": null,
        "discount_applied": 1,
        "discount_type": "fixed",
        "discount_value": 44343534.57999999821186065673828125,
        "type": "paid",
        "amount_paid": 4434,
        "amount_owed": 8988998,
        "amount_remaining": null,
        "due_date": "2019-02-02T00:00:00.000000Z",
        "sales_id": "p983qmNJfpRPqwKB",
        "business_id": "99kz5WlPuAxGDkWm",
        "customer": null,
        "created_at": "2020-02-25T04:41:01.000000Z",
        "updated_at": "2020-02-25T04:41:01.000000Z"
    }
}
```

### HTTP Request
`POST /api/v1/payments`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    type | string |  required  | The type of the payment. Accepted values are: paid, partial or owing.
    description | string |  optional  | The description of the transaction.
    payment_method | string |  optional  | The method of payment. Either cash, mobile money, bank.
    phone_number | string |  optional  | The phone number of the customer if payment method is mobile money.
    date | string |  optional  | The date of the transaction.
    due_date | string |  optional  | The due date of the payments. Normally for partial and owing payments.
    total_amount | float |  optional  | The total amount of the payment. Required if it is partial or paid
    amount_paid | float |  optional  | The amount paid for the transaction. Required if the payment is partial
    amount_remaining | float |  optional  | The amount remaining for the transaction. Required if the payment is partial
    amount_owed | float |  optional  | The amount remaining for the payment. Required if the payment is owing
    discount_applied | boolean |  optional  | Whether discount is applied to the amount paid
    discount_type | float |  optional  | The type of the discount. Whether fixed or percentage.
    discount_value | float |  optional  | The amount of the discount
    shopping_cart_id | string |  required  | The id of the shopping cart.
    customer_id | string |  optional  | The id of the vendor. Required if the payment is partial or owing.
    business_id | string |  required  | The id of the business.

<!-- END_3fc6d1637f13b5e42ca945841a2b5ee9 -->

<!-- START_61d76fe64cacc0179dd867cdc1b27949 -->
## View Payment

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of a payment

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/payments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/payments/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/payments/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/payments/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Payment ot found"
}
```
> Example response (200):

```json
{
    "data": {
        "id": "vllM2knGHypw7oBZ",
        "total_amount": -44342534.57999999821186065673828125,
        "payment_method": null,
        "discount_applied": 1,
        "discount_type": "fixed",
        "discount_value": 44343534.57999999821186065673828125,
        "type": "paid",
        "amount_paid": 4434,
        "amount_owed": 8988998,
        "amount_remaining": null,
        "due_date": "2019-02-02T00:00:00.000000Z",
        "sales_id": "p983qmNJfpRPqwKB",
        "business_id": "99kz5WlPuAxGDkWm",
        "customer": null,
        "created_at": "2020-02-25T04:41:01.000000Z",
        "updated_at": "2020-02-25T04:41:01.000000Z"
    }
}
```

### HTTP Request
`GET /api/v1/payments/{id}`


<!-- END_61d76fe64cacc0179dd867cdc1b27949 -->

<!-- START_7b7bf049d643631f0201bcfa14f1e665 -->
## All Payments

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all payments belonging to a business

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/payments/all/1?customer_id=autem" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/payments/all/1");

    let params = {
            "customer_id": "autem",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/payments/all/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'query' => [
            "customer_id" => "autem",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/payments/all/1'
params = {
	'customer_id': 'autem'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers, params=params)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```
> Example response (200):

```json
{
    "data": [
        {
            "id": "vllM2knGHypw7oBZ",
            "total_amount": -44342534.57999999821186065673828125,
            "payment_method": null,
            "discount_applied": 1,
            "discount_type": "fixed",
            "discount_value": 44343534.57999999821186065673828125,
            "type": "paid",
            "amount_paid": 4434,
            "amount_owed": 8988998,
            "amount_remaining": null,
            "due_date": "2019-02-02T00:00:00.000000Z",
            "sales_id": "p983qmNJfpRPqwKB",
            "business_id": "99kz5WlPuAxGDkWm",
            "customer": null,
            "created_at": "2020-02-25T04:41:01.000000Z",
            "updated_at": "2020-02-25T04:41:01.000000Z"
        },
        {
            "id": "vllM2knGHypw7oBZ",
            "total_amount": -44342534.57999999821186065673828125,
            "payment_method": null,
            "discount_applied": 1,
            "discount_type": "fixed",
            "discount_value": 44343534.57999999821186065673828125,
            "type": "paid",
            "amount_paid": 4434,
            "amount_owed": 8988998,
            "amount_remaining": null,
            "due_date": "2019-02-02T00:00:00.000000Z",
            "sales_id": "p983qmNJfpRPqwKB",
            "business_id": "99kz5WlPuAxGDkWm",
            "customer": null,
            "created_at": "2020-02-25T04:41:01.000000Z",
            "updated_at": "2020-02-25T04:41:01.000000Z"
        }
    ]
}
```

### HTTP Request
`GET /api/v1/payments/all/{business_id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    customer_id |  optional  | The id of the customer. If its set, only payments of this customer will be returned.

<!-- END_7b7bf049d643631f0201bcfa14f1e665 -->

<!-- START_599f6981297334949c74791a312ef392 -->
## Client Statement

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all payments by customer.

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/payments/client-statement/1?type=quia" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/payments/client-statement/1");

    let params = {
            "type": "quia",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/payments/client-statement/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'query' => [
            "type" => "quia",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/payments/client-statement/1'
params = {
	'type': 'quia'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers, params=params)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Customer not found"
}
```
> Example response (200):

```json
{
    "data": [
        {
            "id": "vllM2knGHypw7oBZ",
            "total_amount": -44342534.57999999821186065673828125,
            "payment_method": null,
            "discount_applied": 1,
            "discount_type": "fixed",
            "discount_value": 44343534.57999999821186065673828125,
            "type": "paid",
            "amount_paid": 4434,
            "amount_owed": 8988998,
            "amount_remaining": null,
            "due_date": "2019-02-02T00:00:00.000000Z",
            "created_at": "2020-02-25"
        },
        {
            "id": "vllM2knGHypw7oBZ",
            "total_amount": -44342534.57999999821186065673828125,
            "payment_method": null,
            "discount_applied": 1,
            "discount_type": "fixed",
            "discount_value": 44343534.57999999821186065673828125,
            "type": "paid",
            "amount_paid": 4434,
            "amount_owed": 8988998,
            "amount_remaining": null,
            "due_date": "2019-02-02T00:00:00.000000Z",
            "created_at": "2020-02-25"
        }
    ]
}
```

### HTTP Request
`GET /api/v1/payments/client-statement/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    type |  optional  | The type of the report. It can be weekly, daily or monthly. Defaults to daily if no value is set.

<!-- END_599f6981297334949c74791a312ef392 -->

<!-- START_9f3901b614369d88747708270b7127e7 -->
## Update Payment

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Update the information of a payment

> Example request:

```bash
curl -X PUT "https://bafa436a.ngrok.io/api/v1/payments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"type":"dolor","description":"et","payment_method":"quia","phone_number":"velit","date":"enim","due_date":"quo","total_amount":2763932.1251404997892677783966064453125,"amount_paid":7.0956542000000002445858626742847263813018798828125,"amount_remaining":37,"amount_owed":227256.974512999993748962879180908203125,"discount_applied":true,"discount_type":271262.58016685000620782375335693359375,"discount_value":0.54808069000000003700989736898918636143207550048828125,"shopping_cart_id":"et","customer_id":"aliquam","business_id":"sed"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/payments/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "type": "dolor",
    "description": "et",
    "payment_method": "quia",
    "phone_number": "velit",
    "date": "enim",
    "due_date": "quo",
    "total_amount": 2763932.1251404997892677783966064453125,
    "amount_paid": 7.0956542000000002445858626742847263813018798828125,
    "amount_remaining": 37,
    "amount_owed": 227256.974512999993748962879180908203125,
    "discount_applied": true,
    "discount_type": 271262.58016685000620782375335693359375,
    "discount_value": 0.54808069000000003700989736898918636143207550048828125,
    "shopping_cart_id": "et",
    "customer_id": "aliquam",
    "business_id": "sed"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("https://bafa436a.ngrok.io/api/v1/payments/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "type" => "dolor",
            "description" => "et",
            "payment_method" => "quia",
            "phone_number" => "velit",
            "date" => "enim",
            "due_date" => "quo",
            "total_amount" => "2763932.1251405",
            "amount_paid" => "7.0956542",
            "amount_remaining" => "37",
            "amount_owed" => "227256.974513",
            "discount_applied" => "1",
            "discount_type" => "271262.58016685",
            "discount_value" => "0.54808069",
            "shopping_cart_id" => "et",
            "customer_id" => "aliquam",
            "business_id" => "sed",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/payments/1'
payload = {
    'type': 'dolor',
    'description': 'et',
    'payment_method': 'quia',
    'phone_number': 'velit',
    'date': 'enim',
    'due_date': 'quo',
    'total_amount': '2763932.1251405',
    'amount_paid': '7.0956542',
    'amount_remaining': '37',
    'amount_owed': '227256.974513',
    'discount_applied': '1',
    'discount_type': '271262.58016685',
    'discount_value': '0.54808069',
    'shopping_cart_id': 'et',
    'customer_id': 'aliquam',
    'business_id': 'sed'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('PUT', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "Could not update sales.",
    "errors": {
        "business_id": [
            "The selected business id is invalid."
        ]
    }
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "PaymentTransformer not found"
}
```
> Example response (200):

```json
{
    "data": {
        "id": "vllM2knGHypw7oBZ",
        "total_amount": -44342534.57999999821186065673828125,
        "payment_method": null,
        "discount_applied": 1,
        "discount_type": "fixed",
        "discount_value": 44343534.57999999821186065673828125,
        "type": "paid",
        "amount_paid": 4434,
        "amount_owed": 8988998,
        "amount_remaining": null,
        "due_date": "2019-02-02T00:00:00.000000Z",
        "sales_id": "p983qmNJfpRPqwKB",
        "business_id": "99kz5WlPuAxGDkWm",
        "customer": null,
        "created_at": "2020-02-25T04:41:01.000000Z",
        "updated_at": "2020-02-25T04:41:01.000000Z"
    }
}
```

### HTTP Request
`PUT /api/v1/payments/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    type | string |  required  | The type of the payment. Accepted values are: paid, partial or owing.
    description | string |  optional  | The description of the transaction.
    payment_method | string |  optional  | The method of payment. Either cash, mobile money, bank.
    phone_number | string |  optional  | The phone number of the customer if payment method is mobile money.
    date | string |  optional  | The date of the transaction.
    due_date | string |  optional  | The due date of the payments. Normally for partial and owing payments.
    total_amount | float |  optional  | The total amount of the payment. Required if it is partial or paid
    amount_paid | float |  optional  | The amount paid for the transaction. Required if the payment is partial
    amount_remaining | float |  optional  | The amount remaining for the transaction. Required if the payment is partial
    amount_owed | float |  optional  | The amount remaining for the payment. Required if the payment is owing
    discount_applied | boolean |  optional  | Whether discount is applied to the amount paid
    discount_type | float |  optional  | The type of the discount. Whether fixed or percentage.
    discount_value | float |  optional  | The amount of the discount
    shopping_cart_id | string |  required  | The id of the shopping cart.
    customer_id | string |  optional  | The id of the vendor. Required if the payment is partial or owing.
    business_id | string |  required  | The id of the business.

<!-- END_9f3901b614369d88747708270b7127e7 -->

<!-- START_c2d580a70488db74bb681a56daec701e -->
## Delete Payment

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE "https://bafa436a.ngrok.io/api/v1/payments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/payments/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("https://bafa436a.ngrok.io/api/v1/payments/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/payments/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "status_code": 200,
    "message": "Payment deleted successfully"
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Payment not found"
}
```

### HTTP Request
`DELETE /api/v1/payments/{id}`


<!-- END_c2d580a70488db74bb681a56daec701e -->

#Reports


APIs for managing activities reports
<!-- START_bbfedb8724f516d00d188718f42039b7 -->
## Debtors List

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
List of customers with outstanding payments

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/reports/1/debtors-list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/reports/1/debtors-list");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/reports/1/debtors-list", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/reports/1/debtors-list'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```
> Example response (200):

```json
{
    "data": [
        {
            "id": null,
            "name": "Desmond Gulgowski",
            "amount": 0
        },
        {
            "id": null,
            "name": "Desmond Gulgowski",
            "amount": 0
        }
    ]
}
```

### HTTP Request
`GET /api/v1/reports/{business_id}/debtors-list`


<!-- END_bbfedb8724f516d00d188718f42039b7 -->

<!-- START_e16117fdd505d5ed2db347a9625b6b1c -->
## Sales

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
A summary report of all sales activities

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/reports/1/sales" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/reports/1/sales");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/reports/1/sales", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/reports/1/sales'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```

### HTTP Request
`GET /api/v1/reports/{business_id}/sales`


<!-- END_e16117fdd505d5ed2db347a9625b6b1c -->

<!-- START_f129c2453a16762ed8c348cda2124700 -->
## Inventory

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the total number of inventory (product and services),
expected profits (of all products and services) and
the total cost of inventory (both products and services)

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/reports/1/inventory" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/reports/1/inventory");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/reports/1/inventory", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/reports/1/inventory'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```
> Example response (200):

```json
{
    "data": {
        "cost": {
            "services": 26058,
            "products": 160706.9099999998579733073711395263671875,
            "total": 186764.9099999998579733073711395263671875
        },
        "expected_profits": {
            "services": 26058,
            "products": 144648.9099999998579733073711395263671875
        },
        "count": {
            "products": 37,
            "services": 6,
            "total": 43
        }
    }
}
```

### HTTP Request
`GET /api/v1/reports/{business_id}/inventory`


<!-- END_f129c2453a16762ed8c348cda2124700 -->

<!-- START_3411200560a65f35b9cbd06831205c58 -->
## Finance

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns a summary report of all financial activities.
ie. Total revenue & expenses, total credit & debit, profit and loss, etc.

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/reports/1/finance?type=temporibus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/reports/1/finance");

    let params = {
            "type": "temporibus",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/reports/1/finance", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'query' => [
            "type" => "temporibus",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/reports/1/finance'
params = {
	'type': 'temporibus'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers, params=params)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```

### HTTP Request
`GET /api/v1/reports/{business_id}/finance`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    type |  optional  | Wether 'weekly', 'yearly' or 'monthly' report. Default to weekly if not set.

<!-- END_3411200560a65f35b9cbd06831205c58 -->

<!-- START_c98afd281cfc9956da7d4f419e918edc -->
## Users

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the total administrators and attendants of a buinsess

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/reports/1/users" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/reports/1/users");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/reports/1/users", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/reports/1/users'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```
> Example response (200):

```json
{
    "data": {
        "cost": {
            "services": 26058,
            "products": 160706.9099999998579733073711395263671875,
            "total": 186764.9099999998579733073711395263671875
        },
        "expected_profits": {
            "services": 26058,
            "products": 144648.9099999998579733073711395263671875
        },
        "count": {
            "products": 37,
            "services": 6,
            "total": 43
        }
    }
}
```

### HTTP Request
`GET /api/v1/reports/{business_id}/users`


<!-- END_c98afd281cfc9956da7d4f419e918edc -->

<!-- START_fa3963ba4c092049a6ef7378e7753250 -->
## All

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns a json of sales and finance reports combined

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/reports/1/all?type=debitis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/reports/1/all");

    let params = {
            "type": "debitis",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/reports/1/all", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'query' => [
            "type" => "debitis",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/reports/1/all'
params = {
	'type': 'debitis'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers, params=params)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```

### HTTP Request
`GET /api/v1/reports/{business_id}/all`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    type |  optional  | For finance report, set wether 'weekly', 'yearly'

<!-- END_fa3963ba4c092049a6ef7378e7753250 -->

#Sales


APIs for managing sales
<!-- START_865d64e774bc2b766c43dbfff277e06e -->
## View Sales

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of sales item

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/sales/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/sales/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/sales/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/sales/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Sales not found"
}
```
> Example response (200):

```json
{
    "data": {
        "id": "zplBDBw5TG5OVvzW",
        "total_discount": 0,
        "total": 1946424261166425944444895232,
        "total_tax": 0,
        "business_id": "vRRA2ARxT4WX373X",
        "items": [
            {
                "id": "rYrk8RmnCDPkPLPB",
                "unit_price": 434,
                "quantity": 443434,
                "is_taxed": 0,
                "tax_type": null,
                "tax_amount": null,
                "discount_type": null,
                "discount_amount": null,
                "tax_id": null,
                "service_id": null,
                "product_id": "76MzLxzrFAOJ7Myy"
            },
            {
                "id": "G9k02vxLHwyQr6v2",
                "unit_price": 434,
                "quantity": 38589345984389352,
                "is_taxed": 0,
                "tax_type": null,
                "tax_amount": null,
                "discount_type": null,
                "discount_amount": null,
                "tax_id": null,
                "service_id": null,
                "product_id": "NxREk08WuP1xR38m"
            },
            {
                "id": "9LWW8LVoUmY2R9N4",
                "unit_price": 434,
                "quantity": 4484848489443893377499136,
                "is_taxed": 0,
                "tax_type": null,
                "tax_amount": null,
                "discount_type": null,
                "discount_amount": null,
                "tax_id": null,
                "service_id": null,
                "product_id": "oAqv9J9VuKj1zWwz"
            },
            {
                "id": "2knDPlZOHRxZ4oEQ",
                "unit_price": 4343,
                "quantity": 0,
                "is_taxed": 0,
                "tax_type": null,
                "tax_amount": null,
                "discount_type": null,
                "discount_amount": null,
                "tax_id": null,
                "service_id": "vj1jDwyOf2jMnBDx",
                "product_id": null
            }
        ]
    }
}
```

### HTTP Request
`GET /api/v1/sales/{id}`


<!-- END_865d64e774bc2b766c43dbfff277e06e -->

<!-- START_06ecd35bd0af517565f5476ab5827bdd -->
## All Sales

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all sales belonging to a business

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/sales/1/all" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/sales/1/all");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/sales/1/all", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/sales/1/all'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```
> Example response (200):

```json
{
    "data": [
        {
            "id": "zplBDBw5TG5OVvzW",
            "total_discount": 0,
            "total": 1946424261166425944444895232,
            "total_tax": 0,
            "business_id": "vRRA2ARxT4WX373X",
            "items": [
                {
                    "id": "rYrk8RmnCDPkPLPB",
                    "unit_price": 434,
                    "quantity": 443434,
                    "is_taxed": 0,
                    "tax_type": null,
                    "tax_amount": null,
                    "discount_type": null,
                    "discount_amount": null,
                    "tax_id": null,
                    "service_id": null,
                    "product_id": "76MzLxzrFAOJ7Myy"
                },
                {
                    "id": "G9k02vxLHwyQr6v2",
                    "unit_price": 434,
                    "quantity": 38589345984389352,
                    "is_taxed": 0,
                    "tax_type": null,
                    "tax_amount": null,
                    "discount_type": null,
                    "discount_amount": null,
                    "tax_id": null,
                    "service_id": null,
                    "product_id": "NxREk08WuP1xR38m"
                },
                {
                    "id": "9LWW8LVoUmY2R9N4",
                    "unit_price": 434,
                    "quantity": 4484848489443893377499136,
                    "is_taxed": 0,
                    "tax_type": null,
                    "tax_amount": null,
                    "discount_type": null,
                    "discount_amount": null,
                    "tax_id": null,
                    "service_id": null,
                    "product_id": "oAqv9J9VuKj1zWwz"
                },
                {
                    "id": "2knDPlZOHRxZ4oEQ",
                    "unit_price": 4343,
                    "quantity": 0,
                    "is_taxed": 0,
                    "tax_type": null,
                    "tax_amount": null,
                    "discount_type": null,
                    "discount_amount": null,
                    "tax_id": null,
                    "service_id": "vj1jDwyOf2jMnBDx",
                    "product_id": null
                }
            ]
        }
    ]
}
```

### HTTP Request
`GET /api/v1/sales/{business_id}/all`


<!-- END_06ecd35bd0af517565f5476ab5827bdd -->

#Shopping Cart


APIs for managing shopping cart
<!-- START_1f96e77632d7e4231a85d05b45b3f8fc -->
## Add Items

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Items should be grouped into arrays. If cart_id is set in the query params, the cart will be updated with the new items

> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/shopping-cart/add?cart_id=expedita" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"total":2539860.4822780000977218151092529296875,"quantity":684797042,"total_tax":44.17049200000000297450242214836180210113525390625,"product_id":"tempora","service_id":"non"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/shopping-cart/add");

    let params = {
            "cart_id": "expedita",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "total": 2539860.4822780000977218151092529296875,
    "quantity": 684797042,
    "total_tax": 44.17049200000000297450242214836180210113525390625,
    "product_id": "tempora",
    "service_id": "non"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/shopping-cart/add", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'query' => [
            "cart_id" => "expedita",
        ],
    'json' => [
            "total" => "2539860.482278",
            "quantity" => "684797042",
            "total_tax" => "44.170492",
            "product_id" => "tempora",
            "service_id" => "non",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/shopping-cart/add'
payload = {
    'total': '2539860.482278',
    'quantity': '684797042',
    'total_tax': '44.170492',
    'product_id': 'tempora',
    'service_id': 'non'
}
params = {
	'cart_id': 'expedita'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload, params=params)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "Item 1: The selected product id is invalid.",
    "errors": {
        "business_id": [
            "The selected product id is invalid."
        ]
    }
}
```
> Example response (200):

```json
{
    "data": {
        "id": "PZQ2q192TKgnOvRx",
        "total_tax": 0,
        "total": 0,
        "items": [],
        "user_id": "lxwox1q6HPvloAD0"
    }
}
```

### HTTP Request
`POST /api/v1/shopping-cart/add`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    total | float |  required  | The total amount of the sales including tax.
    quantity | float |  optional  | optional The total quantity sold. Required if item is a product.
    total_tax | float |  optional  | The total tax amount of the sales.
    product_id | string |  optional  | optional The id of the product .
    service_id | string |  optional  | optional The id of the service .
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    cart_id |  optional  | If it set, the existing cart will be updated else new one will be created

<!-- END_1f96e77632d7e4231a85d05b45b3f8fc -->

<!-- START_ed54179242ff6acdce128df90a607fef -->
## View Cart

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all the items in a shopping cart

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/shopping-cart/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/shopping-cart/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/shopping-cart/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/shopping-cart/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Shopping Cart not found"
}
```
> Example response (200):

```json
{
    "data": {
        "id": "PZQ2q192TKgnOvRx",
        "total_tax": 0,
        "total": 0,
        "items": [],
        "user_id": "lxwox1q6HPvloAD0"
    }
}
```

### HTTP Request
`GET /api/v1/shopping-cart/{id}`


<!-- END_ed54179242ff6acdce128df90a607fef -->

<!-- START_13b9227713200d1a87a5181187e35e95 -->
## Delete Cart Item

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
If 'items' query parameter is not set, the main cart will be deleted.

> Example request:

```bash
curl -X DELETE "https://bafa436a.ngrok.io/api/v1/shopping-cart/1?items=assumenda" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/shopping-cart/1");

    let params = {
            "items": "assumenda",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("https://bafa436a.ngrok.io/api/v1/shopping-cart/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'query' => [
            "items" => "assumenda",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/shopping-cart/1'
params = {
	'items': 'assumenda'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('DELETE', url, headers=headers, params=params)
response.json()
```


> Example response (200):

```json
{
    "status_code": 200,
    "message": "Cart deleted successfully"
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Cart not found"
}
```

### HTTP Request
`DELETE /api/v1/shopping-cart/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    items |  optional  | Comma separated list of the shopping cart items id. Eg. ...?items=RgWQ9kwVFRvyvMNo,911N5woRcxXNvNoG

<!-- END_13b9227713200d1a87a5181187e35e95 -->

#Tax


APIs for managing currencies
<!-- START_5a0a8b2b0e97422a2c0cc05a11d237cf -->
## All Taxes

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all taxes

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/taxes" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/taxes");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/taxes", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/taxes'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "data": {
        "id": "oORD5XEzcr36rDpx",
        "name": "vat",
        "percentage": "12.500"
    }
}
```

### HTTP Request
`GET /api/v1/taxes`


<!-- END_5a0a8b2b0e97422a2c0cc05a11d237cf -->

#User


APIs for managing users
<!-- START_40992bdc64e83308f3be9b8eed35fce0 -->
## Create a user

> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/users/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"email":"dolorem","first_name":"John","last_name":"Doe","phone_number":"02454345454","mobile_money_number":"0245434544","country":"Ghana","password":"sequi","password_confirm":"exercitationem"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/users/register");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "email": "dolorem",
    "first_name": "John",
    "last_name": "Doe",
    "phone_number": "02454345454",
    "mobile_money_number": "0245434544",
    "country": "Ghana",
    "password": "sequi",
    "password_confirm": "exercitationem"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/users/register", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "email" => "dolorem",
            "first_name" => "John",
            "last_name" => "Doe",
            "phone_number" => "02454345454",
            "mobile_money_number" => "0245434544",
            "country" => "Ghana",
            "password" => "sequi",
            "password_confirm" => "exercitationem",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/users/register'
payload = {
    'email': 'dolorem',
    'first_name': 'John',
    'last_name': 'Doe',
    'phone_number': '02454345454',
    'mobile_money_number': '0245434544',
    'country': 'Ghana',
    'password': 'sequi',
    'password_confirm': 'exercitationem'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (200):

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJ...",
    "token_type": "bearer",
    "expires_in": 3600,
    "status_code": 201,
    "message": "User created successfully"
}
```
> Example response (422):

```json
{
    "status_code": 422,
    "message": "The email has already been taken.",
    "errors": {
        "email": [
            "The email has already been taken."
        ]
    }
}
```

### HTTP Request
`POST /api/v1/users/register`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | The email of the user.
    first_name | string |  required  | The first name of the user.
    last_name | string |  required  | The last name of the user.
    phone_number | string |  required  | The phone number of the user.
    mobile_money_number | string |  required  | The mobile money number of the user.
    country | string |  required  | The country of the user.
    password | string |  required  | The password of the user. It MUST match 'confirm_password' field
    password_confirm | string |  required  | The password of the user. It MUST match 'password' field

<!-- END_40992bdc64e83308f3be9b8eed35fce0 -->

<!-- START_cb26f2b3a0cb211632f1f1d8a97f8390 -->
## Password Reset

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/users/password-reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"old_password":"fugit","new_password":"John"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/users/password-reset");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "old_password": "fugit",
    "new_password": "John"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/users/password-reset", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "old_password" => "fugit",
            "new_password" => "John",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/users/password-reset'
payload = {
    'old_password': 'fugit',
    'new_password': 'John'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "old_password is invalid.",
    "errors": {
        "old_password": [
            "old_password is invalid."
        ]
    }
}
```
> Example response (200):

```json
{
    "status_code": 200,
    "message": "Password changed successfully"
}
```

### HTTP Request
`POST /api/v1/users/password-reset`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    old_password | string |  required  | The old password of the user.
    new_password | string |  required  | The new password of the user.

<!-- END_cb26f2b3a0cb211632f1f1d8a97f8390 -->

<!-- START_17da6e775b60c8a29ecff7d30f823522 -->
## View a user

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of the user

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/users/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/users/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/users/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/users/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "User not found"
}
```
> Example response (200):

```json
{
    "data": {
        "id": null,
        "last_name": "Gottlieb",
        "first_name": "Vern",
        "country": "Paraguay",
        "phone_number": "818-969-8502",
        "email": "abner.schumm@example.net",
        "type": "manager",
        "mobile_money_number": null
    }
}
```

### HTTP Request
`GET /api/v1/users/{id}`

`POST /api/v1/users/{id}`


<!-- END_17da6e775b60c8a29ecff7d30f823522 -->

<!-- START_c77cbe22c55c58a687e812f8f888c5ff -->
## Update a user

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Update the information of a user

> Example request:

```bash
curl -X PUT "https://bafa436a.ngrok.io/api/v1/users/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"email":"vel","first_name":"John","last_name":"Doe","phone_number":"02454345454","mobile_money_number":"0245434544","country":"Ghana"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/users/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "email": "vel",
    "first_name": "John",
    "last_name": "Doe",
    "phone_number": "02454345454",
    "mobile_money_number": "0245434544",
    "country": "Ghana"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("https://bafa436a.ngrok.io/api/v1/users/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "email" => "vel",
            "first_name" => "John",
            "last_name" => "Doe",
            "phone_number" => "02454345454",
            "mobile_money_number" => "0245434544",
            "country" => "Ghana",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/users/1'
payload = {
    'email': 'vel',
    'first_name': 'John',
    'last_name': 'Doe',
    'phone_number': '02454345454',
    'mobile_money_number': '0245434544',
    'country': 'Ghana'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('PUT', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "Could not create new user.",
    "errors": {
        "email": [
            "The email is invalid."
        ]
    }
}
```
> Example response (200):

```json
{
    "status_code": 200,
    "message": "User updated successfully"
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "User not found"
}
```

### HTTP Request
`PUT /api/v1/users/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | The email of the user.
    first_name | string |  required  | The first name of the user.
    last_name | string |  required  | The last name of the user.
    phone_number | string |  required  | The phone number of the user.
    mobile_money_number | string |  required  | The mobile money number of the user.
    country | string |  required  | The country of the user.

<!-- END_c77cbe22c55c58a687e812f8f888c5ff -->

<!-- START_a0c7c0bb81b46ad0b560535ef356834e -->
## Delete a user

Deletes a user account

> Example request:

```bash
curl -X DELETE "https://bafa436a.ngrok.io/api/v1/users/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/users/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("https://bafa436a.ngrok.io/api/v1/users/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/users/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "status_code": 200,
    "message": "User deleted successfully"
}
```
> Example response (404):

```json
{
    "status_code": 4,
    "message": "User not found"
}
```

### HTTP Request
`DELETE /api/v1/users/{id}`


<!-- END_a0c7c0bb81b46ad0b560535ef356834e -->

#User Authentication


APIs for authenticating users
<!-- START_ab10e1c11b203a254fc25c51c2d30f65 -->
## Login

> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/users/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"email":"dolore","password":"quis"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/users/login");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "email": "dolore",
    "password": "quis"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/users/login", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "email" => "dolore",
            "password" => "quis",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/users/login'
payload = {
    'email': 'dolore',
    'password': 'quis'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (401):

```json
{
    "status_code": 401,
    "message": "Invalid credentials"
}
```
> Example response (200):

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC92MVwvdXNlcnNcL2xvZ2luIiwiaWF0IjoxNTgwNzQ3Mzc0LCJleHAiOjE1ODUwNjczNzQsIm5iZiI6MTU4MDc0NzM3NCwianRpIjoiUldTQW9LUFJ1cnpmSm9adyIsInN1YiI6NzksInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.M_H-HqLkJIvbbVQ0WJ5wky1bNAI-6QFpuCXczHs6Ox0",
    "token_type": "bearer",
    "expires_in": 72000,
    "message": "Login successful",
    "status_code": 200,
    "id": "PY6VnKg8TZ8XQW9v",
    "type": "employee",
    "businesses": [
        {
            "id": "vRRA2ARxT4WX373X",
            "name": "B2B innovate synergies",
            "nature": "Company",
            "location": "Raquelton",
            "owner": "Oleta Kihn",
            "currency": {
                "code": "GHS",
                "sign": "¢",
                "name": "Ghana Cedi",
                "id": "LJlXKgqQHlPE5KEp"
            },
            "reg_no": "g",
            "tax_no": "o",
            "vat_no": "g",
            "logo": "http:\/\/localhost:8000\/storage\/logos\/B2B_innovate_synergies_logo.jpg"
        }
    ]
}
```

### HTTP Request
`POST /api/v1/users/login`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | The email of the user.
    password | string |  required  | The password of the user

<!-- END_ab10e1c11b203a254fc25c51c2d30f65 -->

<!-- START_13a195ed380ca3be0a53c21d896d7f01 -->
## Logout

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/users/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/users/logout");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/users/logout", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/users/logout'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "status_code": 200,
    "message": "Successfully logged out"
}
```
> Example response (401):

```json
{
    "status_code": 401,
    "message": "Token has expired or invalid token"
}
```

### HTTP Request
`POST /api/v1/users/logout`


<!-- END_13a195ed380ca3be0a53c21d896d7f01 -->

#Vendor


APIs for managing vendors
<!-- START_2916f7776ff5494e21aa91f2253d12d7 -->
## Create Vendor

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "https://bafa436a.ngrok.io/api/v1/vendors" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"first_name":"ratione","last_name":"voluptas","email":"doloribus","phone_number":"omnis","description":"vitae","location":"mollitia","business_id":"quo"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/vendors");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "first_name": "ratione",
    "last_name": "voluptas",
    "email": "doloribus",
    "phone_number": "omnis",
    "description": "vitae",
    "location": "mollitia",
    "business_id": "quo"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("https://bafa436a.ngrok.io/api/v1/vendors", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "first_name" => "ratione",
            "last_name" => "voluptas",
            "email" => "doloribus",
            "phone_number" => "omnis",
            "description" => "vitae",
            "location" => "mollitia",
            "business_id" => "quo",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/vendors'
payload = {
    'first_name': 'ratione',
    'last_name': 'voluptas',
    'email': 'doloribus',
    'phone_number': 'omnis',
    'description': 'vitae',
    'location': 'mollitia',
    'business_id': 'quo'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "The selected business id is invalid.",
    "errors": {
        "business_id": [
            "The selected business id is invalid."
        ]
    }
}
```

### HTTP Request
`POST /api/v1/vendors`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    first_name | string |  required  | The first name of the vendor.
    last_name | string |  required  | The last name of the vendor.
    email | string |  optional  | The email of the vendor.
    phone_number | string |  optional  | The phone number of the vendor.
    description | string |  optional  | The description of the vendor.
    location | string |  optional  | The location of the vendor.
    business_id | string |  required  | The id of the business.

<!-- END_2916f7776ff5494e21aa91f2253d12d7 -->

<!-- START_1fab1b24fb8eb057e3e85994f21b3599 -->
## View Vendor

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of a vendor

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/vendors/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/vendors/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/vendors/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/vendors/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Vendor not found"
}
```

### HTTP Request
`GET /api/v1/vendors/{id}`


<!-- END_1fab1b24fb8eb057e3e85994f21b3599 -->

<!-- START_4479b02e6565fa733ebbf630974c483b -->
## All Vendors

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the json representation of all vendors of a business

> Example request:

```bash
curl -X GET -G "https://bafa436a.ngrok.io/api/v1/vendors/all/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/vendors/all/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("https://bafa436a.ngrok.io/api/v1/vendors/all/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/vendors/all/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (404):

```json
{
    "status_code": 404,
    "message": "Business not found"
}
```

### HTTP Request
`GET /api/v1/vendors/all/{business_id}`


<!-- END_4479b02e6565fa733ebbf630974c483b -->

<!-- START_3e22701fdc910c04c6ff3c6f0a37248e -->
## Update Vendor

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Update the information of an vendor

> Example request:

```bash
curl -X PUT "https://bafa436a.ngrok.io/api/v1/vendors/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}" \
    -d '{"first_name":"eius","last_name":"omnis","email":"eos","phone_number":"dolor","description":"molestias","location":"tempore"}'

```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/vendors/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

let body = {
    "first_name": "eius",
    "last_name": "omnis",
    "email": "eos",
    "phone_number": "dolor",
    "description": "molestias",
    "location": "tempore"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("https://bafa436a.ngrok.io/api/v1/vendors/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
    'json' => [
            "first_name" => "eius",
            "last_name" => "omnis",
            "email" => "eos",
            "phone_number" => "dolor",
            "description" => "molestias",
            "location" => "tempore",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/vendors/1'
payload = {
    'first_name': 'eius',
    'last_name': 'omnis',
    'email': 'eos',
    'phone_number': 'dolor',
    'description': 'molestias',
    'location': 'tempore'
}
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('PUT', url, headers=headers, json=payload)
response.json()
```


> Example response (422):

```json
{
    "status_code": 422,
    "message": "The email must be a valid email address.",
    "errors": {
        "email": [
            "The email must be a valid email address."
        ]
    }
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Vendor not found"
}
```

### HTTP Request
`PUT /api/v1/vendors/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    first_name | string |  optional  | The first name of the vendor.
    last_name | string |  optional  | The last name of the vendor.
    email | string |  optional  | The email of the vendor.
    phone_number | string |  optional  | The phone number of the vendor.
    description | string |  optional  | The description of the vendor.
    location | string |  optional  | The location of the vendor.

<!-- END_3e22701fdc910c04c6ff3c6f0a37248e -->

<!-- START_9f91314f2a69f1f1f019a74d9312aabc -->
## Delete Vendor

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE "https://bafa436a.ngrok.io/api/v1/vendors/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {access-token}" \
    -H "X-Authorization: {api-key}"
```

```javascript
const url = new URL("https://bafa436a.ngrok.io/api/v1/vendors/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {access-token}",
    "X-Authorization": "{api-key}",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("https://bafa436a.ngrok.io/api/v1/vendors/1", [
    'headers' => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer {access-token}",
            "X-Authorization" => "{api-key}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'https://bafa436a.ngrok.io/api/v1/vendors/1'
headers = {
	'Content-Type': 'application/json',
	'Accept': 'application/json',
	'Authorization': 'Bearer {access-token}',
	'X-Authorization': '{api-key}'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```


> Example response (200):

```json
{
    "status_code": 200,
    "message": "Vendor deleted successfully"
}
```
> Example response (404):

```json
{
    "status_code": 404,
    "message": "Vendor not found"
}
```

### HTTP Request
`DELETE /api/v1/vendors/{id}`


<!-- END_9f91314f2a69f1f1f019a74d9312aabc -->


