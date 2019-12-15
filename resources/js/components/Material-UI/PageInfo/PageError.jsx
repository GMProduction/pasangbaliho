import React, { Component } from 'react';
import Box from '@material-ui/core/Box';

export class PageError extends Component {
    render() {
        return (
            <Box display='flex' justifyContent='center' alignItems='center' style={{minHeight: '515px'}}>
                <Box>
                    <Box display='flex' justifyContent='center' fontSize={30} fontFamily='Roboto' fontWeight={700}>
                        Ooops, Sepertinya ada kesalahan..
                    </Box>
                    <Box display='flex' justifyContent='center' fontSize={20} fontFamily='Roboto' fontWeight={400}>
                        {this.props.message}
                    </Box>
                    <Box display='flex' justifyContent='center'>
                        <img src='/assets/properties/errorpage.svg' width="350" height="350"></img>
                    </Box>
                </Box>
            </Box>
        );
    }
}

export default PageError;
