<?php
include('simple_html_dom.php');
$arrContextOptions = array(
    "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
    ),
);
$url = 'https://tinhte.vn/';
$html = file_get_html($url, false, stream_context_create($arrContextOptions));

// $html->find('selector' , 'index') selector là class , index là vị trí
$posts = $html->find('0l.jsx-3834913322 li.jsx-3834913322');

// if (!empty($posts)) {
//     foreach ($posts as $item) {
//         $title = $item->find('.thread-title', 0)->plaintext;
//         echo $title . '<br/>';
//     }
// }
?>