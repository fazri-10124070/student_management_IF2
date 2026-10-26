<?php
session_start();

require_once 'config/database.php';
require_once 'includes/language.php';


if (isset($_SESSION['user_id'])) {
    header('Location: admin.php');
    exit;
}

$error = '';

// Memproses form login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = translate('empty_login');
    } else {
        $query = $pdo->prepare(
            "SELECT * FROM users WHERE username = :username LIMIT 1"
        );

        $query->execute([
            'username' => $username
        ]);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

            header('Location: admin.php');
            exit;
        } else {
            $error = translate('login_error');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang, ENT_QUOTES, 'UTF-8'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars(translate('login_title')); ?></title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .header {
            background: #244b78;
            color: white;
            padding: 22px 15px;
            text-align: center;
        }

        .header h1 {
            margin: 0 0 8px;
            font-size: 25px;
        }

        .header p {
            margin: 0;
            font-size: 14px;
        }

        .language {
            text-align: right;
            max-width: 420px;
            margin: 20px auto 0;
            padding: 0 20px;
            font-size: 14px;
        }

        .language a {
            color: #244b78;
            text-decoration: none;
            margin-left: 8px;
        }

        .language a:hover {
            text-decoration: underline;
        }

        .language .active {
            font-weight: bold;
            text-decoration: underline;
        }

        .container {
            max-width: 420px;
            margin: 20px auto 40px;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .card h2 {
            margin-top: 0;
            margin-bottom: 25px;
            text-align: center;
            color: #244b78;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 11px;
            margin-bottom: 18px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #244b78;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background: #244b78;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background: #193858;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            color: #64748b;
            font-size: 13px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1><?= htmlspecialchars(translate('system_name')); ?></h1>
        <p><?= htmlspecialchars(translate('system_description')); ?></p>
    </div>

    <div class="language">
        <?= htmlspecialchars(translate('language')); ?>:

        <a href="?lang=id"
           class="<?= $lang === 'id' ? 'active' : ''; ?>">
            Indonesia
        </a>

        |
        
        <a href="?lang=en"
           class="<?= $lang === 'en' ? 'active' : ''; ?>">
            English
        </a>
    </div>

    <div class="container">
        <div class="card">

            <h2><?= htmlspecialchars(translate('login_title')); ?></h2>

            <?php if ($error !== ''): ?>
                <div class="error">
                    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="login.php">

                <label for="username">
                    <?= htmlspecialchars(translate('username')); ?>
                </label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    required
                    autocomplete="username"
                >

                <label for="password">
                    <?= htmlspecialchars(translate('password')); ?>
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    autocomplete="current-password"
                >

                <button type="submit">
                    <?= htmlspecialchars(translate('login_button')); ?>
                </button>

            </form>

        </div>

        <div class="footer">
            <?= htmlspecialchars(translate('footer')); ?>
        </div>
    </div>

</body>
</html>