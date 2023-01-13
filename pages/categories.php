<?php
    #⊗ppPmSDPrm №1
$query = "SELECT * FROM categories";
$categoriesSQL = mysqli_query($link, $query) or die(mysqli_error($link));

for ($categories = []; $category = mysqli_fetch_assoc($categoriesSQL); $categories[] = $category);

$content = '<ul class="main__category-list">';

foreach ($categories as $category) {
    $category_show = strtoupper($category['category_name']);
    $content .= "<li><a class='main__category-link' href='categories/$category[category_name]'>$category_show</a></li>";
}

$content .= '</ul>';

return [
    'title' => 'Categories',
    'content' => $content,
    'css' => 'http://board/css/categories.css'
];

?>