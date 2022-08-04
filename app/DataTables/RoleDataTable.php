<?php

namespace App\DataTables;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d-m-Y');
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at->format('d-m-Y');
            })
            ->addColumn('action', function ($row) {
                if (Gate::allows('update role')) {
                    $action = '<button type="button" class="btn btn-sm bg-primary"><i class="fas fa-pencil-alt"></i></button>
                    ';
                }

                if (Gate::allows('delete role')) {
                    $action .= ' <button type="button" class="btn btn-sm bg-danger"><i class="fas fa-trash-alt"></i></button>';
                }
                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->parameters(['searchDelay' => 1000])
            ->setTableId('role-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
                ->searchable(false)
                ->orderable(false)
                ->title('No')
                ->width(5)
                ->addClass('text-center'),
            Column::make('name')
                ->width(10),
            Column::make('created_at')
                ->width(5),
            Column::make('updated_at')
                ->width(5),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(50),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Role_' . date('YmdHis');
    }
}
