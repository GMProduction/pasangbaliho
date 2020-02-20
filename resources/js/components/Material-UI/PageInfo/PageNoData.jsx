import React, { Component } from 'react';
import Box from '@material-ui/core/Box';

export class PageNoData extends Component {
    render() {
        return (
            <Box display='flex' justifyContent='center' alignItems='center'>
                <Box>
                    <Box display='flex' justifyContent='center'>
                        <img src='/assets/properties/emptydata.svg' width="350" height="350"></img>
                    </Box>
                    <Box display='flex' justifyContent='center' fontSize={26} fontWeight={700}>
                        Ooops, Sepertinya Data Yang Anda Cari Tidak Ada..
                    </Box>
                </Box>
            </Box>
        );
    }
}

export default PageNoData;
