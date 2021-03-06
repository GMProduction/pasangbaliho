import React from 'react';
import { NavLink } from 'react-router-dom';
import Button from '@material-ui/core/Button';

export const columns = [
    { 
        title: '#', 
        cellStyle:{textAlign: 'center'},
        headerStyle:{textAlign: 'center', width: '5%'},
        sorting: false,
        render: rowData => <div>{rowData.tableData.id + 1}</div>
    },
    {
        title: 'Nama Advertiser',
        field: 'nama',
        cellStyle: 
            {
                textAlign: 'left', 
                width: '20%'
            }
    },
    {
        title: 'Email', 
        field: 'email',
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
        title: 'Telp.', 
        field: 'telp',
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
        title: 'Alamat', 
        field: 'alamat',
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