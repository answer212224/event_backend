<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\MrtMember;
use App\Models\MrtRecord;
use App\Models\MrtWinner;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FormElements extends Component
{
    use LivewireAlert;
    public $week;
    protected $listeners = [
        'confirmed'
    ];
    public function mount()
    {
        $mrtWinners = MrtWinner::get();
        $awards = $mrtWinners->pluck('award');
        $hasWinner[0] = $awards->contains('2022-07-01,2022-07-07,頭獎1');
        $hasWinner[1] = $awards->contains('2022-07-08,2022-07-14,頭獎1');
        $hasWinner[2] = $awards->contains('2022-07-15,2022-07-21,頭獎1');
        $hasWinner[3] = $awards->contains('2022-07-22,2022-07-28,頭獎1');
        $hasWinner[4] = $awards->contains('2022-07-29,2022-08-04,頭獎1');
        $hasWinner[5] = $awards->contains('2022-08-05,2022-08-11,頭獎1');
        $hasWinner[6] = $awards->contains('2022-08-12,2022-08-18,頭獎1');
        $hasWinner[7] = $awards->contains('2022-08-19,2022-08-25,頭獎1');
        $hasWinner[8] = $awards->contains('2022-08-26,2022-09-01,頭獎1');
        $hasWinner[9] = $awards->contains('2022-09-02,2022-09-08,頭獎1');
        $hasWinner[10] = $awards->contains('2022-09-09,2022-09-15,頭獎1');
        $hasWinner[11] = $awards->contains('2022-09-16,2022-09-22,頭獎1');
        $hasWinner[12] = $awards->contains('2022-09-23,2022-09-29,頭獎1');
        $hasWinner[13] = $awards->contains('2022-09-30,2022-10-06,頭獎1');
        $hasWinner[14] = $awards->contains('2022-10-07,2022-10-13,頭獎1');
        $hasWinner[15] = $awards->contains('2022-10-14,2022-10-20,頭獎1');
        $hasWinner[16] = $awards->contains('2022-10-21,2022-10-27,頭獎1');
        $hasWinner[17] = $awards->contains('2022-10-28,2022-10-31,頭獎1');
        $i = 0;
        $weekly = 800;
        while ($hasWinner[$i]) {
            $weekly = $i;
            $i++;
        }

        switch ($weekly) {
            case 0:
                $this->week = '2022-07-08,2022-07-14';
                break;
            case 1:
                $this->week = '2022-07-15,2022-07-21';
                break;
            case 2:
                $this->week = '2022-07-22,2022-07-28';
                break;
            case 3:
                $this->week = '2022-07-29,2022-08-04';
                break;
            case 4:
                $this->week = '2022-08-05,2022-08-11';
                break;
            case 5:
                $this->week = '2022-08-12,2022-08-18';
                break;
            case 6:
                $this->week = '2022-08-19,2022-08-25';
                break;
            case 7:
                $this->week = '2022-08-26,2022-09-01';
                break;
            case 8:
                $this->week = '2022-09-02,2022-09-08';
                break;
            case 9:
                $this->week = '2022-09-09,2022-09-15';
                break;
            case 10:
                $this->week = '2022-09-16,2022-09-22';
                break;
            case 11:
                $this->week = '2022-09-23,2022-09-29';
                break;
            case 12:
                $this->week = '2022-09-30,2022-10-06';
                break;
            case 13:
                $this->week = '2022-10-07,2022-10-13';
                break;
            case 14:
                $this->week = '2022-10-14,2022-10-20';
                break;
            case 15:
                $this->week = '2022-10-21,2022-10-27';
                break;
            case 16:
                $this->week = '2022-10-28,2022-10-31';
                break;
            default:
                $this->week = '2022-07-01,2022-07-07';
                break;
        }
    }
    public function weekCheck()
    {
        $days = explode(',', $this->week);
        $startDate = Carbon::createFromFormat('Y-m-d', $days[0])->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $days[1])->endOfDay();

        $recordCount = MrtRecord::whereBetween('recorded_at', [$startDate, $endDate])->count();

        if ($recordCount < 100) {
            $this->alert('error', $this->week . '之搭乘資料不足', [
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
            $this->alert('success', $this->week . '之搭乘資料已成功匯入', [
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
        session()->put('week', $this->week);
        return redirect()->route('mrt.week');
    }

    public function render()
    {
        $mrtWinners = MrtWinner::get();
        $awards = $mrtWinners->pluck('award');
        $hasWinner[0] = $awards->contains('2022-07-01,2022-07-07,頭獎1');
        $hasWinner[1] = $awards->contains('2022-07-08,2022-07-14,頭獎1');
        $hasWinner[2] = $awards->contains('2022-07-15,2022-07-21,頭獎1');
        $hasWinner[3] = $awards->contains('2022-07-22,2022-07-28,頭獎1');
        $hasWinner[4] = $awards->contains('2022-07-29,2022-08-04,頭獎1');
        $hasWinner[5] = $awards->contains('2022-08-05,2022-08-11,頭獎1');
        $hasWinner[6] = $awards->contains('2022-08-12,2022-08-18,頭獎1');
        $hasWinner[7] = $awards->contains('2022-08-19,2022-08-25,頭獎1');
        $hasWinner[8] = $awards->contains('2022-08-26,2022-09-01,頭獎1');
        $hasWinner[9] = $awards->contains('2022-09-02,2022-09-08,頭獎1');
        $hasWinner[10] = $awards->contains('2022-09-09,2022-09-15,頭獎1');
        $hasWinner[11] = $awards->contains('2022-09-16,2022-09-22,頭獎1');
        $hasWinner[12] = $awards->contains('2022-09-23,2022-09-29,頭獎1');
        $hasWinner[13] = $awards->contains('2022-09-30,2022-10-06,頭獎1');
        $hasWinner[14] = $awards->contains('2022-10-07,2022-10-13,頭獎1');
        $hasWinner[15] = $awards->contains('2022-10-14,2022-10-20,頭獎1');
        $hasWinner[16] = $awards->contains('2022-10-21,2022-10-27,頭獎1');
        $hasWinner[17] = $awards->contains('2022-10-28,2022-10-31,頭獎1');
        return view('livewire.form-elements', compact('hasWinner'));
    }
}
