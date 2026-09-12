<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Variabel yang dikirim dari Product controller.
 *
 * @var object $product
 * @var array  $colors
 * @var string $title
 * @var string $code_error
 */

if (!isset($product) || !$product) {
    show_error('Data produk tidak ditemukan.');
}

if (!isset($colors) || !is_array($colors)) {
    $colors = array();
}
?>


<!-- =========================
     PAGE HEADER
========================== -->

<div class="page-header create-page-header">

    <div>

        <div class="page-breadcrumb">

            <a href="<?= site_url('product'); ?>">

                <i class="bi bi-box-seam"></i>

                Produk

            </a>

            <i class="bi bi-chevron-right"></i>

            <span>
                Edit Produk
            </span>

        </div>


        <h1 class="page-title">
            Edit Produk
        </h1>


        <p class="page-description">
            Perbarui informasi produk, variasi warna, ukuran, dan stok.
        </p>

    </div>

</div>


<!-- =========================
     VALIDATION ERROR
========================== -->

<?php if (validation_errors()) : ?>

    <div
        class="alert alert-danger custom-alert"
        role="alert">

        <i class="bi bi-exclamation-circle-fill"></i>

        <div>
            <?= validation_errors(); ?>
        </div>

    </div>

<?php endif; ?>


<!-- =========================
     CODE ERROR
========================== -->

<?php if (isset($code_error) && $code_error) : ?>

    <div
        class="alert alert-danger custom-alert"
        role="alert">

        <i class="bi bi-exclamation-circle-fill"></i>

        <div>
            <?= htmlspecialchars(
                $code_error,
                ENT_QUOTES,
                'UTF-8'
            ); ?>
        </div>

    </div>

<?php endif; ?>


<!-- =========================
     FORM CARD
========================== -->

<div class="create-card">

    <form
        action="<?= site_url('product/edit/' . $product->id); ?>"
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
                        Perbarui informasi utama produk.
                    </p>

                </div>

            </div>


            <div class="form-grid">


                <!-- =====================
                     KODE PRODUK
                ====================== -->

                <div class="form-group">

                    <label for="product_code">

                        Kode Produk

                        <span class="required">
                            *
                        </span>

                    </label>


                    <div class="input-wrapper">

                        <i class="bi bi-upc-scan"></i>


                        <input
                            type="text"
                            id="product_code"
                            name="product_code"
                            value="<?= htmlspecialchars(
                                        set_value(
                                            'product_code',
                                            $product->product_code
                                        ),
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ); ?>"
                            placeholder="Contoh: KS-003"
                            required>

                    </div>


                    <div
                        id="code-message"
                        class="input-message">
                    </div>

                </div>


                <!-- =====================
                     NAMA PRODUK
                ====================== -->

                <div class="form-group">

                    <label for="product_name">

                        Nama Produk

                        <span class="required">
                            *
                        </span>

                    </label>


                    <div class="input-wrapper">

                        <i class="bi bi-tag"></i>


                        <input
                            type="text"
                            id="product_name"
                            name="product_name"
                            value="<?= htmlspecialchars(
                                        set_value(
                                            'product_name',
                                            $product->product_name
                                        ),
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ); ?>"
                            placeholder="Contoh: Kaos Oversize"
                            required>

                    </div>

                </div>


                <!-- =====================
                     KATEGORI
                ====================== -->

                <div class="form-group">

                    <label for="category">

                        Kategori

                        <span class="required">
                            *
                        </span>

                    </label>


                    <div class="input-wrapper">

                        <i class="bi bi-grid"></i>


                        <input
                            type="text"
                            id="category"
                            name="category"
                            value="<?= htmlspecialchars(
                                        set_value(
                                            'category',
                                            $product->category
                                        ),
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ); ?>"
                            placeholder="Contoh: Pakaian Pria"
                            required>

                    </div>

                </div>


                <!-- =====================
                     HARGA
                ====================== -->

                <div class="form-group">

                    <label for="price">

                        Harga

                        <span class="required">
                            *
                        </span>

                    </label>


                    <div class="input-wrapper">

                        <span class="input-prefix">
                            Rp
                        </span>


                        <input
                            type="number"
                            id="price"
                            name="price"
                            value="<?= htmlspecialchars(
                                        set_value(
                                            'price',
                                            $product->price
                                        ),
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ); ?>"
                            placeholder="75000"
                            min="0"
                            required>

                    </div>

                </div>


                <!-- =====================
                     STATUS
                ====================== -->

                <div class="form-group">

                    <label for="status">

                        Status

                        <span class="required">
                            *
                        </span>

                    </label>


                    <div
                        class="input-wrapper select-wrapper">

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
                                    $product->status === 'Aktif'
                                ); ?>>

                                Aktif

                            </option>


                            <option
                                value="Tidak Aktif"
                                <?= set_select(
                                    'status',
                                    'Tidak Aktif',
                                    $product->status === 'Tidak Aktif'
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


            <div
                class="section-heading variation-heading">


                <div class="section-heading-left">


                    <div class="section-icon">

                        <i class="bi bi-palette"></i>

                    </div>


                    <div>

                        <h2>
                            Variasi Produk
                        </h2>

                        <p>
                            Perbarui warna, ukuran, dan stok produk.
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


            <!-- =========================
                 COLORS CONTAINER
            ========================== -->

            <div id="colors-container">


                <?php if (!empty($colors)) : ?>


                    <?php foreach (
                        $colors
                        as $colorIndex => $color
                    ) : ?>


                        <!-- =====================
                             COLOR ITEM
                        ====================== -->

                        <div class="color-item">


                            <!-- COLOR HEADER -->

                            <div class="color-header">


                                <div class="color-title-wrapper">


                                    <div class="color-number">
                                        <?= $colorIndex + 1; ?>
                                    </div>


                                    <div>

                                        <h3 class="color-title">

                                            Warna
                                            <?= $colorIndex + 1; ?>

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


                            <!-- =====================
                                 NAMA WARNA
                            ====================== -->

                            <div class="form-group color-name-group">


                                <label>

                                    Nama Warna

                                    <span class="required">
                                        *
                                    </span>

                                </label>


                                <div class="input-wrapper">

                                    <i class="bi bi-palette"></i>


                                    <input
                                        type="text"
                                        class="color-name-input"
                                        name="colors[<?= $colorIndex; ?>][name]"
                                        value="<?= htmlspecialchars(
                                                    set_value(
                                                        'colors[' .
                                                            $colorIndex .
                                                            '][name]',
                                                        $color->color_name
                                                    ),
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ); ?>"
                                        placeholder="Contoh: Hitam"
                                        required>

                                </div>

                            </div>


                            <!-- =====================
                                 UKURAN & STOK HEADER
                            ====================== -->

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


                            <!-- =====================
                                 SIZES
                            ====================== -->

                            <div class="sizes-container">


                                <?php if (
                                    isset($color->sizes) &&
                                    is_array($color->sizes) &&
                                    !empty($color->sizes)
                                ) : ?>


                                    <?php foreach (
                                        $color->sizes
                                        as $sizeIndex => $size
                                    ) : ?>


                                        <div class="size-item">


                                            <!-- UKURAN -->

                                            <div class="size-input-group">


                                                <label>

                                                    Ukuran

                                                    <span class="required">
                                                        *
                                                    </span>

                                                </label>


                                                <input
                                                    type="text"
                                                    name="colors[<?= $colorIndex; ?>][sizes][<?= $sizeIndex; ?>][name]"
                                                    value="<?= htmlspecialchars(
                                                                set_value(
                                                                    'colors[' .
                                                                        $colorIndex .
                                                                        '][sizes][' .
                                                                        $sizeIndex .
                                                                        '][name]',
                                                                    $size->size_name
                                                                ),
                                                                ENT_QUOTES,
                                                                'UTF-8'
                                                            ); ?>"
                                                    placeholder="Contoh: M"
                                                    required>


                                            </div>


                                            <!-- STOK -->

                                            <div class="size-input-group">


                                                <label>

                                                    Stok

                                                    <span class="required">
                                                        *
                                                    </span>

                                                </label>


                                                <input
                                                    type="number"
                                                    name="colors[<?= $colorIndex; ?>][sizes][<?= $sizeIndex; ?>][stock]"
                                                    value="<?= htmlspecialchars(
                                                                set_value(
                                                                    'colors[' .
                                                                        $colorIndex .
                                                                        '][sizes][' .
                                                                        $sizeIndex .
                                                                        '][stock]',
                                                                    $size->stock
                                                                ),
                                                                ENT_QUOTES,
                                                                'UTF-8'
                                                            ); ?>"
                                                    placeholder="Contoh: 10"
                                                    min="0"
                                                    required>


                                            </div>


                                            <!-- HAPUS UKURAN -->

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


                                    <?php endforeach; ?>


                                <?php else : ?>


                                    <!-- Jika belum ada ukuran -->

                                    <div class="size-item">


                                        <div class="size-input-group">

                                            <label>

                                                Ukuran

                                                <span class="required">
                                                    *
                                                </span>

                                            </label>


                                            <input
                                                type="text"
                                                name="colors[<?= $colorIndex; ?>][sizes][0][name]"
                                                placeholder="Contoh: M"
                                                required>

                                        </div>


                                        <div class="size-input-group">

                                            <label>

                                                Stok

                                                <span class="required">
                                                    *
                                                </span>

                                            </label>


                                            <input
                                                type="number"
                                                name="colors[<?= $colorIndex; ?>][sizes][0][stock]"
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


                                <?php endif; ?>


                            </div>


                        </div>


                    <?php endforeach; ?>


                <?php else : ?>


                    <!-- =========================
                         DEFAULT COLOR
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


                        <div class="form-group color-name-group">


                            <label>

                                Nama Warna

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <div class="input-wrapper">

                                <i class="bi bi-palette"></i>


                                <input
                                    type="text"
                                    class="color-name-input"
                                    name="colors[0][name]"
                                    placeholder="Contoh: Hitam"
                                    required>

                            </div>


                        </div>


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


                        <div class="sizes-container">


                            <div class="size-item">


                                <div class="size-input-group">

                                    <label>

                                        Ukuran

                                        <span class="required">
                                            *
                                        </span>

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

                                        <span class="required">
                                            *
                                        </span>

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


                <?php endif; ?>


            </div>


        </div>


        <!-- =========================
             FORM FOOTER
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

                Simpan Perubahan

            </button>


        </div>


    </form>

</div>