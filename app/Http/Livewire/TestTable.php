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
            BooleanColumn::make('Status', 'status')
                ->setCallback(function (string $value, $row) {
                    if ($value == 'published') {
                        return true;
                    } else {
                        return false;
                    }
                })
                ->searchable()
                ->sortable(),
            // ->hideIf(true),
            Column::make('Durasi', 'duration')
                ->sortable()
                ->searchable()
                ->format(fn ($value) => $value . ' menit'),
            // Column::make('Dibuat Pada', 'created_at')
            //     ->sortable()
            //     ->searchable()
            //     ->format(fn ($value) => $value->format('d F Y')),
            ButtonGroupColumn::make('Aksi')
                ->hideIf(Route::is('mahasiswa.test.paru-paru') || Route::is('mahasiswa.test.ginjal') || Route::is('mahasiswa.test.reproduksi'))
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Status') // make() has no effect in this case but needs to be set anyway
                        ->title(function ($row) {
                            if ($row->status == 'published') {
                                return 'Nonaktifkan';
                            } else {
                                return 'Aktifkan';
                            }
                        })
                        ->location(function ($row) {
                            $test = Test::find($row->id);
                            if (Route::is('dosen.test.paru-paru')) {
                                return route('dosen.test.paru-paru.update-status', $test->slug);
                            } elseif (Route::is('dosen.test.ginjal')) {
                                return route('dosen.test.ginjal.update-status', $test->slug);
                            } elseif (Route::is('dosen.test.reproduksi')) {
                                return route('dosen.test.reproduksi.update-status', $test->slug);
                            }
                        })
                        ->attributes(function ($row) {
                            if ($row->status == 'published') {
                                return [
                                    'class' => 'button-aktif',
                                ];
                            } else {
                                return [
                                    'class' => 'button-nonaktif',
                                ];
                            }
                        }),
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
                ]),
            ButtonGroupColumn::make('Aksi Mahasiswa')
                ->hideIf(Route::is('dosen.test.paru-paru') || Route::is('dosen.test.ginjal') || Route::is('dosen.test.reproduksi'))
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Kerjakan') // make() has no effect in this case but needs to be set anyway
                        ->title(function ($row) {
                            return 'Kerjakan';
                        })
                        ->location(function ($row) {
                            $test = Test::find($row->id);
                            if (Route::is('mahasiswa.test.paru-paru')) {
                                return route('mahasiswa.test.paru-paru.soal', $test->slug);
                            } elseif (Route::is('mahasiswa.test.ginjal')) {
                                return route('mahasiswa.test.ginjal.soal', $test->slug);
                            } elseif (Route::is('mahasiswa.test.reproduksi')) {
                                return route('mahasiswa.test.reproduksi.soal', $test->slug);
                            }
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
        if (Route::is('dosen.test.paru-paru')) {
            return Test::query()->where('category', 'paru');
        } elseif (Route::is('dosen.test.ginjal')) {
            return Test::query()->where('category', 'ginjal');
        } elseif (Route::is('dosen.test.reproduksi')) {
            return Test::query()->where('category', 'reproduksi');
        } elseif (Route::is('mahasiswa.test.paru-paru')) {
            return Test::query()->where('category', 'paru')->where('status', 'published');
        } elseif (Route::is('mahasiswa.test.ginjal')) {
            return Test::query()->where('category', 'ginjal')->where('status', 'published');
        } elseif (Route::is('mahasiswa.test.reproduksi')) {
            return Test::query()->where('category', 'reproduksi')->where('status', 'published');
        } else {
            return Test::query();
        }
    }
}
