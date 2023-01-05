<?php

namespace App\Http\Livewire;

use App\Models\ElectionMember;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\NumberFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class ElectionMemberTable extends DataTableComponent
{
    protected $model = ElectionMember::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return ElectionMember::query()->withCount(['votes','clicks']);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Udn", "udn")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),

            BooleanColumn::make("Is App", "is_app")
                ->sortable(),
            BooleanColumn::make("Is Win", "is_win")
                ->sortable(),

            Column::make("news click", "id")
                ->format(
                fn($value, $row, Column $column) => $row->clicks_count
            ),
            LinkColumn::make("List", "id")
                ->title(fn ($row) => $row->votes_count)
                ->location(fn ($row) => route('election.votes', $row))
                ->attributes(fn ($row) => ['class' => 'underline text-blue-500 hover:no-underline'])
                ->collapseOnMobile(),

            Column::make("Ip", "ip")
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Created at", "created_at")
                ->sortable()
                ->collapseOnMobile(),
            // LinkColumn::make('')
            //     ->title(fn ($row) => '刪除')
            //     ->location(fn ($row) => route('election.delete', $row))
            //     ->attributes(fn ($row) => ['class' => 'underline text-red-500 hover:no-underline'])
            //     ->collapseOnMobile(),

        ];
    }
}
