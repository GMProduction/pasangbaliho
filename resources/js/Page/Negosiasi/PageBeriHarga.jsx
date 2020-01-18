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
import {fetchNegosiasiById, postNegosiasi} from '../../Actions/NegosiasiActions'; 
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


const style = {
    resize2: {
        fontSize: 14, 
        fontFamily: 'Roboto',
        height: 0
    },
    resize: {
        fontSize: 14, 
        fontFamily: 'Roboto Regular',
    },
    resize3: {
        fontSize: 14, 
        fontFamily: 'Roboto',
        height: 45
    },
    adornment:{
        marginRight: '-12px'
    },
}

const useStyles = theme => ({
    backdrop: {
        zIndex: theme.zIndex.drawer + 1,
        color: '#fff',
        },
});

const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Negosiasi', icon: 'question_answer', link:'/dashboard/negosiasi', active: false},
    {title: 'Daftar Negosiasi', icon: 'list',  active: true},
];

export class PageBeriHarga extends Component {

    constructor(props) {
        super(props);
        this.state = {
            lampiran: null,
            hargaDeal: 0,
            submitProses: false,
            redirect: false
        }
    }
    
    handleChangeLampiran = (e) => {
        if (e.target.files[0] !== undefined) {
            this.setState({
                [e.target.name]: e.target.files[0],
            }, () => {
                console.log(this.state.lampiran);
            })
            
        }else {
            this.setState({
                [e.target.name]: null
            })
        }
    }

    handleChange = (e) => {
        this.setState({
            [e.target.name]: e.target.value
        })
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
        let filter = this.props.filter;
        data.append('idTransaksi', this.props.negosiasi.dataNegosiasiById.id_transaksi)
        data.append('status', filter)
        data.append('idAdvertiser', this.props.negosiasi.dataNegosiasiById.idAdvertiser)
        data.append('idClient', this.props.negosiasi.dataNegosiasiById.idClient)
        if (filter === 'negoharga') {
            data.append('hargaDeal', this.state.hargaDeal)
        }
        this.setState({submitProses: true,})
        try{
            let response = await mainApi.post('/negosiasi/patchTransaksi', data, configJSON)
            if (response.status === 200) {
                if(this.props.filter === 'permintaan'){
                window.open('https://api.whatsapp.com/send?phone='+this.props.negosiasi.dataNegosiasiById.telp+
                '&text=Terima Kasih '+this.props.negosiasi.dataNegosiasiById.namaAdvertiser+' Telah Menggunakan Jasa pasangbaliho.com.Berikut Kami Kirimkan Lampiran Penawaran Harga Media Iklan yang Anda Inginkan.', '_blank')
                }
                if(this.props.filter === 'negoharga'){
                    window.open('https://api.whatsapp.com/send?phone='+this.props.negosiasi.dataNegosiasiById.telp+
                '&text=Terima Kasih '+this.props.negosiasi.dataNegosiasiById.namaAdvertiser+' Telah Menggunakan Jasa pasangbaliho.com.Berikut Adalah Harga Yang Telah Di Sepakati Rp. '+this.state.hargaDeal +' Media Iklan yang Anda Inginkan.', '_blank')
                }
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
        await this.props.fetchNegosiasiById(filter, id)
        await this.props.onMounted('Negosiasi')
    }

    componentWillUnmount () {
        this.props.redirectPage(false)
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

    render() {
        const { classes } = this.props;
        const {pageProgress, pageLoadingStatus, pageLoading, redirect} = this.props.page;
        const {dataNegosiasiByIdFound, dataNegosiasiById} = this.props.negosiasi;
        const filter = this.props.filter;
        let btnTitle = '', title = '';
        switch(filter){
            case 'permintaan' :
                btnTitle = 'Terima';
                title = 'Permintaan Harga';
                break;
            case 'negoharga' :
                btnTitle = 'Beri Kesapakatan Harga';
                title = 'Negosiasi Harga';
                break;
            case 'negomateri' :
                btnTitle = 'Submit';
                title = 'Negosiasi Materi';
                break;
            default:
                break;
        }

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
            let url = '/dashboard/negosiasi/permintaan';
            if (this.props.filter === 'negoharga') {
                url = '/dashboard/negosiasi/negoharga'
            }
            return <Redirect to={url} />
        }

        return (
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
                        <Box flexGrow={1} display="flex" alignItems="center"><Icon fontSize='inherit'>face</Icon>&nbsp; Informasi {title}</Box>
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
                        {
                            this.props.filter === 'negoharga' ?
                            <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={4}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex'>Harga Media Iklan</Box>
                                    <Box>:</Box>
                                </Box>
                            </Grid>
                                <Grid item xs={12} sm={12} md={12} lg={8}>
                                    <Box>{dataNegosiasiById.hargaMarket}</Box>
                                </Grid>
                            </Grid>
                            : ''
                        }
                        <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                        {
                            filter === 'permintaan' ?
                            <React.Fragment>
                                <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                            </React.Fragment>
                            :
                            <NumberFormat fullWidth InputProps={{style: style.resize, startAdornment: <InputAdornment position="start">Rp. </InputAdornment>}} InputLabelProps={{style: style.resize}} value={this.state.lebar} onValueChange={
                                (values) => {
                                    const {formattedValue, value} = values;
                                    this.setState({hargaDeal: formattedValue})
                                }
                            } customInput={TextField} label="Harga kesepakatan" margin="dense" variant="outlined" thousandSeparator={'.'} decimalSeparator=','/>
                        }
                        
                        <Box display="flex" justifyContent='flex-end' alignItems="center">
                            <Button variant="outlined" color="secondary" startIcon={<Icon>close</Icon>} onClick={this.handleSave}>
                                Tolak
                            </Button>
                            <Button variant="contained" color="primary" style={{marginLeft: '10px'}} startIcon={<Icon>check</Icon>} onClick={this.handleSave}>
                                {btnTitle}
                            </Button>
                        </Box>
                        </BasicPanelContent>
                    </BasicPanel>
                </Grid>
                    {/* <Grid item xs={12} sm={12} md={12} lg={6}>
                        <BasicPanel>
                            <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1} display="flex" alignItems="center"><Icon fontSize='inherit'>face</Icon>&nbsp; Informasi Ketersediaan Media</Box>
                            </BasicPanelHeader>
                            <BasicPanelContent>
                            
                            <Box fontSize={18} display='flex' justifyContent='center'>Baliho Ini Tersewa Pada Tanggal</Box>
                            <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                            {/* {
                                this.state.usedon.length > 0 ?
                            this.state.usedon.map((row, id) => {
                                return (
                                    <Box key={id} fontSize={14} fontWeight='bold'>{`- ${row.tanggal_awal} s/d ${row.tanggal_akhir}`}</Box>
                                )
                            }) : 
                                <Box display='flex' fontSize={14} justifyContent='center' fontWeight='bold'>Tidak Ada Penyewa</Box>
                            } */}
                            {/* <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                            </BasicPanelContent>
                        </BasicPanel>
                    </Grid> */} 
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
        fetchNegosiasiById: bindActionCreators(fetchNegosiasiById, dispatch),
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
    )(PageBeriHarga);

    function Alert(props) {
        return <MuiAlert elevation={6} variant="filled" {...props} />;
}