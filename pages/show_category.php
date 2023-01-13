<?php

if (!empty($_POST)) {
    $query = "SELECT * FROM categories WHERE category_name = '$slugs[categorySlug]'";
    $categorySQL = mysqli_query($link, $query);
    $category_id = mysqli_fetch_assoc($categorySQL)['category_id'];

    $date = date("Y-m-d");
    var_dump($date);
    var_dump($category_id);
    $query = "INSERT INTO `ads`(`ad_head`, `ad_text`, `ad_date`, `category_id`) VALUES ('$_POST[head]', '$_POST[text]', '$date', $category_id)";
    mysqli_query($link, $query) or die(mysqli_error($link));
    unset($_POST);
    header("Location: $slugs[categorySlug]");
}

$category = $slugs['categorySlug'];

$query = "SELECT * FROM ads LEFT JOIN categories USING (category_id) HAVING category_name = '$category'";
$adsSQL = mysqli_query($link, $query) or die(mysqli_error($link));

for ($ads = []; $ad = mysqli_fetch_assoc($adsSQL); $ads[] = $ad);

$content = '<a class="main__return-button" href="http://board/categories">RETURN</a>';

if (empty($ads)) {
    $content .= '<p class="main_content">There is no advertisements in this category yet</p>';
} else {

    foreach ($ads as $ad) {
        $ad = "
            <article class='main__ad'>
                <h3>$ad[ad_head]</h3>
                <p>$ad[ad_text]<p>
                <time datetime='$ad[ad_date]'>$ad[ad_date]</time>
            </article>
        ";
        $content .= $ad;
    }
}

$form = "
    <form action='' method='POST' class='main__form form'>
        <input name='head' placeholder='Input ad head' class='form__head'>
        <textarea name='text' placeholder='Input ad text here' class='form__text'></textarea>
        <input type='submit' value='SUBMIT' class='form__submit'>
    </form>
";

$content .= $form;

return [
    'title' => $category . ' ads',
    'content' => $content,
    'css' => 'http://board/css/category.css'
]
?>