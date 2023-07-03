# OpenLink
(2023 rewrite)

OpenLink is a link shortener based on HiberLink. This is it's rewrote version in Symfony with Tailwind. It used to be made in bare PHP with handwritten CSS.

# TODO
- working API,
- mobile ui,
- dark mode,
- docker !
- prod-ready

## API

### `/link.php`
#### Example
```bash
curl --user-agent "curl" -X POST "https://example.com/link.php" --data "link=https://github.com"
```
**Every setting are required.**

#### Response
- In case of error: `error`.
- In case of success: response will be the link.

### `/index.php`
#### Exemple
```bash
curl --user-agent "curl" -X GET -L "https://example.com/index.php?ID"
```
**or**
```bash
curl --user-agent "curl" -X GET -L "https://example.com/?ID"
```
**Every setting are required
<br>`ID` depends on the request.
<br>Response will be in header `Location` or in page**

#### Response
- Error: `erreur`.
- Success: response will be long link.

### `/status.php`
#### Exemple
```bash
curl --user-agent "curl" -X GET -L "https://example.com/status.php"
```

#### Response
- Success: `{"status": "OK"}`.
- Error: Anything else.


## Installation
### Requirements
- PHP 7.0 or better,
- PHP PDO,
- Nodejs,
- MySQL/MariaDB server.

### Guided configuration

`php bin/console doctrine:migrations:migrate`