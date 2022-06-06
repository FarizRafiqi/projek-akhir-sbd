<?php

namespace App\DataTables;

use App\Models\DrugType;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DrugTypeDataTable extends DataTable
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
            ->editColumn('type', function ($drugType) {
                return $drugType->type;
            })
            ->editColumn('image', function ($drugType) {
                return $drugType->image ? "<i class='" . $drugType->image . " text-center fs-3'></i>" : "-";
            })
            ->editColumn('slug', function ($drugType) {
                return $drugType->slug ?? '-';
            })
            ->addColumn('action', function ($row) {
                $showGate       = '';
                $editGate       = 'drug_type_edit';
                $deleteGate     = 'drug_type_delete';
                $crudRoutePart  = 'drug-types';

                return view('partials.datatables-action', compact(
                    'showGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row',
                ));
            })->rawColumns(['action', 'image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DrugType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DrugType $model)
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
            ->setTableId('drugTypesTable')
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
                    'attr' => ['id' => 'massDeleteDrugType']
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
            Column::make('type')->title('Tipe Obat'),
            Column::make('image')->title('Icon')->addClass("text-center"),
            Column::make('slug'),
            Column::computed('action')->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->width(60)
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
        return 'DrugType_' . date('YmdHis');
    }
}
