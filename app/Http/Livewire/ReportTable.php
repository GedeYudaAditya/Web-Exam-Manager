<?php

namespace App\Http\Livewire;

use App\Models\Report;
use App\Models\Test;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Yajra\DataTables\Html\Button;

class ReportTable extends DataTableComponent
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
            Column::make('Nama Test', 'test_id')
                ->sortable()
                ->searchable()
                ->format(function ($row) {
                    $test = Test::find($row);
                    return $test->name;
                }),
            Column::make('Nilai', 'score')
                ->sortable()
                ->searchable()
                ->format(function ($row) {
                    return $row . '%';
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
                            return route('mahasiswa.test.result', $row->slug);
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
        return Report::query()->with('test')->where('user_id', auth()->user()->id);
    }
}
