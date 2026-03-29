<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\Property;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AppointmentScheduler extends Component
{
    public Property $property;

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $preferredAt = '';

    public string $message = '';

    /**
     * Mount defaults.
     */
    public function mount(): void
    {
        if (Auth::check()) {
            $this->name = (string) Auth::user()->name;
            $this->email = (string) Auth::user()->email;
        }
    }

    /**
     * Validation rules for appointment scheduler.
     *
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'preferredAt' => ['required', 'date', 'after:now'],
            'message' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Save appointment request.
     */
    public function schedule(): void
    {
        $validated = $this->validate();

        Appointment::query()->create([
            'property_id' => $this->property->id,
            'agent_id' => $this->property->agent_id,
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'preferred_at' => $validated['preferredAt'],
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        $this->reset(['phone', 'preferredAt', 'message']);
        $this->dispatch('appointment-scheduled');
    }

    public function render(): View
    {
        return view('livewire.appointment-scheduler');
    }
}
