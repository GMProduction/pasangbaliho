import React from 'react';
import { NavLink } from 'react-router-dom';
import Button from '@material-ui/core/Button';
import {dateFormater} from '../../../Controller/Helper'

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
        title: 'Nama Media', 
        field: 'namaMedia',
        headerStyle:
            {
                textAlign: 'left', 
                minWidth: '200px'
            },
        cellStyle: 
            {
                textAlign: 'left', 
                fontSize: 12
            }
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
export const columnsPermintaanNegoHarga = [
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
                            to={`/admin/negosiasi/negoharga/${rowData.id_transaksi}`}
                        >
                            Kelola
                        </Button>
                    </div>
    }
];
export const columnsPermintaanNegoMateri = [
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
                            to={`/admin/negosiasi/negomateri/${rowData.id_transaksi}`}
                        >
                            Kelola
                        </Button>
                    </div>
    }
];