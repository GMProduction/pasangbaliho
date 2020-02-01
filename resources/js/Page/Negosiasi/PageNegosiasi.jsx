import React, { Component } from 'react';
import Grid from '@material-ui/core/Grid';
import PanelMenu from '../../components/Material-UI/Panel/PanelMenu/PanelMenu';
import Fade from 'react-reveal/Fade';
import {withStyles} from '@material-ui/core';
import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';
import LoadingBar  from 'react-top-loading-bar';
import Paper from '@material-ui/core/Paper';
import Box from '@material-ui/core/Box';
import Icon from '@material-ui/core/Icon';
import { NavLink } from 'react-router-dom';

import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import {prepareMount, pageOnProgress, onMounted } from '../../Actions/pageActions';


const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Negosiasi', icon: 'question_answer', active: true},
];

export class PageNegosiasi extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loadingBarProgress: 0,
        }
    }

    async componentDidMount(){
        await this.props.prepareMount('Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.onMounted('Negosiasi')
    }

    render() {
        const { classes } = this.props;
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
                <Grid container justify='center' spacing={3}>
                    <Grid item xs={12} sm={12} md={6} lg={6} >
                        <PanelMenu
                                link='/dashboard/negosiasi/permintaan'
                                color='#20C1D5'
                                icon='local_offer'
                                title={`Permintaan Harga`}
                                subTitle='Permintaan Harga Media Iklan Oleh Advertiser Untuk Memasang Iklan.'
                            />
                    </Grid>
                    <Grid item xs={12} sm={12} md={6} lg={6} >
                        <PanelMenu
                            link='/dashboard/negosiasi/negoharga'
                            color='#FC9007'
                            icon='monetization_on'
                            title={`Negosiasi Harga`}
                            subTitle='Proses Negosiasi Harga Media Iklan Oleh Advertiser Untuk Memasang Iklan.'
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
    )(PageNegosiasi);
