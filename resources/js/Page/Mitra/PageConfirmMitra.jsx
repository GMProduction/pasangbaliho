import React, { Component } from 'react';
import Box from '@material-ui/core/Box';
import {BasicPanel, BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import Button from '@material-ui/core/Button';
import Grid from '@material-ui/core/Grid';
import Icon from '@material-ui/core/Icon';
import TextField from '@material-ui/core/TextField';
import BasicTextfield from '../../components/Material-UI/Textfield/BasicTextfield';
import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';

import Divider from '@material-ui/core/Divider';

import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import compose from 'recompose/compose';
import { Redirect } from 'react-router'
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import {prepareMount, onMounted, pageOnProgress, onSubmit, onNotify} from '../../Actions/pageActions';
import {fetchMitraById, postMitra} from '../../Actions/MitraActions';

const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Media Iklan', icon: 'desktop_mac', link:'/dashboard/mediaiklan', active: false},
    {title: 'Form Media', icon: 'note',  active: true},
];

export class PageConfirmMitra extends Component {

    constructor(props) {
        super(props);
        this.state = {
            searchKey: '',
            redirect : false,
        }
    }

    handleSubmit = async () => {
        let data = new FormData();
        Object.keys(this.state).map( row => {
            data.append(row, this.state[row])
        })
        this.props.onSubmit(true, 'Sedang menyimpan Data...')
        let filter = this.props.filter;
        let res = await this.props.postMitra(data, filter);
        if (res.status === 'success'){
            this.props.onNotify(true, 'success', 'Berhasil Menyimpan Data')
            this.clearField(filter)
        }else{
            this.props.onNotify(true, 'error', 'Gagal Menyimpan Data')
        }
        this.props.onSubmit(false, '')
    }
    
    async componentDidMount () {
        
        await this.props.prepareMount('Mohon tunggu Sebentar...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        let id = this.props.match.params.id; 
        await this.props.fetchMitraById(id)
        await this.props.onMounted('Mitra')
    }



    render(){
        const { classes } = this.props;
        const {pageProgress, pageLoadingStatus, pageLoading, redirect} = this.props.page;
        const {dataMitraById} = this.props.mitra;

        if (pageLoading === true) {
            return(
                <div>
                    <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                    <Preloading textloading={pageLoadingStatus}/>
                </div>
            )
        }

        if (this.state.redirect === true) {
            let url = '/dashboard/perlengkapan/mitra';
            return <Redirect to={url} />
        }

        return(
            <div>
                <LoadingBar progress={pageProgress} height={3} color='#f11946'/>
                <MBreadcumb items={breadcumbItems}/>
                <Fade bottom>
                <Grid justify='center' container spacing={2}>
                    <Grid item xs={12} sm={12} md={12} lg={9}>
                        <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                                <Box flexGrow={1}>Detail Informasi Mitra</Box>
                            </BasicPanelHeader>
                            <BasicPanelContent>
                                <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={5}>
                                        Email
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={1}>
                                        :
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                        {dataMitraById.email}
                                    </Grid>
                                </Grid>
                                <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={5}>
                                        Nama Mitra
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={1}>
                                        :
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                        {dataMitraById.nama}
                                    </Grid>
                                </Grid>
                                <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={5}>
                                        Nama Instansi
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={1}>
                                        :
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                        {dataMitraById.nama_instansi}
                                    </Grid>
                                </Grid>
                                <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={5}>
                                        No. Telp
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={1}>
                                        :
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                        {dataMitraById.telp}
                                    </Grid>
                                </Grid>
                                <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={5}>
                                        Alamat
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={1}>
                                        :
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                        {dataMitraById.alamat}
                                    </Grid>
                                </Grid>
                                
                                
                                <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                                <Box display="flex" justifyContent='flex-end' alignItems="center">
                                    <Button variant="outlined" color="primary" style={{marginLeft: '10px'}} startIcon={<Icon>check</Icon>} onClick={this.handleSubmit}>
                                        Simpan
                                    </Button>
                                </Box>
                            </BasicPanelContent>
                        </BasicPanel>
                    </Grid>
                </Grid>
                </Fade>
            </div>
        );
    }
}

function mapStateToProps(state) {
    return{
        mitra: state.MitraReducer,
        page: state.PageReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        prepareMount: bindActionCreators(prepareMount, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        pageOnProgress: bindActionCreators(pageOnProgress, dispatch),
        onSubmit: bindActionCreators(onSubmit, dispatch),
        onNotify: bindActionCreators(onNotify, dispatch),
        fetchMitraById: bindActionCreators(fetchMitraById, dispatch),
        postMitra: bindActionCreators(postMitra, dispatch),
    }
}
export default compose(
    connect(mapStateToProps, mapDispatcToProps)
    )(PageConfirmMitra);
