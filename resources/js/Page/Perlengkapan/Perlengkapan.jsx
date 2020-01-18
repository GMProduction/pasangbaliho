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

import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import {prepareMount, pageOnProgress, onMounted } from '../../Actions/pageActions';


const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Media Iklan', icon: 'desktop_mac', active: true},
];

export class Perlengkapan extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loadingBarProgress: 0,
        }
    }

    async componentDidMount(){
        await this.props.prepareMount('Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.onMounted('Perlengkapan')
    }

    render() {
        const {pageProgress, pageLoadingStatus, pageLoading, dataLoading} = this.props.page;
        if (pageLoading === true) {
            return(
                <div>
                    <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                    <Preloading textloading={pageLoadingStatus}/>
                </div>
            )
        }
        return (
            <div>
                <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                <MBreadcumb items={breadcumbItems}/>
                <Fade right>
                <Grid container justify='center' spacing={3} style={{marginBottom: '15px'}}>
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
                <Grid container justify='center' spacing={3} style={{marginBottom: '15px'}}>
                        <Grid item xs={12} sm={12} md={6} lg={6}>
                            <PanelMenu
                                link='/dashboard/perlengkapan/mitra'
                                color='#56AE5A'
                                icon='assignment_ind'
                                title={`Kategori Media`}
                                subTitle='Mitra Media Iklan Pasang Baliho'
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={6} lg={6}>
                            <PanelMenu
                                link='/dashboard/perlengkapan/mitra'
                                color='#EB4A47'
                                icon='assignment_ind'
                                title={`Slide Banner`}
                                subTitle='Mitra Media Iklan Pasang Baliho'
                            />
                        </Grid>
                </Grid>
                <Grid container justify='center' spacing={3} style={{marginBottom: '15px'}}>
                        <Grid item xs={12} sm={12} md={6} lg={6}>
                            <PanelMenu
                                link='/dashboard/perlengkapan/mitra'
                                color='#9129AC'
                                icon='assignment_ind'
                                title={`Provinsi`}
                                subTitle='Mitra Media Iklan Pasang Baliho'
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={6} lg={6}>
                            <PanelMenu
                                link='/dashboard/perlengkapan/advertiser'
                                color='#E91E63'
                                icon='face'
                                title={`Kota`}
                                subTitle='Pemasang Iklan Pasang Baliho'
                            />
                        </Grid>
                </Grid>
                <Grid container justify='center' spacing={3} style={{marginBottom: '15px'}}>
                        <Grid item xs={12} sm={12} md={6} lg={12}>
                            <PanelMenu
                                link='/dashboard/perlengkapan/advertiser'
                                color='#EB4A47'
                                icon='face'
                                title={`Admin`}
                                subTitle='Pemasang Iklan Pasang Baliho'
                            />
                        </Grid>
                </Grid>
                </Fade>
            </div>
        );
    }
}

function mapStateToProps(state) {
    return{
        page: state.PageReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        prepareMount: bindActionCreators(prepareMount, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        pageOnProgress: bindActionCreators(pageOnProgress, dispatch),
    }
}

export default compose(
    connect(mapStateToProps, mapDispatcToProps)
    )(Perlengkapan);
