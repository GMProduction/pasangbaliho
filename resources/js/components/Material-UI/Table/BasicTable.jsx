import React, { Component } from 'react';
import MaterialTable from 'material-table';

export class BasicTable extends Component {
    render() {
        return (
            <div style={{overflow: 'auto'}}>
                <MaterialTable
                    columns={this.props.columns}
                    data={this.props.data}
                    options={{
                        draggable: false,
                        emptyRowsWhenPaging: false,
                        headerStyle: {    
                            fontFamily: 'Roboto'
                        },
                        rowStyle:{
                            fontFamily: 'Roboto',
                        }
                    }}
                    style={{boxShadow: 'none'}}
                    components={{Toolbar: props => (
                            <div>
                            </div>
                        )
                    }}
                    // onRowClick={this.props.onRowClick}
                    isLoading={this.props.loading === null ? false : this.props.loading}
                />
            </div>
        );
    }
}

export default BasicTable;
