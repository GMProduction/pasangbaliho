import React from 'react';
import {dateFormater, formatAngka} from '../../../Controller/Helper'


export const columns = [
    { 
        title: '#', 
        cellStyle:{textAlign: 'center', fontSize: 12},
        headerStyle:{textAlign: 'center', minWidth: '50px'},
        sorting: false,
        render: rowData => <div>{rowData.tableData.id + 1}</div>
    },
    {
        title: 'ID Transaksi',
        field: 'id_transaksi',
        cellStyle: 
            {
                textAlign: 'center', 
                fontSize: 12
            },
        headerStyle:{textAlign: 'center', minWidth: '150px'},
    },
    {
        title: 'Nama Advertiser',
        field: 'namaAdvertiser',
        cellStyle: 
            {
                textAlign: 'left', 
                fontSize: 12
            },
        headerStyle:{textAlign: 'center', minWidth: '120px'},
    },
    {
        title: 'Nama Media', 
        field: 'namaMedia',
        cellStyle: 
            {
                textAlign: 'center', 
                fontSize: 12
            },
        headerStyle:{textAlign: 'center', minWidth: '180px'},
    },
    {
        title: 'Harga (Rp.)', 
        headerStyle:
            {
                textAlign: 'right', 
                minWidth: '120px'
            },
        cellStyle: 
            {
                textAlign: 'right', 
                fontSize: 12
            },
        render: rowData => 
            <div>
                {formatAngka(rowData.harga_deal)}
            </div>
    },
    {
        title: 'Tanggal Penyewaan', 
        headerStyle:
            {
                textAlign: 'center', 
                minWidth: '180px'
            },
        cellStyle: 
            {
                textAlign: 'center', 
                fontSize: 12
            },
        render: rowData => 
                <div>
                    {`${dateFormater(rowData.tanggal_awal)} - ${dateFormater(rowData.tanggal_akhir)}`}
                </div>
    }
];
export const columnsPayment = [
    { 
        title: '#', 
        cellStyle:{textAlign: 'center', fontSize: 12},
        headerStyle:{textAlign: 'center', minWidth: '50px'},
        sorting: false,
        render: rowData => <div>{rowData.tableData.id + 1}</div>
    },
    {
        title: 'No. Transaksi',
        field: 'idTransaksi',
        cellStyle: 
            {
                textAlign: 'center', 
                fontSize: 12
            },
        headerStyle:{textAlign: 'center', minWidth: '80px'},
    },
    {
        title: 'Atas Nama', 
        field: 'atas_nama',
        cellStyle: 
            {
                textAlign: 'center', 
                fontSize: 12
            },
        headerStyle:{textAlign: 'center', minWidth: '180px'},
    },
    {
        title: 'Vendor',
        field: 'vendor',
        cellStyle: 
            {
                textAlign: 'center', 
                fontSize: 12
            },
        headerStyle:{textAlign: 'center', minWidth: '150px'},
    },
    {
        title: 'No. Rekening', 
        field: 'no_rekening',
        cellStyle: 
            {
                textAlign: 'center', 
                fontSize: 12
            },
        headerStyle:{textAlign: 'center', minWidth: '150px'},
    },
    {
        title: 'Nominal (Rp.)', 
        cellStyle: 
            {
                textAlign: 'center', 
                fontSize: 12
            },
        headerStyle:{textAlign: 'center', minWidth: '150px'},
        render: rowData => 
        <div>
            {`${formatAngka(rowData.nominal)}`}
        </div>
    }
];