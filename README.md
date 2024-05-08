Hello liketux
Sorry to write you here but I can't find where to contact you since the issues module is not enabled....
Very nice your work with the javanile/php-imap2 project.
I see that you have integrated many PRs, even one of mine.
I wanted to ask you if you plan to add this fork to the composer to make it easier to use.
Thanks, best regards
Gabriel ( gabriel.tandil@gmail.com )


<div align="center">

# ⭐ Give me a star, please! ⭐

<img src="https://raw.githubusercontent.com/francescobianco/gif/main/images/give-stars-h192.gif" /><img src="https://raw.githubusercontent.com/francescobianco/gif/main/images/push-button-h192.gif" />

</div>

---

<div align="center">

![PHP IMAP2](docs/logo.png)

# PHP IMAP2

[![Linter](https://github.com/javanile/php-imap2/actions/workflows/linter.yml/badge.svg)](https://github.com/javanile/php-imap2/actions/workflows/linter.yml)

</div>

## Requirements

- PHP >= 7.0

## Install

```shell
composer require javanile/php-imap2
```

or

Download latest release 

## Usage

```php
$mbh = imap2_open($server, $username, $token, OP_XOAUTH2);
if (! $mbh) {
    error_log(imap2_last_error());
    throw new \RuntimeException('Unable to open the INBOX');
}
```

## Gmail OAuth2

Scope: https://mail.google.com/

## Sandbox

- [Gmail Demo](https://replit.com/@frabik/PHP-IMAP2-Google-Demo?v=1#main.php)
- Outlook Demo - **COMING SOON**


## Contributors

- [dicode-nl](https://github.com/dicode-nl)
- [glensc](https://github.com/glensc)
- [bago](https://github.com/bago)

## Other links 

- <https://php.libhunt.com/php-imap2-alternatives>

## Reference

### Microsoft Outlook

- <http://wiki.canfigure.net/en/guides/exchange-oauth2>

### IMAP & OAUTH

- <https://www.atmail.com/blog/imap-commands/>
- <https://developers.google.com/gmail/imap/xoauth2-protocol>
- <https://github.com/ddeboer/imap/issues/443#issuecomment-1172158902>
