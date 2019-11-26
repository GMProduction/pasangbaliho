import React, { Component } from 'react';
import Iconpanel, { IconPanelHeader, IconPanelSubHeader, IconPanelContent } from '../../../components/Material-UI/Panel/Iconpanel/Iconpanel';
import Icon from '@material-ui/core/Icon';
import Grid from '@material-ui/core/Grid';
import Box from '@material-ui/core/Box';
import Typography from '@material-ui/core/Typography';
import Divider from '@material-ui/core/Divider';
import { NavLink } from 'react-router-dom';

const style= {
    link:{
        marginTop: '5px',
        textDecoration: 'none',
        color: 'black',
        '&:hover' : {
            color: 'red !important',
            background: 'black'
        }
    }
}
export class StatusBox extends Component {
    render() {
        return (
            <div className='statusbox'>
                <Grid container spacing={3}>
                    <Grid item xs={12} sm={12} md={6} lg={3}>
                        <Iconpanel>
                            <IconPanelHeader color='#FC9006'>
                                <Icon fontSize='inherit'>desktop_mac</Icon>
                            </IconPanelHeader>
                            <IconPanelSubHeader>
                                <Typography component="div">
                                    <Box fontSize={14} fontFamily="Roboto Light" display="flex" justifyContent="flex-end" alignItems="center">Baliho</Box>
                                    <Box fontSize={24} fontFamily="Roboto Light" display="flex" justifyContent="flex-end" alignItems="center">{this.props.jumlahBaliho}</Box>
                                </Typography>
                            </IconPanelSubHeader>
                            <IconPanelContent>
                                <Divider/> 
                                <Typography component="div">
                                    <Box fontSize={14} fontFamily="Roboto Light" display="flex" justifyContent="flex-start" alignItems="center">
                                        <NavLink to='/dashboard/baliho' style={style.link}>Lihat Detail</NavLink>
                                    </Box>
                                </Typography>
                            </IconPanelContent>
                        </Iconpanel>
                    </Grid>
                    <Grid item xs={12} sm={12} md={6} lg={3}>
                        <Iconpanel>
                            <IconPanelHeader color='#55AE59'>
                                <Icon fontSize='inherit'>assignment_ind</Icon>
                            </IconPanelHeader>
                            <IconPanelSubHeader>
                                <Typography component="div">
                                    <Box fontSize={14} fontFamily="Roboto Light" display="flex" justifyContent="flex-end" alignItems="center">Client</Box>
                                    <Box fontSize={24} fontFamily="Roboto Light" display="flex" justifyContent="flex-end" alignItems="center">120</Box>
                                </Typography>
                            </IconPanelSubHeader>
                            <IconPanelContent>
                                <Divider/> 
                                <Typography component="div">
                                    <Box fontSize={14} fontFamily="Roboto Light" display="flex" justifyContent="flex-start" alignItems="center">
                                        <NavLink to='/dashboard/client' style={style.link}>Lihat Detail</NavLink>
                                    </Box>
                                </Typography>
                            </IconPanelContent>
                        </Iconpanel>
                    </Grid>
                    <Grid item xs={12} sm={12} md={6} lg={3}>
                        <Iconpanel>
                            <IconPanelHeader color='#EB4946'>
                                <Icon fontSize='inherit'>face</Icon>
                            </IconPanelHeader>
                            <IconPanelSubHeader>
                                <Typography component="div">
                                    <Box fontSize={14} fontFamily="Roboto Light" display="flex" justifyContent="flex-end" alignItems="center">Advertiser</Box>
                                    <Box fontSize={24} fontFamily="Roboto Light" display="flex" justifyContent="flex-end" alignItems="center">120</Box>
                                </Typography>
                            </IconPanelSubHeader>
                            <IconPanelContent>
                                <Divider/> 
                                <Typography component="div">
                                    <Box fontSize={14} fontFamily="Roboto Light" display="flex" justifyContent="flex-start" alignItems="center">
                                        <NavLink to='/dashboard/advertiser' style={style.link}>Lihat Detail</NavLink>
                                    </Box>
                                </Typography>
                            </IconPanelContent>
                        </Iconpanel>
                    </Grid>
                    <Grid item xs={12} sm={12} md={6} lg={3}>
                        <Iconpanel>
                            <IconPanelHeader color='#1FC1D5'>
                                <Icon fontSize='inherit'>shopping_cart</Icon>
                            </IconPanelHeader>
                            <IconPanelSubHeader>
                                <Typography component="div">
                                    <Box fontSize={14} fontFamily="Roboto Light" display="flex" justifyContent="flex-end" alignItems="center">Penjualan</Box>
                                    <Box fontSize={24} fontFamily="Roboto Light" display="flex" justifyContent="flex-end" alignItems="center">120</Box>
                                </Typography>
                            </IconPanelSubHeader>
                            <IconPanelContent>
                                <Divider/> 
                                <Typography component="div">
                                    <Box fontSize={14} fontFamily="Roboto Light" display="flex" justifyContent="flex-start" alignItems="center">
                                        <NavLink to='/dashboard/penjualan' style={style.link}>Lihat Detail</NavLink>
                                    </Box>
                                </Typography>
                            </IconPanelContent>
                        </Iconpanel>
                    </Grid>
                </Grid>
                
            </div>
        );
    }
}
export default StatusBox;
