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
        <h2 style="text-align: center;">MENU</h2>
        <div class="btn-group">
            <a href="register.php" class="btn btn-outline-info">Register</a>
            <a href="login.php" class="btn btn-outline-success">Log in</a>
        </div>
    </div>

    <?
        class User {
            public $username;
            public $email;
            public $password;
        
            function __construct($username, $email, $password) {
                $this->username = $username;
                $this->email = $email;
                $this->password = $password;
            }
        }

        $filepath = 'users.txt';

        // if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userToWrite = new User($username, $email, $password);

            $usersFromFile = [];
            $isUserExists = false;

            if(file_exists($filepath)){
                $usersFromFile = readFromFile($filepath);

                foreach($usersFromFile as $user){
                    $userArray = explode(":", $user);

                    for($i = 0; $i < count($userArray); $i++){
                        if($username === $userArray[0] && $email === $userArray[1] || $email === $userArray[1]){
                            echo "<div style='color: red;'>This user is already registred!</div>";
                            $isUserExists = true;
                            echo "<script>
                                    setTimeout(()=>{
                                        location = 'login.php';
                                    }, 1500)
                                </script>";
                            break;
                        }
                    }
                }
            }

            if(!$isUserExists){
                writeToFile($filepath, $userToWrite);
                echo "<script>
                        setTimeout(()=>{
                            location = 'login.php';
                        }, 3000)
                    </script>";
            }
        }

        function readFromFile($filepath){
            $users = [];
            
            $fd = fopen($filepath, 'r') or die("File not found!");
            while(!feof($fd)){
                $str = fgets($fd);
                $user = trim($str);
                if(!empty($user)){
                    $users[] = $user;
                }
            }
            fclose($fd);
            return $users;
        }

        function writeToFile($filepath, $user){
            $fd = fopen($filepath, "a+") or die("Unable to create file!");
            $hashedPassword = hashPassword($user->password);
            $str = "$user->username:$user->email:$hashedPassword";
            fwrite($fd, $str . PHP_EOL);
            fclose($fd);
            echo "<div class='info' style='color: green; text-align: center'>Registration was successful!</div>";
        }

        function hashPassword($password){
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            return $hashedPassword;
        }
    ?>
</body>
</html>