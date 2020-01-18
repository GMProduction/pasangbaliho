import React, {Component}  from 'react';
import Box from '@material-ui/core/Box';
import Backdrop from '@material-ui/core/Backdrop';
import CircularProgress from '@material-ui/core/CircularProgress';
import {withStyles} from '@material-ui/core';
import compose from 'recompose/compose';

const useStyles = theme => ({
    backdrop: {
        zIndex: theme.zIndex.drawer + 1,
        color: '#fff',
        },
});

export class LoadingScreen extends Component{

    render(){
        const { classes } = this.props;
        return(
            <div>
                <Backdrop
                    className={classes.backdrop}
                    open={this.props.open}
                >
                    <Box display='flex' justifyContent='center' alignItems='center'>
                        <Box>
                            <Box display='flex' justifyContent='center' style={{marginBottom: '10px'}}>
                                <CircularProgress color="inherit" />
                            </Box>
                            <Box display='flex' justifyContent='center' alignItems='center'>
                                {this.props.text}
                            </Box>
                        </Box>
                    </Box>
                    
                </Backdrop>
            </div>
        );
    }
}
export default compose(
    withStyles(useStyles)
    )(LoadingScreen);
