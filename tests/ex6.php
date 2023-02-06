<?php

require('../vendor/autoload.php');

use HeadlessChromium\BrowserFactory;

$browserFactory = new BrowserFactory();

$browserFactory->setOptions([
    'windowSize' => [1920, 1000],
]);

// both browser will have the same 'windowSize' option
$browser1 = $browserFactory->createBrowser();
$browser2 = $browserFactory->createBrowser();

$browserFactory->addOptions(['enableImages' => false]);

// this browser will have both the 'windowSize' and 'enableImages' options
$browser3 = $browserFactory->createBrowser();

$browserFactory->addOptions(['enableImages' => true]);

// this browser will have the previous 'windowSize', but 'enableImages' will be true
$browser4 = $browserFactory->createBrowser();

try {
    // creates a new page and navigate to an URL
    $page = $browser4->createPage();
    $page->navigate('http://example.com')->waitForNavigation();

    // get page title
    $pageTitle = $page->evaluate('document.title')->getReturnValue();

    // screenshot - Say "Cheese"! 😄
    $page->screenshot()->saveToFile('./bar.png');

    // pdf
    $page->pdf(['printBackground' => false])->saveToFile('./bar.pdf');
} finally {
    // bye
    $browser4->close();
}