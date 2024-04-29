<?php

namespace App\Livewire\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Seance;
use Illuminate\Database\Eloquent\Builder;

class SeanceTable extends DataTableComponent
{
    protected $model = Seance::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('dashboard.seances.edit', $row);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
                Column::make("Date", "date")
                ->format(
                    fn($value, $row, Column $column) => isset($value) ? $value->format('d/m/Y') : null
                )
                ->sortable(),
            Column::make("Créé par", "initiated_by_id")
                ->format(
                    fn($value, $row, Column $column) => $row->initiated_by->firstname
                )
                ->searchable(
                    fn(Builder $query, $searchTerm) => $query->whereHas('initiated_by', function ($query) use ($searchTerm) {
                        $query->where('users.firstname', $searchTerm)
                            ->where('users.lastname', $searchTerm);
                    })
                )
                ->sortable(
                    fn(Builder $query, string $direction) => $query->join('users', 'users.id', '=', 'seances.initiated_by_id')
                        ->orderBy('users.firstname', $direction)
                        ->orderBy('users.lastname', $direction)
                ),
            Column::make("Dernière mise à jour", "updated_at")
                ->format(
                    fn($value, $row, Column $column) => isset($value) ? $value->format('d/m/Y') : null
                )
                ->sortable(),
        ];
    }
}
