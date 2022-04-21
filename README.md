# OpenLink
[![CodeFactor](https://www.codefactor.io/repository/github/jusdepatate/openlink/badge)](https://www.codefactor.io/repository/github/jusdepatate/openlink)


OpenLink is a link shortner project based off the abandoned project [HiberLink](https://github.com/HiberFile/HiberLink).

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
- MySQL/MariaDB server.

### Guided configuration

- `git clone https://github.com/jusdepatate/OpenLink.git`,
- `cd OpenLink`
- `cp env.example.php env.php`,
- Edit `env.php` with your fav text editor (ex: `nano env.php`),
- `php setup.php` or access the setup.php page with a browser (`curl` is enough),
- `rm setup.php`. (you will still be able to update thru git pull if you remove this file, thanks to [.gitignore](.gitignore))

### Variables `env.php`
- `title` => Name and title of the website,
- `ext_url` => external URL of server, **should start by `https://`/`http://` and should not end with `/`**,
- `char_per_id` => Number of characters to use for links ID, `8` should be enough (98079714615416886934934209737619787751599303819750539264 possibilities),
- `warn_on_redirect` => if set to `true`, will warn user that they are going to be redirected,


- `matomo` => boolean for JS matomo integration
- `matomo_siteid` => siteid on matomo,
- `matomo_url` => Matomo URL **as given by Matomo** (should start by `https://`/`http://` and **should end** with `/`),


- `mysql_address` => MySQL server address,
- `mysql_port` => MySQL server port,
- `mysql_database` => MySQL databse,
- `mysql_username` => MySQL username,
- `mysql_password` => MySQL password.

## Known to be working on
- Arch Linux + Nginx 1.12 + PHP 8.0
- Debian 11 + Apache 2.4 + PHP 7.4