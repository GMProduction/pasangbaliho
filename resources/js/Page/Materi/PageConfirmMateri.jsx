import React, {Component} from 'react'
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
import InputAdornment from '@material-ui/core/InputAdornment';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import PageNoData from '../../components/Material-UI/PageInfo/PageNoData';
import {fetchNegosiasiAndSaldoById, patchNegosiasi} from '../../Actions/NegosiasiActions'; 
import {prepareMount, pageOnProgress, onMounted, prepareSearch, onSearched, onSubmit, onNotify} from '../../Actions/pageActions';

import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';
import {dateFormater, formatAngka} from '../../Controller/Helper';

const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Materi', icon: 'payment', link:'/dashboard/materi', active: false},
    {title: 'Detail', icon: 'list',  active: true},
];

export class PageConfirmMateri extends Component {

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
        data.append('idTransaksi', this.props.negosiasi.dataNegosiasiById.id_transaksi)
        if(cancel){
            data.append('status', 'batal')
            data.append('keterangan', this.state.keterangan)
        }else{
            data.append('status', 'negomateri')
        }
        data.append('idAdvertiser', this.props.negosiasi.dataNegosiasiById.idAdvertiser)
        data.append('idClient', this.props.negosiasi.dataNegosiasiById.idClient)
        let response = await this.props.patchNegosiasi(data)
        if (response.status === 'success'){
            let text = ''
            if(cancel){
                text = 'Mohon Maaf Transaksi Anda Kami Batalkan, di Karenakan '+this.state.keterangan
            }else{
                text = 'Transaksi Anda Sudah Selesai. Media Iklan Anda Akan Segera Kami Pasang'
            }

            if (this.state.notif){
                window.open('https://api.whatsapp.com/send?phone='+this.props.negosiasi.dataNegosiasiById.telp+
            '&text='+text+'. Terima Kasih '+this.props.negosiasi.dataNegosiasiById.namaAdvertiser+' Telah Menggunakan Jasa pasangbaliho.com', '_blank')
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
        await this.props.prepareMount()
        await this.props.pageOnProgress(30, 'Sedang Melakukan Fetch Data...')
        await this.props.fetchNegosiasiAndSaldoById(id)
        await this.props.onMounted('Materi Iklan')
    }

    render(){

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
                    <PageNoData/>
                </div>
            )
        }

        if (this.state.redirect === true) {
            let url = '/dashboard/materi';
            return <Redirect to={url} />
        }

        return(
            <div>
                <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                <MBreadcumb items={breadcumbItems}/>
                <Fade bottom>
                <Grid container justify='center' spacing={2}>
                <Grid item xs={12} sm={12} md={12} lg={10}>
                    <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1} display="flex" alignItems="center">DETAIL PERMOHONAN</Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                        <Box style={{marginBottom: '15px'}} fontWeight='Bold' fontSize={26} display='flex' justifyContent='flex-end'>
                            {`Transaksi #${dataNegosiasiById.id_transaksi}`}
                        </Box>
                        <Grid container spacing={1}>
                            <Grid item xs={12} sm={12} md={6} lg={6}>
                                <Box fontWeight='Bold'>Pemohon :</Box>
                                <Box fontWeight={300}>{dataNegosiasiById.namaInstansi}</Box>
                                <Box fontWeight={300}>{dataNegosiasiById.namaAdvertiser}</Box>
                                <Box fontWeight={300}>{dataNegosiasiById.alamat}</Box>
                                <Box fontWeight={300}>{dataNegosiasiById.email}</Box>
                                <Box fontWeight={300}>{`(+)${dataNegosiasiById.telp}`}</Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={6} lg={6}>
                                <Box style={{paddingRight: '20px'}} display='flex' justifyContent='flex-end' alignItems='center'>
                                <img src={dataNegosiasiById.paymentStatus === 'Lunas' ? `/assets/properties/paid.png` : `/assets/properties/unpaid.png`} height="100"></img>
                                </Box>
                            </Grid>
                        </Grid>
                        <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                        <Box style={{ backgroundColor: '#EEEEEE', marginBottom: '15px', padding: '15px', borderStyle: 'solid', borderWidth: '1px', borderRadius: '5px', borderColor: 'grey'}}>
                            <Box display='flex' justifyContent='center' fontWeight='Bold'>
                                INFORMASI PEMAKAIAN
                            </Box>
                            <Grid container spacing={1}>
                                <Grid item xs={12} md={3} sm={3} lg={3}>
                                    Tgl. Pengajuan
                                </Grid>
                                <Grid item xs={12} md={8} sm={8} lg={8}>
                                    {`: ${dateFormater(dataNegosiasiById.tanggal_transaksi)}`}
                                </Grid>
                            </Grid>
                            <Grid container spacing={1}>
                                <Grid item xs={12} md={3} sm={3} lg={3}>
                                    Jenis Media
                                </Grid>
                                <Grid item xs={12} md={8} sm={8} lg={8}>
                                    {`: ${dataNegosiasiById.kategori}`}
                                </Grid>
                            </Grid>
                            <Grid container spacing={1}>
                            <Grid item xs={12} md={3} sm={3} lg={3}>
                                    Nama Media
                                </Grid>
                                <Grid item xs={12} md={8} sm={8} lg={8}>
                                    {`: ${dataNegosiasiById.namaBaliho}`}
                                </Grid>
                            </Grid>
                            <Grid container spacing={1}>
                            <Grid item xs={12} md={3} sm={3} lg={3}>
                                    Tgl. Pemakaian
                                </Grid>
                                <Grid item xs={12} md={8} sm={8} lg={8}>
                                {`: ${dateFormater(dataNegosiasiById.tanggal_awal)} Sampai Dengan ${dateFormater(dataNegosiasiById.tanggal_akhir)}`}
                                </Grid>
                            </Grid>
                            {
                                dataNegosiasiById.tampilHarga !== 'tidak terlihat' ?
                                    <Grid container spacing={1}>
                                    <Grid item xs={12} sm={3} md={3} lg={3}>
                                            Kisaran Harga
                                    </Grid>
                                    <Grid item xs={12} sm={8} md={8} lg={8}>
                                        {dataNegosiasiById.tampilHarga !== 'range' ?
                                            ': Rp. '+formatAngka(dataNegosiasiById.hargaMarket)
                                            :
                                            ': Rp. '+formatAngka(dataNegosiasiById.hargaMarket)+ ' - Rp. '+ formatAngka(dataNegosiasiById.hargaMax)
                                        }
                                    </Grid>
                                    </Grid>
                                : 'Negosiasi Dengan Admin'
                            }
                        </Box>
                        <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                        {
                            this.state.batal ? 
                            <React.Fragment>
                                <TextField name='keterangan' id="keterangan" label="Keterangan Pembatalan" margin="dense" variant="outlined" fullWidth multiline rows="5"
                            value={this.state.keterangan} onChange={this.handleChange}/>
                            <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                            </React.Fragment>
                            :
                            ''
                        }
                        <Grid container spacing={1}>
                            <Grid item xs={12} sm={12} md={6} lg={6}></Grid>
                            <Grid item xs={12} sm={12} md={3} lg={3}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex' fontWeight='bold' fontSize={16}>Harga Kesepakatan</Box>
                                    <Box>:</Box>
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={3} lg={3}>
                                <Box display='flex' fontWeight='bold' fontSize={16}>
                                    <Box flexGrow={1}>Rp.</Box>
                                    <Box justifyContent='flex-end'>{`${formatAngka(dataNegosiasiById.harga_deal)}`}</Box>
                                </Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={1}>
                            <Grid item xs={12} sm={12} md={6} lg={6}></Grid>
                            <Grid item xs={12} sm={12} md={3} lg={3}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex' fontWeight='bold' fontSize={16}>Pembayaran</Box>
                                    <Box>:</Box>
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={3} lg={3}>
                                <Box display='flex' fontWeight='bold' fontSize={16}>
                                    <Box flexGrow={1}>Rp.</Box>
                                    <Box justifyContent='flex-end'>{`${formatAngka(dataNegosiasiById.Pembayaran)}`}</Box>
                                </Box>
                            </Grid>
                        </Grid>
                        <Grid container spacing={1}>
                            <Grid item xs={12} sm={12} md={6} lg={6}></Grid>
                            <Grid item xs={12} sm={12} md={3} lg={3}>
                                <Box display='flex'>
                                    <Box flexGrow={1} display='flex' fontWeight='bold' fontSize={16}>Saldo</Box>
                                    <Box>:</Box>
                                </Box>
                            </Grid>
                            <Grid item xs={12} sm={12} md={3} lg={3}>
                                <Box display='flex' fontWeight='bold' fontSize={16}>
                                    <Box flexGrow={1}>Rp.</Box>
                                    <Box justifyContent='flex-end'>{`${formatAngka(dataNegosiasiById.saldo)}`}</Box>
                                </Box>
                                
                            </Grid>
                        </Grid>
                        <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                        <Box display="flex" justifyContent='flex-end' alignItems="center">
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
                                    Cancel
                                </Button>
                                <Button variant="contained" color="primary" style={{marginLeft: '10px'}} startIcon={<Icon>check</Icon>} onClick={() => this.handleSave(this.state.batal)}>
                                    Submit
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
        negosiasi: state.NegosiasiReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        prepareMount: bindActionCreators(prepareMount, dispatch),
        pageOnProgress: bindActionCreators(pageOnProgress, dispatch),
        fetchNegosiasiAndSaldoById: bindActionCreators(fetchNegosiasiAndSaldoById, dispatch),
        patchNegosiasi: bindActionCreators(patchNegosiasi, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        prepareSearch: bindActionCreators(prepareSearch, dispatch),
        onSearched: bindActionCreators(onSearched, dispatch),
        onSubmit: bindActionCreators(onSubmit, dispatch),
        onNotify: bindActionCreators(onNotify, dispatch),
    }
}

export default compose(
    connect(mapStateToProps, mapDispatcToProps) 
    )(PageConfirmMateri);
