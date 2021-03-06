import React, { Component } from 'react';
import Box from '@material-ui/core/Box';

export class PageForbidden extends Component {
    render() {
        return (
            <Box display='flex' justifyContent='center' alignItems='center'>
                <Box>
                    <Box display='flex' justifyContent='center'>
                        <img src='/assets/properties/notfoundpage.svg' width="350" height="350"></img>
                    </Box>
                    <Box display='flex' justifyContent='center' fontSize={26} fontWeight={700}>
                        Ooops, Sepertinya Anda Tidak Di Perbolehkan Mengakses Halaman Ini..
                    </Box>
                </Box>
            </Box>
        );
    }
}

export default PageForbidden;
