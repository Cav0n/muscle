<?php

namespace App\Livewire\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SeanceInvite;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class SeanceInviteTable extends DataTableComponent
{
    protected $model = SeanceInvite::class;

    public function builder(): Builder
    {
        return SeanceInvite::query()
            ->where('user_id', Auth::id());
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
            Column::make("Invité par", "invited_by_id")
                ->format(
                    fn($value, $row, Column $column) => $row->invited_by->firstname
                )
                ->searchable(
                    fn(Builder $query, $searchTerm) => $query->whereHas('invited_by', function ($query) use ($searchTerm) {
                        $query->where('users.firstname', $searchTerm)
                            ->where('users.lastname', $searchTerm);
                    })
                )
                ->sortable(
                    fn(Builder $query, string $direction) => $query->join('users', 'users.id', '=', 'seance_invites.invited_by_id')
                        ->orderBy('users.firstname', $direction)
                        ->orderBy('users.lastname', $direction)
                ),
            Column::make("Seance id", "seance_id")
                ->format(
                    fn($value, $row, Column $column) => "Séance du " . $row->seance->date->format('d/m/Y')
                ),
            Column::make("Envoyée le", "created_at")
                ->format(
                    fn($value, $row, Column $column) => isset($value) ? $value->format('d/m/Y à H:i') : null
                )
                ->sortable(),
            LinkColumn::make('Action')
                ->title(fn($row) => 'Accepter')
                ->location(fn($row) => route('dashboard.seances.invites.accept', $row))
                ->attributes(fn($row) => [
                    'class' => 'px-3 py-1 rounded-md bg-green-600 text-white border border-green-700 font-semibold transition-all duration-300 hover:bg-transparent hover:text-green-500',
                ]),
        ];
    }
}
