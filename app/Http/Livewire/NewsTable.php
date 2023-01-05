<?php

namespace App\Http\Livewire;

use App\Exports\NewsExport;
use App\Models\NewsVote;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\NumberFilter;

class NewsTable extends DataTableComponent
{
    protected $model = NewsVote::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function bulkActions(): array
    {
        return [
            'export' => 'Export To Excel',
        ];
    }

    public function export()
    {
        $users = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new NewsExport($users), 'users.xlsx');
    }

    public function filters(): array
    {
        return [
            NumberFilter::make('Year')
                ->config([
                    'min' => 2022,
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereYear('created_at', $value);
                }),
        ];
    }


    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("票選", "vote_id")
                ->sortable(),
            Column::make("Name", "name")
                ->searchable(),
            Column::make("Phone", "phone")
                ->searchable(),
            Column::make("Address", "address")
                ->searchable(),
            Column::make("Email", "email")
                ->searchable(),
            Column::make("IP", "ip"),
            Column::make("Created at", "created_at")
                ->sortable(),
        ];
    }
}
