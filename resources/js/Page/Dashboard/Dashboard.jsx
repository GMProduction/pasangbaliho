import React, { Component } from 'react';
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import StatusBox from './Component/StatusBox';
import Grid from '@material-ui/core/Grid';
import PermintaanHarga from './Component/PermintaanHarga';
import PermintaanPenambahanAsset from './Component/PermintaanPenambahanAsset';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import {prepareMount, onMounted, fetchData} from '../../Actions/DashboardActions';

export class Dashboard extends Component {

    constructor(props) {
        super(props);
    }

    async componentDidMount () {
        await this.props.prepareMount()
        await this.props.fetchData()
        await this.props.onMounted()
    }

    render() {
        const {pageProgress, pageLoadingStatus, pageLoading} = this.props.page;
        const {qtyMedia, qtyAdvertiser, qtyMitra, dataPermintaanHarga, dataPermintaanAssets} = this.props.dashboard;
        if (pageLoading === true) {
            return(
                <div>
                    <LoadingBar progress={pageProgress} height={3} color='#f11946'
                    />
                    <Preloading textloading={pageLoadingStatus}/>
                </div>
            )
        }
        return (
            <div>
                <LoadingBar progress={pageProgress} height={3} color='#f11946'/>
                <React.Fragment>
                    <Fade right>
                        <StatusBox qtyMedia={qtyMedia} qtyAdvertiser={qtyAdvertiser} qtyMitra={qtyMitra}/>
                    </Fade>
                    <Fade bottom>
                    <React.Fragment>
                        <Grid container spacing={3} style={{marginTop: '10px'}}>
                            <Grid item xs={12} sm={12} md={7} lg={7}>
                                <PermintaanHarga data={dataPermintaanHarga}/>
                            </Grid>
                            <Grid item xs={12} sm={12} md={5} lg={5}>
                                <PermintaanPenambahanAsset data={dataPermintaanAssets}/>
                            </Grid>
                        </Grid>
                        <Grid container spacing={3} style={{marginTop: '10px'}}>
                            <Grid item xs={12} sm={12} md={12} lg={12}>
                            </Grid>
                        </Grid>
                    </React.Fragment>
                    </Fade>
                </React.Fragment> 
            </div>
        );
    }
}

function mapStateToProps(state) {
    return{
        dashboard: state.DashboardReducer,
        page: state.PageReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        fetchData: bindActionCreators(fetchData, dispatch),
        prepareMount: bindActionCreators(prepareMount, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch)
    }
}


export default connect(mapStateToProps, mapDispatcToProps)(Dashboard);
