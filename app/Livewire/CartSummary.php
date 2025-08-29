<?php

namespace App\Livewire;

use Livewire\Component;

class CartSummary extends Component
{
    public array $cart = [];
    public float $subtotal = 0.0;
    public float $shipping = 0.0;
    public int $loyaltyPoints = 0;
    public ?array $coupon = null;
    public string $couponCode = '';

    protected $listeners = ['addToCart' => 'add', 'applyCoupon' => 'applyCoupon'];

    public function mount()
    {
        $this->recalculate();
    }

    public function add(array $product): void
    {
        $id = $product['id'];
        if (isset($this->cart[$id])) {
            $this->cart[$id]['qty']++;
        } else {
            $this->cart[$id] = [
                'id' => $id,
                'name' => $product['name'],
                'price' => $product['price'],
                'qty' => 1,
            ];
        }

        $this->recalculate();
    }

    public function applyCoupon(string $code): void
    {
        // Stubbed coupon logic for demonstration
        $this->coupon = ['code' => $code, 'discount' => $code === 'SAVE10' ? 0.10 : 0];
        $this->recalculate();
    }

    protected function recalculate(): void
    {
        $this->subtotal = collect($this->cart)->sum(fn($item) => $item['price'] * $item['qty']);
        $this->loyaltyPoints = (int) floor($this->subtotal / 10);
        $this->shipping = $this->subtotal > 100 ? 0 : 10;
    }

    public function getTotalProperty(): float
    {
        $discount = $this->coupon['discount'] ?? 0;
        return round($this->subtotal - ($this->subtotal * $discount) + $this->shipping, 2);
    }

    public function render()
    {
        return view('livewire.cart-summary');
    }
}
