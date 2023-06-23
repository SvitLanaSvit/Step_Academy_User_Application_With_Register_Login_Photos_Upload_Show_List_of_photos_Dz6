<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>INFO</h2> 
        <?
            $users = [];
            $filepath = 'users.txt';
            if(isset($_POST['submit'])){
                $email = $_POST['email'];
                $password = $_POST['password'];

                if(file_exists($filepath)){
                    $users = ReadFromFile($filepath);

                    if(count($users) > 0){
                        $isUserMatch = false;

                        foreach($users as $user){
                            $userArray = explode(':', $user);
                            $isPasswordMatch = verifyPassword($password, $userArray[2]);
                            if($email === $userArray[1] && $isPasswordMatch){
                                $isUserMatch = true;
                                break;
                            }
                        }

                        if($isUserMatch){
                            setcookie("email", "$email", time() + (60 * 60 * 2), "/", "", 0, 0 );
                            echo "<div style='color: green;'>You have successfully passed the verification</div>";
                                    echo "<script>
                                            setTimeout(()=>{
                                                location = 'home.php';
                                            }, 2000)
                                        </script>";
                        }
                        else{
                            echo "<div style='color: red;'>Email or password are not correct!</div>";
                            echo "<script>
                                    setTimeout(()=>{
                                        location = 'login.php';
                                    }, 2000)
                                </script>";
                        }
                    }   
                }
            }

            function readFromFile($filepath){
                $users = [];

                $fd = fopen($filepath, 'r') or die("The file is not found!");
                while(!feof($fd)){
                    $str = fgets($fd);
                    $user = trim($str);
                    if(!empty($user)){
                        $users[] = $user;
                    }
                }

                return $users;
            }

            function verifyPassword($password, $hashedPassword){
            return password_verify($password, $hashedPassword);
            }
        ?>
    </div>
</body>
</html>