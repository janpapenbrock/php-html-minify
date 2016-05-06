# php-html-minify

Want whitespace-free HTML for lowest page size? Save your mobile visitors some bytes from their monthly bill.

## Install

This is available via composer:

    "require": {
        "janpapenbrock/php-html-minify": "~1.0"
    }

## Usage

    $minify = new janpapenbrock\HtmlMinify\HtmlMinify();
    $minHtml = $minify->minify($html);
