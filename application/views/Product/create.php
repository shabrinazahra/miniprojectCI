<div class="page-header create-page-header">

    <div>
        <div class="page-breadcrumb">
            <a href="<?= site_url('product'); ?>">
                <i class="bi bi-box-seam"></i>
                Produk
            </a>

            <i class="bi bi-chevron-right"></i>

            <span>Tambah Produk</span>
        </div>

        <h1 class="page-title">
            Tambah Produk
        </h1>


        <p class="page-description">
            Tambahkan produk beserta variasi warna, ukuran, dan stok.
        </p>

        <p class="form-required-info">
            <i class="bi bi-info-circle"></i>
            Semua field bertanda <strong>*</strong> wajib diisi dan tidak boleh kosong.
        </p>

        <p class="page-description">
            Tambahkan produk beserta variasi warna, ukuran, dan stok.
        </p>
    </div>

</div>


<!-- =========================
     VALIDATION ERROR
========================== -->

<?php if (validation_errors()) : ?>

    <div class="alert alert-danger custom-alert" role="alert">

        <i class="bi bi-exclamation-circle-fill"></i>

        <div>
            <?= validation_errors(); ?>
        </div>

    </div>

<?php endif; ?>


<!-- =========================
     FORM CARD
========================== -->

<div class="create-card">

    <form
        action="<?= site_url('product/create'); ?>"
        method="post">


        <!-- =========================
             INFORMASI PRODUK
        ========================== -->

        <div class="form-section">

            <div class="section-heading">

                <div class="section-icon">
                    <i class="bi bi-box"></i>
                </div>

                <div>
                    <h2>
                        Informasi Produk
                    </h2>

                    <p>
                        Masukkan informasi utama produk.
                    </p>
                </div>

            </div>


            <div class="form-grid">

                <!-- Kode Produk -->
                <div class="form-group">

                    <label for="product_code">
                        Kode Produk
                        <span class="required">*</span>
                    </label>

                    <div class="input-wrapper">

                        <i class="bi bi-upc-scan"></i>

                        <input
                            type="text"
                            id="product_code"
                            name="product_code"
                            value="<?= set_value('product_code'); ?>"
                            data-product-id=""
                            data-check-url="<?= site_url('product/check_code'); ?>"
                            placeholder="Contoh: KS-003"
                            required>

                    </div>

                    <div
                        id="code-message"
                        class="input-message">
                    </div>

                </div>


                <!-- Nama Produk -->
                <div class="form-group">

                    <label for="product_name">
                        Nama Produk
                        <span class="required">*</span>
                    </label>

                    <div class="input-wrapper">

                        <i class="bi bi-tag"></i>

                        <input
                            type="text"
                            id="product_name"
                            name="product_name"
                            value="<?= set_value('product_name'); ?>"
                            placeholder="Contoh: Kaos Oversize"
                            required>

                    </div>

                </div>


                <!-- Kategori -->
                <div class="form-group">

                    <label for="category">
                        Kategori
                        <span class="required">*</span>
                    </label>

                    <div class="input-wrapper">

                        <i class="bi bi-grid"></i>

                        <input
                            type="text"
                            id="category"
                            name="category"
                            value="<?= set_value('category'); ?>"
                            placeholder="Contoh: Pakaian Pria"
                            required>

                    </div>

                </div>


                <!-- Harga -->
                <div class="form-group">

                    <label for="price">
                        Harga
                        <span class="required">*</span>
                    </label>

                    <div class="input-wrapper">

                        <span class="input-prefix">
                            Rp
                        </span>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            value="<?= set_value('price'); ?>"
                            placeholder="75000"
                            min="0"
                            required>

                    </div>

                </div>


                <!-- Status -->
                <div class="form-group">

                    <label for="status">
                        Status
                        <span class="required">*</span>
                    </label>

                    <div class="input-wrapper select-wrapper">

                        <i class="bi bi-toggle-on"></i>

                        <select
                            name="status"
                            id="status"
                            required>

                            <option
                                value="Aktif"
                                <?= set_select(
                                    'status',
                                    'Aktif',
                                    TRUE
                                ); ?>>
                                Aktif
                            </option>

                            <option
                                value="Tidak Aktif"
                                <?= set_select(
                                    'status',
                                    'Tidak Aktif'
                                ); ?>>
                                Tidak Aktif
                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>


        <!-- =========================
             VARIASI PRODUK
        ========================== -->

        <div class="form-section variation-section">

            <div class="section-heading variation-heading">

                <div class="section-heading-left">

                    <div class="section-icon">
                        <i class="bi bi-palette"></i>
                    </div>

                    <div>

                        <h2>
                            Variasi Produk
                        </h2>

                        <p>
                            Tambahkan warna, ukuran, dan stok produk.
                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    class="btn btn-primary add-color-btn"
                    id="add-color">

                    <i class="bi bi-plus-lg"></i>

                    <span>
                        Tambah Warna
                    </span>

                </button>

            </div>


            <!-- Container Warna -->
            <div id="colors-container">


                <!-- =========================
                     WARNA PERTAMA
                ========================== -->

                <div class="color-item">

                    <div class="color-header">

                        <div class="color-title-wrapper">

                            <div class="color-number">
                                1
                            </div>

                            <div>

                                <h3 class="color-title">
                                    Warna 1
                                </h3>

                                <p>
                                    Tentukan warna dan ukuran produk.
                                </p>

                            </div>

                        </div>


                        <button
                            type="button"
                            class="btn btn-danger-outline remove-color">

                            <i class="bi bi-trash3"></i>

                            <span>
                                Hapus Warna
                            </span>

                        </button>

                    </div>


                    <!-- Nama Warna -->
                    <div class="form-group color-name-group">

                        <label>
                            Nama Warna
                            <span class="required">*</span>
                        </label>

                        <div class="input-wrapper">

                            <i class="bi bi-palette"></i>

                            <input
                                type="text"
                                name="colors[0][name]"
                                placeholder="Contoh: Hitam"
                                required>

                        </div>

                    </div>


                    <!-- Ukuran & Stok -->
                    <div class="sizes-heading">

                        <div>

                            <h4>
                                Ukuran & Stok
                            </h4>

                            <p>
                                Atur jumlah stok untuk setiap ukuran.
                            </p>

                        </div>

                        <button
                            type="button"
                            class="btn btn-light add-size">

                            <i class="bi bi-plus-lg"></i>

                            Tambah Ukuran

                        </button>

                    </div>


                    <!-- Sizes -->
                    <div class="sizes-container">

                        <div class="size-item">

                            <div class="size-input-group">

                                <label>
                                    Ukuran
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="colors[0][sizes][0][name]"
                                    placeholder="Contoh: M"
                                    required>

                            </div>


                            <div class="size-input-group">

                                <label>
                                    Stok
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="number"
                                    name="colors[0][sizes][0][stock]"
                                    placeholder="Contoh: 10"
                                    min="0"
                                    required>

                            </div>


                            <button
                                type="button"
                                class="btn btn-remove-size remove-size"
                                title="Hapus ukuran">

                                <i class="bi bi-trash"></i>

                                <span>
                                    Hapus
                                </span>

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- =========================
             FORM ACTION
        ========================== -->

        <div class="form-footer">

            <a
                href="<?= site_url('product'); ?>"
                class="btn btn-cancel">
                Batal

            </a>


            <button
                type="submit"
                class="btn btn-primary save-product-btn">

                Simpan Produk

            </button>

        </div>


    </form>

</div>