<?php

namespace App\DataTables;

use App\Models\Purchase;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PurchaseDataTable extends DataTable
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
            ->editColumn('user_id', function ($purchase) {
                return $purchase->user->name;
            })
            ->editColumn('total_price', function ($purchase) {
                return $purchase->formatted_total_price;
            })
            ->editColumn('paid', function ($purchase) {
                return $purchase->formatted_paid;
            })
            ->editColumn('change', function ($purchase) {
                return $purchase->formatted_change;
            })
            ->editColumn('buy_date', function ($purchase) {
                return $purchase->buy_date;
            })
            ->editColumn('status', function ($purchase) {
                $state = "";
                if ($purchase->status == 'success') {
                    $state = "success";
                } else if ($purchase->status == "pending") {
                    $state = "warning";
                } else if ($purchase->status == "failed") {
                    $state = "danger";
                }
                return "<span class='badge rounded-pill bg-" . $state . "'>" . $purchase->status . "</span>";
            })
            ->addColumn('action', function ($row) {
                $showGate       = 'purchase_show';
                $editGate       = 'purchase_edit';
                $deleteGate     = 'purchase_delete';
                $crudRoutePart  = 'purchases';

                return view('partials.datatables-action', compact(
                    'showGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row',
                ));
            })->rawColumns(['status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Purchase $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Purchase $model)
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
        $user = User::find(auth()->id());
        if ($user->isAdmin() || $user->isStaff()) {
            return $this->builder()
                ->setTableId('purchases-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->dom('Bfrtip')
                ->orderBy(1, 'asc')
                ->buttons(
                    Button::make('export')->text('<i class="fas fa-download"></i> Ekspor'),
                    Button::make('print')->text('<i class="fas fa-print"></i> Cetak'),
                )->parameters([
                    'paging' => true,
                    'responsive' => true,
                ]);
        } else {
            return $this->builder()
                ->setTableId('purchases-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->orderBy(1, 'asc')->parameters([
                    'paging' => true,
                    'responsive' => true,
                ]);
        }
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
            Column::make('user_id')->title('Nama Pelanggan'),
            Column::make('total_price')->title('Total Harga'),
            Column::make('paid')->title('Dibayar'),
            Column::make('change')->title('Kembalian'),
            Column::make('buy_date')->title('Tanggal Beli'),
            Column::make('status')->title('Status'),
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
        return 'Brand_' . date('YmdHis');
    }
}
