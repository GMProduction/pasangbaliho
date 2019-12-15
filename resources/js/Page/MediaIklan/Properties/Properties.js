import React from 'react';

export const columns = [
    {title: '#',cellStyle:{textAlign: 'center'},headerStyle:{textAlign: 'center', width: '5%'},sorting: false,
        render: rowData => <div>{rowData.tableData.id + 1}</div>},
    {title: 'Nama Mitra',field: 'nama',headerStyle:{textAlign: 'left', width: '20%'},cellStyle:{textAlign: 'left', width: '20%'}},
    {title: 'Jenis Media',field: 'kategori',headerStyle:{textAlign: 'center',width: '15%'},cellStyle:{textAlign: 'center',width: '15%'}},
    {title: 'Kota',field: 'nama_kota',headerStyle:{textAlign: 'center', width: '15%'},cellStyle:{textAlign: 'center', width: '15%'}},
    {title: 'Alamat',field: 'alamat', headerStyle:{textAlign: 'left', width: '30%'}, cellStyle:{textAlign: 'left',width: '30%'}},
];