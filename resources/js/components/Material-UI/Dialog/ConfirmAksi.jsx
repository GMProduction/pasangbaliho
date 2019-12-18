import React, { Component } from 'react';
import Button from '@material-ui/core/Button';
import Icon from '@material-ui/core/Icon';
import IconButton from '@material-ui/core/IconButton';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogContentText from '@material-ui/core/DialogContentText';
import DialogTitle from '@material-ui/core/DialogTitle';
import { NavLink } from 'react-router-dom';

export class ConfirmAksi extends Component {

    constructor(props) {
        super(props);
        this.state = {
            open: false
        }
    }
    handleOpen = (e) => {
        this.setState({
            open: true
        })
    }

    handleClose= (e) => {
        this.setState({
            open: false
        })
    }

    handleSubmit = (param) => {
        this.props.onSubmit(param);
    }

    render(){
        
        return(
            <div>
                <IconButton  size='small' color="primary" 
                    component={NavLink} 
                    to={this.props.url}
                >
                    <Icon>edit</Icon>
                </IconButton >
                <IconButton  size='small' color="primary" 
                    onClick={this.handleOpen}
                >
                    <Icon>delete</Icon>
                </IconButton >
                <Dialog
                    open={this.state.open}
                    onClose={this.handleClose}
                    aria-labelledby="alert-dialog-title"
                    aria-describedby="alert-dialog-description"
                >
                    <DialogTitle id="alert-dialog-title">{this.props.dialogTitle}</DialogTitle>
                    <DialogActions>
                    <Button onClick={this.handleClose} color="primary">
                        Tidak
                    </Button>
                    <Button onClick={() => {this.handleSubmit(this.props.id)}} color="primary" autoFocus>
                        ya
                    </Button>
                    </DialogActions>
                </Dialog>
            </div>
        );
    }
}

export default ConfirmAksi;