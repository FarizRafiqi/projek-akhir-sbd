<?php

namespace App\DataTables;

use App\Models\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('name', function ($item) {
                return $item->name;
            })
            ->addColumn('action', function ($row) {
                $showGate       = '';
                $editGate       = 'role_edit';
                $deleteGate     = 'role_delete';
                $crudRoutePart  = 'roles';

                return view('partials.datatables-action', compact(
                    'showGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row',
                ));
            })->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('rolesDataTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1, 'asc')
            ->addCheckbox(['className' => 'select-checkbox', 'printable' => false], true)
            ->buttons(
                Button::make('export')->text('<i class="fas fa-download"></i> Ekspor'),
                Button::make('print')->text('<i class="fas fa-print"></i> Cetak'),
                Button::make([
                    'text' => 'Pilih Semua',
                    'action' => 'function(e, dt, node, config){
                                dt.rows().select();
                                $(`input[type="checkbox"]`).prop(`checked`, true);
                            }',
                ]),
                Button::make([
                    'text' => 'Batal Pilih Semua',
                    'action' => 'function(e, dt, node, config){
                                dt.rows().deselect();
                            }',
                ]),
                Button::make([
                    'text' => 'Hapus yang Dipilih',
                    'className' => 'btn-danger',
                    'extend' => 'selected',
                    'attr' => ['id' => 'massDeleteRole']
                ]),
            )->parameters([
                'paging' => true,
                'select' => [
                    'style' => 'multi',
                    'selector' => 'td:first-child',
                ],
                'responsive' => true,
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name')->title('Peran'),
            Column::computed('action')->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->width(300)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Role_' . date('YmdHis');
    }
}
