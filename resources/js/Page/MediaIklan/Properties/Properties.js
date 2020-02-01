import React from 'react';

export const columns = [
    {title: '#',cellStyle:{textAlign: 'center', fontSize: 12},headerStyle:{textAlign: 'center', minWidth: '50px'},sorting: false,
        render: rowData => <div>{rowData.tableData.id + 1}</div>},
    {title: 'Nama Mitra',field: 'nama',headerStyle:{textAlign: 'center', minWidth: '180px'},cellStyle:{textAlign: 'center', fontSize: 12}},
    {title: 'Jenis Media',field: 'kategori',headerStyle:{textAlign: 'center',minWidth: '180px'},cellStyle:{textAlign: 'center',fontSize: 12}},
    {title: 'Nama Media',field: 'nama_baliho',headerStyle:{textAlign: 'left',minWidth: '250px'},cellStyle:{textAlign: 'left',fontSize: 12}},
    {title: 'Kota',
        headerStyle:
            {textAlign: 'center', minWidth: '200px'},
        cellStyle:
            {textAlign: 'center', fontSize: 12},
        render: rowData =>
            <div>
                {`${rowData.nama_kota} (${rowData.nama_provinsi})`}
            </div>
    },
    {title: 'Alamat',
        field: 'alamat', 
        headerStyle:
            {textAlign: 'left', minWidth: '250px'}, 
        cellStyle:
            {textAlign: 'left', fontSize: 12}
    },
];