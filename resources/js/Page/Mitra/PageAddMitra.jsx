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

export class PageAddMitra extends Component {

    constructor(props) {
        super(props);
        this.state = {
            searchKey: '',
            redirect : false,
            idClient: '', email : '', nama: '', namaInstansi: '', password: '',  telp: '', alamat: '',
            status: '', apiToken: '',submitProses: false, error: false, succes: false
        }
    }

    handleChange = (e) => {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    clearField = (param) => {
        if(param === 'add'){
            this.setState({
                idClient: '', email : '', nama: '', namaInstansi: '', password: '',  telp: '', alamat: '',
            status: '', apiToken: ''
            })
        }else{
            this.setState({redirect: true})
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
    initState = (data) => {
        this.setState({
            idClient: data.id_client !== null ? data.id_client : '',
            email : data.email !== null ? data.email : '', 
            nama: data.nama !== null ? data.nama : '',
            namaInstansi: data.nama_instansi !== null ? data.nama_instansi : '', 
            telp: data.telp !== null ? data.telp : '', 
            alamat: data.alamat !== null ? data.alamat : '',
        })
    }
    async componentDidMount () {
        
        await this.props.prepareMount('Mohon tunggu Sebentar...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        if(this.props.filter === 'edit'){
            let id = this.props.match.params.id; 
            await this.props.fetchMitraById(id)
            this.initState(this.props.mitra.dataMitraById)
        }
        await this.props.onMounted('Mitra')
    }



    render(){
        const { classes } = this.props;
        const {pageProgress, pageLoadingStatus, pageLoading, redirect} = this.props.page;
        let title = 'Penambahan';
        if (this.props.filter === 'edit') {
            title = 'Edit'
        }

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
                                <Box flexGrow={1}>Form {title} Mitra</Box>
                            </BasicPanelHeader>
                            <BasicPanelContent>
                                <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                    <BasicTextfield name='email' placeholder='Email' label='Email' onChange={this.handleChange} value={this.state.email}/>
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                    <BasicTextfield name='namaInstansi' placeholder='Nama Instansi' label='Nama Instansi' onChange={this.handleChange} value={this.state.namaInstansi}/>
                                    </Grid>
                                </Grid>
                                <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={12}>
                                    <BasicTextfield name='nama' placeholder='Nama' label='Nama' onChange={this.handleChange} value={this.state.nama}/>
                                    </Grid>
                                </Grid>
                                <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={this.props.filter !== 'edit' ? 6 : 12}>
                                    <BasicTextfield name='telp' placeholder='No. Telp' label='No. Telp' onChange={this.handleChange} value={this.state.telp}/>
                                    </Grid>
                                    {this.props.filter !== 'edit' ? 
                                        <Grid item xs={12} sm={12} md={12} lg={6}>
                                        <TextField name='password' id="password" label="Password" margin="dense" variant="outlined" fullWidth type='password'
                                            value={this.state.password} onChange={this.handleChange}/>
                                        </Grid>
                                        : ''
                                    }
                                </Grid>
                                <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={12}>
                                    <TextField name='alamat' id="alamat" label="Alamat" margin="dense" variant="outlined" fullWidth multiline rows="3"
                                         value={this.state.alamat} onChange={this.handleChange}/>
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
    )(PageAddMitra);
