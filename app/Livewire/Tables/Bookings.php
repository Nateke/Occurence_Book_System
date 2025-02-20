<?php

namespace App\Livewire\Tables;

use App\Models\Booking;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class Bookings extends PowerGridComponent
{
    use WithExport;
  public int $perPage = 10;
  public string $tableName="Booking List";
  public array $perPageValues = [0, 5, 10, 15, 20, 30, 50];

  public function setUp(): array
  {
    $this->showCheckBox();

    return [
      Exportable::make('export')
        ->striped()
        ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
      Header::make()->showSearchInput()
        ->showToggleColumns()
        ->includeViewOnBottom('components.datatable.header-bottom')
        ->includeViewOnTop('components.datatable.header-top'),
      Footer::make()
        ->showPerPage()
//                ->showRecordCount()
        ->showPerPage($this->perPage, $this->perPageValues)
        ->showRecordCount(mode: 'full')
        ->pagination('vendor.livewire.bootstrap'),
    ];
  }

    public function datasource(): Builder
    {
        return Booking::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('officer_id')
            ->add('booking_date_formatted', fn (Booking $model) => Carbon::parse($model->booking_date)->format('d/m/Y'))
            ->add('booking_time')
            ->add('location')
            ->add('remarks')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Officer id', 'officer_id'),
            Column::make('Booking date', 'booking_date_formatted', 'booking_date')
                ->sortable(),

            Column::make('Booking time', 'booking_time_formatted', 'booking_time')
                ->sortable(),

            Column::make('Booking time', 'booking_time')
                ->sortable()
                ->searchable(),

            Column::make('Location', 'location')
                ->sortable()
                ->searchable(),

            Column::make('Remarks', 'remarks')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('booking_date'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Booking $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
