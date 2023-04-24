<?php

namespace App\Http\Livewire;

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

class TestTable extends DataTableComponent
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
            Column::make('Nama Test', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Passing Score', 'passing_score')
                ->sortable()
                ->searchable()
                ->format(fn ($value) => $value . '%'),
            Column::make('Durasi', 'duration')
                ->sortable()
                ->searchable()
                ->format(fn ($value) => $value . ' menit'),
            Column::make('Dibuat Pada', 'created_at')
                ->sortable()
                ->searchable()
                ->format(fn ($value) => $value->format('d F Y')),
            ButtonGroupColumn::make('Aksi')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Buat Soal') // make() has no effect in this case but needs to be set anyway
                        ->title(function ($row) {
                            return 'Buat Soal';
                        })
                        ->location(function ($row) {
                            $test = Test::find($row->id);
                            if (Route::is('dosen.test.paru-paru')) {
                                return route('dosen.test.paru-paru.soal', $test->slug);
                            } elseif (Route::is('dosen.test.ginjal')) {
                                return route('dosen.test.ginjal.soal', $test->slug);
                            } elseif (Route::is('dosen.test.reproduksi')) {
                                return route('dosen.test.reproduksi.soal', $test->slug);
                            }
                        })
                        ->attributes(function ($row) {
                            return [
                                'class' => 'button-info',
                            ];
                        }),
                    LinkColumn::make('Edit') // make() has no effect in this case but needs to be set anyway
                        ->title(function ($row) {
                            return 'Edit';
                        })
                        ->location(function ($row) {
                            $test = Test::find($row->id);
                            if (Route::is('dosen.test.paru-paru')) {
                                return route('dosen.test.paru-paru.edit', $test->slug);
                            } elseif (Route::is('dosen.test.ginjal')) {
                                return route('dosen.test.ginjal.edit', $test->slug);
                            } elseif (Route::is('dosen.test.reproduksi')) {
                                return route('dosen.test.reproduksi.edit', $test->slug);
                            }
                        })
                        ->attributes(function ($row) {
                            return [
                                'class' => 'button',
                            ];
                        }),
                    LinkColumn::make('Delete')
                        ->title(fn () => 'Delete')
                        ->location(function ($row) {
                            $test = Test::find($row->id);
                            if (Route::is('dosen.test.paru-paru')) {
                                return route('dosen.test.paru-paru.delete', $test->slug);
                            } elseif (Route::is('dosen.test.ginjal')) {
                                return route('dosen.test.ginjal.delete', $test->slug);
                            } elseif (Route::is('dosen.test.reproduksi')) {
                                return route('dosen.test.reproduksi.delete', $test->slug);
                            }
                        })
                        ->attributes(function ($row) {
                            return [
                                'class' => 'button-danger ',
                                'onclick' => 'return confirm("Are you sure?");'
                            ];
                        }),
                ])
        ];
    }

    public function builder(): Builder
    {
        if (Route::is('dosen.test.paru-paru')) {
            return Test::query()->where('category', 'paru');
        } elseif (Route::is('dosen.test.ginjal')) {
            return Test::query()->where('category', 'ginjal');
        } elseif (Route::is('dosen.test.reproduksi')) {
            return Test::query()->where('category', 'reproduksi');
        } else {
            return Test::query();
        }
    }
}
