import React from 'react';
import { NavLink } from 'react-router-dom';
import Button from '@material-ui/core/Button';
import {dateFormater} from '../../../Controller/Helper'


export const columns = [
    { 
        title: '#', 
        cellStyle:{textAlign: 'center'},
        headerStyle:{textAlign: 'center', width: '5%'},
        sorting: false,
        render: rowData => <div>{rowData.tableData.id + 1}</div>
    },
    {
        title: 'ID Transaksi',
        field: 'id_transaksi',
        cellStyle: 
            {
                textAlign: 'left', 
                width: '20%'
            }
    },
    {
        title: 'Nama Advertiser',
        field: 'namaAdvertiser',
        cellStyle: 
            {
                textAlign: 'left', 
                width: '20%'
            }
    },
    {
        title: 'Nama Media', 
        field: 'namaMedia',
        headerStyle:
            {
                textAlign: 'center', 
                width: '15%'
            },
        cellStyle: 
            {
                textAlign: 'center', 
                width: '15%'
            }
    },
    {
        title: 'Nama Media', 
        field: 'namaMedia',
        headerStyle:
            {
                textAlign: 'left', 
                width: '30%'
            },
        cellStyle: 
            {
                textAlign: 'left', 
                width: '30%'
            }
    },
    {
        title: 'Tanggal Penyewaan', 
        headerStyle:
            {
                textAlign: 'center', 
                width: '20%'
            },
        cellStyle: 
            {
                textAlign: 'center', 
                width: '20%'
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
        cellStyle:{textAlign: 'center'},
        headerStyle:{textAlign: 'center', width: '5%'},
        sorting: false,
        render: rowData => <div>{rowData.tableData.id + 1}</div>
    },
    {
        title: 'ID Transaksi',
        field: 'idTransaksi',
        cellStyle: 
            {
                textAlign: 'left', 
                width: '20%'
            }
    },
    {
        title: 'Vendor',
        field: 'vendor',
        cellStyle: 
            {
                textAlign: 'left', 
                width: '20%'
            }
    },
    {
        title: 'No. Rekening', 
        field: 'no_rekening',
        headerStyle:
            {
                textAlign: 'center', 
                width: '15%'
            },
        cellStyle: 
            {
                textAlign: 'center', 
                width: '15%'
            }
    },
    {
        title: 'Atas Nama', 
        field: 'atas_nama',
        headerStyle:
            {
                textAlign: 'left', 
                width: '30%'
            },
        cellStyle: 
            {
                textAlign: 'left', 
                width: '30%'
            }
    }
];