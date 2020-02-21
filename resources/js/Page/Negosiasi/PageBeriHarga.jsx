import React, { Component } from 'react';
import { Redirect } from 'react-router'
import Icon from '@material-ui/core/Icon';
import Box from '@material-ui/core/Box';
import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import NumberTextfield from '../../components/Material-UI/Textfield/NumberTextfield';
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
import PageNoData from '../../components/Material-UI/PageInfo/PageNoData';
import {fetchNegosiasiById, patchNegosiasi} from '../../Actions/NegosiasiActions'; 
import {fetchMediaUsedById} from '../../Actions/MediaIklanActions'; 
import {prepareMount, pageOnProgress, onMounted, onSubmit, onNotify} from '../../Actions/pageActions';


import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';
import {dateFormater, formatAngka} from '../../Controller/Helper'



const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Negosiasi', icon: 'question_answer', link:'/dashboard/negosiasi', active: false},
    {title: 'Daftar Permintaan', icon: 'list',  active: true},
];

export class PageBeriHarga extends Component {

    constructor(props) {
        super(props);
        this.state = {
            hargaDeal: 0,
            redirect: false,
            batal: false,
            keterangan: ''
        }
    }
    

    handleChange = (e) => {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    handleCancel = () => {
        this.setState({batal: !this.state.batal})
    }

     handleSave = async (cancel) =>{
        let data = new FormData();
        let filter = this.props.filter;
        data.append('idTransaksi', this.props.negosiasi.dataNegosiasiById.id_transaksi)
        if (cancel) {
            data.append('status', 'batal')
            data.append('keterangan', this.state.keterangan)
        }else{
            data.append('status', filter)
        }
        data.append('idAdvertiser', this.props.negosiasi.dataNegosiasiById.idAdvertiser)
        data.append('idClient', this.props.negosiasi.dataNegosiasiById.idClient)
        if (filter === 'negoharga') {
            data.append('hargaDeal', this.state.hargaDeal)
        }
        this.props.onSubmit(true, 'Mohon Tunggu sSebentar....')
            let response = await this.props.patchNegosiasi(data)
            if (response.status === 'success') {
                let text = ''
                if (this.props.filter === 'permintaan') {
                    if(cancel){
                        text = 'Mohon Maaf Permintaan Penawaran Anda Kami Batalkan. Di Karenakan' + this.state.keterangan;
                    }else{
                        text = 'Permintaan Penawaran Anda Telah Kami Terima, berikut kami Kirimkan Lampiran Penawaran Media Iklan yang Anda Inginkan. '
                    }
                }

                if (this.props.filter === 'negoharga') {
                    if(cancel){
                        text = 'Mohon Maaf Negosiasi Harga Kami Batalkan. Di Karenakan' + this.state.keterangan
                    }else{
                        text = 'Permintaan Negosiasi Harga Anda Telah Kami Terima. Berikut Adalah Harga Yang Telah Di Sepakati Rp. '+this.state.hargaDeal +' dari Media Iklan yang Anda Inginkan.'
                    }
                }
                
                window.open('https://api.whatsapp.com/send?phone='+this.props.negosiasi.dataNegosiasiById.telp+
                '&text='+text+'. Terima Kasih '+this.props.negosiasi.dataNegosiasiById.namaAdvertiser+' Telah Menggunakan Jasa pasangbaliho.com.', '_blank')
                
                this.props.onNotify(true, 'success', 'Berhasail Dalam proses Penyimpanan Data')
                this.setState({
                    redirect: true
                })
            }else{
                this.props.onNotify(true, 'error', 'Gagal Dalam proses Penyimpanan Data')
            }
        this.props.onSubmit(false, '')
    }

    async componentDidMount () {
        let id = this.props.match.params.id;
        let filter = this.props.filter;
        await this.props.prepareMount()
        await this.props.pageOnProgress(30, 'Sedang Melakukan Fetch Data...')
        await this.props.fetchNegosiasiById(filter, id)
        if(this.props.negosiasi.dataNegosiasiById !== null){
            await this.props.fetchMediaUsedById(this.props.negosiasi.dataNegosiasiById.idBaliho)
        }
        await this.props.onMounted('Negosiasi')
    }


    render() {
        const {pageProgress, pageLoadingStatus, pageLoading} = this.props.page;
        const {dataNegosiasiByIdFound, dataNegosiasiById} = this.props.negosiasi;
        const {dataMediaUsage} = this.props.media;
        const filter = this.props.filter;

        let btnTitle = '', title = '';
        switch(filter){
            case 'permintaan' :
                btnTitle = 'Terima';
                title = 'PERMINTAAN HARGA';
                break;
            case 'negoharga' :
                btnTitle = 'Kirim Harga';
                title = 'PERMINTAAN HARGA';
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
                    <PageNoData/>
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
                <Fade bottom>
                <Grid container justify='center' spacing={2}>
                <Grid item xs={12} sm={12} md={12} lg={10}>
                    <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                        <Box flexGrow={1} display="flex" alignItems="center">INFORMASI {title}</Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                        <Box fontWeight='Bold' fontSize={26} display='flex' justifyContent='flex-end'>
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
                                <Box fontWeight='Bold'>Mitra Penyedia :</Box>
                                <Box fontWeight={300}>{dataNegosiasiById.namaClient}</Box>
                                <Box fontWeight={300}>{dataNegosiasiById.emailClient}</Box>
                                <Box fontWeight={300}>{`(+)${dataNegosiasiById.telpClient}`}</Box>
                            </Grid>
                        </Grid>
                        <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                        <Box style={{ backgroundColor: '#EEEEEE', marginBottom: '15px', padding: '15px', borderStyle: 'solid', borderWidth: '1px', borderRadius: '5px', borderColor: 'grey'}}>
                            <Box display='flex' justifyContent='center' fontWeight='Bold'>
                                INFORMASI PERMOHONAN
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
                                    Tanggal Penyewaan
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
                        <Box style={{ backgroundColor: '#EEEEEE', marginBottom: '15px', padding: '15px', borderStyle: 'solid', borderWidth: '1px', borderRadius: '5px', borderColor: 'grey'}}>
                            <Box display='flex' justifyContent='center' fontWeight='Bold'>
                                Media Ini Tersewa Pada Tanggal
                            </Box>
                            {
                                dataMediaUsage.length > 0 ?
                                dataMediaUsage.map((row, id) => {
                                return (
                                    <Box key={id} display='flex' justifyContent='center' fontSize={14} fontWeight='bold'>{`${dateFormater(row.tanggal_awal)} s/d ${dateFormater(row.tanggal_akhir)}`}</Box>
                                )
                            }) : 
                                <Box display='flex' fontSize={14} justifyContent='center' fontWeight='bold'>- Tidak Ada Penyewa -</Box>
                            } 
                        </Box>
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
                        {
                            filter === 'permintaan' ?
                            ''
                            :
                            <React.Fragment>
                            <Grid container spacing={1}>
                                <Grid item xs={12} sm={12} md={8} lg={6}></Grid>
                                <Grid item xs={12} sm={12} md={4} lg={6}>
                                <Box display='flex' alignItems='center' justifyContent='flex-end'>
                                    <Box fontWeight='Bold' fontSize={16} style={{marginRight: '15px'}}>
                                    Kesepakatan Harga : 
                                    </Box>
                                    <Box>
                                    <NumberTextfield InputProps={{startAdornment: <InputAdornment position="start">Rp.</InputAdornment>}} value={this.state.hargaDeal} onChange={
                                        (values) => {
                                            const {formattedValue, value} = values;
                                            this.setState({hargaDeal: formattedValue})
                                        }
                                    }/>
                                    </Box>
                                </Box>
                                </Grid>
                            </Grid>
                            <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                            </React.Fragment>
                        }

                        
                        
                        <Box display="flex" justifyContent='flex-end' alignItems="center">
                            <Button variant="outlined" color="secondary" startIcon={<Icon>close</Icon>} onClick={this.handleCancel}>
                                {this.state.batal ? 'Batal' : 'Tolak'}
                            </Button>
                            <Button variant="contained" color="primary" style={{marginLeft: '10px'}} startIcon={<Icon>check</Icon>} onClick={() => this.handleSave(this.state.batal)}>
                                {this.state.batal ? 'Tolak' : btnTitle }
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
        page: state.PageReducer,
        negosiasi: state.NegosiasiReducer,
        media: state.MediaIklanReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        prepareMount: bindActionCreators(prepareMount, dispatch),
        pageOnProgress: bindActionCreators(pageOnProgress, dispatch),
        fetchNegosiasiById: bindActionCreators(fetchNegosiasiById, dispatch),
        patchNegosiasi: bindActionCreators(patchNegosiasi, dispatch),
        fetchMediaUsedById: bindActionCreators(fetchMediaUsedById, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        onSubmit: bindActionCreators(onSubmit, dispatch),
        onNotify: bindActionCreators(onNotify, dispatch),
    }
}

export default compose(
    connect(mapStateToProps, mapDispatcToProps) 
    )(PageBeriHarga);
