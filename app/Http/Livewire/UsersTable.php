<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Yajra\DataTables\Html\Button;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        // $this->selectFields();
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->searchable()
                ->hideIf(true),
            Column::make('Nama', 'name')
                ->sortable()
                ->searchable(),
            Column::make('E-Mail', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Dibuat Pada', 'created_at')
                ->sortable()
                ->searchable()
                ->format(fn ($value) => $value->format('d F Y')),
            BooleanColumn::make('Status', 'status')
                ->setCallback(function (string $value, $row) {
                    if ($value == 'aktif') {
                        return true;
                    } else {
                        return false;
                    }
                })
                ->sortable()
                ->searchable(),
            ButtonGroupColumn::make('Aksi')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Accept') // make() has no effect in this case but needs to be set anyway
                        ->title(function ($row) {
                            if ($row->status == 'aktif') {
                                return 'Decline';
                            } else {
                                return 'Accept';
                            }
                        })
                        ->location(function ($row) {
                            if ($row->status == 'aktif') {
                                return route('dosen.test.user.dec', $row->id);
                            } else {
                                return route('dosen.test.user.acc', $row->id);
                            }
                        })
                        ->attributes(function ($row) {
                            if ($row->status == 'aktif') {
                                return [
                                    'class' => 'button-secondary ',
                                ];
                            } else {
                                return [
                                    'class' => 'button ',
                                ];
                            }
                        }),
                    LinkColumn::make('Delete')
                        ->title(fn () => 'Delete')
                        ->location(fn ($row) => route('dosen.test.user.del', $row->id))
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
        return User::query()->where('role', 'mahasiswa');
    }

    public function bulkActions(): array
    {
        return [
            'accept' => 'Activate',
            'decline' => 'Deactivate',
            'delete' => 'Delete',
        ];
    }

    public function accept()
    {
        // accept all users
        foreach ($this->selected as $id) {
            $user = User::find($id);
            $user->status = 'aktif';
            $user->save();
        }
        $this->clearSelected();
    }

    public function decline()
    {
        // decline all users
        foreach ($this->selected as $id) {
            $user = User::find($id);
            $user->status = 'nonaktif';
            $user->save();
        }
        $this->clearSelected();
    }

    public function delete()
    {
        // delete all users
        foreach ($this->selected as $id) {
            $user = User::find($id);
            $user->delete();
        }
        $this->clearSelected();
    }
}
