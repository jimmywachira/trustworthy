<?php

namespace App\Livewire;

use App\Models\Lead;
use App\Models\Property;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class PropertyLeadForm extends Component
{
    public Property $property;

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    /**
     * Validation rules for lead capture.
     *
     * @return array<string, string>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
        ];
    }

    /**
     * Persist an inquiry lead for the current property.
     */
    public function submit(): void
    {
        $validated = $this->validate();

        Lead::create([
            ...$validated,
            'property_id' => $this->property->id,
        ]);

        $this->reset(['name', 'email', 'phone']);
        $this->dispatch('lead-submitted');
    }

    public function render(): View
    {
        return view('livewire.property-lead-form');
    }
}
