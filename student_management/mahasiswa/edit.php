<?php
require_once '../includes/auth.php';
require_once '../includes/language.php';
require_once '../config/database.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    header('Location: index.php');
    exit;
}

// Mengambil data mahasiswa
$query = $pdo->prepare(
    "SELECT * FROM mahasiswa WHERE id = :id"
);
$query->execute(['id' => $id]);
$mahasiswa = $query->fetch(PDO::FETCH_ASSOC);

if (!$mahasiswa) {
    header('Location: index.php');
    exit;
}

$nim = $mahasiswa['nim'];
$nama = $mahasiswa['nama'];
$prodi = $mahasiswa['prodi'];
$semester = $mahasiswa['semester'];
$email = $mahasiswa['email'];
$error = '';

// Memproses perubahan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = trim($_POST['nim'] ?? '');
    $nama = trim($_POST['nama'] ?? '');
    $prodi = trim($_POST['prodi'] ?? '');
    $semester = trim($_POST['semester'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (
        $nim === '' ||
        $nama === '' ||
        $prodi === '' ||
        $semester === '' ||
        $email === ''
    ) {
        $error = translate('required_fields');
    } elseif (
        filter_var($semester, FILTER_VALIDATE_INT) === false ||
        (int) $semester < 1 ||
        (int) $semester > 14
    ) {
        $error = translate('invalid_semester');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = translate('invalid_email');
    } else {
        try {
            $query = $pdo->prepare(
                "UPDATE mahasiswa
                 SET nim = :nim,
                     nama = :nama,
                     prodi = :prodi,
                     semester = :semester,
                     email = :email
                 WHERE id = :id"
            );

            $query->execute([
                'nim' => $nim,
                'nama' => $nama,
                'prodi' => $prodi,
                'semester' => (int) $semester,
                'email' => $email,
                'id' => $id
            ]);

            header('Location: index.php');
            exit;

        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $error = translate('duplicate_nim');
            } else {
                $error = translate('update_error');
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang, ENT_QUOTES, 'UTF-8'); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars(translate('edit_student')); ?></title>

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
            max-width: 850px;
            margin: auto;
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
            max-width: 850px;
            margin: 18px auto 0;
            padding: 0 20px;
            text-align: right;
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
            max-width: 850px;
            margin: 25px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 28px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
        }

        .card h2 {
            margin-top: 0;
            color: #244b78;
        }

        .description {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #244b78;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .button {
            display: inline-block;
            padding: 11px 16px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
        }

        .button-save {
            background: #0f766e;
            color: white;
        }

        .button-save:hover {
            background: #115e59;
        }

        .button-cancel {
            background: white;
            color: #244b78;
            border: 1px solid #244b78;
        }

        .button-cancel:hover {
            background: #e2e8f0;
        }

        .footer {
            text-align: center;
            color: #64748b;
            font-size: 13px;
            padding: 20px;
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="header-content">
            <h1><?= htmlspecialchars(translate('system_name')); ?></h1>
            <p><?= htmlspecialchars(translate('student_management')); ?></p>
        </div>
    </header>

    <div class="language">
        <?= htmlspecialchars(translate('language')); ?>:

        <a href="?id=<?= (int) $id; ?>&lang=id"
           class="<?= $lang === 'id' ? 'active' : ''; ?>">
            Indonesia
        </a>

        |

        <a href="?id=<?= (int) $id; ?>&lang=en"
           class="<?= $lang === 'en' ? 'active' : ''; ?>">
            English
        </a>
    </div>

    <main class="container">

        <div class="card">

            <h2><?= htmlspecialchars(translate('edit_student')); ?></h2>

            <p class="description">
                <?= htmlspecialchars(translate('edit_description')); ?>
            </p>

            <?php if ($error !== ''): ?>
                <div class="error">
                    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="edit.php?id=<?= (int) $id; ?>">

                <div class="form-group">
                    <label for="nim">
                        <?= htmlspecialchars(translate('student_number')); ?>
                    </label>

                    <input
                        type="text"
                        id="nim"
                        name="nim"
                        value="<?= htmlspecialchars($nim, ENT_QUOTES, 'UTF-8'); ?>"
                        maxlength="20"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="nama">
                        <?= htmlspecialchars(translate('full_name')); ?>
                    </label>

                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="<?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8'); ?>"
                        maxlength="50"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="prodi">
                        <?= htmlspecialchars(translate('study_program')); ?>
                    </label>

                    <input
                        type="text"
                        id="prodi"
                        name="prodi"
                        value="<?= htmlspecialchars($prodi, ENT_QUOTES, 'UTF-8'); ?>"
                        maxlength="50"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="semester">
                        <?= htmlspecialchars(translate('semester')); ?>
                    </label>

                    <input
                        type="number"
                        id="semester"
                        name="semester"
                        value="<?= htmlspecialchars((string) $semester, ENT_QUOTES, 'UTF-8'); ?>"
                        min="1"
                        max="14"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="email">
                        <?= htmlspecialchars(translate('email')); ?>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>"
                        maxlength="50"
                        required
                    >
                </div>

                <div class="actions">
                    <button type="submit" class="button button-save">
                        <?= htmlspecialchars(translate('save_changes')); ?>
                    </button>

                    <a href="index.php" class="button button-cancel">
                        <?= htmlspecialchars(translate('cancel')); ?>
                    </a>
                </div>

            </form>

        </div>

    </main>

    <footer class="footer">
        <?= htmlspecialchars(translate('footer')); ?>
    </footer>

</body>
</html>