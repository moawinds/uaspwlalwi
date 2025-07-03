<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

class TransaksiController extends BaseController
{
    protected $cart;

    public function __construct()
    {
        helper(['number', 'form']);
        $this->cart = \Config\Services::cart();
    }

    public function index()
    {
        $data['items'] = $this->cart->contents();
        $data['total'] = $this->cart->total();
        return view('v_keranjang', $data);
    }

    public function add($id)
    {
        $productModel = new ProductModel();
        $produk = $productModel->find($id);

        if (!$produk) {
            return redirect()->to('/produk')->with('failed', 'Produk tidak ditemukan.');
        }

        $this->cart->insert([
            'id'      => $produk['id'],
            'qty'     => 1,
            'price'   => $produk['harga'],
            'name'    => $produk['nama'],
            'options' => ['foto' => $produk['foto']]
        ]);

        session()->setFlashdata('success', 'Produk berhasil ditambahkan ke keranjang. (<a href="' . base_url() . 'keranjang">Lihat</a>)');
        return redirect()->to('/produk');
    }

    public function cart_edit()
    {
        $post = $this->request->getPost();
        $index = 0;

        foreach ($this->cart->contents() as $item) {
            $rowid = $post['rowid' . $index] ?? null;
            $qty   = $post['qty' . $index] ?? null;

            if ($rowid && $qty) {
                $this->cart->update([
                    'rowid' => $rowid,
                    'qty'   => $qty
                ]);
            }

            $index++;
        }

        session()->setFlashdata('success', 'Jumlah produk berhasil diperbarui!');
        return redirect()->to(base_url('keranjang'));
    }

    public function cart_delete($rowid)
    {
        $this->cart->remove($rowid);
        session()->setFlashdata('success', 'Produk berhasil dihapus dari keranjang.');
        return redirect()->to(base_url('keranjang'));
    }

    public function cart_clear()
    {
        $this->cart->destroy();
        session()->setFlashdata('success', 'Keranjang berhasil dikosongkan.');
        return redirect()->to(base_url('keranjang'));
    }

    public function checkout()
    {
        $cartItems = $this->cart->contents();

        if (empty($cartItems)) {
            session()->setFlashdata('failed', 'Keranjang masih kosong!');
            return redirect()->to(base_url('keranjang'));
        }

        $db = \Config\Database::connect();

        try {
            $db->transStart();

            $transaksiData = [
                'username'     => session()->get('username'),
                'total_harga'  => $this->cart->total(),
                'alamat'       => 'Alamat default',
                'ongkir'       => 0,
                'status'       => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s')
            ];
            $db->table('transaction')->insert($transaksiData);
            $transaksiId = $db->insertID();

            foreach ($cartItems as $item) {
                $detail = [
                    'transaction_id' => $transaksiId,
                    'product_id'     => $item['id'],
                    'jumlah'         => $item['qty'],
                    'diskon'         => 0,
                    'subtotal_harga' => $item['price'] * $item['qty'],
                    'created_at'     => date('Y-m-d H:i:s'),
                    'updated_at'     => date('Y-m-d H:i:s')
                ];
                $db->table('transaction_detail')->insert($detail);
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception("Database gagal commit.");
            }

            session()->set('last_invoice_id', $transaksiId);
            $this->cart->destroy();
            return redirect()->to(base_url('invoice/' . $transaksiId));

        } catch (\Throwable $e) {
            session()->setFlashdata('failed', 'Gagal menyimpan transaksi: ' . $e->getMessage());
            return redirect()->to(base_url('keranjang'));
        }
    }

    public function invoice()
    {
        $lastId = session()->get('last_invoice_id');

        if (!$lastId) {
            return redirect()->to('/produk')->with('failed', 'Invoice tidak ditemukan.');
        }

        return redirect()->to(base_url('invoice/' . $lastId));
    }

    public function invoiceById($id)
    {
        $db = \Config\Database::connect();

        $transaksi = $db->table('transaction')->where('id', $id)->get()->getRowArray();
        $detail = $db->table('transaction_detail')
            ->select('transaction_detail.*, product.nama as nama_produk')
            ->join('product', 'product.id = transaction_detail.product_id', 'left')
            ->where('transaction_id', $id)
            ->get()
            ->getResultArray();

        if (!$transaksi) {
            return redirect()->to('/produk')->with('failed', 'Data invoice tidak ditemukan.');
        }

        return view('v_invoice', [
            'transaksi' => $transaksi,
            'detail' => $detail
        ]);
    }

    public function cetakPdf($id)
    {
        $db = \Config\Database::connect();

        $transaksi = $db->table('transaction')->where('id', $id)->get()->getRowArray();

        $detail = $db->table('transaction_detail')
            ->select('transaction_detail.*, product.nama as nama_produk')
            ->join('product', 'product.id = transaction_detail.product_id', 'left')
            ->where('transaction_id', $id)
            ->get()
            ->getResultArray();

        if (!$transaksi) {
            return redirect()->to('/produk')->with('failed', 'Data invoice tidak ditemukan.');
        }

        $html = view('v_invoice_pdf', [
            'transaksi' => $transaksi,
            'detail' => $detail
        ]);

        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("invoice_{$id}.pdf", ['Attachment' => true]);
    }
}
