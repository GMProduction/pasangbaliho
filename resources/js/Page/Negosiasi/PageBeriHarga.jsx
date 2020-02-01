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
import {fetchNegosiasiById, patchNegosiasi} from '../../Actions/NegosiasiActions'; 
import {fetchMediaUsedById} from '../../Actions/MediaIklanActions'; 
import {prepareMount, pageOnProgress, onMounted, onSubmit, onNotify} from '../../Actions/pageActions';
import {withStyles} from '@material-ui/core';

import {mainApi} from '../../Controller/APIControll';
import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';

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
        await this.props.fetchNegosiasiById(filter, id)
        await this.props.fetchMediaUsedById(this.props.negosiasi.dataNegosiasiById.idBaliho)
        await this.props.onMounted('Negosiasi')
    }


    render() {
        const { classes } = this.props;
        const {pageProgress, pageLoadingStatus, pageLoading, redirect} = this.props.page;
        const {dataNegosiasiByIdFound, dataNegosiasiById} = this.props.negosiasi;
        const {dataMediaUsage} = this.props.media;
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
                            <NumberTextfield InputProps={{startAdornment: <InputAdornment position="start">Rp.</InputAdornment>}} value={this.state.hargaClient} onChange={
                                (values) => {
                                    const {formattedValue, value} = values;
                                    this.setState({hargaDeal: formattedValue})
                                }
                            }/>
                        }

                        {
                            this.state.batal ? 
                            <TextField name='keterangan' id="keterangan" label="Keterangan Pembatalan" margin="dense" variant="outlined" fullWidth multiline rows="5"
                            value={this.state.keterangan} onChange={this.handleChange}/>
                            :
                            ''
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
                    <Grid item xs={12} sm={12} md={12} lg={4}>
                        <BasicPanel>
                            <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1} display="flex" alignItems="center"><Icon fontSize='inherit'>face</Icon>&nbsp; Informasi Ketersediaan Media</Box>
                            </BasicPanelHeader>
                            <BasicPanelContent>
                            
                            <Box fontSize={18} display='flex' justifyContent='center'>Baliho Ini Tersewa Pada Tanggal</Box>
                            <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                             {
                                dataMediaUsage.length > 0 ?
                                dataMediaUsage.map((row, id) => {
                                return (
                                    <Box key={id} fontSize={14} fontWeight='bold'>{`- ${row.tanggal_awal} s/d ${row.tanggal_akhir}`}</Box>
                                )
                            }) : 
                                <Box display='flex' fontSize={14} justifyContent='center' fontWeight='bold'>Tidak Ada Penyewa</Box>
                            } 
                             <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
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
        fetchNegosiasiById: bindActionCreators(fetchNegosiasiById, dispatch),
        patchNegosiasi: bindActionCreators(patchNegosiasi, dispatch),
        fetchMediaUsedById: bindActionCreators(fetchMediaUsedById, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        onSubmit: bindActionCreators(onSubmit, dispatch),
        onNotify: bindActionCreators(onNotify, dispatch),
    }
}

export default compose(
    withStyles(useStyles),
    connect(mapStateToProps, mapDispatcToProps) 
    )(PageBeriHarga);

    function Alert(props) {
        return <MuiAlert elevation={6} variant="filled" {...props} />;
}