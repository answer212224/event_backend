<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Activity;
use App\Models\NewsVote;
use App\Models\NewsPrize;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class NewsLottery extends Component
{
    use LivewireAlert;

    public $year;

    public function mount()
    {
        $this->year = today()->year;
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
        $news = NewsVote::whereYear('created_at', $this->year)->get();
        $prizes = NewsPrize::where('lottery_year', $this->year)->get();

        $sum = $prizes->pluck('amount')->sum();

        if ($sum <= 0) {
            $this->alert('error', $this->year . '的獎項尚未設置!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        } else if ($news->count() < $sum) {
            $this->alert('error', '參加人數不足!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        } else {
            $voteCount = $news->countBy('vote_id')->sortDesc();
            $highestVote = $voteCount->keys()->first();

            $prizesGbCate = $prizes->groupBy('category');

            $sumOfprize1 = $prizesGbCate['大事件獎']->sum('amount');
            $sumOfprize2 = $prizesGbCate['參加獎']->sum('amount');

            $bigNewsWinners = $news->where('vote_id', $highestVote)->unique('phone')->random($sumOfprize1);
            $participateWinners = $news->unique('phone')->random($sumOfprize2);
            session()->put('bigNewsWinners', $bigNewsWinners);
            session()->put('participateWinners', $participateWinners);
            session()->put('prizesGbCate', $prizesGbCate);
            return redirect()->route('news.result');
        }
    }

    public function render()
    {
        $prizes = NewsPrize::where('lottery_year', $this->year)->get()->groupBy('category');

        $activity = Activity::where('name', 'news')->first();

        return view('livewire.news-lottery', compact('prizes', 'activity'));
    }
}
