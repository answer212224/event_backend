<?php

namespace App\Http\Livewire;

use App\Models\Activity;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ActivityForm extends Component
{
    use LivewireAlert;

    public $start;
    public $end;
    public $name;

    protected $listeners = [
        'confirmed'
    ];

    public function mount()
    {
        $activity = Activity::where('name', $this->name)->first();

        $this->start = $activity->start_at->format('Y-m-d\TH:i:s');
        $this->end = $activity->end_at->format('Y-m-d\TH:i:s');
    }

    public function check()
    {
        $this->alert('warning', '請確認活動日期是否正確 ?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Confirm',
            'showCancelButton' => true,
            'onConfirmed' => 'confirmed',
            'cancelButtonText' => 'Cancel',
            'onDismissed' => 'cancelled',
            'timer' => '10000',
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function confirmed()
    {
        $activity = Activity::where('name', $this->name)->first();
        $activity->update([
            'start_at' => $this->start,
            'end_at' => $this->end
        ]);

        $this->alert('success', 'Success is approaching!');
    }

    public function render()
    {
        return view('livewire.activity-form');
    }
}
