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


export class PageNegosiasi extends Component {

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
                    <Grid item xs={12} sm={12} md={12} lg={12} >
                        <Grid container spacing={3}>
                            <Grid item xs={12} sm={12} md={6} lg={6}>
                                <PanelMenu
                                    link='/negosiasi/permintaan'
                                    color='#20C1D5'
                                    icon='local_offer'
                                    title={`Permintaan Harga (${0})`}
                                    subTitle='Permintaan Harga Media Iklan Oleh Advertiser Untuk Memasang Iklan.'
                                />
                            </Grid>
                            <Grid item xs={12} sm={12} md={6} lg={6}>
                                <PanelMenu
                                    link='/negosiasi/negoharga'
                                    color='#FC9007'
                                    icon='monetization_on'
                                    title={`Negosiasi Harga (${0})`}
                                    subTitle='Proses Negosiasi Harga Media Iklan Oleh Advertiser Untuk Memasang Iklan.'
                                />
                            </Grid>
                        </Grid>
                    </Grid>
                    <Grid item xs={12} sm={12} md={12} lg={12} style={{marginBottom: '15px'}}>
                        <PanelMenu
                            link='/negosiasi/negomateri'
                            color='#9129AC'
                            icon='forum'
                            title={`Negosiasi Materi (${0})`}
                            subTitle='Proses Negosiasi Materi Media Iklan Oleh Advertiser Untuk Memasang Iklan.'
                        />
                    </Grid>
                </Grid>
                </Fade>
            </div>
        );
    }
}

export default withStyles(breadcumbStyle)(PageNegosiasi);
