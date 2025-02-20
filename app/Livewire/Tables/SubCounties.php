<?php

namespace App\Livewire\Tables;

use App\Models\County;
use App\Models\Subcounty;
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

final class SubCounties extends PowerGridComponent
{
  use WithExport;

  protected bool $canLoadMore = true;
  public int $perPage = 25;
  public string $tableName="Sub-Counties List";
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
        return Subcounty::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('county', fn(Subcounty $subcounty)=>$subcounty->county ? $subcounty->county->name : "")
           ->add('stations', fn(Subcounty $scounty) => $scounty->stations ? $scounty->stations->count() : '0')
            ->add('subcounty_name');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Sub-County Name', 'subcounty_name')
                ->sortable()
                ->searchable(),
          Column::make('County Name', 'county')
                ->sortable(),
          Column::make('Stations Counts', 'stations'),
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
//        $this->js('alert('.$rowId.')');
    }

    public function actions(Subcounty $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->id()
                ->class(' btn btn-sm btn-primary pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
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
