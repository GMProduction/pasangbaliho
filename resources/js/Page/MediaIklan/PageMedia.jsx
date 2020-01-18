import React, { Component } from 'react';
import Grid from '@material-ui/core/Grid';
import PanelMenu from '../../components/Material-UI/Panel/PanelMenu/PanelMenu';
import Fade from 'react-reveal/Fade';
import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';
import LoadingBar  from 'react-top-loading-bar';

import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import {prepareMount, pageOnProgress, onMounted } from '../../Actions/pageActions';

const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Media Iklan', icon: 'desktop_mac', active: true},
];

export class PageMedia extends Component {
    constructor(props) {
        super(props);
        this.state = {
            dataPermintaan: [],
            dataPublikasi: [],
            dataBlokir: [],
            dataSemua: [],
            loadingBarProgress: 0,
        }
    }

    async componentDidMount(){
        await this.props.prepareMount('Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.onMounted('Media Iklan')
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
                <Grid container justify='center'>
                    <Grid item xs={12} sm={12} md={12} lg={12} style={{marginBottom: '25px'}}>
                        <Grid container spacing={3}>
                            <Grid item xs={12} sm={12} md={6} lg={6}>
                                <PanelMenu
                                    link='/dashboard/mediaiklan/form'
                                    color='#FC9007'
                                    icon='note_add'
                                    title='Penambahan Media Iklan'
                                    subTitle='Penambahan Media Iklan Yang Di Tambahkan oleh Admin.'
                                />
                            </Grid>
                            <Grid item xs={12} sm={12} md={6} lg={6}>
                                <PanelMenu
                                    link='/dashboard/mediaiklan/permintaan'
                                    color='#20C1D5'
                                    icon='local_offer'
                                    title={`Permintaan Penambahan Media Iklan`}
                                    subTitle='Permintaan Penambahan Media Iklan Yang di tambahkan oleh Mitra Media.'
                                />
                            </Grid>
                        </Grid>
                    </Grid>
                    <Grid item xs={12} sm={12} md={12} lg={12} style={{marginBottom: '25px'}}>
                        <Grid container spacing={3}>
                            <Grid item xs={12} sm={12} md={6} lg={6}>
                            <PanelMenu
                                link='/dashboard/mediaiklan/publish'
                                color='#56AE5A'
                                icon='filter_list'
                                title={`Daftar Media Iklan Terpublikasi (${this.state.dataPublikasi.length})`}
                                subTitle='Daftar Media Iklan Yang Di Publikasikan.'
                            />
                            </Grid>
                            <Grid item xs={12} sm={12} md={6} lg={6}>
                            <PanelMenu
                                link='/dashboard/mediaiklan/block'
                                color='#EB4A47'
                                icon='block'
                                title={`Daftar Media Iklan Terblokir (${this.state.dataBlokir.length})`}
                                subTitle='Daftar Media Iklan Yang Di Blokir Oleh Admin Atau Tidak Di Publikasikan.'
                            />
                            </Grid>
                        </Grid>
                    </Grid>
                    
                    <Grid item xs={12} sm={12} md={12} lg={12} style={{marginBottom: '15px'}}>
                        <PanelMenu
                                link='/dashboard/mediaiklan/daftar'
                                color='#9128AC'
                                icon='list'
                                title={`Daftar Semua Media iklan (${this.state.dataSemua.length})`}
                                subTitle='Daftar Semua Media Iklan Yang Di Publikasikan Atau Tidak Di Publikasikan.'
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
    )(PageMedia);
