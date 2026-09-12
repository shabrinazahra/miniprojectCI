<?php

/**
 * @var object $product
 * @var array $colors
 */

if (!isset($product) || !$product) {
    show_error('Data produk tidak ditemukan.');
}

if (!isset($colors) || !is_array($colors)) {
    $colors = [];
}
?>


<!-- =========================
     PAGE HEADER / BREADCRUMB
========================== -->

<div class="page-header detail-page-header">

    <div>

        <div class="page-breadcrumb">

            <a href="<?= site_url('product'); ?>">

                <i class="bi bi-box-seam"></i>

                Produk

            </a>


            <i class="bi bi-chevron-right breadcrumb-arrow"></i>


            <span>
                Detail Produk
            </span>

        </div>


        <h1 class="page-title">
            Detail Produk
        </h1>


        <p class="page-description">
            Informasi lengkap produk dan variasinya.
        </p>

    </div>

</div>


<!-- =========================
     INFORMASI PRODUK
========================== -->

<div class="product-card">

    <div class="product-card-header">

        <div>

            <span class="section-label">
                INFORMASI PRODUK
            </span>

            <h2 class="product-detail-name">
                <?= html_escape($product->product_name); ?>
            </h2>

        </div>


        <div>

            <?php if ($product->status === 'Aktif'): ?>

                <span class="status-badge status-active">

                    <i class="bi bi-check-circle-fill"></i>

                    Aktif

                </span>

            <?php else: ?>

                <span class="status-badge status-inactive">

                    <i class="bi bi-x-circle-fill"></i>

                    <?= html_escape($product->status); ?>

                </span>

            <?php endif; ?>

        </div>

    </div>


    <div class="product-info-grid">


        <!-- KODE -->

        <div class="info-item">

            <span class="info-label">

                <i class="bi bi-upc-scan"></i>

                Kode Produk

            </span>

            <span class="info-value">

                <?= html_escape($product->product_code); ?>

            </span>

        </div>


        <!-- NAMA -->

        <div class="info-item">

            <span class="info-label">

                <i class="bi bi-box-seam"></i>

                Nama Produk

            </span>

            <span class="info-value">

                <?= html_escape($product->product_name); ?>

            </span>

        </div>


        <!-- KATEGORI -->

        <div class="info-item">

            <span class="info-label">

                <i class="bi bi-tags"></i>

                Kategori

            </span>

            <span class="info-value">

                <?= html_escape($product->category); ?>

            </span>

        </div>


        <!-- HARGA -->

        <div class="info-item">

            <span class="info-label">

                <i class="bi bi-cash-stack"></i>

                Harga

            </span>

            <span class="info-value price-value">

                Rp <?= number_format(
                        $product->price,
                        0,
                        ',',
                        '.'
                    ); ?>

            </span>

        </div>

    </div>

</div>


<!-- =========================
     VARIASI PRODUK
========================== -->

<div class="product-card variation-card">

    <div class="product-card-header">

        <div>

            <span class="section-label">
                VARIASI PRODUK
            </span>

            <h2 class="section-title">
                Warna dan Ukuran
            </h2>

        </div>


        <div class="variation-count">

            <i class="bi bi-palette"></i>

            <?= count($colors); ?> warna

        </div>

    </div>


    <?php if (!empty($colors)): ?>

        <div class="variation-list">

            <?php foreach ($colors as $color): ?>

                <div class="variation-item">


                    <div class="variation-header">

                        <div class="variation-color">

                            <span class="color-icon">

                                <i class="bi bi-palette-fill"></i>

                            </span>


                            <div>

                                <span class="variation-label">
                                    Warna
                                </span>

                                <h3>
                                    <?= html_escape(
                                        $color->color_name
                                    ); ?>
                                </h3>

                            </div>

                        </div>


                        <?php if (!empty($color->sizes)): ?>

                            <span class="size-count">

                                <?= count($color->sizes); ?>

                                ukuran

                            </span>

                        <?php endif; ?>

                    </div>


                    <?php if (!empty($color->sizes)): ?>

                        <div class="table-responsive">

                            <table class="table product-table variation-table">

                                <thead>

                                    <tr>

                                        <th>
                                            Ukuran
                                        </th>

                                        <th>
                                            Stok
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    <?php foreach ($color->sizes as $size): ?>

                                        <tr>

                                            <td>

                                                <span class="size-name">

                                                    <?= html_escape(
                                                        $size->size_name
                                                    ); ?>

                                                </span>

                                            </td>


                                            <td>

                                                <?php if ((int) $size->stock > 0): ?>

                                                    <span class="stock-badge stock-available">

                                                        <i class="bi bi-box-seam"></i>

                                                        <?= (int) $size->stock; ?>
                                                        stok

                                                    </span>

                                                <?php else: ?>

                                                    <span class="stock-badge stock-empty">

                                                        <i class="bi bi-exclamation-circle"></i>

                                                        Stok habis

                                                    </span>

                                                <?php endif; ?>

                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>

                            </table>

                        </div>

                    <?php else: ?>

                        <div class="empty-variation">

                            <i class="bi bi-inbox"></i>

                            Belum ada ukuran untuk warna ini.

                        </div>

                    <?php endif; ?>

                </div>

            <?php endforeach; ?>

        </div>


    <?php else: ?>

        <div class="empty-state">

            <div class="empty-icon">

                <i class="bi bi-palette"></i>

            </div>

            <h3>
                Belum Ada Variasi
            </h3>

            <p>
                Produk ini belum memiliki variasi warna dan ukuran.
            </p>

            <a
                href="<?= site_url('product/edit/' . $product->id); ?>"
                class="btn btn-primary">

                <i class="bi bi-plus-lg"></i>

                Tambahkan Variasi

            </a>

        </div>

    <?php endif; ?>

</div>