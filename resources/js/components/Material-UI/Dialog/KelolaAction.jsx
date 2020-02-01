import React, {Component} from 'react'
import Button from '@material-ui/core/Button';
import Icon from '@material-ui/core/Icon';
import IconButton from '@material-ui/core/IconButton';
import Tooltip from '@material-ui/core/Tooltip';
import EditIcon from '@material-ui/icons/Edit';
import CloseIcon from '@material-ui/icons/Close';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogContentText from '@material-ui/core/DialogContentText';
import DialogTitle from '@material-ui/core/DialogTitle';
import { NavLink } from 'react-router-dom';
import {withStyles} from '@material-ui/core';
import compose from 'recompose/compose';

const useStyles = theme => ({
    iconButton: {
        color: '#555555',
        marginLeft: '5px'
    }
});



export class KelolaAction extends Component {

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

    handleDelete = (id) => {
        this.props.onDelete(id);
        this.setState({
            open: false
        })
    }



    render(){
        const { open } = this.state
        const { editUrl, message, id, classes } = this.props
        return(
            <div>
                <IconButton  size='small' color="primary" 
                    component={NavLink} 
                    to={editUrl}
                    classes={{
                        colorPrimary: classes.iconButton
                    }}
                >
                    <EditIcon/>
                </IconButton >
                <IconButton size='small' color="primary" 
                            classes={{
                                colorPrimary: classes.iconButton
                            }}
                    onClick={this.handleOpen}
                >
                    <CloseIcon/>
                </IconButton >
                <Dialog
                    open={open}
                    onClose={this.handleClose}
                    aria-labelledby="alert-dialog-title"
                    aria-describedby="alert-dialog-description"
                >
                    <DialogTitle id="alert-dialog-title">Hapus Data</DialogTitle>
                    <DialogContent>
                        <DialogContentText id="alert-dialog-description">
                            {message}
                        </DialogContentText>
                    </DialogContent>
                    <DialogActions>
                    <Button onClick={this.handleClose} color="primary">
                        Tidak
                    </Button>
                    <Button onClick={() => {this.handleDelete(id)}} color="primary" autoFocus>
                        ya
                    </Button>
                    </DialogActions>
                </Dialog>
            </div>
        );
    }
}

export default compose(
    withStyles(useStyles))(KelolaAction);