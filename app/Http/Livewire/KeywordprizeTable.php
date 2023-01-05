<?php

namespace App\Http\Livewire;

use App\Models\KeywordPrize;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\NumberFilter;

class KeywordprizeTable extends DataTableComponent
{
    protected $model = KeywordPrize::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function filters(): array
    {
        return [
            NumberFilter::make('year')
                ->config([
                    'max' => 2028,
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('lottery_year', $value);
                }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("lottery_year", "lottery_year")
                ->searchable()
                ->sortable(),
            Column::make("Category", "category")
                ->searchable()
                ->sortable(),
            Column::make("Award", "award")
                ->searchable()
                ->sortable(),
            Column::make("prize", "prize")
                ->searchable()
                ->sortable(),
            Column::make("amount", "amount")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),

            LinkColumn::make('')
                ->title(fn ($row) => '刪除')
                ->location(fn ($row) => route('keywords.prize.delete', $row))
                ->attributes(fn ($row) => ['class' => 'underline text-red-500 hover:no-underline'])
                ->collapseOnMobile(),

        ];
    }
}
