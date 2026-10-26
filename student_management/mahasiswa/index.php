<?php
require_once '../includes/auth.php';
require_once '../includes/language.php';
require_once '../config/database.php';

$query = $pdo->query("SELECT * FROM mahasiswa ORDER BY id DESC");
$mahasiswa = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang, ENT_QUOTES, 'UTF-8'); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars(translate('student_list')); ?></title>

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
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
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
            max-width: 1200px;
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
            max-width: 1200px;
            margin: 25px auto;
            padding: 0 20px;
        }

        .top-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .top-actions h2 {
            margin: 0;
            color: #244b78;
        }

        .button {
            display: inline-block;
            padding: 10px 14px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 14px;
            cursor: pointer;
        }

        .button-add {
            background: #244b78;
        }

        .button-add:hover {
            background: #193858;
        }

        .button-edit {
            background: #0f766e;
        }

        .button-edit:hover {
            background: #115e59;
        }

        .button-delete {
            background: #dc2626;
        }

        .button-delete:hover {
            background: #b91c1c;
        }

        .button-dashboard {
            background: white;
            color: #244b78;
            border: 1px solid #244b78;
        }

        .button-dashboard:hover {
            background: #e2e8f0;
        }

        .description {
            margin-bottom: 20px;
            color: #64748b;
            line-height: 1.6;
        }

        .table-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
            white-space: nowrap;
        }

        th {
            background: #244b78;
            color: white;
        }

        tr:hover td {
            background: #f8fafc;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .empty {
            text-align: center;
            padding: 25px;
            color: #64748b;
        }

        .footer {
            text-align: center;
            color: #64748b;
            font-size: 13px;
            padding: 20px;
        }

        @media (max-width: 600px) {
            .header h1 {
                font-size: 21px;
            }

            .table-card {
                padding: 10px;
            }
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="header-content">
            <div>
                <h1><?= htmlspecialchars(translate('system_name')); ?></h1>
                <p><?= htmlspecialchars(translate('student_management')); ?></p>
            </div>

            <a href="../admin.php" class="button button-dashboard">
                <?= htmlspecialchars(translate('back_dashboard')); ?>
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

        <div class="top-actions">
            <h2><?= htmlspecialchars(translate('student_list')); ?></h2>

            <a href="tambah.php" class="button button-add">
                + <?= htmlspecialchars(translate('add_student')); ?>
            </a>
        </div>

        <p class="description">
            <?= htmlspecialchars(translate('student_description')); ?>
        </p>

        <div class="table-card">

            <?php if (count($mahasiswa) > 0): ?>

                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th><?= htmlspecialchars(translate('student_number')); ?></th>
                            <th><?= htmlspecialchars(translate('full_name')); ?></th>
                            <th><?= htmlspecialchars(translate('study_program')); ?></th>
                            <th><?= htmlspecialchars(translate('semester')); ?></th>
                            <th><?= htmlspecialchars(translate('email')); ?></th>
                            <th><?= htmlspecialchars(translate('created_at')); ?></th>
                            <th><?= htmlspecialchars(translate('actions')); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>

                        <?php foreach ($mahasiswa as $mhs): ?>
                            <tr>
                                <td><?= $no++; ?></td>

                                <td>
                                    <?= htmlspecialchars($mhs['nim'], ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($mhs['nama'], ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($mhs['prodi'], ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($mhs['semester'], ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($mhs['email'], ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($mhs['created_at'], ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <td>
                                    <div class="actions">
                                        <a
                                            href="edit.php?id=<?= (int) $mhs['id']; ?>"
                                            class="button button-edit"
                                        >
                                            <?= htmlspecialchars(translate('edit_student')); ?>
                                        </a>

                                        <form
                                            action="hapus.php"
                                            method="POST"
                                            onsubmit="return confirm('<?= $lang === 'en' ? 'Are you sure you want to delete this student?' : 'Apakah Anda yakin ingin menghapus data mahasiswa ini?'; ?>');"
                                        >
                                            <input
                                                type="hidden"
                                                name="id"
                                                value="<?= (int) $mhs['id']; ?>"
                                            >

                                            <button
                                                type="submit"
                                                class="button button-delete"
                                            >
                                                <?= htmlspecialchars(translate('delete_student')); ?>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php else: ?>

                <div class="empty">
                    <?= htmlspecialchars(translate('empty_data')); ?>
                </div>

            <?php endif; ?>

        </div>

    </main>

    <footer class="footer">
        <?= htmlspecialchars(translate('footer')); ?>
    </footer>

</body>
</html>