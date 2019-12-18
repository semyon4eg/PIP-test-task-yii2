<?php

namespace app;

use GuzzleHttp\Client;
use PhpQuery\PhpQuery as phpQuery;

$client = new Client();
$res = $client->request('GET', 'https://www.ixbt.com/news/', ['query' => ['show' => 'tape']]);
$body = $res->getBody();
$document = phpQuery::newDocumentHTML($body);
$newsblock = $document->find(".newslistbig__items");

$news = $newsblock->find(".item");
foreach ($news as $new) {
    $title = '';
    $body = '';
    $categories = [];

    $pqNew = phpQuery::pq($new);

    $title = $pqNew->find(".b-article__header")->text(); //->find('a')
    
    $body = $pqNew->find(".item__text")->find('p')->text();
    
    $tags = $pqNew->find(".b-article__tags__list")->find("a");
    if (!empty($tags)) {
        foreach ($tags as $tag) {
            $pqTag = phpQuery::pq($tag)->text();
            $pqTag = trim($pqTag);
            $categories[] = $pqTag;
        }
    }

    $r = $client->request('POST', 'http://poravinternet.loc/postrests', [
        'json' => ['title' => $title,
                'body' => $body,
                'categoriesChosen' => $categories
        ]
    ]);
}
