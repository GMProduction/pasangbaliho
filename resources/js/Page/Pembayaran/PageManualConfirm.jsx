import React, { Component } from 'react';
import { Redirect } from 'react-router'
import Icon from '@material-ui/core/Icon';
import Box from '@material-ui/core/Box';
import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import TextField from '@material-ui/core/TextField';
import Checkbox from '@material-ui/core/Checkbox';
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import Grid from '@material-ui/core/Grid';
import { Divider } from '@material-ui/core';
import Button from '@material-ui/core/Button';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import PageNoData from '../../components/Material-UI/PageInfo/PageNoData';
import {fetchPaymentById, patchPayment} from '../../Actions/PaymentActions'; 
import {prepareMount, pageOnProgress, onMounted, onSubmit, onNotify} from '../../Actions/pageActions';
import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';
import {dateFormater, formatAngka} from '../../Controller/Helper';


const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'pembayaran', icon: 'payment', link:'/dashboard/pembayaran', active: false},
    {title: 'Data Transfer', icon: 'list',  active: true},
];

export class PageManualConfirm extends Component{

    constructor(props) {
        super(props);
        this.state = {
            redirect: false,
            batal: false,
            notif: true,
            keterangan: ''
        }
    }

    handleChange = (e) => {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    handleNotif = (e) => {
        this.setState({notif: !this.state.notif})
    }

    handleCancel = () => {
        this.setState({batal: !this.state.batal})
    }

    handleSave = async (cancel) =>{
        this.props.onSubmit(true, 'Sedang Menyimpan Data...')
        let data = new FormData();
        data.append('id', this.props.payment.dataPaymentById.id)
        if(cancel) {
            data.append('status', 'tolak')
            data.append('keterangan', this.state.keterangan)
        }else{
            data.append('status', 'terima')
            data.append('keterangan', 'Pembayaran Sukses')
        }
        let response = await this.props.patchPayment(data)
            if (response.status === 'success') {
                let text = ''
                if(cancel){
                    text = 'Mohon Maaf Pembayaran Tidak Valid. Di Karenakan ' + this.state.keterangan+'. ';
                } else {
                    text = 'Pembayaran Dengan No. Rekening '+this.props.payment.dataPaymentById.no_rekening+' Atas Nama '+this.props.payment.dataPaymentById.atas_nama+' Sudah Kami Konfirmasi. '
                }
                if(this.state.notif){
                    window.open('https://api.whatsapp.com/send?phone='+this.props.payment.dataPaymentById.telp+
                    '&text='+text+'Terima Kasih '+this.props.payment.dataPaymentById.namaAdvertiser+' Telah Menggunakan Jasa pasangbaliho.com.', '_blank')
                }
                
                this.props.onNotify(true, 'success', 'Berhasil Menyimpan Data')
                this.setState({
                    redirect: true
                })
            }else{
                this.props.onNotify(true, 'error', 'Gagal Menyimpan Data')
            }
        this.props.onSubmit(false, '')
    }

    async componentDidMount () {
        let id = this.props.match.params.id;
        let filter = this.props.filter;
        await this.props.prepareMount()
        await this.props.pageOnProgress(30, 'Sedang Melakukan Fetch Data...')
        await this.props.fetchPaymentById('pending','Manual Payment', id)
        await this.props.onMounted('Pembayaran')
    }

    render(){
        const { classes } = this.props;
        const {pageProgress, pageLoadingStatus, pageLoading, redirect} = this.props.page;
        const {dataPaymentById, dataPaymentByIdFound} = this.props.payment;
        console.log(dataPaymentById)
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
                    <PageNoData/>
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
                <MBreadcumb items={breadcumbItems}/>
                <Fade bottom>
                    <Grid container justify='center' spacing={2}>
                    <Grid item xs={12} sm={12} md={12} lg={8}>
                    <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1} display="flex" alignItems="center">INFORMASI PEMBAYARAN</Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                        <Box style={{marginBottom: '15px'}} fontWeight='Bold' fontSize={26} display='flex' justifyContent='flex-end'>
                            {`Transaksi #${dataPaymentById.idTransaksi}`}
                        </Box>
                        <Grid container spacing={1}>
                            <Grid item xs={12} sm={12} md={6} lg={6}>
                                <Box fontWeight='Bold'>Pemohon :</Box>
                                <Box fontWeight={300}>{dataPaymentById.namaInstansi}</Box>
                                <Box fontWeight={300}>{dataPaymentById.namaAdvertiser}</Box>
                                <Box fontWeight={300}>{dataPaymentById.alamat}</Box>
                                <Box fontWeight={300}>{dataPaymentById.email}</Box>
                                <Box fontWeight={300}>{`(+)${dataPaymentById.telp}`}</Box>
                            </Grid>
                        </Grid>
                        <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                        <Box style={{ backgroundColor: '#EEEEEE', marginBottom: '15px', padding: '15px', borderStyle: 'solid', borderWidth: '1px', borderRadius: '5px', borderColor: 'grey'}}>
                            <Box display='flex' justifyContent='center' fontWeight='Bold'>
                                INFORMASI PEMBAYARAN
                            </Box>
                            <Grid container spacing={1}>
                                <Grid item xs={12} md={3} sm={3} lg={3}>
                                    Vendor
                                </Grid>
                                <Grid item xs={12} md={8} sm={8} lg={8}>
                                    {`: ${dataPaymentById.vendor}`}
                                </Grid>
                            </Grid>
                            <Grid container spacing={1}>
                                <Grid item xs={12} md={3} sm={3} lg={3}>
                                    No. Rekening
                                </Grid>
                                <Grid item xs={12} md={8} sm={8} lg={8}>
                                    {`: ${dataPaymentById.no_rekening}`}
                                </Grid>
                            </Grid>
                            <Grid container spacing={1}>
                                <Grid item xs={12} md={3} sm={3} lg={3}>
                                    Atas Nama
                                </Grid>
                                <Grid item xs={12} md={8} sm={8} lg={8}>
                                    {`: ${dataPaymentById.atas_nama}`}
                                </Grid>
                            </Grid>
                            <Grid container spacing={1}>
                                <Grid item xs={12} md={3} sm={3} lg={3}>
                                    Vendor
                                </Grid>
                                <Grid item xs={12} md={8} sm={8} lg={8}>
                                    {`: Rp. ${formatAngka(dataPaymentById.nominal)}`}
                                </Grid>
                            </Grid>
                        </Box>
                        
                        {
                            this.state.batal ? 
                            <TextField name='keterangan' id="keterangan" label="Keterangan Pembatalan" margin="dense" variant="outlined" fullWidth multiline rows="5"
                            value={this.state.keterangan} onChange={this.handleChange}/>
                            :
                            ''
                        }
                        
                        <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                        <Box display="flex" justifyContent='flex-start' alignItems="center">
                            <Box flexGrow={1}>
                            <Checkbox
                                name='notif'
                                checked={this.state.notif}
                                onChange={this.handleNotif}
                                value="secondary"
                                inputProps={{ 'aria-label': 'secondary checkbox' }}
                            />
                            Kirim Pemberitahuan Ke Whatsapp
                            </Box>
                            <Box>
                                <Button variant="outlined" color="secondary" startIcon={<Icon>close</Icon>} onClick={this.handleCancel}>
                                {this.state.batal ? 'Batal' : 'Tolak'}
                                </Button>
                                <Button variant="contained" color="primary" style={{marginLeft: '10px'}} startIcon={<Icon>check</Icon>} onClick={() => this.handleSave(this.state.batal)}>
                                {this.state.batal ? 'Tolak' : 'Submit   ' }
                                </Button>
                            </Box>
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
        page: state.PageReducer,
        payment: state.PaymentReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        prepareMount: bindActionCreators(prepareMount, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        pageOnProgress: bindActionCreators(pageOnProgress, dispatch),
        onSubmit: bindActionCreators(onSubmit, dispatch),
        onNotify: bindActionCreators(onNotify, dispatch),
        fetchPaymentById: bindActionCreators(fetchPaymentById, dispatch),
        patchPayment: bindActionCreators(patchPayment, dispatch),
    }
}

export default compose(
    connect(mapStateToProps, mapDispatcToProps) 
    )(PageManualConfirm);
