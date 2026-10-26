<?php
require_once 'includes/auth.php';
require_once 'includes/language.php';
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang, ENT_QUOTES, 'UTF-8'); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars(translate('dashboard')); ?></title>

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
            padding: 25px 20px;
        }

        .header-content {
            max-width: 1000px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
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
            padding: 18px 20px 0;
            max-width: 1000px;
            margin: auto;
        }

        .language a {
            color: #244b78;
            text-decoration: none;
            margin-left: 8px;
            font-size: 14px;
        }

        .language a:hover {
            text-decoration: underline;
        }

        .language .active {
            font-weight: bold;
            text-decoration: underline;
        }

        .container {
            max-width: 1000px;
            margin: 25px auto;
            padding: 0 20px;
        }

        .welcome {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
            margin-bottom: 25px;
        }

        .welcome h2 {
            margin-top: 0;
            color: #244b78;
        }

        .menu-title {
            margin-bottom: 15px;
            color: #244b78;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 20px;
        }

        .menu-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
        }

        .menu-card h3 {
            margin-top: 0;
            color: #244b78;
        }

        .menu-card p {
            color: #64748b;
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            padding: 11px 16px;
            border-radius: 5px;
            background: #244b78;
            color: white;
            text-decoration: none;
            font-size: 14px;
            border: none;
        }

        .button:hover {
            background: #193858;
        }

        .button-logout {
            background: #dc2626;
        }

        .button-logout:hover {
            background: #b91c1c;
        }

        .footer {
            text-align: center;
            color: #64748b;
            font-size: 13px;
            padding: 20px;
        }

        @media (max-width: 600px) {
            .header-content {
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="header-content">
            <div>
                <h1><?= htmlspecialchars(translate('system_name')); ?></h1>
                <p><?= htmlspecialchars(translate('system_description')); ?></p>
            </div>

            <a href="logout.php" class="button button-logout">
                <?= htmlspecialchars(translate('logout')); ?>
            </a>
        </div>
    </header>

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

    <main class="container">

        <section class="welcome">
            <h2><?= htmlspecialchars(translate('dashboard')); ?></h2>

            <p>
                <?= htmlspecialchars(translate('welcome')); ?>,
                <strong>
                    <?= htmlspecialchars($_SESSION['nama_lengkap'] ?? $_SESSION['username']); ?>
                </strong>
            </p>

            <p>
                <?= htmlspecialchars(translate('username')); ?>:
                <?= htmlspecialchars($_SESSION['username']); ?>
            </p>
        </section>

        <h2 class="menu-title">
            <?= htmlspecialchars(translate('main_menu')); ?>
        </h2>

        <section class="menu">
            <div class="menu-card">
                <h3><?= htmlspecialchars(translate('student_management')); ?></h3>

                <p>
                    <?= htmlspecialchars(translate('student_description')); ?>
                </p>

                <a href="mahasiswa/index.php" class="button">
                    <?= htmlspecialchars(translate('student_management')); ?>
                </a>
            </div>
        </section>

    </main>

    <footer class="footer">
        <?= htmlspecialchars(translate('footer')); ?>
    </footer>

</body>
</html>