<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="styles/materialize.min.css">
    <link rel="stylesheet" href="styles/styles.min.css">
</head>
<body>

<div class="auth-block">
    <div class="card">
        <form method="POST" action="script.php">
            <div class="card-content">
                <div class="input-field">
                    <input id="text" type="text" name="teamName" required>
                    <label for="text">Название команды</label>
                </div>
            </div>
            <div class="card-action">
                <button class="modal-action btn waves-effect" name="submit">Получить результаты</button>
            </div>
        </form>
    </div>
</div>

<script src="scripts/materialize.min.js"></script>
<script src="scripts/scripts.js"></script>
</body>
</html>