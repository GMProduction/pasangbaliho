import React from 'react';

export const columns = [
    {title: '#',cellStyle:{textAlign: 'center', fontSize: 12},headerStyle:{textAlign: 'center', minWidth: '50px'},sorting: false,
        render: rowData => <div>{rowData.tableData.id + 1}</div>},
    {title: 'Judul',field: 'judul',headerStyle:{textAlign: 'center', minWidth: '350px'},cellStyle:{textAlign: 'left', fontSize: 12}},
];