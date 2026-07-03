<?php

namespace App\Libraries;

/**
 * Cart Library untuk CodeIgniter 4
 * Menggunakan Session untuk menyimpan data cart
 */
class Cart
{
    protected $session;
    protected $cartKey = 'ci4_cart';

    public function __construct()
    {
        $this->session = session();
    }

    /**
     * Tambah item ke keranjang
     */
    public function insert(array $item): string
    {
        if (empty($item['id']) || empty($item['qty']) || empty($item['price']) || empty($item['name'])) {
            return '';
        }

        $cart = $this->session->get($this->cartKey) ?? [];

        // Generate rowid unik berdasarkan id + options
        $options = $item['options'] ?? [];
        $rowid   = md5($item['id'] . serialize($options));

        if (isset($cart[$rowid])) {
            // Jika item sudah ada, tambah qty
            $cart[$rowid]['qty'] += (int) $item['qty'];
        } else {
            $cart[$rowid] = [
                'rowid'   => $rowid,
                'id'      => $item['id'],
                'qty'     => (int) $item['qty'],
                'price'   => (float) $item['price'],
                'name'    => $item['name'],
                'options' => $options,
                'subtotal' => (float) $item['price'] * (int) $item['qty'],
            ];
        }

        // Update subtotal
        $cart[$rowid]['subtotal'] = $cart[$rowid]['price'] * $cart[$rowid]['qty'];

        $this->session->set($this->cartKey, $cart);
        return $rowid;
    }

    /**
     * Update item di keranjang
     */
    public function update(array $item): bool
    {
        if (empty($item['rowid'])) {
            return false;
        }

        $cart  = $this->session->get($this->cartKey) ?? [];
        $rowid = $item['rowid'];

        if (!isset($cart[$rowid])) {
            return false;
        }

        if (isset($item['qty'])) {
            $qty = (int) $item['qty'];
            if ($qty <= 0) {
                $this->remove($rowid);
                return true;
            }
            $cart[$rowid]['qty']      = $qty;
            $cart[$rowid]['subtotal'] = $cart[$rowid]['price'] * $qty;
        }

        $this->session->set($this->cartKey, $cart);
        return true;
    }

    /**
     * Hapus item dari keranjang
     */
    public function remove(string $rowid): bool
    {
        $cart = $this->session->get($this->cartKey) ?? [];

        if (isset($cart[$rowid])) {
            unset($cart[$rowid]);
            $this->session->set($this->cartKey, $cart);
            return true;
        }

        return false;
    }

    /**
     * Kosongkan keranjang
     */
    public function destroy(): void
    {
        $this->session->remove($this->cartKey);
    }

    /**
     * Ambil semua isi keranjang
     */
    public function contents(): array
    {
        return $this->session->get($this->cartKey) ?? [];
    }

    /**
     * Hitung total harga
     */
    public function total(): float
    {
        $cart  = $this->contents();
        $total = 0.0;

        foreach ($cart as $item) {
            $total += $item['subtotal'];
        }

        return $total;
    }

    /**
     * Hitung total item
     */
    public function totalItems(): int
    {
        return count($this->contents());
    }

    /**
     * Hitung total quantity
     */
    public function totalQuantity(): int
    {
        $cart = $this->contents();
        $qty  = 0;

        foreach ($cart as $item) {
            $qty += $item['qty'];
        }

        return $qty;
    }
}
