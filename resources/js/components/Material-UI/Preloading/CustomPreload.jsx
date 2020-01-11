import React, { Component } from 'react';
import { LineScale } from 'react-pure-loaders';
import Box from '@material-ui/core/Box';

export class CustomPreload extends Component {
    render() {
        return (
            <Box display='flex' justifyContent='center' alignItems='center' style={{minHeight: '515px'}}>
                <Box>
                <Box display='flex' justifyContent='center'>
                <LineScale
                color='#123abc'
                loading={true}/>
                </Box>
                <Box display='flex' justifyContent='center' fontFamily='Roboto' fontWeight={300}>
                    {this.props.textloading}
                </Box>
                </Box>
            </Box>
        );
    }
}

export default CustomPreload;
