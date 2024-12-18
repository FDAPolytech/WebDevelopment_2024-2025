<?php

require __DIR__ . '/../config.php';
require __DIR__ .'/../data/product.php';
require __DIR__ .'/../data/category.php';

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    http_response_code(404);
    exit;
}

$search =      isset($_GET['search'])   ? $_GET['search']   : null;
$category_id = isset($_GET['category']) ? $_GET['category'] : null;

$offset =   isset($_GET[''])      ? $_GET['']      : 0;
$limit =    isset($_GET['limit']) ? $_GET['limit'] : 30;

$productRepository = new ProductRepository($pdo);
$products = [];

if ($search && $category_id && $category_id != 'all') {
    $products = $productRepository->getBySearchWithCategoryId($search, $category_id, $offset, $limit);
} else if ($category_id && $category_id != 'all') {
    $products = $productRepository->getByCategoryId($category_id, $offset, $limit);
} else if ($search) {
    $products = $productRepository->getBySearch($search, $offset, $limit);
} else {
    $products = $productRepository->getAll($offset, $limit);
}

$categoryRepository = new CategoryRepository($pdo);
$categories = $categoryRepository->getAll();

shuffle($products);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <?php require __DIR__ . '/partials/navigation.php'; ?>

    <form id="searchbar">
        <span id="search-wrapper">
            <select>
                <option value="all">All categories</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category->id ?>" <?php echo $category->id == $category_id ? 'selected' : '' ?>>
                        <?php echo $category->name ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="text" placeholder="Search for products..." value="<?php echo $search ?>">
        </span>
        
        <button type="submit">
            <img src="/img/search-icon.svg" alt="Search">
        </button>
    </form>

    <?php require __DIR__ . '/partials/products.php'; ?>
    
    <script src="/js/search.js"></script>
</body>
</html>
