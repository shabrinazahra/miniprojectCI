<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        <?= isset($title) ? $title : 'Product Management'; ?>
    </title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS Custom -->
    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/product.css'); ?>">

</head>

<body>

    <!-- =========================
         NAVBAR
    ========================== -->
    <nav class="navbar app-navbar sticky-top">

        <div class="container-fluid px-4 px-lg-5">

            <!-- Logo / Brand -->
            <a href="<?= site_url('product'); ?>"
                class="navbar-brand app-brand">

                <span class="brand-icon">
                    <i class="bi bi-box-seam"></i>
                </span>

                <span class="brand-text">
                    Product Management
                </span>

            </a>

        </div>

    </nav>


    <!-- =========================
         MAIN CONTENT
    ========================== -->
    <main class="main-content">

        <div class="container-fluid px-4 px-lg-5">