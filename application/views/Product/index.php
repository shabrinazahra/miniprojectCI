<!-- =========================
     PAGE HEADER
========================== -->
<div class="page-header">

    <div>
        <h1 class="page-title">
            Daftar Produk
        </h1>

        <p class="page-description">
            Kelola data produk yang tersedia di sistem.
        </p>
    </div>

</div>


<!-- =========================
     FLASH MESSAGE
========================== -->

<?php if ($this->session->flashdata('success')) : ?>

    <div class="alert alert-success custom-alert" role="alert">

        <i class="bi bi-check-circle-fill"></i>

        <span>
            <?= html_escape($this->session->flashdata('success')); ?>
        </span>

    </div>

<?php endif; ?>


<?php if ($this->session->flashdata('error')) : ?>

    <div class="alert alert-danger custom-alert" role="alert">

        <i class="bi bi-exclamation-circle-fill"></i>

        <span>
            <?= html_escape($this->session->flashdata('error')); ?>
        </span>

    </div>

<?php endif; ?>


<!-- =========================
     PRODUCT CARD
========================== -->
<div class="product-card">

    <!-- =========================
         CARD HEADER
    ========================== -->
    <div class="product-card-header">

        <div>

            <h5 class="product-card-title">
                Data Produk
            </h5>

            <p class="product-card-subtitle">
                Daftar produk yang tersimpan
            </p>

        </div>


        <!-- SATU-SATUNYA TOMBOL TAMBAH PRODUK -->
        <a
            href="<?= site_url('product/create'); ?>"
            class="btn btn-primary add-product-btn">

            <i class="bi bi-plus-lg"></i>

            <span>
                Tambah Produk
            </span>

        </a>

    </div>


    <!-- =========================
         SEARCH
    ========================== -->
    <div class="product-toolbar">

        <div class="search-box">

            <i class="bi bi-search search-icon"></i>

            <input
                type="text"
                id="productSearch"
                class="form-control search-input"
                placeholder="Cari produk..."
                autocomplete="off">

        </div>

    </div>


    <!-- =========================
         TABLE
    ========================== -->
    <div class="table-responsive">

        <table
            class="table product-table"
            id="productTable">

            <thead>

                <tr>

                    <th class="text-center column-number">
                        No
                    </th>

                    <th>
                        Kode Produk
                    </th>

                    <th>
                        Nama Produk
                    </th>

                    <th>
                        Kategori
                    </th>

                    <th>
                        Harga
                    </th>

                    <th class="text-center">
                        Status
                    </th>

                    <th class="text-center column-action">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                <?php if (!empty($products)) : ?>

                    <?php $no = 1; ?>

                    <?php foreach ($products as $product) : ?>

                        <tr>

                            <!-- =========================
                                 NOMOR
                            ========================== -->
                            <td class="text-center product-number">

                                <?= $no++; ?>

                            </td>


                            <!-- =========================
                                 KODE PRODUK
                            ========================== -->
                            <td>

                                <span class="product-code">

                                    <?= html_escape(
                                        $product->product_code
                                    ); ?>

                                </span>

                            </td>


                            <!-- =========================
                                 NAMA PRODUK
                            ========================== -->
                            <td>

                                <div class="product-name">

                                    <?= html_escape(
                                        $product->product_name
                                    ); ?>

                                </div>

                            </td>


                            <!-- =========================
                                 KATEGORI
                            ========================== -->
                            <td>

                                <?php if (!empty($product->category)) : ?>

                                    <?= html_escape(
                                        $product->category
                                    ); ?>

                                <?php else : ?>

                                    <span class="text-muted">
                                        -
                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- =========================
                                 HARGA
                            ========================== -->
                            <td>

                                <span class="product-price">

                                    Rp
                                    <?= number_format(
                                        (float) $product->price,
                                        0,
                                        ',',
                                        '.'
                                    ); ?>

                                </span>

                            </td>


                            <!-- =========================
                                 STATUS
                            ========================== -->
                            <td class="text-center">

                                <?php
                                $status = isset($product->status)
                                    ? strtolower(
                                        trim(
                                            (string) $product->status
                                        )
                                    )
                                    : '';
                                ?>

                                <?php if (
                                    $status === '1' ||
                                    $status === 'aktif'
                                ) : ?>

                                    <span class="status-badge status-active">

                                        <span class="status-dot"></span>

                                        Aktif

                                    </span>

                                <?php else : ?>

                                    <span class="status-badge status-inactive">

                                        <span class="status-dot"></span>

                                        Tidak Aktif

                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- =========================
                                 AKSI
                            ========================== -->
                            <td class="text-center">

                                <div class="action-buttons">

                                    <!-- DETAIL -->
                                    <a
                                        href="<?= site_url(
                                                    'product/detail/' . $product->id
                                                ); ?>"
                                        class="action-btn action-detail"
                                        title="Detail">

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    <!-- EDIT -->
                                    <a
                                        href="<?= site_url(
                                                    'product/edit/' . $product->id
                                                ); ?>"
                                        class="action-btn action-edit"
                                        title="Edit">

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    <!-- HAPUS -->
                                    <a
                                        href="<?= site_url(
                                                    'product/delete/' . $product->id
                                                ); ?>"
                                        class="action-btn action-delete"
                                        title="Hapus">

                                        <i class="bi bi-trash"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else : ?>

                    <!-- =========================
                         EMPTY STATE
                    ========================== -->
                    <tr id="emptyProductRow">

                        <td colspan="7">

                            <div class="empty-state">

                                <div class="empty-icon">

                                    <i class="bi bi-box-seam"></i>

                                </div>

                                <h6>
                                    Belum ada produk
                                </h6>

                                <p>
                                    Data produk belum tersedia.
                                    Silakan tambahkan produk baru melalui tombol
                                    <strong>Tambah Produk</strong> di atas.
                                </p>

                            </div>

                        </td>

                    </tr>

                <?php endif; ?>


                <!-- =========================
                     SEARCH EMPTY STATE
                ========================== -->
                <tr
                    id="noSearchResult"
                    style="display: none;">

                    <td colspan="7">

                        <div class="search-empty-state">

                            <i class="bi bi-search"></i>

                            <p>
                                Produk yang dicari tidak ditemukan.
                            </p>

                        </div>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>