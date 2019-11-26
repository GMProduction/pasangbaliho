import React, { Component } from 'react';
import MaterialTable from 'material-table';

export class BasicTable extends Component {
    render() {
        return (
            <div>
                <MaterialTable
                    columns={this.props.columns}
                    data={this.props.data}
                    options={{
                        draggable: false,
                        emptyRowsWhenPaging: false,
                        headerStyle: {    
                            fontFamily: 'Roboto Regular'
                        },
                    }}
                    style={{boxShadow: 'none'}}
                    components={{Toolbar: props => (
                            <div>
                            </div>
                        )
                    }}
                    isLoading={this.props.loading === null ? false : this.props.loading}
                />
            </div>
        );
    }
}

export default BasicTable;
