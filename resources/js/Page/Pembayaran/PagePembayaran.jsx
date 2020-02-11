import React, { Component } from 'react'
import Grid from '@material-ui/core/Grid';
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import CenterPanel from '../../components/Material-UI/Panel/CenteredPanel/CenterPanel';

import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';

import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import {prepareMount, pageOnProgress, onMounted } from '../../Actions/pageActions';


const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Pembayaran', icon: 'payment', active: true},
];

export class PagePembayaran extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loadingBarProgress: 0,
        }
    }

    async componentDidMount(){
        await this.props.prepareMount('Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.onMounted('Pembayaran')
    }

    
    render(){
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
        return(
            <div>
                <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                <MBreadcumb items={breadcumbItems}/>
                <Fade right>
                <Grid container spacing={3}>
                    <Grid item xs={12} sm={12} md={3} lg={3} style={{marginBottom: '25px'}}>
                            <CenterPanel
                                link='/dashboard/pembayaran/list'
                                color='#20C1D5'
                                icon='list'
                                title={`Proses Pembayaran`}
                            />
                    </Grid>
                    <Grid item xs={12} sm={12} md={3} lg={3}>
                        <CenterPanel
                            link='/dashboard/pembayaran/manual'
                            color='#FC9007'
                            icon='monetization_on'
                            title={`Manual Transfer`}
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
    )(PagePembayaran);