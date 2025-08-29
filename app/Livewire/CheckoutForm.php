<?php

namespace App\Livewire;

use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CheckoutForm extends Component
{
    public array $shipping = [
        'address' => '',
        'city' => '',
        'postal_code' => '',
    ];

    public array $payment = [
        'card_last_four' => '',
        'token' => '',
    ];

    public string $errorMessage = '';

    public ?UserPreference $preference = null;

    public function mount(): void
    {
        $this->preference = Auth::user()?->preference;

        if (request()->boolean('oneclick')) {
            $this->fillFromPreferences();
        }
    }

    public function fillFromPreferences(): void
    {
        if (!$this->preference || !$this->isPreferenceComplete($this->preference)) {
            $this->errorMessage = 'Saved preferences are incomplete or outdated.';
            return;
        }

        $this->shipping = $this->preference->shipping;
        $this->payment = $this->preference->payment;
        $this->errorMessage = '';
    }

    protected function isPreferenceComplete(UserPreference $pref): bool
    {
        $shipping = $pref->shipping ?? [];
        $payment = $pref->payment ?? [];

        foreach (['address', 'city', 'postal_code'] as $field) {
            if (empty($shipping[$field])) {
                return false;
            }
        }

        foreach (['card_last_four', 'token'] as $field) {
            if (empty($payment[$field])) {
                return false;
            }
        }

        if ($pref->updated_at && $pref->updated_at->lt(now()->subYear())) {
            return false;
        }

        return true;
    }

    public function savePreferences(): void
    {
        $data = $this->validate([
            'shipping.address' => 'required|string',
            'shipping.city' => 'required|string',
            'shipping.postal_code' => 'required|string',
            'payment.card_last_four' => 'required|string|size:4',
            'payment.token' => 'required|string',
        ]);

        Auth::user()->preference()->updateOrCreate([], $data);
        $this->errorMessage = '';
    }

    public function render()
    {
        return view('livewire.checkout-form');
    }
}
