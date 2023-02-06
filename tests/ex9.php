<?php

require('../vendor/autoload.php');

use HeadlessChromium\BrowserFactory;
use HeadlessChromium\Input\Mouse;
use HeadlessChromium\Dom\Dom;

$browserFactory = new BrowserFactory();

$width = 1920;
$height = 1080;

// starts headless chrome
$browser = $browserFactory->createBrowser([
    'headless' => false, // disable headless mode
    'windowSize' => [$width, $height],
    'enableImages' => true,
]);


try {
    // creates a new page and navigate to an URL
    $page = $browser->createPage();
    $page->navigate('https://www.google.com.tw/')->waitForNavigation();

    $rand = sRandomString('', 32);
    // $page->setUserAgent('ua '.$rand.' user-agent ');
    $page->setUserAgent('Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:109.0) Gecko/20100101 Firefox/109.0');


    // $elem = $page->dom()->querySelector('#gb');

    // $elem->querySelectorAll('input.q');



    // $elem->click();

    // $page->mouse()
    //     ->move(10,20)
    //     ->click()
    //     ->move(100, 200, ['steps' => 5])
    //     ->scrollDown(100) // scroll down 100px
    //     ->scrollUp(50)    // scroll up 50px
    //     ->click(['button' => Mouse::BUTTON_RIGHT]);

    // $page->mouse()->find('#gb')->click(); // find and click at an element with id "a"

    $page->keyboard()
    // ->typeRawKey('Tab') // type a raw key, such as Tab
    ->typeText('dcard');
    // ->press('Enter');  // type the text "bar"

    $page->mouse()->scrollDown(50)->click();

sleep(3);
// $page->waitForReload();

    $elem = $page->dom()->querySelector('body');
    $elem->querySelectorAll('input.btnK');
    $elem->click();

    $page->waitForReload();

    $rand = sRandomString('', 32);
    
    // $page->setUserAgent('my '.$rand.' user-agent ');
    $page->setUserAgent('Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:109.0) Gecko/20100101 Firefox/109.0');


sleep(5);

    $page->mouse()->find('h3')->click();

    $page->waitForReload();

sleep(5);

    $page->mouse()
        ->move(10,20)
        ->click()
        ->move(100, 200, ['steps' => 5])
        ->scrollUp(50)   // scroll up 50px
        ->scrollDown(1900) // scroll down 100px
        ->scrollDown(567) // scroll down 100px
        ->scrollDown(456) // scroll down 100px
        ->scrollDown(546) // scroll down 100px
        ->scrollDown(646) // scroll down 100px
        ->scrollDown(856) // scroll down 100px
        ->scrollDown(547); // scroll down 100px
        // ->click(['button' => Mouse::BUTTON_RIGHT]);


    $page->mouse()
        ->scrollUp(234)
        ->scrollUp(685)
        ->scrollUp(675)
        ->scrollUp(768)
        ->scrollUp(563)
        ->scrollUp(456);

    $rand = sRandomString('', 32);
    // $page->setUserAgent('my '.$rand.' user-agent ');
    $page->setUserAgent('Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:109.0) Gecko/20100101 Firefox/109.0');


    $page->navigate('https://www.dcard.tw/f/makeup?latest=true')->waitForNavigation();
    // $page->navigate('https://www.dcard.tw/f/3c?latest=true')->waitForNavigation();
    // $page->navigate('https://www.dcard.tw/f/girl?latest=true')->waitForNavigation();
    // $page->navigate('h1ttps://www.dcard.tw/f/orthodontics?latest=true')->waitForNavigation();
    // $page->navigate('https://www.dcard.tw/f/facelift?latest=true')->waitForNavigation();

sleep(1);

   $page->mouse()
        ->scrollUp(50)   // scroll up 50px
        ->scrollDown(570) // scroll down 100px
        ->scrollDown(567) // scroll down 100px
        ->scrollDown(456) // scroll down 100px
        ->scrollDown(546) // scroll down 100px
        ->scrollDown(646) // scroll down 100px
        ->scrollDown(856) // scroll down 100px
        ->scrollDown(547) // scroll down 100px
        ->scrollDown(547) // scroll down 100px
        ->scrollDown(147) // scroll down 100px
        ->scrollDown(117) // scroll down 100px
        ->scrollDown(117) // scroll down 100px
        ->scrollDown(127) // scroll down 100px
        ->scrollDown(147) // scroll down 100px
        ->scrollDown(647); // scroll down 100px


    // get page title
    $pageTitle = $page->evaluate('document.title')->getReturnValue();
echo "title1234 = $pageTitle\n";


// evaluate script in the browser
$evaluation = $page->evaluate('document.documentElement.innerHTML');

// wait for the value to return and get it
$value = $evaluation->getReturnValue();

// echo "value=$value\n";


$aTitle = extraTitle('/<h2 .*?><a .*?><span>(.*?)<\/span><\/a>/i', $value);

$aLink = extraTitle('/<h2 .*?><a class=".*?" href="(.*?)" style=".*?"><span>.*?<\/span><\/a>/i', $value);



echo "<pre>";print_r($aTitle);echo "</pre>";
// echo "<pre>";print_r($aLink);echo "</pre>";

foreach($aLink as $str){
    echo "https://www.dcard.tw".$str."\r\n";
}

// log2file('ddd.txt', $value);

// $page->waitForReload();


    // screenshot - Say "Cheese"! 😄
    $page->screenshot()->saveToFile('./bar.png');

    // // pdf
    // $page->pdf(['printBackground' => false])->saveToFile('./bar.pdf');
} catch (\ElementNotFoundException $exception) {
    // element not found
    echo $exception->getMessage();

} catch (\Exception $ex){
    echo $ex->getMessage();
} finally {
    // bye
    $browser->close();
}


function extraTitle($pattern, $document) {
    preg_match_all($pattern, $document, $match);
    // echo "<pre>";print_r($match);echo "</pre>";exit;
    return $match[1];
}


function sRandomString($sString,$sNum){ //(字元,回傳幾位)
    if(strlen($sString)==0){
        $s="ABCDEFGHJKMNPQRSTUVWXYZ";
        $s.="abcdefghjkmnpqrstuvwxyz";
        $s.="23456789";
    } else {
        $s=$sString;
    }
    $rs = '';
    $aTemp = str_split($s);
    for($i=0;$i<$sNum;$i++){
        $rs .= $aTemp[rand(0,strlen($s)-1)];
    }
    return $rs;
}

function log2file($filename, $contents) {
    file_put_contents($filename, $contents);
}