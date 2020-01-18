import React, {Component} from 'react'
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
import {fetchNegosiasiAndSaldoById, postNegosiasi} from '../../Actions/NegosiasiActions'; 
import {prepareMount, pageOnProgress, onMounted, prepareSearch, onSearched} from '../../Actions/pageActions';
import {redirectPage } from '../../Actions/pageActions';
import {withStyles} from '@material-ui/core';
import Backdrop from '@material-ui/core/Backdrop';
import CircularProgress from '@material-ui/core/CircularProgress';
import Snackbar from '@material-ui/core/Snackbar';
import MuiAlert from '@material-ui/lab/Alert';
import {mainApi} from '../../Controller/APIControll';
import NumberFormat from 'react-number-format';
import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';


const useStyles = theme => ({
    backdrop: {
        zIndex: theme.zIndex.drawer + 1,
        color: '#fff',
        },
});

const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'pembayaran', icon: 'payment', link:'/dashboard/pembayaran', active: false},
    {title: 'Daftar Negosiasi', icon: 'list',  active: true},
];

export class PageConfirmPayment extends Component {

    constructor(props) {
        super(props);
        this.state = {
            lampiran: null,
            hargaDeal: 0,
            submitProses: false,
            redirect: false,
            error: false,success: false
        }
    }

    handleSave = async () =>{
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
        data.append('idTransaksi', this.props.negosiasi.dataNegosiasiById.id_transaksi)
        data.append('status', 'pembayaran')
        data.append('idAdvertiser', this.props.negosiasi.dataNegosiasiById.idAdvertiser)
        data.append('idClient', this.props.negosiasi.dataNegosiasiById.idClient)
        this.setState({submitProses: true,})
        try{
            let response = await mainApi.post('/negosiasi/patchTransaksi', data, configJSON)
            if (response.status === 200) {
                window.open('https://api.whatsapp.com/send?phone='+this.props.negosiasi.dataNegosiasiById.telp+
                '&text=Terima Kasih '+this.props.negosiasi.dataNegosiasiById.namaAdvertiser+' Telah Menggunakan Jasa pasangbaliho.com. Silahkan Melanjutkan Proses negosiasi Materi dengan Admin Kami.', '_blank')
                
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
        await this.props.fetchNegosiasiAndSaldoById(id)
        await this.props.onMounted('Negosiasi')
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
        const {dataNegosiasiByIdFound, dataNegosiasiById} = this.props.negosiasi;
    
        if (pageLoading === true) {
            return(
                <div>
                    <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                    <Preloading textloading={pageLoadingStatus}/>
                </div>
            )
        }

        if (dataNegosiasiByIdFound !== true) {
            return(
                <div>
                    <h1>DATA NOT FOUND</h1>
                </div>
            )
        }

        if (this.state.redirect === true) {
            let url = '/dashboard/pembayaran/list';
            return <Redirect to={url} />
        }
        return(
            <div>
                <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                 <MBreadcumb items={breadcumbItems}/>
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
                        <Box flexGrow={1} display="flex" alignItems="center"><Icon fontSize='inherit'>face</Icon>&nbsp; Informasi Proses Pembayaran</Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>Advertiser</Box>
                                    <Box>:</Box>
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                                <Box>{dataNegosiasiById.namaAdvertiser}</Box>
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
                                <Box>{dataNegosiasiById.namaInstansi}</Box>
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
                                <Box>{dataNegosiasiById.email}</Box>
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
                                <Box>{dataNegosiasiById.telp}</Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>Tgl. Pengajuan Sewa</Box>
                                    <Box>:</Box>
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                                <Box>{`${dataNegosiasiById.tanggal_awal} s/d ${dataNegosiasiById.tanggal_akhir}`}</Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>Jenis Media</Box>
                                    <Box>:</Box>
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                                <Box>{dataNegosiasiById.kategori}</Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>Nama Media</Box>
                                    <Box>:</Box>
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                                <Box>{dataNegosiasiById.namaBaliho}</Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>Harga Kesepakatan</Box>
                                    <Box>:</Box>
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                                <Box>{dataNegosiasiById.harga_deal}</Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>Pembayaran</Box>
                                    <Box>:</Box>
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                                <Box>{dataNegosiasiById.Pembayaran}</Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>Saldo</Box>
                                    <Box>:</Box>
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                                <Box>{dataNegosiasiById.saldo}</Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>Status</Box>
                                    <Box>:</Box>
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={8}>
                                <Box>{dataNegosiasiById.paymentStatus}</Box>
                            </Grid>
                        </Grid>
                        <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                        <Box display="flex" justifyContent='flex-end' alignItems="center">
                            <Button variant="outlined" color="secondary" startIcon={<Icon>close</Icon>} onClick={this.handleSave}>
                                Cancel
                            </Button>
                            <Button variant="contained" color="primary" style={{marginLeft: '10px'}} startIcon={<Icon>check</Icon>} onClick={this.handleSave}>
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
        negosiasi: state.NegosiasiReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        prepareMount: bindActionCreators(prepareMount, dispatch),
        fetchNegosiasiAndSaldoById: bindActionCreators(fetchNegosiasiAndSaldoById, dispatch),
        postNegosiasi: bindActionCreators(postNegosiasi, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        prepareSearch: bindActionCreators(prepareSearch, dispatch),
        onSearched: bindActionCreators(onSearched, dispatch),
        redirectPage: bindActionCreators(redirectPage, dispatch),
    }
}

export default compose(
    withStyles(useStyles),
    connect(mapStateToProps, mapDispatcToProps) 
    )(PageConfirmPayment);

function Alert(props) {
    return <MuiAlert elevation={6} variant="filled" {...props} />;
}