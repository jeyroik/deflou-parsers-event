![tests](https://github.com/jeyroik/deflou-parsers-event/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/deflou-parsers-event/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a>
<a href="https://codeclimate.com/github/jeyroik/deflou-parsers-event/maintainability"><img src="https://api.codeclimate.com/v1/badges/3a738d9ed501152e61a5/maintainability" /></a>
<a href="https://github.com/jeyroik/extas-installer/" title="Extas Installer v3"><img alt="Extas Installer v3" src="https://img.shields.io/badge/installer-v3-green"></a>
[![Latest Stable Version](https://poser.pugx.org/jeyroik/deflou-parsers-event/v)](//packagist.org/packages/jeyroik/extas-q-crawlers)
[![Total Downloads](https://poser.pugx.org/jeyroik/deflou-parsers-event/downloads)](//packagist.org/packages/jeyroik/extas-q-crawlers)
[![Dependents](https://poser.pugx.org/jeyroik/deflou-parsers-event/dependents)](//packagist.org/packages/jeyroik/extas-q-crawlers)

# Description

Parser for using event parameters for DeFlou.

For using details see `tests`.

# example usage in a destination field

For example event has parameter:

- title: Имя пользователя
- value: Jey Roik

You can use it in this way:

`Имя пользователя: $"Имя пользователя"`

