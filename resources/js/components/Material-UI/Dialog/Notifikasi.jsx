import React, { Component } from 'react';

import Snackbar from '@material-ui/core/Snackbar';
import SnackbarContent from '@material-ui/core/SnackbarContent';

export class Notifikasi extends Component {

    constructor(props) {
        super(props);
        this.state = {
            open: false
        }
    }


    handleClose= (e) => {
        this.setState({
            open: false
        })
    }

    render(){
        return(
            <div>
                <Snackbar
                    anchorOrigin={{
                    vertical: 'bottom',
                    horizontal: 'right',
                    }}
                    open={this.props.open}
                    ContentProps={{
                    'aria-describedby': 'message-id',
                    }}
                    message={<span id="message-id">Snackbars</span>}
                />
            </div>
        );
    }
}

export default Notifikasi;