<?php

include('simple_html_dom.php');
// Kết nối tới cơ sở dữ liệu MySQL
$username = 'root';
$password = '';
$database = 'demo';
try {
  $conn = new PDO('mysql:host=localhost;dbname=' . $database, $username, $password);

} catch (Exception $e) {
  echo $e->getMessage();
  //   echo 'không kết nối được CSDL';
}

// Truy cập vào trang tinhte.vnZ
$url = 'https://tinhte.vn/';
$html = file_get_html($url);
/*Đọc toàn bộ nội dung HTML của một trang web*/
// echo $html;
 
//===========================================================================================================

/*Hiển thị tất cả các ảnh từ trang cần lấy */
// $base_url = $url_parsed = parse_url($url)['scheme'] . '://' . parse_url($url)['host']; //Trích xuất URL cơ sở từ URL của trang web
// foreach ($html->find('img') as $element) { //Lặp qua tất cả các phần tử <img> trong HTML
//     $image_src = $element->src; //Lấy thuộc tính src của phần tử <img>
//     if (strpos($image_src, '/') === 0) { //Nếu đường dẫn hình ảnh là tương đối
//         $image_src = $base_url . $image_src; //Thêm URL cơ sở để tạo URL hoàn chỉnh cho hình ảnh
//     }
//     $image_width = '500px';
//     $image_height = '300px';

//     echo '<img src="' . $image_src . '" style="width: ' . $image_width . '; height: ' . $image_height . ';" /><br><br>'; //hiển thị ảnh trên trang web
// }

//===========================================================================================================

//Hiển thị tất cả các link trong bài viết.
// foreach ($html->find('a') as $element)
//     echo $element->href . '<br>';

//===========================================================================================================

// //Lấy nội dung từ một id cụ thể.
// $noidung = $html->find('#jumpToTop', 0);
// echo $noidung;

//===========================================================================================================

// //lấy phần tử trong một phần tử
// $thuoctinh = $html->find('#properties', 0)->find('li');
 //foreach ($thuoctinh as $e) {
//     echo $e->plaintext;
// }
// ;

//===========================================================================================================


//thay đổi nội dung của một trang trước khi xuất dữ liệu ra
// $html->find('body', 0)->outertext = '';
// echo $html;

//===========================================================================================================


// //Lấy nội dung từ class  
$noidung = $html->find('li.jsx-934348644');
// // echo $noidung;

// // Lặp qua từng bài viết và lấy thông tin

$posts = [];
foreach ($noidung as $post) {
  $title = $post->find('.thread-title', 0) ? $post->find('.thread-title', 0)->innertext : '';
  $content = $post->find('.excerpt', 0) ? $post->find('.excerpt', 0)->innertext : '';
  $author = $post->find('.author', 0) ? $post->find('.author', 0)->innertext : '';

  if($title == ''){
    continue;
  }

  $posts[] = [
    'title' => $title,
    'content' => $content,
    'author' => $author,
  ];

}
foreach ($posts as $post) {
  $title = $post['title'];
  $content = $post['content'];
  $author = $post['author'];
  // Thực hiện câu truy vấn INSERT để lưu thông tin vào cơ sở dữ liệu
  $sql = "INSERT INTO posts ( title, content ,author) VALUES ('$title', '$content', '$author')";
  try {
    $conn->query($sql);
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}
?>