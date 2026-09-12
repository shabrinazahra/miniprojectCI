<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property CI_Input $input
 * @property CI_DB_query_builder $db
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Output $output
 * @property Product_model $Product_model
 * @property Variation_model $Variation_model
 */

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Product_model');
        $this->load->model('Variation_model');

        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
    }

    /**
     * Halaman daftar produk
     */
    public function index()
    {
        $data['title'] = 'Daftar Produk';
        $data['products'] = $this->Product_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('product/index', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Halaman tambah produk
     */
    public function create()
    {
        if ($this->input->method() === 'post') {

            $this->form_validation->set_rules(
                'product_code',
                'Kode Produk',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'product_name',
                'Nama Produk',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'category',
                'Kategori',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'price',
                'Harga',
                'required|numeric'
            );

            $this->form_validation->set_rules(
                'status',
                'Status',
                'required|trim'
            );

            if ($this->form_validation->run() === FALSE) {

                $data['title'] = 'Tambah Produk';

                $this->load->view('templates/header', $data);
                $this->load->view('product/create', $data);
                $this->load->view('templates/footer');

                return;
            }

            $product_code = trim($this->input->post('product_code', TRUE));

            // Cek kode produk
            if ($this->Product_model->code_exists($product_code)) {
                $data['title'] = 'Tambah Produk';
                $data['code_error'] = 'Kode produk sudah digunakan.';

                $this->load->view('templates/header', $data);
                $this->load->view('product/create', $data);
                $this->load->view('templates/footer');

                return;
            }

            $product_data = array(
                'product_code' => $product_code,
                'product_name' => trim($this->input->post('product_name', TRUE)),
                'category'     => trim($this->input->post('category', TRUE)),
                'price'        => $this->input->post('price'),
                'status'       => $this->input->post('status', TRUE) ?: 'Aktif'
            );

            $product_id = $this->Product_model->insert($product_data);

            // Simpan warna dan ukuran
            $this->_save_variations($product_id);

            $this->session->set_flashdata(
                'success',
                'Produk berhasil ditambahkan.'
            );

            redirect('product');
        }

        $data['title'] = 'Tambah Produk';

        $this->load->view('templates/header', $data);
        $this->load->view('product/create', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Halaman edit produk
     */
    public function edit($id)
    {
        $product = $this->Product_model->get_by_id($id);

        if (!$product) {
            show_404();
        }

        if ($this->input->method() === 'post') {

            $this->form_validation->set_rules(
                'product_code',
                'Kode Produk',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'product_name',
                'Nama Produk',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'category',
                'Kategori',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'price',
                'Harga',
                'required|numeric'
            );

            $this->form_validation->set_rules(
                'status',
                'Status',
                'required|trim'
            );

            if ($this->form_validation->run() === FALSE) {

                $data['title'] = 'Edit Produk';
                $data['product'] = $product;
                $data['colors'] = $this->Variation_model->get_colors($id);

                foreach ($data['colors'] as $color) {
                    $color->sizes = $this->Variation_model->get_sizes($color->id);
                }

                $this->load->view('templates/header', $data);
                $this->load->view('product/edit', $data);
                $this->load->view('templates/footer');

                return;
            }

            $product_code = trim(
                $this->input->post('product_code', TRUE)
            );

            // Cek kode produk kecuali produk yang sedang diedit
            if ($this->Product_model->code_exists($product_code, $id)) {

                $data['title'] = 'Edit Produk';
                $data['product'] = $product;
                $data['code_error'] = 'Kode produk sudah digunakan.';
                $data['colors'] = $this->Variation_model->get_colors($id);

                foreach ($data['colors'] as $color) {
                    $color->sizes = $this->Variation_model->get_sizes($color->id);
                }

                $this->load->view('templates/header', $data);
                $this->load->view('product/edit', $data);
                $this->load->view('templates/footer');

                return;
            }

            $product_data = array(
                'product_code' => $product_code,
                'product_name' => trim($this->input->post('product_name', TRUE)),
                'category'     => trim($this->input->post('category', TRUE)),
                'price'        => $this->input->post('price'),
                'status'       => $this->input->post('status', TRUE) ?: 'Aktif'
            );

            $this->Product_model->update($id, $product_data);

            /*
             * Untuk variasi, kita hapus data lama terlebih dahulu.
             * Karena tabel product_sizes memiliki foreign key
             * ke product_colors dengan ON DELETE CASCADE,
             * ukuran ikut terhapus ketika warna dihapus.
             */
            $this->db
                ->where('product_id', $id)
                ->delete('product_colors');

            $this->_save_variations($id);

            $this->session->set_flashdata(
                'success',
                'Produk berhasil diperbarui.'
            );

            redirect('product');
        }

        $data['title'] = 'Edit Produk';
        $data['product'] = $product;
        $data['colors'] = $this->Variation_model->get_colors($id);

        foreach ($data['colors'] as $color) {
            $color->sizes = $this->Variation_model->get_sizes($color->id);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('product/edit', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Detail produk
     */
    public function detail($id)
    {
        $product = $this->Product_model->get_by_id($id);

        if (!$product) {
            show_404();
        }

        $data['title'] = 'Detail Produk';
        $data['product'] = $product;
        $data['colors'] = $this->Variation_model->get_colors($id);

        foreach ($data['colors'] as $color) {
            $color->sizes = $this->Variation_model->get_sizes($color->id);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('product/detail', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Hapus produk
     */
    public function delete($id)
    {
        $product = $this->Product_model->get_by_id($id);

        if (!$product) {
            show_404();
        }

        $this->Product_model->delete($id);

        $this->session->set_flashdata(
            'success',
            'Produk berhasil dihapus.'
        );

        redirect('product');
    }

    /**
     * AJAX pengecekan kode produk
     */
    public function check_code()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $code = trim($this->input->post('product_code', TRUE));
        $id   = $this->input->post('id');

        $exists = $this->Product_model->code_exists($code, $id);

        $this->output
            ->set_content_type('application/json')
            ->set_output(
                json_encode(array(
                    'exists' => $exists
                ))
            );
    }

    /**
     * Simpan warna dan ukuran produk
     */
    private function _save_variations($product_id)
    {
        $colors = $this->input->post('colors');

        if (!is_array($colors)) {
            return;
        }

        foreach ($colors as $color) {

            if (!is_array($color)) {
                continue;
            }

            $color_name = isset($color['name'])
                ? trim($color['name'])
                : '';

            if ($color_name === '') {
                continue;
            }

            $color_id = $this->Variation_model->insert_color(
                array(
                    'product_id' => $product_id,
                    'color_name' => $color_name
                )
            );

            if (!$color_id) {
                continue;
            }

            if (
                !isset($color['sizes']) ||
                !is_array($color['sizes'])
            ) {
                continue;
            }

            foreach ($color['sizes'] as $size) {

                if (!is_array($size)) {
                    continue;
                }

                $size_name = isset($size['name'])
                    ? trim($size['name'])
                    : '';

                $stock = isset($size['stock'])
                    ? (int) $size['stock']
                    : 0;

                if ($size_name === '') {
                    continue;
                }

                $this->Variation_model->insert_size(
                    array(
                        'color_id' => $color_id,
                        'size_name' => $size_name,
                        'stock' => $stock
                    )
                );
            }
        }
    }
}
