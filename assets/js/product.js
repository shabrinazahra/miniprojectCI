/**
 * =========================================================
 * PRODUCT MANAGEMENT JAVASCRIPT
 * =========================================================
 *
 * Digunakan oleh:
 * - product/index.php
 * - product/create.php
 * - product/edit.php
 *
 * Fungsi:
 * - Pencarian produk
 * - Tambah warna
 * - Hapus warna
 * - Tambah ukuran
 * - Hapus ukuran
 * - Update index input variasi
 * - Cek kode produk AJAX
 * - Konfirmasi hapus produk
 */

document.addEventListener("DOMContentLoaded", function () {
	/* =====================================================
	   SEARCH PRODUK - INDEX
	===================================================== */

	const searchInput = document.getElementById("productSearch");
	const productTable = document.getElementById("productTable");

	if (searchInput && productTable) {
		const noSearchResult = document.getElementById("noSearchResult");

		searchInput.addEventListener("input", function () {
			const keyword = this.value.toLowerCase().trim();

			const rows = productTable.querySelectorAll(
				"tbody tr:not(#noSearchResult):not(#emptyProductRow)",
			);

			let found = false;

			rows.forEach(function (row) {
				const text = row.textContent.toLowerCase();

				if (text.includes(keyword)) {
					row.style.display = "";
					found = true;
				} else {
					row.style.display = "none";
				}
			});

			if (noSearchResult) {
				if (keyword !== "" && !found) {
					noSearchResult.style.display = "";
				} else {
					noSearchResult.style.display = "none";
				}
			}
		});
	}

	/* =====================================================
	   VARIASI PRODUK - CREATE / EDIT
	===================================================== */

	const colorsContainer = document.getElementById("colors-container");
	const addColorButton = document.getElementById("add-color");

	/*
	 * Jika halaman bukan create/edit,
	 * bagian variasi tidak dijalankan.
	 */

	if (colorsContainer) {
		/* =================================================
		   UPDATE INDEX WARNA & UKURAN
		================================================= */

		function updateIndexes() {
			const colors = colorsContainer.querySelectorAll(".color-item");

			colors.forEach(function (colorItem, colorIndex) {
				/* -----------------------------------------
				   NOMOR WARNA
				----------------------------------------- */

				const number = colorItem.querySelector(".color-number");

				if (number) {
					number.textContent = colorIndex + 1;
				}

				/* -----------------------------------------
				   JUDUL WARNA
				----------------------------------------- */

				const title = colorItem.querySelector(".color-title");

				if (title) {
					title.textContent = "Warna " + (colorIndex + 1);
				}

				/* -----------------------------------------
				   INPUT NAMA WARNA
				----------------------------------------- */

				const colorInput = colorItem.querySelector(".color-name-input");

				if (colorInput) {
					colorInput.name = "colors[" + colorIndex + "][name]";
				}

				/* -----------------------------------------
				   UKURAN
				----------------------------------------- */

				const sizes = colorItem.querySelectorAll(".size-item");

				sizes.forEach(function (sizeItem, sizeIndex) {
					/*
					 * Cari input ukuran.
					 *
					 * Prioritas:
					 * .size-name-input
					 * kemudian input text
					 */

					const sizeInput =
						sizeItem.querySelector(".size-name-input") ||
						sizeItem.querySelector('input[type="text"]');

					const stockInput = sizeItem.querySelector('input[type="number"]');

					/* INPUT UKURAN */

					if (sizeInput) {
						sizeInput.name =
							"colors[" + colorIndex + "][sizes][" + sizeIndex + "][name]";
					}

					/* INPUT STOK */

					if (stockInput) {
						stockInput.name =
							"colors[" + colorIndex + "][sizes][" + sizeIndex + "][stock]";
					}
				});
			});
		}

		/* =================================================
		   TAMBAH UKURAN
		================================================= */

		function addSize(colorItem) {
			if (!colorItem) {
				return;
			}

			const sizesContainer = colorItem.querySelector(".sizes-container");

			if (!sizesContainer) {
				return;
			}

			const colorItems = Array.from(
				colorsContainer.querySelectorAll(".color-item"),
			);

			const colorIndex = colorItems.indexOf(colorItem);

			const sizeIndex = sizesContainer.querySelectorAll(".size-item").length;

			const sizeItem = document.createElement("div");

			sizeItem.className = "size-item";

			sizeItem.innerHTML = `
				<div class="size-input-group">

					<label>
						Ukuran
						<span class="required">*</span>
					</label>

					<input
						type="text"
						class="size-name-input"
						name="colors[${colorIndex}][sizes][${sizeIndex}][name]"
						placeholder="Contoh: L"
						required>

				</div>


				<div class="size-input-group">

					<label>
						Stok
						<span class="required">*</span>
					</label>

					<input
						type="number"
						name="colors[${colorIndex}][sizes][${sizeIndex}][stock]"
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
			`;

			sizesContainer.appendChild(sizeItem);

			updateIndexes();
		}

		/* =================================================
		   TAMBAH WARNA
		================================================= */

		function addColor() {
			const colorIndex = colorsContainer.querySelectorAll(".color-item").length;

			const colorItem = document.createElement("div");

			colorItem.className = "color-item";

			colorItem.innerHTML = `
				<div class="color-header">

					<div class="color-title-wrapper">

						<div class="color-number">
							${colorIndex + 1}
						</div>

						<div>

							<h3 class="color-title">
								Warna ${colorIndex + 1}
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
						<span class="required">*</span>
					</label>

					<div class="input-wrapper">

						<i class="bi bi-palette"></i>

						<input
							type="text"
							class="color-name-input"
							name="colors[${colorIndex}][name]"
							placeholder="Contoh: Putih"
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
								<span class="required">*</span>
							</label>

							<input
								type="text"
								class="size-name-input"
								name="colors[${colorIndex}][sizes][0][name]"
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
								name="colors[${colorIndex}][sizes][0][stock]"
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
			`;

			colorsContainer.appendChild(colorItem);

			updateIndexes();
		}

		/* =================================================
		   BUTTON TAMBAH WARNA
		================================================= */

		if (addColorButton) {
			addColorButton.addEventListener("click", function () {
				addColor();
			});
		}

		/* =================================================
		   EVENT TAMBAH / HAPUS
		================================================= */

		colorsContainer.addEventListener("click", function (event) {
			/* -----------------------------------------
			   TAMBAH UKURAN
			----------------------------------------- */

			const addSizeButton = event.target.closest(".add-size");

			if (addSizeButton) {
				const colorItem = addSizeButton.closest(".color-item");

				if (colorItem) {
					addSize(colorItem);
				}

				return;
			}

			/* -----------------------------------------
			   HAPUS UKURAN
			----------------------------------------- */

			const removeSizeButton = event.target.closest(".remove-size");

			if (removeSizeButton) {
				const sizeItem = removeSizeButton.closest(".size-item");

				if (!sizeItem) {
					return;
				}

				const sizesContainer = sizeItem.closest(".sizes-container");

				if (!sizesContainer) {
					return;
				}

				const totalSizes = sizesContainer.querySelectorAll(".size-item").length;

				if (totalSizes > 1) {
					sizeItem.remove();

					updateIndexes();
				} else {
					alert("Minimal harus ada 1 ukuran.");
				}

				return;
			}

			/* -----------------------------------------
			   HAPUS WARNA
			----------------------------------------- */

			const removeColorButton = event.target.closest(".remove-color");

			if (removeColorButton) {
				const colorItem = removeColorButton.closest(".color-item");

				if (!colorItem) {
					return;
				}

				const totalColors =
					colorsContainer.querySelectorAll(".color-item").length;

				if (totalColors > 1) {
					colorItem.remove();

					updateIndexes();
				} else {
					alert("Minimal harus ada 1 warna.");
				}
			}
		});

		/* =================================================
		   INISIALISASI INDEX
		================================================= */

		updateIndexes();
	}

	/* =====================================================
	   CEK KODE PRODUK
	   CREATE / EDIT
	===================================================== */

	const productCodeInput = document.getElementById("product_code");

	const codeMessage = document.getElementById("code-message");

	if (productCodeInput && codeMessage) {
		let codeTimeout;

		productCodeInput.addEventListener("input", function () {
			clearTimeout(codeTimeout);

			const code = this.value.trim();

			/* -----------------------------------------
			   KOSONG
			----------------------------------------- */

			if (code === "") {
				codeMessage.textContent = "";

				codeMessage.classList.remove("text-danger", "text-success");

				return;
			}

			/* -----------------------------------------
			   STATUS MEMERIKSA
			----------------------------------------- */

			codeMessage.textContent = "Memeriksa kode...";

			codeMessage.classList.remove("text-danger", "text-success");

			codeTimeout = setTimeout(function () {
				const formData = new FormData();

				formData.append("product_code", code);

				/*
				 * Create:
				 * data-product-id kosong
				 *
				 * Edit:
				 * data-product-id berisi ID produk
				 */

				const productId = productCodeInput.dataset.productId || "";

				formData.append("id", productId);

				/*
				 * URL AJAX diambil dari:
				 * data-check-url
				 */

				const checkUrl = productCodeInput.dataset.checkUrl;

				if (!checkUrl) {
					codeMessage.textContent = "";

					return;
				}

				fetch(checkUrl, {
					method: "POST",

					body: formData,

					headers: {
						"X-Requested-With": "XMLHttpRequest",
					},
				})
					.then(function (response) {
						if (!response.ok) {
							throw new Error("Gagal memeriksa kode.");
						}

						return response.json();
					})

					.then(function (data) {
						if (data.exists) {
							codeMessage.textContent = "Kode produk sudah digunakan.";

							codeMessage.classList.add("text-danger");

							codeMessage.classList.remove("text-success");
						} else {
							codeMessage.textContent = "Kode produk tersedia.";

							codeMessage.classList.add("text-success");

							codeMessage.classList.remove("text-danger");
						}
					})

					.catch(function () {
						codeMessage.textContent = "";

						codeMessage.classList.remove("text-danger", "text-success");
					});
			}, 400);
		});
	}

	/* =====================================================
	   KONFIRMASI HAPUS PRODUK
	===================================================== */

	const deleteButtons = document.querySelectorAll(".action-delete");

	deleteButtons.forEach(function (button) {
		button.addEventListener("click", function (event) {
			const confirmed = confirm(
				"Apakah Anda yakin ingin menghapus produk ini?",
			);

			if (!confirmed) {
				event.preventDefault();
			}
		});
	});
});
