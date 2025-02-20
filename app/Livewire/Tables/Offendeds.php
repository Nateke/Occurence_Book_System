<?php

namespace App\Livewire\Tables;

use App\Models\Country;
use App\Models\County;
use App\Models\Offended;
use App\Models\Officer;
use App\Models\Subcounty;
use App\Models\Ward;
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

final class Offendeds extends PowerGridComponent
{
    use WithExport;
  protected bool $canLoadMore = true;
  public int $perPage = 10;
  public string $tableName="Offended List";
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
        return Offended::query()->with('country','county','subcounty','ward', 'officer');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
//            ->add('id')
          ->add('first_name')
          ->add('middle_name')
          ->add('last_name')
          ->add('other_name')
          ->add('id_scan')
          ->add('dob_formatted', fn (Offended $model) => Carbon::parse($model->dob)->format('d/m/Y'))
          ->add('gender')
          ->add('underage_flag', function (Offended $offended) { return $offended->underage_flag == 0 ? 'No' : 'Yes';})
          ->add('phone_number')
          ->add('country', fn(Offended $offended) => $offended->country->name ?? '')
          ->add('county', fn(Offended $offended) => $offended->county->name ?? '')
          ->add('subcounty', fn(Offended $offended) => $offended->subcounty->subcounty_name ?? '')
          ->add('ward', fn(Offended $offended) => $offended->ward->name ?? '')
          ->add('officer', fn(Offended $offended) => $offended->officer->officer_name ?? '')
          ->add('location')
          ->add('address')
          ->add('created_at');
    }

    public function columns(): array
    {
        return [
//            Column::make('Id', 'id'),
             Column::make('First name', 'first_name')
               ->sortable()
               ->searchable(),

             Column::make('Middle name', 'middle_name')
               ->sortable()
               ->searchable(),

             Column::make('Last name', 'last_name')
               ->sortable()
               ->searchable(),

             Column::make('Other name', 'other_name')
               ->sortable()
               ->searchable(),

             Column::make('Id Number', 'id_scan'),
             Column::make('Dob', 'dob_formatted', 'dob')
               ->sortable(),

             Column::make('Gender', 'gender')
               ->sortable()
               ->searchable(),

             Column::make('Is Under age', 'underage_flag')
               ->sortable()
               ->searchable(),

             Column::make('Phone number', 'phone_number')
               ->sortable()
               ->searchable(),
          Column::make('Officer', 'officer'),
             Column::make('Country ', 'country'),
             Column::make('County', 'county'),
             Column::make('Subcounty ', 'subcounty'),
             Column::make('Ward ', 'ward'),
             Column::make('Location', 'location')
               ->sortable()
               ->searchable(),

             Column::make('Address', 'address')
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
//        $this->js('alert('.$rowId.')');
    }
    #[\Livewire\Attributes\On('view')]
    public function view($rowId): void
    {
//        $this->js('alert('.$rowId.')');
    }

    public function actions(Offended $row): array
    {
        return [
            Button::add('view')
                ->slot(' View ')
                ->id()
                ->class('btn btn-sm btn-primary pg-btn-white dark:ring-pg-secondary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
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
