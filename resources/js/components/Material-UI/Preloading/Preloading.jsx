import React, { Component } from 'react';
import CircularProgress from '@material-ui/core/CircularProgress'
import Box from '@material-ui/core/Box';

export class Preloading extends Component {
    render() {
        return (
            <Box display='flex' justifyContent='center' alignItems='center' style={{minHeight: '515px'}}>
                <Box >
                <Box display='flex' justifyContent='center' style={{marginBottom: '15px'}}>
                <CircularProgress />
                </Box>
                <Box display='flex' justifyContent='center' fontFamily='Roboto' fontWeight={300}>
                    {this.props.textloading}
                </Box>
                </Box>
            </Box>
        );
    }
}

export default Preloading;
