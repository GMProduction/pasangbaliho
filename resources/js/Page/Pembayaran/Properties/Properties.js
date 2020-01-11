import React from 'react';
import { NavLink } from 'react-router-dom';
import Button from '@material-ui/core/Button';


export const columns = [
    {title: '#',cellStyle:{textAlign: 'center'},headerStyle:{textAlign: 'center', width: '5%'},sorting: false,
        render: rowData => <div>{rowData.tableData.id + 1}</div>},
    {title: 'No. Transaksi',field: 'idTransaksi',cellStyle:{textAlign: 'left',width: '20%'}},
    {title: 'Nama Advertiser',field: 'namaAdvertiser',headerStyle:{textAlign: 'center', width: '15%'},cellStyle: {textAlign: 'center',width: '15%'}},
    {title: 'Nama Baliho.', field: 'namaBaliho',headerStyle:{textAlign: 'center', width: '15%'},cellStyle: {textAlign: 'center', width: '15%'}},
    {title: 'Nominal', field: 'nominal',headerStyle:{textAlign: 'center', width: '15%'},cellStyle: {textAlign: 'center', width: '15%'}},
    
];