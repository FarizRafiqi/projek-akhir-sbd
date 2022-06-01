<?php

namespace App\DataTables;

use App\Models\Drug;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class DrugDataTable extends DataTable
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
            ->editColumn('drug_type_id', function ($drug) {
                return $drug->drug_type_id;
            })
            ->editColumn('drug_form_id', function ($drug) {
                return $drug->drug_form_id;
            })
            ->editColumn('name', function ($drug) {
                return $drug->name;
            })
            ->editColumn('image', function ($drug) {
                return $drug->image ?? '';
            })
            ->editColumn('price', function ($drug) {
                return $drug->formatted_price;
            })
            ->editColumn('description', function ($drug) {
                return Str::limit($drug->description);
            })
            ->editColumn('stock', function ($drug) {
                return $drug->stock;
            })
            ->addColumn('action', function ($row) {
                $showGate       = '';
                $editGate       = 'drug_edit';
                $deleteGate     = 'drug_delete';
                $crudRoutePart  = 'drugs';

                return view('partials.datatables-action', compact(
                    'showGate', 
                    'editGate', 
                    'deleteGate', 
                    'crudRoutePart',
                    'row',
                ));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Drug $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Drug $model)
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
            ->setTableId('drugs-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->addCheckbox(['className' => 'select-checkbox'], true)
            ->buttons(
                Button::make('export'),
                Button::make('print'),
                Button::make([
                    'text' => 'Select All',
                    'action' => 'function(e, dt, node, config){
                                dt.rows().select();
                                $(`input[type="checkbox"]`).prop(`checked`, true);
                            }',
                ]),
                Button::make([
                    'text' => 'Deselect All',
                    'action' => 'function(e, dt, node, config){
                                dt.rows().deselect();
                            }',
                ]),
                Button::make([
                    'text' => 'Delete Selected',
                    'className' => 'btn-danger',
                    'extend' => 'selected',
                    'attr' => ['id' => 'massDeleteDrug']
                ]),
            )->parameters([
                'paging' => true,
                'select' => [
                    'style' => 'multi',
                    'selector' => 'td:first-child',
                ],
                'order' => [[1, 'asc']],
                'responsive' => true
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
            Column::make('drug_type_id'),
            Column::make('drug_form_id'),
            Column::make('name'),
            Column::make('image'),
            Column::make('price'),
            Column::make('description'),
            Column::make('stock'),
            Column::computed('action')
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
        return 'Drug_' . date('YmdHis');
    }
}
