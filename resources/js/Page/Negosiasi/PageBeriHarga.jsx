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
import {prepareMount, onMounted, prepareSearch, onSearched, prepareSubmit, onSubmit, fetchNegosiasiById, postNegosiasi} from '../../Actions/NegosiasiActions'; 
import {redirectPage } from '../../Actions/pageActions';

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

export class PageBeriHarga extends Component {

    constructor(props) {
        super(props);
        this.state = {
            lampiran: null,
            hargaDeal: 0,
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
        let data = new FormData();
        let data2 = new FormData();
        let filter = this.props.filter;
        data.append('idTransaksi', this.props.negosiasi.dataNegosiasiById.id_transaksi)
        data.append('status', filter)
        data.append('idAdvertiser', this.props.negosiasi.dataNegosiasiById.idAdvertiser)
        data.append('idClient', this.props.negosiasi.dataNegosiasiById.idClient)
        data2.append('lampiran', this.state.lampiran)
        if (filter === 'negoharga') {
            data.append('hargaDeal', this.state.hargaDeal)
        }
        await this.props.prepareSubmit()
        await this.props.postNegosiasi(data, data2, filter)
        await this.props.onSubmit()
    }

    async componentDidMount () {
        let id = this.props.match.params.id;
        let filter = this.props.filter;
        await this.props.prepareMount()
        await this.props.fetchNegosiasiById(filter, id)
        await this.props.onMounted()
        console.log(this.props)
    }

    componentWillUnmount () {
        this.props.redirectPage(false)
    }

    render() {
        const {pageProgress, pageLoadingStatus, pageLoading, redirect} = this.props.page;
        const {dataNegosiasiByIdFound, dataNegosiasiById} = this.props.negosiasi;
        const filter = this.props.filter;
        let btnTitle = '', title = '';
        switch(filter){
            case 'permintaan' :
                btnTitle = 'Kirim Penawaran';
                title = 'Permintaan Harga';
                break;
            case 'negoharga' :
                btnTitle = 'Kirim Kesapakatan Harga';
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
                    <h1>NOT FOUND</h1>
                </div>
            )
        }

        if (redirect === true) {
            let url = '/negosiasi';
            if (this.props.filter === 'permintaan') {
                url = '/negosiasi/permintaan'
            }else if(this.props.filter === 'negoharga'){
                url = '/negosiasi/negoharga'
            }
            return <Redirect to={url} />
        }
        
        return (
            <div>
                 <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                
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
                        <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                        {
                            filter === 'permintaan' ?
                            <React.Fragment>
                                <input accept=".doc, .docx, .pdf, .xls, .xlsx" style={{display: 'none'}} id="lampiran" type="file" name='lampiran'
                                onChange={this.handleChangeLampiran}
                                />
                                <label htmlFor="lampiran">
                                    <TextField disabled label="Lampiran Penawaran" variant="outlined" margin="dense" fullWidth
                                        InputProps={{style: style.resize,
                                            endAdornment: <InputAdornment position="end" style={style.adornment}>
                                                <Button style={style.resize} component="span">Browse</Button>
                                            </InputAdornment>
                                        }} InputLabelProps={{style: style.resize}}
                                        value={this.state.lampiran !== null ? this.state.lampiran.name : ''}/>
                                </label>
                                <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                            </React.Fragment>
                            :
                            <TextField name='hargaDeal' id='hargaDeal' label="Harga Kesepakatan" margin="dense" variant="outlined" fullWidth type='number'
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.hargaDeal} onChange={this.handleChange}/>
                        }
                        
                        <Box display="flex" justifyContent='flex-end' alignItems="center">
                            <Button variant="contained" color="secondary" startIcon={<Icon>close</Icon>} onClick={this.handleSave}>
                                Tolak
                            </Button>
                            <Button variant="outlined" color="primary" style={{marginLeft: '10px'}} startIcon={<Icon>check</Icon>} onClick={this.handleSave}>
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
        prepareSubmit: bindActionCreators(prepareSubmit, dispatch),
        onSubmit: bindActionCreators(onSubmit, dispatch),
        redirectPage: bindActionCreators(redirectPage, dispatch),
    }
}

export default compose(
    connect(mapStateToProps, mapDispatcToProps) 
    )(PageBeriHarga);
