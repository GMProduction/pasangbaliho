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
        title: 'No. Transaksi',
        field: 'id_transaksi',
        headerStyle:{textAlign: 'center', minWidth: '100px'},
        cellStyle: 
            {
                textAlign: 'center', 
                fontSize: 12
            }
    },
    {
        title: 'Nama Advertiser',
        field: 'namaAdvertiser',
        cellStyle: 
            {
                textAlign: 'left', 
                fontSize: 12
            },
        headerStyle:
        {
            textAlign: 'left', 
            minWidth: '120px'
        },
    },
    {
        title: 'Nama Media', 
        field: 'namaMedia',
        headerStyle:
            {
                textAlign: 'center', 
                minWidth: '180px'
            },
        cellStyle: 
            {
                textAlign: 'center', 
                fontSize: 12
            }
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