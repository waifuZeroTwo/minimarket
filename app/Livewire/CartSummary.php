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

    /**
     * Basic product catalog for upsell recommendations.
     *
     * @var array<int, array<string, mixed>>
     */
    protected array $catalog = [];

    protected $listeners = ['addToCart' => 'add', 'applyCoupon' => 'applyCoupon'];

    public function mount(): void
    {
        $this->catalog = [
            ['id' => 1, 'slug' => 'espresso', 'name' => 'Espresso', 'price' => 3.50, 'image' => 'https://source.unsplash.com/random/300x300?espresso', 'category' => 'coffee'],
            ['id' => 2, 'slug' => 'cappuccino', 'name' => 'Cappuccino', 'price' => 4.25, 'image' => 'https://source.unsplash.com/random/300x300?cappuccino', 'category' => 'coffee'],
            ['id' => 3, 'slug' => 'latte', 'name' => 'Latte', 'price' => 4.75, 'image' => 'https://source.unsplash.com/random/300x300?latte', 'category' => 'coffee'],
            ['id' => 4, 'slug' => 'mocha', 'name' => 'Mocha', 'price' => 5.00, 'image' => 'https://source.unsplash.com/random/300x300?mocha', 'category' => 'coffee'],
            ['id' => 5, 'slug' => 'green-tea', 'name' => 'Green Tea', 'price' => 2.50, 'image' => 'https://source.unsplash.com/random/300x300?greentea', 'category' => 'tea'],
            ['id' => 6, 'slug' => 'black-tea', 'name' => 'Black Tea', 'price' => 2.75, 'image' => 'https://source.unsplash.com/random/300x300?blacktea', 'category' => 'tea'],
            ['id' => 7, 'slug' => 'french-press', 'name' => 'French Press', 'price' => 25.00, 'image' => 'https://source.unsplash.com/random/300x300?frenchpress', 'category' => 'equipment'],
            ['id' => 8, 'slug' => 'coffee-grinder', 'name' => 'Coffee Grinder', 'price' => 45.00, 'image' => 'https://source.unsplash.com/random/300x300?grinder', 'category' => 'equipment'],
        ];

        $this->recalculate();
    }

    public function add(array $product): void
    {
        $id = $product['id'];
        $catalogItem = collect($this->catalog)->firstWhere('id', $id);
        if (isset($this->cart[$id])) {
            $this->cart[$id]['qty']++;
        } else {
            $this->cart[$id] = [
                'id' => $id,
                'name' => $product['name'],
                'price' => $product['price'],
                'qty' => 1,
                'category' => $catalogItem['category'] ?? null,
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

    public function getCouponSavingsProperty(): float
    {
        $discount = $this->coupon['discount'] ?? 0;
        return round($this->subtotal * $discount, 2);
    }

    public function getUpsellItemsProperty(): array
    {
        $cartIds = array_keys($this->cart);
        $categories = collect($this->cart)->pluck('category')->filter()->unique()->all();

        return collect($this->catalog)
            ->whereIn('category', $categories)
            ->whereNotIn('id', $cartIds)
            ->take(3)
            ->values()
            ->all();
    }

    public function render()
    {
        return view('livewire.cart-summary');
    }
}
