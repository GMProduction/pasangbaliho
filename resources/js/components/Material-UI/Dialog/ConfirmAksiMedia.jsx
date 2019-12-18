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

export class ConfirmAksiMedia extends Component {

    constructor(props) {
        super(props);
        this.state = {
            openDelete: false,
            openStatus: false
        }
    }
    handleOpen = (e) => {
        this.setState({
            openDelete: true
        })
    }
    handleOpenStatus = (e) => {
        this.setState({
            openStatus: true
        })
    }

    handleClose= (e) => {
        this.setState({
            openDelete: false
        })
    }

    handleCloseStatus = (e) => {
        this.setState({
            openStatus: false
        })
    }

    handleSubmit = (param) => {
        this.props.onSubmit(param);
    }

    handleSubmitStatus = (param) => {
        this.props.onSubmitStatus(param);
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
                <IconButton  size='small' color="primary" 
                    onClick={this.handleOpenStatus}
                >
                <Icon>{this.props.iconStatus}</Icon>
                </IconButton >
                <Dialog
                    open={this.state.openDelete}
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
                <Dialog
                    open={this.state.openStatus}
                    onClose={this.handleCloseStatus}
                    aria-labelledby="alert-dialog-title"
                    aria-describedby="alert-dialog-description"
                >
                    <DialogTitle id="alert-dialog-title">{this.props.dialogTitleBlock}</DialogTitle>
                    <DialogActions>
                    <Button onClick={this.handleCloseStatus} color="primary">
                        Tidak
                    </Button>
                    <Button onClick={() => {this.handleSubmitStatus(this.props.id)}} color="primary" autoFocus>
                        ya
                    </Button>
                    </DialogActions>
                </Dialog>
            </div>
        );
    }
}

export default ConfirmAksiMedia;