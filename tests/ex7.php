<?php

require('../vendor/autoload.php');

use HeadlessChromium\BrowserFactory;

$browserFactory = new BrowserFactory();

// starts headless chrome
// $browser = $browserFactory->createBrowser();
$browser = $browserFactory->createBrowser([
    'headless' => false, // disable headless mode
]);

try {
    // creates a new page and navigate to an URL
    $page = $browser->createPage();
    $page->navigate('https://www.google.com.tw/')->waitForNavigation();

    // get page title
    $pageTitle = $page->evaluate('document.title')->getReturnValue();

    // screenshot - Say "Cheese"! 😄
    $page->screenshot()->saveToFile('./bar.png');

    // pdf
    $page->pdf(['printBackground' => false])->saveToFile('./bar.pdf');
} finally {
    // bye
    $browser->close();
}

