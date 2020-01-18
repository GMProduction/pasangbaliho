import React, { Component } from 'react';
import { Redirect } from 'react-router'
import Icon from '@material-ui/core/Icon';
import Box from '@material-ui/core/Box';
import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import TextField from '@material-ui/core/TextField';
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import Grid from '@material-ui/core/Grid';
import { Divider } from '@material-ui/core';
import Button from '@material-ui/core/Button';
import InputAdornment from '@material-ui/core/InputAdornment';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import {fetchPaymentById, postNegosiasi} from '../../Actions/PaymentActions'; 
import {prepareMount, pageOnProgress, onMounted, prepareSearch, onSearched} from '../../Actions/pageActions';
import {redirectPage } from '../../Actions/pageActions';
import {withStyles} from '@material-ui/core';
import Backdrop from '@material-ui/core/Backdrop';
import CircularProgress from '@material-ui/core/CircularProgress';
import Snackbar from '@material-ui/core/Snackbar';
import MuiAlert from '@material-ui/lab/Alert';
import {mainApi} from '../../Controller/APIControll';
import NumberFormat from 'react-number-format';


const useStyles = theme => ({
    backdrop: {
        zIndex: theme.zIndex.drawer + 1,
        color: '#fff',
        },
});

export class PagePaymentConfirm extends Component{

    constructor(props) {
        super(props);
        this.state = {
            lampiran: null,
            hargaDeal: 0,
            submitProses: false,
            redirect: false,
            error: false,
            success: false
        }
    }

    handleSave = async (status) =>{
        const user = JSON.parse(localStorage.getItem('user'));
        const token = user.api_token;
        const configJSON = {
            headers: {
                'content-type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            }
        }
        let data = new FormData();
        data.append('id', this.props.payment.dataPaymentById.id)
        data.append('status', status)
        
        this.setState({submitProses: true,})
        try{
            let response = await mainApi.post('/payment/patchPayment', data, configJSON)
            if (response.status === 200) {
                
                window.open('https://api.whatsapp.com/send?phone='+this.props.payment.dataPaymentById.telp+
                '&text=Terima Kasih '+this.props.payment.dataPaymentById.namaAdvertiser+' Telah Menggunakan Jasa pasangbaliho.com. Pembayaran Dengan No. Rekening '+this.props.payment.dataPaymentById.no_rekening+' Atas Nama '+this.props.payment.dataPaymentById.atas_nama+' Sudah Kami Konfirmasi', '_blank')
                
                this.setState({submitProses: false,})
                this.setState({error: false,success: true})
                this.setState({
                    redirect: true
                })
            }
        }catch(e){
            alert('Terjadi Kesalahan /n'+e);
            this.setState({submitProses: false,})
            this.setState({error: true,success: false})
        }
    }

    async componentDidMount () {
        let id = this.props.match.params.id;
        let filter = this.props.filter;
        await this.props.prepareMount()
        await this.props.fetchPaymentById('pending','Manual Payment', id)
        await this.props.onMounted()
    }

    render(){
        const { classes } = this.props;
        const {pageProgress, pageLoadingStatus, pageLoading, redirect} = this.props.page;
        const {dataPaymentById, dataPaymentByIdFound} = this.props.payment;
        console.log(dataPaymentById);
        if (pageLoading === true) {
            return(
                <div>
                    <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                    <Preloading textloading={pageLoadingStatus}/>
                </div>
            )
        }

        if (dataPaymentByIdFound !== true) {
            return(
                <div>
                    <h1>DATA NOT FOUND</h1>
                </div>
            )
        }

        if (this.state.redirect === true) {
            let url = '/dashboard/pembayaran/manual';
            return <Redirect to={url} />
        }
        return(
            <div>
                <LoadingBar progress={pageProgress} height={3} color='#f11946' />
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
                <Fade bottom>
                    <Grid container justify='center' spacing={2}>
                    <Grid item xs={12} sm={12} md={12} lg={8}>
                    <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1} display="flex" alignItems="center">Informasi Pembayaran Manual Transfer</Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>No. Transaksi</Box>
                                    <Box>:</Box>
                                    
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                            <Box>{dataPaymentById.idTransaksi}</Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>Advertiser</Box>
                                    <Box>:</Box>
                                    
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                            <Box>{dataPaymentById.namaAdvertiser}</Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>Instansi</Box>
                                    <Box>:</Box>
                                    
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                            <Box>{dataPaymentById.namaInstansi}</Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>Email</Box>
                                    <Box>:</Box>
                                    
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                            <Box>{dataPaymentById.email}</Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>No. Hp</Box>
                                    <Box>:</Box>
                                    
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                            <Box>{dataPaymentById.telp}</Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>Vendor</Box>
                                    <Box>:</Box>
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                            <Box>{dataPaymentById.vendor}</Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>No. Rekening</Box>
                                    <Box>:</Box>
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                            <Box>{dataPaymentById.no_rekening}</Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>Atas Nama</Box>
                                    <Box>:</Box>
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                            <Box>{dataPaymentById.atas_nama}</Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>Nominal Transfer</Box>
                                    <Box>:</Box>
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                            <Box>{dataPaymentById.nominal}</Box>
                            </Grid>
                        </Grid>
                        <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                        <Box display="flex" justifyContent='flex-end' alignItems="center">
                            <Button variant="outlined" color="secondary" startIcon={<Icon>close</Icon>} onClick={() => this.handleSave('tolak')}>
                                Cancel
                            </Button>
                            <Button variant="contained" color="primary" style={{marginLeft: '10px'}} startIcon={<Icon>check</Icon>} onClick={() => this.handleSave('terima')}>
                                Submit
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
        page: state.PageReducer,
        payment: state.PaymentReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        prepareMount: bindActionCreators(prepareMount, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        prepareSearch: bindActionCreators(prepareSearch, dispatch),
        onSearched: bindActionCreators(onSearched, dispatch),
        fetchPaymentById: bindActionCreators(fetchPaymentById, dispatch),
    }
}

export default compose(
    withStyles(useStyles),
    connect(mapStateToProps, mapDispatcToProps) 
    )(PagePaymentConfirm);

function Alert(props) {
    return <MuiAlert elevation={6} variant="filled" {...props} />;
}