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
        title: 'Nama Advertiser',
        field: 'namaAdvertiser',
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
        title: 'Nama Media', 
        field: 'namaBaliho',
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
        title: 'Pengajuan Sewa', 
        headerStyle:
            {
                textAlign: 'center', 
                width: '20%'
            },
        cellStyle: 
            {
                textAlign: 'center', 
                fontFamily: 'Roboto Light',
                width: '20%'
            },
        render: rowData => 
                <div>
                    {`${rowData.tanggal_awal} - ${rowData.tanggal_akhir}`}
                </div>
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
                            to={`/admin/negosiasi/permintaan/${rowData.id_transaksi}`}
                        >
                            Kelola
                        </Button>
                    </div>
    }
];