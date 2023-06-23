<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        h2{
            text-align: center;
        }

        .photo-gallery{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .photo-item{
            width: 25%;
            height: 200px;
            margin: 5px;
        }

        .photo-item img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="home.php" class="btn btn-outline-secondary">BACK TO HOME PAGE</a>
        <h2 style="text-align: center;">Photo Gallery</h2>
        <?
            $directory = '';
            if(isset($_COOKIE['email'])){
                $email = $_COOKIE['email'];
                $parts = explode('@', $email);
                $directory = $parts[0];
            }
            else{
                echo header('Location: menu.php');
            }
        ?>

        <div class="photo-gallery">
            <?
                $folderPath = $directory.'/';
                $photoFiles = glob($folderPath.'*.{jpg, jpeg, png, gif}', GLOB_BRACE);
                foreach($photoFiles as $file){
                    $filename = basename($file);
                    echo "<div class='photo-item'><img src='$file' alt='$filename'></div>";
                }
            ?>
        </div>

    </div>
</body>
</html>