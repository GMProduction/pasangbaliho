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
import {initData, resetData} from '../../Actions/DashboardActions';

export class Dashboard extends Component {

    constructor(props) {
        super(props);
    }

    componentDidMount () {
        this.props.initData()
    }

    componentWillUnmount () {
        this.props.resetData()
        
    }

    render() {
        console.log(this.props.reducer.pageLoading);
        return (
            <div>
                <LoadingBar
                    progress={this.props.reducer.loadingBarProgress}
                    height={3}
                    color='#f11946'
                   />
                   
                {
                    this.props.reducer.pageLoading === false ? 
                    <React.Fragment>
                        <Fade right>
                            <StatusBox qtyMedia={this.props.reducer.qtyMedia} qtyAdvertiser={this.props.reducer.qtyAdvertiser} qtyMitra={this.props.reducer.qtyMitra}/>
                        </Fade>
                        <Fade bottom>
                        <React.Fragment>
                            <Grid container spacing={3} style={{marginTop: '10px'}}>
                                <Grid item xs={12} sm={12} md={7} lg={7}>
                                    <PermintaanHarga data={this.props.reducer.dataPermintaanHarga}/>
                                </Grid>
                                <Grid item xs={12} sm={12} md={5} lg={5}>
                                    <PermintaanPenambahanAsset data={this.props.reducer.dataPermintaanAssets}/>
                                </Grid>
                            </Grid>
                            <Grid container spacing={3} style={{marginTop: '10px'}}>
                                <Grid item xs={12} sm={12} md={12} lg={12}>
                                </Grid>
                            </Grid>
                        </React.Fragment>
                        </Fade>
                    </React.Fragment> 
                    : 
                    <Preloading textloading={this.props.reducer.loadingStatus}/>
                }
            </div>
        );
    }
}

function mapStateToProps(state) {
    return{
        reducer: state.DashboardReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        initData: bindActionCreators(initData, dispatch),
        resetData: bindActionCreators(resetData, dispatch)
    }
}


export default connect(mapStateToProps, mapDispatcToProps)(Dashboard);
