<?php

namespace App\Livewire;

use Livewire\Component;

class ProductList extends Component
{
    public array $products = [];
    public int $perPage = 4;

    protected array $allProducts = [];

    public function mount(): void
    {
        $this->allProducts = [
            ['id' => 1, 'slug' => 'espresso', 'name' => 'Espresso', 'price' => 3.50, 'image' => 'https://source.unsplash.com/random/300x300?espresso', 'category' => 'coffee'],
            ['id' => 2, 'slug' => 'cappuccino', 'name' => 'Cappuccino', 'price' => 4.25, 'image' => 'https://source.unsplash.com/random/300x300?cappuccino', 'category' => 'coffee'],
            ['id' => 3, 'slug' => 'latte', 'name' => 'Latte', 'price' => 4.75, 'image' => 'https://source.unsplash.com/random/300x300?latte', 'category' => 'coffee'],
            ['id' => 4, 'slug' => 'mocha', 'name' => 'Mocha', 'price' => 5.00, 'image' => 'https://source.unsplash.com/random/300x300?mocha', 'category' => 'coffee'],
            ['id' => 5, 'slug' => 'green-tea', 'name' => 'Green Tea', 'price' => 2.50, 'image' => 'https://source.unsplash.com/random/300x300?greentea', 'category' => 'tea'],
            ['id' => 6, 'slug' => 'black-tea', 'name' => 'Black Tea', 'price' => 2.75, 'image' => 'https://source.unsplash.com/random/300x300?blacktea', 'category' => 'tea'],
            ['id' => 7, 'slug' => 'french-press', 'name' => 'French Press', 'price' => 25.00, 'image' => 'https://source.unsplash.com/random/300x300?frenchpress', 'category' => 'equipment'],
            ['id' => 8, 'slug' => 'coffee-grinder', 'name' => 'Coffee Grinder', 'price' => 45.00, 'image' => 'https://source.unsplash.com/random/300x300?grinder', 'category' => 'equipment'],
        ];
        $this->products = array_slice($this->allProducts, 0, $this->perPage);
    }

    public function loadMore(): void
    {
        $this->perPage += 4;
        $this->products = array_slice($this->allProducts, 0, $this->perPage);
    }

    public function getHasMoreProperty(): bool
    {
        return $this->perPage < count($this->allProducts);
    }

    public function render()
    {
        return view('livewire.product-list');
    }
}
