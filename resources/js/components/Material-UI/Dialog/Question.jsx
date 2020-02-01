import React, {Component} from 'react';

import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogContentText from '@material-ui/core/DialogContentText';
import DialogTitle from '@material-ui/core/DialogTitle';
import Button from '@material-ui/core/Button';

export class Question extends Component {

    
    render(){
        const {open, title, message} = this.props;
        return(
            <div>
                <Dialog
                    open={open}
                    onClose={this.props.onClose}
                    aria-labelledby="alert-dialog-title"
                    aria-describedby="alert-dialog-description"
                >
                <DialogTitle id="alert-dialog-title">{title}</DialogTitle>
                    <DialogContent>
                        <DialogContentText id="alert-dialog-description">
                            {message}
                        </DialogContentText>
                    </DialogContent>
                    <DialogActions>
                    <Button onClick={this.props.onClose} color="primary">
                        Tidak
                    </Button>
                    <Button onClick={this.props.onConfirm} color="primary" autoFocus>
                        ya
                    </Button>
                    </DialogActions>
                </Dialog>
            </div>
        );
    }
}

export default Question;