import React, { Component } from 'react';
import Box from '@material-ui/core/Box';
import {BasicPanel, BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import TextField from '@material-ui/core/TextField';
import Button from '@material-ui/core/Button';
import Grid from '@material-ui/core/Grid';
import Icon from '@material-ui/core/Icon';

import Divider from '@material-ui/core/Divider';
import Backdrop from '@material-ui/core/Backdrop';
import CircularProgress from '@material-ui/core/CircularProgress';
import {withStyles} from '@material-ui/core';
import Snackbar from '@material-ui/core/Snackbar';
import MuiAlert from '@material-ui/lab/Alert';

import BCPageMitra from '../../components/Material-UI/Breadcumbs/BCPageMitra';
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import compose from 'recompose/compose';
import { Redirect } from 'react-router'
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import {prepareMount, onMounted, pageOnProgress} from '../../Actions/pageActions';
import {fetchAdvertiserById, postAdvertiser} from '../../Actions/AdvertiserActions';

const style = {
    resize: {
        fontSize: 14, 
        fontFamily: 'Roboto Regular'
    },
}

const useStyles = theme => ({
    backdrop: {
        zIndex: theme.zIndex.drawer + 1,
        color: '#fff',
        },
});

export class PageAddAdvertiser extends Component {

    constructor(props) {
        super(props);
        this.state = {
            searchKey: '',
            redirect : false,
            id: '', email : '', nama: '', namaInstansi: '', password: '',  telp: '', alamat: '',
            submitProses: false, error: false, succes: false
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
                id: '', email : '', nama: '', namaInstansi: '', password: '',  telp: '', alamat: '',
            })
        }
    }

    initState = (data) => {
        this.setState({
            id: data.id !== null ? data.id : '',
            email : data.email !== null ? data.email : '', 
            nama: data.nama !== null ? data.nama : '',
            namaInstansi: data.nama_instansi !== null ? data.nama_instansi : '', 
            password: data.password !== null ? data.password : '', 
            telp: data.telp !== null ? data.telp : '', 
            alamat: data.alamat !== null ? data.alamat : '',
        })
    }

    handleSubmit = async () => {
        let data = new FormData();
        Object.keys(this.state).map( row => {
            data.append(row, this.state[row])
        })
        this.setState({submitProses: true,})
        let filter = this.props.filter;
        let res = await this.props.postAdvertiser(data, filter);
        if (res.status !== 'success'){
            this.setState({error: true,success: false})
        }else{
            if(filter === 'add'){this.clearField('add')}
            this.setState({error: false,success: true})
        }
        this.setState({submitProses: false,})
    }

    async componentDidMount () {
        
        await this.props.prepareMount('Mohon tunggu Sebentar...')
        if(this.props.filter === 'edit'){
            let id = this.props.match.params.id; 
            await this.props.fetchAdvertiserById(id)
            this.initState(this.props.advertiser.dataAdvertiserById)
        }
        await this.props.onMounted('Advertiser')
    }

    handleCloseSnackBar = (param) => {
        if(param === 'error'){
            this.setState({
                error: false
            })
        }else{
            this.setState({
                success: false
            })
        }
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

        // if (redirect === true) {
        //     let url = '/advertiser';
        //     return <Redirect to={url} />
        // }
        return(
            <div>
                <LoadingBar progress={pageProgress} height={3} color='#f11946'/>
                <Snackbar anchorOrigin={{ vertical: 'bottom', horizontal: 'right' }} open={this.state.error} autoHideDuration={3000} onClose={() => this.handleCloseSnackBar('error')}>
                    <Alert onClose={() => this.handleCloseSnackBar('error')} color="error">
                        Gagal Dalam Menyimpan Data. harap Isi Data Dengan Benar.
                    </Alert>
                </Snackbar>
                <Snackbar anchorOrigin={{ vertical: 'bottom', horizontal: 'right' }} open={this.state.success} autoHideDuration={3000} onClose={() => this.handleCloseSnackBar('success')}>
                    <Alert onClose={() => this.handleCloseSnackBar('success')} color="success">
                        Berhasil Menyimpan Data.
                    </Alert>
                </Snackbar>
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
                                    <TextField name='email' id="email" label="Email Advertiser" margin="dense" variant="outlined" fullWidth type='email'
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.email} onChange={this.handleChange}/>
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                    <TextField name='nama' id="nama" label="Nama Advertiser" margin="dense" variant="outlined" fullWidth
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
                                    <Grid item xs={12} sm={12} md={12} lg={12}>
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
                <Backdrop
                    className={classes.backdrop}
                    open={this.state.submitProses}
                >
                    <Box display='flex' justifyContent='center' alignItems='center'>
                        <Box>
                            <Box display='flex' justifyContent='center' style={{marginBottom: '10px'}}>
                                <CircularProgress color="inherit" />
                            </Box>
                            <Box display='flex' justifyContent='center' alignItems='center'>
                            Mohon Tunggu Sebentar. Sedang Menyimpan Data...
                            </Box>
                        </Box>
                    </Box>
                </Backdrop>
            </div>
        );
    }

}

function mapStateToProps(state) {
    return{
        advertiser: state.AdvertiserReducer,
        page: state.PageReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        prepareMount: bindActionCreators(prepareMount, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        pageOnProgress: bindActionCreators(pageOnProgress, dispatch),
        fetchAdvertiserById: bindActionCreators(fetchAdvertiserById, dispatch),
        postAdvertiser: bindActionCreators(postAdvertiser, dispatch),
    }
}
export default compose(
    withStyles(useStyles),
    connect(mapStateToProps, mapDispatcToProps)
    )(PageAddAdvertiser);

function Alert(props) {
    return <MuiAlert elevation={6} variant="filled" {...props} />;
}