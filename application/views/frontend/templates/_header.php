<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        body {
            background-color: #f4f7f6;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4">
        <div class="container">
            <a class="navbar-brand font-weight-bold text-primary" href="<?= base_url() ?>">
                <i class="fas fa-hospital-symbol"></i> RS Sehat Selalu
            </a>
            <?php if (current_user()): ?>
                <div class="ml-auto">
                    <span class="navbar-text mr-3">Halo, <strong><?= current_user()->nama_lengkap; ?></strong></span>
                    <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm">Logout</a>
                </div>
            <?php endif; ?>
        </div>
    </nav>
    <div class="container">