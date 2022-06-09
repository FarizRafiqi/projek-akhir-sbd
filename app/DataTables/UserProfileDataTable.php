<?php

namespace App\DataTables;

use App\Models\Drug;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserProfileDataTable extends DataTable
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
                return $drug->drugType->type;
            })
            ->editColumn('drug_form_id', function ($drug) {
                return $drug->drugForm->form;
            })
            ->editColumn('name', function ($drug) {
                return $drug->name;
            })
            ->editColumn('image', function ($drug) {
                $folder = "/img/drugs/";
                $image =  "<img src='" . Storage::url($folder . $drug->image) . "' width='100px'>";
                return $drug->image ? $image : '-';
            })
            ->editColumn('price', function ($drug) {
                return $drug->formatted_price;
            })
            ->editColumn('stock', function ($drug) {
                return $drug->formatted_stock;
            })
            ->rawColumns(['image', 'action'])
            ->addColumn('action', function ($row) {
                $showGate       = 'drug_show';
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
        if ($this->filter) {
            return $this->filter;
        }
        
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
                    'attr' => ['id' => 'massDeleteDrug']
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
            Column::make('drug_type_id')->title('Tipe Obat'),
            Column::make('drug_form_id')->title('Bentuk Obat'),
            Column::make('name')->title('Nama Obat'),
            Column::make('image')->title('Gambar'),
            Column::make('price')->title('Harga'),
            Column::make('stock')->title('Stok'),
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
        return 'Drug_' . date('YmdHis');
    }
}
