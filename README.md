# OpenLink
[![CodeFactor](https://www.codefactor.io/repository/github/jusdepatate/openlink/badge)](https://www.codefactor.io/repository/github/jusdepatate/openlink)


OpenLink is a link shortner project based off the project [HiberLink](https://github.com/HiberFile/HiberLink).

## API

### `/link.php`
#### Exemple
```bash
curl --user-agent "curl" -X POST "https://example.com/link.php" --data "link=https://github.com"
```
**Every settings are required.**

#### Response
- In case of error: `error`.
- In case of sucess: response will be the link.

### `/index.php`
#### Exemple
```bash
curl --user-agent "curl" -X POST -L "https://example.com/index.php?ID"
```
**or**
```bash
curl --user-agent "curl" -X POST -L "https://example.com/?ID"
```
**Every settings are required
<br>`ID` depends on the request.
<br>Response will be in header `Location` or in page**

#### Réponse
- En cas d'erreur: `erreur`.
- En cas de réussite: la réponse est le lien long.


## Installation
### Requirements
- PHP 7.0 or better,
- PHP PDO,
- MySQL/MariaDB server.

### Configuration guidée

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


- `matomo` => boolean for JS matomo integration
- `matomo_siteid` => siteid on matomo,
- `matomo_url` => Matomo URL **as given by Matomo** (should start by `https://`/`http://` and **should end** with `/`),


- `mysql_address` => MySQL server address,
- `mysql_port` => MySQL server port,
- `mysql_database` => MySQL databse,
- `mysql_username` => MySQL username,
- `mysql_password` => MySQL password.

## Known to be working on
- Debian 10 + Apache 2.4 + PHP 7.3
- Ubuntu 18.04 + Apache 2.4 + PHP 7.2
- Arch Linux + Apache 2.4 + PHP 7.4
- Arch Linux + Apache 2.4 + PHP 8.0
