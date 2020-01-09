import React, { Component } from 'react';
import Box from '@material-ui/core/Box';
import {BasicPanel, BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import TextField from '@material-ui/core/TextField';
import Button from '@material-ui/core/Button';
import Grid from '@material-ui/core/Grid';
import Icon from '@material-ui/core/Icon';

import Divider from '@material-ui/core/Divider';

import BCPageMitra from '../../components/Material-UI/Breadcumbs/BCPageMitra';
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import compose from 'recompose/compose';
import { Redirect } from 'react-router'
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import {prepareMount, onMounted, pageOnProgress} from '../../Actions/pageActions';
import {fetchMitraById, postMitra} from '../../Actions/MitraActions';


const style = {
    resize: {
        fontSize: 14, 
        fontFamily: 'Roboto Regular'
    },
}

export class PageAddMitra extends Component {

    constructor(props) {
        super(props);
        this.state = {
            searchKey: '',
            redirect : false,
            idClient: '', email : '', nama: '', namaInstansi: '', password: '', noKtp: '', npwp: '', nib: '', telp: '', alamat: '',
            status: '', apiToken: ''
        }
    }

    handleChange = (e) => {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    handleSubmit = async () => {
        let data = new FormData();
        Object.keys(this.state).map( row => {
            data.append(row, this.state[row])
        })
        await this.props.prepareMount('Mohon tunggu Sebentar. Sedang Melakukan Penghapusan Data...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Melakukan Penghapusan Data...')
        let filter = this.props.filter;
        await this.props.postMitra(data, filter);
        await this.props.onMounted('Mitra')
    }
    initState = (data) => {
        this.setState({
            idClient: data.id_client !== null ? data.id_client : '',
            email : data.email !== null ? data.email : '', 
            nama: data.nama !== null ? data.nama : '',
            namaInstansi: data.nama_instansi !== null ? data.nama_instansi : '', 
            password: data.password !== null ? data.password : '', 
            noKtp: data.no_ktp !== null ? data.no_ktp : '', 
            npwp: data.npwp !== null ? data.npwp : '', 
            nib: data.nib !== null ? data.nib : '', 
            telp: data.telp !== null ? data.telp : '', 
            alamat: data.alamat !== null ? data.alamat : '',
        })
    }
    async componentDidMount () {
        
        await this.props.prepareMount('Mohon tunggu Sebentar...')
        if(this.props.filter === 'edit'){
            let id = this.props.match.params.id; 
            await this.props.fetchMitraById(id)
            this.initState(this.props.mitra.dataMitraById)
        }
        await this.props.onMounted('Mitra')
    }


    render(){
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

        if (redirect === true) {
            let url = '/mitra';
            return <Redirect to={url} />
        }
        return(
            <div>
                <LoadingBar progress={pageProgress} height={3} color='#f11946'/>
                <BCPageMitra/>
                
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
                                    <TextField name='email' id="email" label="Email Mitra" margin="dense" variant="outlined" fullWidth type='email'
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.email} onChange={this.handleChange}/>
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                    <TextField name='nama' id="nama" label="Nama Mitra" margin="dense" variant="outlined" fullWidth
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.nama} onChange={this.handleChange}/>
                                    </Grid>
                                </Grid>
                                <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={this.props.filter !== 'edit' ? 6 : 12}>
                                    <TextField name='namaInstansi' id="namaInstansi" label="Nama Instansi" margin="dense" variant="outlined" fullWidth
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.namaInstansi} onChange={this.handleChange}/>
                                    </Grid>
                                    {this.props.filter !== 'edit' ? 
                                        <Grid item xs={12} sm={12} md={12} lg={6}>
                                        <TextField name='password' id="password" label="Password" margin="dense" variant="outlined" fullWidth type='password'
                                            InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.password} onChange={this.handleChange}/>
                                        </Grid>
                                        : ''
                                    }
                                </Grid>
                                <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                    <TextField name='noKtp' id="noKtp" label="No. KTP" margin="dense" variant="outlined" fullWidth
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.noKtp} onChange={this.handleChange}/>
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                    <TextField name='npwp' id="npwp" label="NPWP" margin="dense" variant="outlined" fullWidth
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.npwp} onChange={this.handleChange}/>
                                    </Grid>
                                </Grid>
                                <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                    <TextField name='nib' id="nib" label="NIB" margin="dense" variant="outlined" fullWidth
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.nib} onChange={this.handleChange}/>
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                    <TextField name='telp' id="telp" label="No. Telp" margin="dense" variant="outlined" fullWidth
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.telp} onChange={this.handleChange}/>
                                    </Grid>
                                </Grid>
                                <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={12}>
                                    <TextField name='alamat' id="alamat" label="Alamat" margin="dense" variant="outlined" fullWidth multiline rows="3"
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.alamat} onChange={this.handleChange}/>
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
        fetchMitraById: bindActionCreators(fetchMitraById, dispatch),
        postMitra: bindActionCreators(postMitra, dispatch),
    }
}
export default compose(
    connect(mapStateToProps, mapDispatcToProps)
    )(PageAddMitra);
