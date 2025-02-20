<?php

namespace App\Livewire\Tables;

use App\Models\Officer;
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

final class Officers extends PowerGridComponent
{
    use WithExport;
  protected bool $canLoadMore = true;
  public int $perPage = 10;
  public string $tableName="Officers List";
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
        return Officer::query()->with('user', 'station','county','subcounty','ward');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('station_id', fn(Officer $officer)=>$officer->station->station_name ?? '')
            ->add('county', fn(Officer $county)=>$county->user->county->name ?? '')
            ->add('subcounty', fn(Officer $subcounty)=>$subcounty->user->subcounty->subcounty_name ?? '')
            ->add('ward', fn(Officer $ward)=>$ward->user->ward->name ?? '')
            ->add('officer_name')
            ->add('badge_number')
            ->add('rank')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
//            Column::make('Id', 'id'),
            Column::make('Officer name', 'officer_name')
                ->sortable()
                ->searchable(),
          Column::make('Station', 'station_id'),
            Column::make('Badge number', 'badge_number')
                ->sortable()
                ->searchable(),

            Column::make('Rank', 'rank')
                ->sortable()
                ->searchable(),
          Column::make('County', 'county')
                ->sortable()
                ->searchable(),
          Column::make('Sub-County', 'subcounty')
                ->sortable()
                ->searchable(),
          Column::make('Ward', 'ward')
                ->sortable()
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

    public function actions(Officer $row): array
    {
        return [
            Button::add('view')
                ->slot('View ')
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
