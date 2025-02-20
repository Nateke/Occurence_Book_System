<?php

namespace App\Livewire\Tables;

use App\Models\Activity;
use App\Models\Offender;
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

final class Activities extends PowerGridComponent
{
    use WithExport;

  protected bool $canLoadMore = true;
  public int $perPage = 25;
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
        return Activity::query()->with('user');
    }

    public function relationSearch(): array
    {
        return [
          'user.name',
          'user.email',
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('user', fn(Activity $activity) => $activity->user->name ?? '')
            ->add('section')
            ->add('action')
            ->add('target')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
          Column::make('Performed By', 'user')
                ->sortable()
                ->searchable(),
          Column::make('Action', 'action')
            ->searchable(),
          Column::make('Section', 'section')
            ->searchable(),
          Column::make('Target', 'target')
            ->searchable(),
          Column::make('Date', 'created_at')
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

    public function actions(Activity $row): array
    {
        return [
            Button::add('edit')
                ->slot('View ')
                ->id()
                ->class('btn btn-sm btn-primary pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
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
