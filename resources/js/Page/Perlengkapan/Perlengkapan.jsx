import React, { Component } from 'react';
import Grid from '@material-ui/core/Grid';
import PanelMenu from '../../components/Material-UI/Panel/PanelMenu/PanelMenu';
import Fade from 'react-reveal/Fade';
import {withStyles} from '@material-ui/core';
import { breadcumbStyle } from '../../Style/Breadcumb';
import Breadcrumbs from '@material-ui/core/Breadcrumbs';
import LoadingBar  from 'react-top-loading-bar';
import Paper from '@material-ui/core/Paper';
import Box from '@material-ui/core/Box';
import Icon from '@material-ui/core/Icon';
import { NavLink } from 'react-router-dom';


export class Perlengkapan extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loadingBarProgress: 0,
        }
    }

    componentDidMount () {
        this.setState({
            loadingBarProgress: 100
        })
    }

    render() {
        const { classes } = this.props;
        return (
            <div>
                <LoadingBar
                    progress={this.state.loadingBarProgress}
                    height={3}
                    color='#f11946'
                   />
                <Paper elevation={0} style={breadcumbStyle.paper}>
                    <Breadcrumbs separator="›" aria-label="breadcrumb">
                            <NavLink
                            color="inherit" to="/admin"
                            className={classes.link}
                            >
                            <Icon className={classes.icon}>dashboard</Icon>
                                Dashboard
                            </NavLink>
                            <Box display='flex' alignItems='center' style={{color: '#555555', fontFamily: 'Roboto Light', fontSize: '14px'}}>
                            <Icon className={classes.icon}>question_answer</Icon>
                                Negosiasi
                            </Box>
                    </Breadcrumbs>
                </Paper>
                <Fade right>
                <Grid container justify='center' spacing={3}>
                        <Grid item xs={12} sm={12} md={6} lg={6}>
                            <PanelMenu
                                link='/dashboard/perlengkapan/mitra'
                                color='#20C1D5'
                                icon='assignment_ind'
                                title={`Mitra`}
                                subTitle='Mitra Media Iklan Pasang Baliho'
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={6} lg={6}>
                            <PanelMenu
                                link='/dashboard/perlengkapan/advertiser'
                                color='#FC9007'
                                icon='face'
                                title={`Advertiser`}
                                subTitle='Pemasang Iklan Pasang Baliho'
                            />
                        </Grid>
                </Grid>
                <Grid container justify='center' spacing={3}>
                        <Grid item xs={12} sm={12} md={6} lg={6}>
                            <PanelMenu
                                link='/dashboard/perlengkapan/mitra'
                                color='#20C1D5'
                                icon='assignment_ind'
                                title={`Kategori Media`}
                                subTitle='Mitra Media Iklan Pasang Baliho'
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={6} lg={6}>
                            <PanelMenu
                                link='/dashboard/perlengkapan/advertiser'
                                color='#FC9007'
                                icon='face'
                                title={`Admin`}
                                subTitle='Pemasang Iklan Pasang Baliho'
                            />
                        </Grid>
                </Grid>
                <Grid container justify='center' spacing={3}>
                        <Grid item xs={12} sm={12} md={6} lg={6}>
                            <PanelMenu
                                link='/dashboard/perlengkapan/mitra'
                                color='#20C1D5'
                                icon='assignment_ind'
                                title={`Provinsi`}
                                subTitle='Mitra Media Iklan Pasang Baliho'
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={6} lg={6}>
                            <PanelMenu
                                link='/dashboard/perlengkapan/advertiser'
                                color='#FC9007'
                                icon='face'
                                title={`Kota`}
                                subTitle='Pemasang Iklan Pasang Baliho'
                            />
                        </Grid>
                </Grid>
                </Fade>
            </div>
        );
    }
}

export default withStyles(breadcumbStyle)(Perlengkapan);
