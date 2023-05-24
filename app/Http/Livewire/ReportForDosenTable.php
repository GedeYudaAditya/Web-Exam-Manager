<?php

namespace App\Http\Livewire;

use App\Models\Report;
use App\Models\Test;
use App\Models\User;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Yajra\DataTables\Html\Button;
use Illuminate\Support\Str;

class ReportForDosenTable extends DataTableComponent
{
    protected $model = Test::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->searchable()
                ->hideIf(true),
            Column::make('SLUG', 'slug')
                ->sortable()
                ->searchable()
                ->hideIf(true),
            Column::make('Nama Test', 'test.name')
                ->sortable()
                ->searchable(),
            Column::make('User', 'user.name')
                ->sortable()
                ->searchable(),
            Column::make('Nilai', 'score')
                ->sortable()
                ->searchable()
                ->format(function ($row) {
                    return $row . '%';
                }),
            Column::make('Jenis Test', 'test.category')
                ->sortable()
                ->searchable()
                ->format(function ($row) {
                    return Str::ucfirst($row);
                }),
            Column::make('Tanggal', 'created_at')
                ->sortable()
                ->searchable()
                ->format(function ($row) {
                    // return $row->created_at->format('d-m-Y');
                    return $row->format('d F Y');
                }),
            // Action detail
            ButtonGroupColumn::make('Actions')
                ->buttons([
                    LinkColumn::make('Detail')
                        ->title(fn ($row) => 'Detail')
                        ->location(function ($row) {
                            return route('dosen.test.report.detail', $row->slug);
                        })
                        ->attributes(function ($row) {
                            return [
                                'class' => 'button-info',
                            ];
                        }),
                ]),
        ];
    }

    public function builder(): Builder
    {
        return Report::query()
            ->join('tests', 'reports.test_id', '=', 'tests.id')
            ->join('users', 'reports.user_id', '=', 'users.id')
            ->select('reports.*', 'tests.name as test_name', 'tests.category as category', 'users.name as user_name');
    }

    // export button
    public function export()
    {
        return redirect()->route('dosen.export');
    }

    public function leaderboard()
    {
        return redirect()->route('dosen.export.leaderboard');
    }

    public function bulkActions(): array
    {
        return [
            'export' => 'Export',
            'leaderboard' => 'Export Leaderboard',
        ];
    }
}
