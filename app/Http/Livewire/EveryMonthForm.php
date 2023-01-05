<?php

namespace App\Http\Livewire;

use App\Models\MrtEveryMonthRecord;
use App\Models\MrtWinner;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EveryMonthForm extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'confirmed'
    ];

    public function everyMonthCheck()
    {
        $count = MrtEveryMonthRecord::count();

        if ($count < 2) {
            $this->alert('error', '搭乘資料不足', [
                'position' => 'center',
                'timer' => '10000',
                'toast' => true,
                'timerProgressBar' => true,
                'text' => '',
                'showConfirmButton' => false,
                'onConfirmed' => '',
                'showCancelButton' => true,
                'onDismissed' => '',
                'cancelButtonText' => '關閉',
                'showDenyButton' => false,
                'onDenied' => '',
                'confirmButtonText' => '',
                'width' => '',
            ]);
        } else {
            $this->alert('success', '搭乘資料已成功匯入', [
                'position' => 'center',
                'timer' => '10000',
                'toast' => true,
                'timerProgressBar' => true,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'showCancelButton' => true,
                'cancelButtonText' => '關閉',
                'confirmButtonText' => '開始抽獎',
            ]);
        }
    }

    public function confirmed()
    {
        // Get input value and do anything you want to it
        return redirect()->route('mrt.everyMonth');
    }
    public function render()
    {
        return view('livewire.every-month-form');
    }
}
