# php-html-minify

Want whitespace-free HTML for lowest page size? Save your mobile visitors some bytes from their monthly bill.

## Install

This is available via composer:

    "require": {
        "janpapenbrock/php-html-optimization": "~1.0"
    }

## Usage

    $optimizer = new janpapenbrock\HtmlOptimization\Optimizer();
    $minHtml = $optimizer->optimize($html);
