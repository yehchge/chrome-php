<?php

require('../vendor/autoload.php');

use HeadlessChromium\BrowserFactory;

$browserFactory = new BrowserFactory();

// starts headless chrome
$browser = $browserFactory->createBrowser([
    'headless' => false, // disable headless mode
    'windowSize'   => [1920, 1000],
    'enableImages' => false,
    // 'connectionDelay' => 0.8,            // add 0.8 second of delay between each instruction sent to chrome,
    // 'debugLogger'     => 'php://stdout', // will enable verbose mode
]);

try {
    // creates a new page and navigate to an URL
    $page = $browser->createPage();
    $page->navigate('http://example.com')->waitForNavigation();

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