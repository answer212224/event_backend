<?php

namespace App\Http\Livewire;

use App\Models\Keyword;
use App\Exports\KeywordExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\NumberFilter;


class KeywordTable extends DataTableComponent
{
    protected $model = Keyword::class;

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

        return Excel::download(new KeywordExport($users), 'users.xlsx');
    }

    public function filters(): array
    {
        return [
            NumberFilter::make('Year')
                ->config([
                    'min' => 2020,
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereYear('date_only', $value);
                }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("姓名", "name")
                ->searchable(),
            Column::make("電話", "phone")
                ->searchable(),
            Column::make("Email", "email")
                ->searchable(),
            Column::make("日期", "date_only")
                ->sortable(),
            Column::make("票選", "vote_id")
                ->sortable(),
            Column::make("IP", "ip"),
            Column::make("Created at", "created_at")
                ->sortable(),
        ];
    }
}
