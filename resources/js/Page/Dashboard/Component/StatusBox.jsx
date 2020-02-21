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
                                    <Box display="flex" justifyContent="flex-end" alignItems="center">Media</Box>
                                    <Box display="flex" justifyContent="flex-end" alignItems="center">{this.props.qtyMedia}</Box>
                                </Typography>
                            </IconPanelSubHeader>
                            <IconPanelContent>
                                <Divider/> 
                                <Typography component="div">
                                    <Box display="flex" justifyContent="flex-start" alignItems="center">
                                        <NavLink to='/dashboard/mediaiklan/all' style={style.link}>Lihat Detail</NavLink>
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
                                    <Box display="flex" justifyContent="flex-end" alignItems="center">Mitra</Box>
                                    <Box display="flex" justifyContent="flex-end" alignItems="center">{this.props.qtyMitra}</Box>
                                </Typography>
                            </IconPanelSubHeader>
                            <IconPanelContent>
                                <Divider/> 
                                <Typography component="div">
                                    <Box display="flex" justifyContent="flex-start" alignItems="center">
                                        <NavLink to='/dashboard/perlengkapan/mitra' style={style.link}>Lihat Detail</NavLink>
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
                                    <Box display="flex" justifyContent="flex-end" alignItems="center">Advertiser</Box>
                                    <Box display="flex" justifyContent="flex-end" alignItems="center">{this.props.qtyAdvertiser}</Box>
                                </Typography>
                            </IconPanelSubHeader>
                            <IconPanelContent>
                                <Divider/> 
                                <Typography component="div">
                                    <Box display="flex" justifyContent="flex-start" alignItems="center">
                                        <NavLink to='/dashboard/perlengkapan/advertiser' style={style.link}>Lihat Detail</NavLink>
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
                                    <Box display="flex" justifyContent="flex-end" alignItems="center">Penjualan</Box>
                                    <Box display="flex" justifyContent="flex-end" alignItems="center">{this.props.qtyPenjualan}</Box>
                                </Typography>
                            </IconPanelSubHeader>
                            <IconPanelContent>
                                <Divider/> 
                                <Typography component="div">
                                    <Box display="flex" justifyContent="flex-start" alignItems="center">
                                        <NavLink to='/penjualan' style={style.link}>Lihat Detail</NavLink>
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
