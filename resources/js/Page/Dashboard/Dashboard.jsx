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

import {fetchQtyMitra} from '../../Actions/MitraActions';
import {fetchQtyAdvertiser} from '../../Actions/AdvertiserActions';
import {fetchQtyMedia, fetchMedia} from '../../Actions/MediaIklanActions';
import {fetchNegosiasi} from '../../Actions/NegosiasiActions';
import {prepareMount, pageOnProgress, onMounted} from '../../Actions/pageActions';

export class Dashboard extends Component {

    constructor(props) {
        super(props);
    }

    async componentDidMount () {
        await this.props.prepareMount('Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        if (this.props.role === 'admin') {
            await this.props.pageOnProgress(20, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data Jumlah Mitra...')
            await this.props.fetchQtyMitra()
            await this.props.pageOnProgress(40, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data Jumlah Advertiser...')
            await this.props.fetchQtyAdvertiser()
            await this.props.pageOnProgress(60, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data Jumlah Media...')
            await this.props.fetchQtyMedia()
            await this.props.pageOnProgress(80, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data Permintaan Harga...')
            await this.props.fetchNegosiasi('permintaan','')
            await this.props.pageOnProgress(90, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data Permintaan Penambahan Asset...')
            await this.props.fetchMedia('pending','')
        }
        await this.props.onMounted('Dashboard')
    }

    render() {
        const {pageProgress, pageLoadingStatus, pageLoading} = this.props.page;
        const {qtyMitra} = this.props.mitra;
        const {qtyAdvertiser} = this.props.advertiser;
        const {qtyMedia, dataMedia} = this.props.mediaiklan;
        const {dataNegosiasi} = this.props.negosiasi;
        if (pageLoading === true) {
            return(
                <div>
                    <LoadingBar progress={pageProgress} height={3} color='#f11946'/>
                    <Preloading textloading={pageLoadingStatus}/>
                </div>
            )
        }

        if (this.props.role === 'admin') {
            return(
                <div>
                    <LoadingBar progress={pageProgress} height={3} color='#f11946'/>
                    <React.Fragment>
                        <Fade right>
                            <StatusBox qtyMedia={qtyMedia} qtyAdvertiser={qtyAdvertiser} qtyMitra={qtyMitra}/>
                        </Fade>

                        <Fade bottom>
                            <Grid container spacing={3} style={{marginTop: '10px'}}>
                                <Grid item xs={12} sm={12} md={12} lg={12}>
                                    <PermintaanHarga data={dataNegosiasi}/>
                                </Grid>
                            </Grid>
                        </Fade>
                    </React.Fragment> 
                </div>
            );
        }
        return (
            <div>
                <LoadingBar progress={pageProgress} height={3} color='#f11946'/>
                <h1>Pasang Baliho.com</h1>
            </div>
        );
    }
}

function mapStateToProps(state) {
    return{
        mitra: state.MitraReducer,
        advertiser: state.AdvertiserReducer,
        mediaiklan: state.MediaIklanReducer,
        negosiasi: state.NegosiasiReducer,
        page: state.PageReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        prepareMount: bindActionCreators(prepareMount, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        pageOnProgress: bindActionCreators(pageOnProgress, dispatch),
        fetchQtyMitra: bindActionCreators(fetchQtyMitra, dispatch),
        fetchQtyAdvertiser: bindActionCreators(fetchQtyAdvertiser, dispatch),
        fetchQtyMedia: bindActionCreators(fetchQtyMedia, dispatch),
        fetchNegosiasi: bindActionCreators(fetchNegosiasi, dispatch),
        fetchMedia: bindActionCreators(fetchMedia, dispatch),
    }
}


export default connect(mapStateToProps, mapDispatcToProps)(Dashboard);
