<?php

namespace App\Livewire\Tables;

use App\Models\Station;
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

final class Stations extends PowerGridComponent
{
    use WithExport;
  protected bool $canLoadMore = true;
  public int $perPage = 10;
  public string $tableName="Stations List";
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
        return Station::query()->with('county','subcounty','ward', 'officers');
    }

    public function relationSearch(): array
    {
        return ['ward.name', 'subcounty.subcounty_name', 'county.name'];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
//            ->add('id')
            ->add('station_name')
            ->add('station_number')
            ->add('county', fn(Station $offended) => $offended->county->name)
            ->add('subcounty', fn(Station $offended) => $offended->subcounty->subcounty_name)
            ->add('ward', fn(Station $offended) => $offended->ward->name)
          ->add('officers', fn(Station $offended) => $offended->officers->count())
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
//            Column::make('Id', 'id'),
            Column::make('Station name', 'station_name')
                ->sortable()
                ->searchable(),

            Column::make('Station number', 'station_number')
                ->sortable()
                ->searchable(),
            Column::make('County', 'county')->sortable()
              ->searchable(),
          Column::make('Subcounty', 'subcounty')
            ->searchable(),
            Column::make('Ward', 'ward')
              ->searchable(),
          Column::make('Officers Counts', 'officers')
              ->searchable(),
//            Column::make('Created at', 'created_at_formatted', 'created_at')
//                ->sortable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {

    }
#[\Livewire\Attributes\On('view')]
    public function view($rowId): void
    {

    }

    public function actions(Station $row): array
    {
        return [
            Button::add('view')
                ->slot('View')
                ->id()
                ->class('btn btn-sm btn-primary pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('view', ['rowId' => $row->id])
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
