import React from 'react';

export const columns = [
    {title: '#',cellStyle:{textAlign: 'center', fontSize: 12},headerStyle:{textAlign: 'center', minWidth: '50px'},sorting: false,
        render: rowData => <div>{rowData.tableData.id + 1}</div>},
    {title: 'Nama Mitra',field: 'nama',headerStyle:{textAlign: 'center', minWidth: '180px'},cellStyle:{textAlign: 'left',   }},
    {title: 'Nama Instansi',field: 'nama_instansi',headerStyle:{textAlign: 'center', minWidth: '180px'},cellStyle:{textAlign: 'left', fontSize: 12}},
    {title: 'Email',field: 'email',headerStyle:{textAlign: 'center', minWidth: '100px'},cellStyle: {textAlign: 'center', fontSize: 12}},
    {title: 'Telp.', field: 'telp',headerStyle:{textAlign: 'center', minWidth: '100'},cellStyle: {textAlign: 'center', fontSize: 12}},
    {title: 'Alamat', field: 'alamat',headerStyle:{textAlign: 'left', minWidth: '300px',},cellStyle: {textAlign: 'left', fontSize: 12}},
];