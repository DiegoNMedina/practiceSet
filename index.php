<?php
/* Get all data */
include('./getPost.php');
include('./getUser.php');

//Pagination required
$postPPage = 10;

//All Post
$post = count($result['articles']);

//Cells
$pages = ceil($post / $postPPage);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <title>Practice-Set</title>
</head>
<body>
<header>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">News Practice-Set</a>
            <form class="d-flex">
                <button class="btn btn-success" type="submit">Home</button>
            </form>
        </div>
    </nav>
    </header>
    <div class="container">
        <!-- NEWS -->
        <div class="posts">
            <?php
                if(!$_GET){
                    header('Location:index.php?page=1');
                }
                $i = 0;
                $numberPost = $pages;
                $location = $_GET['page'];
                if($_GET['page'] >= 2) {
                    $i = ($postPPage * $location) - $postPPage;
                    $postPPage = $postPPage * $location;
                }
                for ($i; $i < $postPPage ; $i++) {
                    $user = getRandomUser();
                    $userName = $user['results'][0]['name']; 
                    $author = $userName['title'].' '.$userName['first'].' '.$userName['last'];
                    $title = $result['articles'][$i]['title'];
                    $content = $result['articles'][$i]['content'];
                    $datePost = $result['articles'][$i]['publishedAt'];
                    $image = $result['articles'][$i]['urlToImage'];
                    echo    '<div class="card post" style="width: 28rem;">
                                <img class="card-img-top post-img" src="'.$image.'" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">'.$title.'</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Author: '.$author.'</h6>
                                    <p class="card-text">'.$content.'</p>
                                    <h6 class="card-subtitle mb-2 text-muted">'.$datePost.'</h6>
                                </div>
                            </div>';
                }
            ?>
            <!-- PAGINATION -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php echo $_GET['page'] <= 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" 
                    href="index.php?page=<?php echo $_GET['page']-1 ?>">Previous</a>
                    </li>
                    <?php for($i=0; $i < $pages; $i++): ?>
                    <li class="page-item 
                        <?php echo $_GET['page'] == $i+1 ? 'active' : '' ?>">
                        <a class="page-link" 
                            href="index.php?page=<?php echo $i + 1?>">
                            <?php echo $i + 1; ?>
                        </a>
                    </li>
                    <?php endfor ?>
                    <li class="page-item
                    <?php echo $_GET['page'] >= $pages ? 'disabled' : ''; ?>">
                    <a class="page-link" href="index.php?page=<?php echo $_GET['page']+1?>">
                    Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</body>
</html>