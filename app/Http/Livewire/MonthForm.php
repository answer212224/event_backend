<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use MrtMonthRecords;
use Livewire\Component;
use App\Models\MrtMember;
use App\Models\MrtWinner;
use App\Models\MrtMonthRecord;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MonthForm extends Component
{
    use LivewireAlert;
    public $month;
    protected $listeners = [
        'confirmed'
    ];

    public function mount()
    {
        $mrtWinners = MrtWinner::get();
        $awards = $mrtWinners->pluck('award');
        $hasWinner[0] = $awards->contains('2022-07-29,2022-08-04,特獎');
        $hasWinner[1] = $awards->contains('2022-08-26,2022-09-01,特獎');
        $hasWinner[2] = $awards->contains('2022-09-30,2022-10-06,特獎');
        $hasWinner[3] = $awards->contains('2022-10-28,2022-10-31,特獎');


        $i = 0;

        while ($hasWinner[$i]) {
            $i++;
        }

        switch ($i) {
            case 0:
                $this->month = 7;
                break;
            case 1:
                $this->month = 8;
                break;
            case 2:
                $this->month = 9;
                break;
            case 3:
                $this->month = 10;
                break;
            default:
                $this->month = 7;
                break;
        }
    }
    public function monthCheck()
    {

        $count = MrtMonthRecord::where('month', $this->month)->count();

        if ($count < 100) {
            $this->alert('error', $this->month . '月搭乘資料不足', [
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
            $this->alert('success', $this->month . '月之搭乘資料已成功匯入', [
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
        session()->put('month', $this->month);

        return redirect()->route('mrt.month');
    }


    public function render()
    {
        $mrtWinners = MrtWinner::get();

        $awards = $mrtWinners->pluck('award');
        $hasWinner[0] = $awards->contains('2022-07-29,2022-08-04,特獎');
        $hasWinner[1] = $awards->contains('2022-08-26,2022-09-01,特獎');
        $hasWinner[2] = $awards->contains('2022-09-30,2022-10-06,特獎');
        $hasWinner[3] = $awards->contains('2022-10-28,2022-10-31,特獎');

        return view('livewire.month-form', compact('hasWinner'));
    }
}
