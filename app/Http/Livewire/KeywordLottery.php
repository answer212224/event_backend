<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Keyword;
use App\Models\KeywordPrize;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class KeywordLottery extends Component
{
    use LivewireAlert;

    public $year;

    public function mount()
    {
        $this->year = today()->year + 1;
    }

    protected $listeners = [
        'confirmed'
    ];

    public function check()
    {
        $this->alert('warning', "請確認是否要抽 {$this->year} 年關鍵字抽獎 ?", [
            'position' => 'center',
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
        $keywords = Keyword::whereYear('created_at', $this->year - 1)->get();
        $prizes = KeywordPrize::where('lottery_year', $this->year)->get();
        $sum = $prizes->pluck('amount')->sum();

        if ($sum <= 0) {
            $this->alert('error', $this->year . '的獎項尚未設置!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        } else if ($keywords->count() < $sum) {
            $this->alert('error', '參加人數不足!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        } else {
            $voteCount = $keywords->countBy('vote_id')->sortDesc();
            $highestVote = $voteCount->keys()->first();

            $prizesGbCate = $prizes->groupBy('category');

            $sumOfprize1 = $prizesGbCate['預測王']->sum('amount');
            $sumOfprize2 = $prizesGbCate['參加獎']->sum('amount');

            $predictionWinners = $keywords->where('vote_id', $highestVote)->unique('phone')->random($sumOfprize1);
            $participateWinners = $keywords->unique('phone')->random($sumOfprize2);
            session()->put('predictionWinners', $predictionWinners);
            session()->put('participateWinners', $participateWinners);
            session()->put('prizesGbCate', $prizesGbCate);

            return redirect()->route('keywords.result');
        }
    }

    public function render()
    {
        $prizes = KeywordPrize::where('lottery_year', $this->year)->get()->groupBy('category');

        $activity = Activity::where('name', 'keywords')->first();

        return view('livewire.keyword-lottery', compact('prizes', 'activity'));
    }
}
