import React from 'react';
import { NavLink } from 'react-router-dom';
import Button from '@material-ui/core/Button';

export const columnsPermintaan = [
    { 
        title: '#', 
        cellStyle:{textAlign: 'center'},
        headerStyle:{textAlign: 'center', width: '5%'},
        sorting: false,
        render: rowData => <div>{rowData.tableData.id + 1}</div>
    },
    {
        title: 'Nama Mitra',
        field: 'nama',
        cellStyle: 
            {
                textAlign: 'left', 
                fontFamily: 'Roboto Light',
                width: '20%'
            }
    },
    {
        title: 'Jenis Media', 
        field: 'kategori',
        headerStyle:
            {
                textAlign: 'center', 
                width: '15%'
            },
        cellStyle: 
            {
                textAlign: 'center', 
                fontFamily: 'Roboto Light',
                width: '15%'
            }
    },
    {
        title: 'Kota', 
        field: 'nama_kota',
        headerStyle:
            {
                textAlign: 'center', 
                width: '15%'
            },
        cellStyle: 
            {
                textAlign: 'center', 
                fontFamily: 'Roboto Light',
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
                fontFamily: 'Roboto Light',
                width: '30%'
            }
    },
    {
        title: 'Aksi',
        headerStyle:
            {
                textAlign: 'center', 
                width: '15%'
            },
        cellStyle:
            {
                textAlign: 'center',
                fontFamily: 'Roboto Light',
            },
        sorting: false,
        render: rowData => 
                    <div>
                        <Button variant="outlined" size='small' color="primary" 
                            component={NavLink} 
                            to={`/admin/mediaiklan/permintaan/${rowData.id_baliho}`}
                        >
                            Kelola
                        </Button>
                    </div>
    }
];