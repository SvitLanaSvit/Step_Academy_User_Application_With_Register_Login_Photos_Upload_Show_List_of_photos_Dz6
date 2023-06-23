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
        <h2>Log in</h2>
        <form action="info.php" method="POST">
            <div class="mb-3 w-25">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3 w-25">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="btn-group">
                <button type="submit" name="submit" class="btn btn-primary">Log in</button>
                <a href="menu.php" class="btn btn-secondary">Back to menu</a>
            </div>
            
        </form>
    </div>
</body>
</html>