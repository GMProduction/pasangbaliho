import React, { Component } from 'react';
import Grid from '@material-ui/core/Grid';
import PanelMenu from '../../components/Material-UI/Panel/PanelMenu/PanelMenu';
import CenterPanel from '../../components/Material-UI/Panel/CenteredPanel/CenterPanel';
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
                        <Grid item xs={12} sm={12} md={3} lg={3}>
                            <CenterPanel
                                link='/dashboard/perlengkapan/mitra'
                                color='#20C1D5'
                                icon='assignment_ind'
                                title={`Mitra`}
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={3} lg={3}>
                            <CenterPanel
                                link='/dashboard/perlengkapan/requestmitra'
                                color='#0d47a1'
                                icon='group_add'
                                title={`Permintaan Mitra`}
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={3} lg={3}>
                            <CenterPanel
                                link='/dashboard/perlengkapan/advertiser'
                                color='#FC9007'
                                icon='face'
                                title={`Advertiser`}
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={3} lg={3}>
                            <CenterPanel
                                link='/dashboard/perlengkapan/kategori'
                                color='#56AE5A'
                                icon='group_work'
                                title={`Kategori Media`}
                            />
                        </Grid>
                </Grid>
                <Grid container spacing={3} style={{marginBottom: '15px'}}>
                        <Grid item xs={12} sm={12} md={3} lg={3}>
                            <CenterPanel
                                link='/dashboard/perlengkapan/mitra'
                                color='#9129AC'
                                icon='place'
                                title={`Provinsi`}
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={3} lg={3}>
                            <CenterPanel
                                link='/dashboard/perlengkapan/advertiser'
                                color='#E91E63'
                                icon='location_city'
                                title={`Kota`}
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={3} lg={3}>
                            <CenterPanel
                                link='/dashboard/perlengkapan/mitra'
                                color='#EB4A47'
                                icon='desktop_windows'
                                title={`Slide Banner`}
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
