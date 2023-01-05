<?php

namespace App\Exports;

use App\Models\ElectionMember;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class ElectionMembersExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        $members = ElectionMember::withCount([
            'votes',
            'votes as win_count' => function (Builder $query) {
                $query->where('is_win', true);
            },

        ])->get();

        return $members;
    }

    public function map($member): array
    {
        if ($member->votes_count > 1) {
            $is_play = true;
        } else {
            $is_play = false;
        }
        return [
            $member->udn,
            $member->email,
            $member->ip,
            $member->created_at,
            $member->is_app,
            $is_play,
            $member->win_count
        ];
    }

    public function headings(): array
    {
        return [
            'udn',
            'email',
            'ip',
            'created_at',
            'is_app',
            'played',
            'win_count'
        ];
    }
}
